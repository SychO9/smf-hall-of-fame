<?php
/**
 * @package SMF Hall Of Fame (HOF)
 * @author SychO (M.S) https://github.com/SychO9
 * @version 1.3
 * @license Copyright 2020
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 */

// First of all, we make sure we are accessing the source file via SMF so that people can not directly access the file.
if (!defined('SMF'))
	die('Hack Attempt...');

/**
 * Main Function.
 */
function Hof()
{
	global $context, $scripturl, $txt, $smcFunc, $settings, $modSettings;

	// Which version is this ?
	$context['is_two_point_one'] = true;
	if (!defined('SMF_VERSION') || (defined('SMF_VERSION') && strpos(SMF_VERSION, '2.1') === false))
		$context['is_two_point_one'] = false;

	// Load the css file, only in 2.0, 2.1 uses a hook to load the css file called by integrate_pre_css_output
	if (!$context['is_two_point_one'])
		$context['html_headers'] = $context['html_headers'].'<link rel="stylesheet" type="text/css" href="'.$settings['default_theme_url'].'/css/hof.css" /><link rel="stylesheet" type="text/css" href="'.$settings['default_theme_url'].'/css/admin.css?fin20" />';

	// Template, Language
	loadTemplate('Hof');

	// Seriously where am I ?
	$context['page_title'] = !empty($modSettings['hof_globalTitle']) ? $modSettings['hof_globalTitle'] : $txt['hof_PageTitle'];
	$context['page_title_html_safe'] = $smcFunc['htmlspecialchars'](un_htmlspecialchars($context['page_title']));
	$context['linktree'][] = array(
		'url' => $scripturl. '?action=hof',
		'name' => !empty($modSettings['hof_globalTitle']) ? $modSettings['hof_globalTitle'] : $txt['hof_PageTitle'],
	);

	// SubActions
	$subActions = array(
		'admin' => 'HofSettings',
		'edit' => 'editClass',
		'add_class' => 'addClass',
		'remove_class' => 'removeClass',
		'update_class' => 'updateClass',
		'add_famer' => 'addFamer',
		'remove_famer' => 'removeFamer',
		'hofeditSettings' => 'hofeditSettings',
	);

	// Take Me To The SubAction ?
	$sa = !empty($_GET['sa']) ? $smcFunc['htmlspecialchars']($_GET['sa'], ENT_QUOTES) : '';
	if (!empty($sa) && !empty($subActions[$sa]))
		$subActions[$sa]();
	else
		ViewHof();
}

/**
 * Add a Class
 */
function addClass()
{
	global $smcFunc;

	// Are you allowed to be here sir ?
	isAllowedTo('admin_forum');

	// Sanitize posted data
	$title = !empty($_POST['title']) ? $smcFunc['htmlspecialchars']($_POST['title'], ENT_QUOTES) : '';
	$description = !empty($_POST['description']) ? $smcFunc['htmlspecialchars']($_POST['description'], ENT_QUOTES) : '';

	// At least you've chosen a title right ? right ?
	if (!empty($title))
	{
		$smcFunc['db_insert']('insert',
			'{db_prefix}hof_classes',
			array(
				'title' => 'string', 'description' => 'string',
			),
			array(
				$title, $description,
			),
			array('id_class')
		);

		redirectexit('action=admin;area=hof;sa=admin;state=success');
	}
	else
		redirectexit('action=admin;area=hof;sa=admin;state=fail');
}

/**
 * Remove a Class.
 */
function removeClass()
{
	global $smcFunc;

	isAllowedTo('admin_forum');

	// Values.
	$class_id = (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) ? ((int)$_REQUEST['id']) : 0;

	if (!empty($class_id))
	{
		// first Delete the class itself
		$smcFunc['db_query']('', "
			DELETE FROM {db_prefix}hof_classes
			WHERE id_class = {int:id}",
			array(
				'id' => $class_id,
			)
		);
		// Second Delete users that belong to the class
		$smcFunc['db_query']('', "
			DELETE FROM {db_prefix}hof
			WHERE id_class = {int:id}",
			array(
				'id' => $class_id,
			)
		);

		redirectexit('action=admin;area=hof;sa=admin;state=success');
	}
	else
		redirectexit('action=admin;area=hof;sa=admin;state=fail');
}

/**
 * Update a Class.
 */
function updateClass()
{
	global $smcFunc;

	isAllowedTo('admin_forum');

	// Sanitize
	$class_id = !empty($_POST['id']) ? (int)$_POST['id'] : 0;
	$title = !empty($_POST['title']) ? $smcFunc['htmlspecialchars']($_POST['title'], ENT_QUOTES) : '';
	$description = !empty($_POST['description']) ? $smcFunc['htmlspecialchars']($_POST['description'], ENT_QUOTES) : '';

	if (!empty($title) && !empty($class_id!=0))
	{
		$smcFunc['db_insert']('replace',
			'{db_prefix}hof_classes',
			array(
				'id_class' => 'int', 'title' => 'string', 'description' => 'string',
			),
			array(
				$class_id, $title, $description,
			),
			array('id_class')
		);

		redirectexit('action=admin;area=hof;sa=admin;state=success');
	}
	else
		redirectexit('action=admin;area=hof;sa=admin;state=fail');
}

/**
 * Add a Member to a Hall Of Fame Class
 */
function addFamer()
{
	global $smcFunc;

	isAllowedTo('admin_forum');

	// Sanitize
	$member_name = !empty($_POST['famer']) ? $smcFunc['htmlspecialchars']($_POST['famer'], ENT_QUOTES) : '';
	$_SESSION['save_success'] = false;

	// query
	if (!empty($member_name))
	{
		$query = $smcFunc['db_query']('', "
			SELECT id_member
			FROM {db_prefix}members
			WHERE real_name = {string:member_name}",
			array(
				'member_name' => $member_name,
			)
		);
		$member_id = (int) $smcFunc['db_fetch_assoc']($query)['id_member'];
		$smcFunc['db_free_result']($query);

		// Sanitize Numeric
		$class = !empty($_POST['class']) ? (int)$_POST['class'] : 0;
		$date = !empty($_POST['date']) ? (int)$_POST['date'] : 0;

		// Do they already belong to this class ?
		$query2 = $smcFunc['db_query']('', "
			SELECT COUNT(*) AS count
			FROM {db_prefix}hof
			WHERE id_member = {int:id_mem}
				AND id_class = {int:class}",
			array(
				'id_mem' => $member_id,
				'class' => $class,
			)
		);
		$count = $smcFunc['db_fetch_assoc']($query2)['count'];
		$smcFunc['db_free_result']($query2);
		$duplicate = $count > 0;

		// Don't add people more than once
		if (!empty($member_id) && !empty($date) && !$duplicate)
		{
			$smcFunc['db_insert']('insert',
				'{db_prefix}hof',
				array(
					'id_member' => 'int', 'date_added' => 'int', 'id_class' => 'int',
				),
				array(
					$member_id, $date, $class,
				),
				array('id_member', 'id_class')
			);

			$_SESSION['save_success'] = true;
		}
	}

	redirectexit('action=admin;area=hof;sa=admin');
}

/**
 * Remove a Member from a HOF Class.
 */
function removeFamer()
{
	global $smcFunc;

	// no sneaky peaky !
	isAllowedTo('admin_forum');

	// Values.
	$id = (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) ? (int)$_REQUEST['id'] : 0;
	$class = (isset($_REQUEST['class']) && !empty($_REQUEST['class'])) ? (int)$_REQUEST['class'] : 0;

	if (!empty($id) && !empty($class))
	{
		$smcFunc['db_query']('', "
			DELETE FROM {db_prefix}hof
			WHERE id_member = {int:id}
				AND id_class = {int:class}",
			array(
				'id' => $id,
				'class' => $class,
			)
		);

		redirectexit('action=admin;area=hof;sa=admin;state=success');
	}
	else
		redirectexit('action=admin;area=hof;sa=admin;state=fail');
}

/**
 * Fetch Classes & Famers.
 */
function ViewHof()
{
	global $context, $txt, $modSettings, $smcFunc, $user_info, $scripturl;

	// The Usual Stuff First
	if (empty($modSettings['hof_active']) && !allowedTo('admin_forum'))
		redirectexit('action=forum');

	$context['sub_template']  = 'main';

	// Query Dem Classes
	$classes = array();
	$query = $smcFunc['db_query']('', "
		SELECT id_class, title, description
		FROM {db_prefix}hof_classes"
	);
	while ($row = $smcFunc['db_fetch_assoc']($query))
	{
		$classes[$row['id_class']]  = array(
			'id' => $row['id_class'],
			'title' => $row['title'],
			'description' => $row['description'],
		);
	}
	$smcFunc['db_free_result']($query);

	$context['hof_classes'] = $classes;

	// If we're always html resizing, assume it's too large.
	if ($modSettings['avatar_action_too_large'] == 'option_html_resize' || $modSettings['avatar_action_too_large'] == 'option_js_resize')
	{
		$avatar_width = !empty($modSettings['avatar_max_width_external']) ? ' width="' . $modSettings['avatar_max_width_external'] . '"' : '';
		$avatar_height = !empty($modSettings['avatar_max_height_external']) ? ' height="' . $modSettings['avatar_max_height_external'] . '"' : '';
	}
	else
	{
		$avatar_width = '';
		$avatar_height = '';
	}

	// The Famers of the Class
	$famers = array();
	foreach ($classes as $id => $data)
	{
		$query2 = $smcFunc['db_query']('', "
			SELECT
				mem.id_group, mem.avatar, mem.id_member, mem.real_name,
				mem.date_registered, mem.avatar, mem.usertitle, h.id_member, h.date_added, h.id_class,
				IFNULL(a.id_attach, 0) AS id_attach, a.filename, a.attachment_type
			FROM ({db_prefix}members as mem, {db_prefix}hof as h)
				LEFT JOIN {db_prefix}attachments as a ON (a.id_member = mem.id_member)
			WHERE h.id_member = mem.id_member
				AND h.id_class = {int:class}
			ORDER BY h.date_added",
			array(
				'class' => $data['id'],
			)
		);
		while ($row2 = $smcFunc['db_fetch_assoc']($query2))
		{
			$famers[$data['id']][] = array(
				'avatar' => array(
					'name' => $row2['avatar'],
					'image' => $row2['avatar'] == '' ? ($row2['id_attach'] > 0 ? '<img class="avatar" src="' . (empty($row2['attachment_type']) ? $scripturl . '?action=dlattach;attach=' . $row2['id_attach'] . ';type=avatar' : $modSettings['custom_avatar_url'] . '/' . $row2['filename']) . '" alt="" />' : '') : ((stristr($row2['avatar'], 'http://') || stristr($row2['avatar'], 'https://')) ? '<img class="avatar" src="' . $row2['avatar'] . '"' . $avatar_width . $avatar_height . ' alt="" />' : '<img class="avatar" src="' . $modSettings['avatar_url'] . '/' . htmlspecialchars($row2['avatar']) . '" alt="" />'),
					'href' => $row2['avatar'] == '' ? ($row2['id_attach'] > 0 ? (empty($row2['attachment_type']) ? $scripturl . '?action=dlattach;attach=' . $row2['id_attach'] . ';type=avatar' : $modSettings['custom_avatar_url'] . '/' . $row2['filename']) : '') : ((stristr($row2['avatar'], 'http://') || stristr($row2['avatar'], 'https://')) ? $row2['avatar'] : $modSettings['avatar_url'] . '/' . $row2['avatar']),
					'url' => $row2['avatar'] == '' ? '' : ((stristr($row2['avatar'], 'http://') || stristr($row2['avatar'], 'https://')) ? $row2['avatar'] : $modSettings['avatar_url'] . '/' . $row2['avatar'])
				),
				'title' => $row2['usertitle'],
				'id_member' => $row2['id_member'],
				'realName' => $row2['real_name'],
				'dateRegistered' => $row2['date_registered'],
				'id_group' => $row2['id_group'],
			);
		}
		$smcFunc['db_free_result']($query2);
	}

	$context['hof_famers'] = $famers;
}

/**
 * Settings Page.
 */
function HofSettings()
{
	global $context, $mbname, $txt, $smcFunc, $modSettings, $sourcedir, $scripturl;

	// Again
	isAllowedTo('admin_forum');

	if (isset($_SESSION['save_success']))
	{
		$context['success_save'] = $_SESSION['save_success'];
		unset($_SESSION['save_success']);
	}

	// Helper file
	require_once($sourcedir . '/ManageServer.php');

	$readonly = !empty($modSettings['hof_layout']) && $modSettings['hof_layout'] != 2;

	// Available Settings
	$config_vars = array(
		array('text', 'hof_globalTitle'),
		$context['is_two_point_one'] ? array('text', 'hof_menu_icon') : array(),
		array('check', 'hof_active', 'subtext'=> (empty($modSettings['hof_active']) ? '<a href="'.$scripturl.'?action=hof" target="_blank" rel="noopener">'.$txt['preview'].'</a>' : '')),
		array('select', 'hof_layout', array(1 => $txt['hof_layout_1'], 2 => $txt['hof_layout_2'], 3 => $txt['hof_layout_3'])),
		array('text', 'hof_ewidth', 'javascript' => ($readonly ? 'readonly="readonly"' : '')),
		array('check', 'hof_square_avatar', 'javascript' => ($readonly ? 'onclick="return false;"' : '')),
		array('text', 'hof_border_radius', 'subtext' => $txt['hof_border_radius_help']),
	);

	// Saving?
	if (isset($_GET['save']))
	{
		checkSession();

		saveDBSettings($config_vars);
		$_SESSION['adm-save'] = true;

		writeLog();
		redirectexit('action=admin;area=hof;sa=admin');
	}

	$context['post_url'] = $scripturl . '?action=admin;area=hof;sa=admin;save';
	$context['settings_title'] = $txt['settings'];

	prepareDBSettingContext($config_vars);
	$context['sub_template']  = 'adminset';

	// Adding classes and Users UI data
	$context['page_title'] = $mbname.' - '.$txt['hof_admin'];

	// Get all the Classes
	$classes = array();

	// QUERY
	$query = $smcFunc['db_query']('', '
	SELECT id_class, title, description
	FROM {db_prefix}hof_classes');
	while ($row = $smcFunc['db_fetch_assoc']($query))
	{
		$classes[$row['id_class']]  = array(
			'id' => $row['id_class'],
			'title' => $row['title'],
			'description' => $row['description'],
		);
	}
	$smcFunc['db_free_result']($query);

	$context['hof_classes'] = $classes;

	$famers = array();
	foreach ($classes as $class_id => $class)
	{
		$query2 = $smcFunc['db_query']('', "
			SELECT
				m.id_member, m.id_group, m.id_member, m.real_name, m.posts,
				m.last_login, m.date_registered, h.id_member, h.date_added, h.id_class
			FROM {db_prefix}members as m
				LEFT JOIN {db_prefix}hof as h ON (m.id_member = h.id_member)
			WHERE h.id_class = {int:class}
			ORDER BY h.date_added",
			array(
				'class' => $class_id,
			)
		);
		while ($row2 = $smcFunc['db_fetch_assoc']($query2))
		{
			$famers[$class_id][$row2['id_member']] = array(
				'id_group' => $row2['id_group'],
				'id_member' => $row2['id_member'],
				'realName' => $row2['real_name'],
				'lastLogin' => $row2['last_login'],
				'dateRegistered' => $row2['date_registered'],
				'posts' => $row2['posts'],
				'class' => $row2['id_class'],
			);
		}
		$smcFunc['db_free_result']($query2);
	}

	$context['hof_famers'] = $famers;
}

/**
 * Edit a Class Page.
 */
function editClass()
{
	global $context, $txt, $smcFunc, $scripturl;

	// Let's Make Sure we know where we are ye ?
	$context['page_title'] = $txt['hof_edit_class'];
	$context['page_title_html_safe'] = $smcFunc['htmlspecialchars'](un_htmlspecialchars($context['page_title']));
	$context['linktree'][] = array(
		'url' => $scripturl. '?action=hof;sa=edit_class',
		'name' => $txt['hof_edit_class'],
	);

	// No access, means no access
	isAllowedTo('admin_forum');

	// Sanitization
	$class = (isset($_REQUEST['class']) && !empty($_REQUEST['class'])) ? (int)$_REQUEST['class'] : 0;
	$context['sub_template']  = 'editClass';

	if (!empty($class))
	{
		$class_content = array();
		$query = $smcFunc['db_query']('', "
			SELECT id_class, title, description
			FROM {db_prefix}hof_classes
			WHERE id_class = {int:class}",
			array(
				'class' => $class,
			)
		);
		while($row = $smcFunc['db_fetch_assoc']($query))
		{
			$class_content = array(
				'id' => $row['id_class'],
				'title' => $row['title'],
				'description' => $row['description']
			);
		}
		$smcFunc['db_free_result']($query);

		$context['hof_current_class'] = $class_content;
	}
	else
		redirectexit('action=admin;area=hof;sa=admin;state=fail');
}