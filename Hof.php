<?php
/* --------------------- AUTHOR:
/* SYCHO (M.S)
/* SMF Hall Of Fame (HOF)
/* http://sycho.22web.org
/* Copyright 2018
/*
/* Licensed under the Apache License, Version 2.0 (the "License");
/* you may not use this file except in compliance with the License.
/* You may obtain a copy of the License at
/*
/*     http://www.apache.org/licenses/LICENSE-2.0
/*
---------------------------- */


// First of all, we make sure we are accessing the source file via SMF so that people can not directly access the file. 
if (!defined('SMF'))
	die('Hack Attempt...');

/* Main Function.
---------------------- */
function Hof() {
	global $context, $scripturl, $txt, $smcFunc;
	
	// For Starters Let's Not forget about the author's ...
	$context['key'] = "48616c6c206f662046616d65204d6f64652043726561746564206279203c6120687265663d22687474703a2f2f737963686f2e32327765622e6f72672f22207461726765743d225f626c616e6b223e537963684f3c2f613e";
	
	// Template, Language
	loadtemplate('Hof');
	loadLanguage('Hof');
	
	// Seriously where am I ?
	$context['page_title'] = $txt['hof_PageTitle'];
	$context['page_title_html_safe'] = $smcFunc['htmlspecialchars'](un_htmlspecialchars($context['page_title']));
	$context['linktree'][] = array(
  		'url' => $scripturl. '?action=hof',
 		'name' => $txt['hof_PageTitle'],
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
	);
	
	// Take Me To The SubAction ?
	if (!empty($subActions[@$_GET['sa']]))
		$subActions[$_GET['sa']]();
	else
		ViewHof();
}

/* Add a Class
--------------------- */
function addClass() {
	global $context, $settings, $scripturl, $txt, $db_prefix, $options, $user_info;
	global $modSettings, $smcFunc, $memberContext;
	
	// Permit
	isAllowedTo('admin_forum');
	
	// Values.
	$title = (string) $_POST['title'];
	$description = (string) $_POST['description'];
	
	if(!empty($title)) {
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
	} else
		redirectexit('action=admin;area=hof;sa=admin;state=fail');
}
/* Remove a Class.
---------------------- */
function removeClass() {
	global $context, $settings, $scripturl, $txt, $db_prefix, $options, $user_info;
	global $modSettings, $smcFunc, $memberContext;
	isAllowedTo('admin_forum');
	// Values.
	$ID = (int) $_REQUEST['id'];
	
	if($ID!="") {
		$smcFunc['db_query']('', "DELETE FROM {db_prefix}hof_classes 
				WHERE id_class = " . $ID);
		
		$smcFunc['db_query']('', "DELETE FROM {db_prefix}hof
					WHERE id_class = " . $ID);
		redirectexit('action=admin;area=hof;sa=admin;state=success');
	} else			
		redirectexit('action=admin;area=hof;sa=admin;state=fail');
}
/* Update a Class.
--------------------- */
function updateClass() {
	global $context, $settings, $scripturl, $txt, $db_prefix, $options, $user_info;
	global $modSettings, $smcFunc, $memberContext;
	isAllowedTo('admin_forum');
	// Values.
	$id = (int) $_POST['id'];
	$title = (string) $_POST['title'];
	$description = (string) $_POST['description'];
	
	if(!empty($title)) {
		$smcFunc['db_insert']('replace',
			'{db_prefix}hof_classes',
			array(
				'id_class' => 'int', 'title' => 'string', 'description' => 'string',
			),
			array(
				$id, $title, $description,
			),
			array('id_class')
		);
		redirectexit('action=admin;area=hof;sa=admin;state=success');
	} else
		redirectexit('action=admin;area=hof;sa=admin;state=fail');
}
/* Add a Member to a Hall Of Fame Class
------------------------------------------ */
function addFamer() {
	global $context, $settings, $scripturl, $txt, $db_prefix, $options, $user_info;
	global $modSettings, $smcFunc, $memberContext;
	isAllowedTo('admin_forum');
	// Values.
	$MEMBER_NAME = $_POST['famer'];
	$query = $smcFunc['db_query']('', "
		SELECT id_member
		FROM {db_prefix}members
		WHERE real_name = '".$MEMBER_NAME."'");
	$ID_MEMBER = (int) $smcFunc['db_fetch_assoc']($query)['id_member'];
	$smcFunc['db_free_result']($query);
	
	$CLASS = (int) $_POST['class'];
	$DATE = (int) $_POST['date'];
	
	$query2 = $smcFunc['db_query']('', "
		SELECT COUNT(*) AS count 
		FROM {db_prefix}hof 
		WHERE id_member = ".$ID_MEMBER." 
			AND id_class = ".$CLASS."");
	$count = $smcFunc['db_fetch_assoc']($query2)['count'];
	$duplicate = $count > 0;
	
	if(!empty($ID_MEMBER) && !empty($DATE) && !$duplicate) {
		$smcFunc['db_insert']('insert',
			'{db_prefix}hof',
			array(
				'id_member' => 'int', 'date_added' => 'int', 'id_class' => 'int',
			),
			array(
				$ID_MEMBER, $DATE, $CLASS,
			),
			array('id_member', 'id_class')
		);
		redirectexit('action=admin;area=hof;sa=admin;state=success');
	} elseif($duplicate)
		redirectexit('action=admin;area=hof;sa=admin;state=fail;message=User%20Already%20In%20Class');
	else redirectexit('action=admin;area=hof;sa=admin;state=fail');
}
/* Remove a Member from a HOF Class.
---------------------------------------- */
function removeFamer() {
	global $context, $settings, $scripturl, $txt, $db_prefix, $options, $user_info;
	global $modSettings, $smcFunc, $memberContext;
	isAllowedTo('admin_forum');

	// Values.
	$ID = (int) $_REQUEST['id'];
	$CLASS = (int) $_REQUEST['class'];
	if(!empty($ID)) {
		$smcFunc['db_query']('', "DELETE FROM {db_prefix}hof
				WHERE id_member = " . $ID . " AND id_class = " . $CLASS . "");
		redirectexit('action=admin;area=hof;sa=admin;state=success');
	} else			
		redirectexit('action=admin;area=hof;sa=admin;state=fail');
}
/* Fetch Classes & Famers.
---------------------------- */
function ViewHof() {
	global $context, $mbname, $txt, $modSettings, $smcFunc, $user_info, $sourcedir, $scripturl;
		
	// The Usual Stuff First
	isAllowedTo('view_mlist');
	$context['sub_template']  = 'main';
	$context['page_title'] = $mbname.' - '.$txt['hof'];
	$context['linktree'][] = array(
		'url' => $scripturl . '?action=hof',
		'name' => $txt['hof']
	);
	
	// Query Dem Classes
	$classes = array();
	$query = $smcFunc['db_query']('', "
	SELECT id_class, title, description
	FROM {db_prefix}hof_classes");
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
	
	// The Famers of the Class
	$famers = array();
	foreach ($classes as $id => $data) 	{
		
		$query2 = $smcFunc['db_query']('', "
		SELECT 
			m.ID_GROUP, m.avatar, m.ID_MEMBER, m.real_name, m.email_address, m.hide_email, m.date_registered, h.id_member, h.date_added, h.id_class
		FROM ({db_prefix}members as m, {db_prefix}hof as h) 
		WHERE h.id_member = m.ID_MEMBER
			AND h.id_class = ".$data['id']."
		ORDER BY h.date_added");
		while ($row2 = $smcFunc['db_fetch_assoc']($query2)) {
			
			$famers[$data['id']][] = array(
				'avatar' => $row2['avatar'],
				'ID_MEMBER' => $row2['ID_MEMBER'],
				'realName' => $row2['real_name'],
				'emailAddress' => $row2['email_address'],
				'hideEmail' => $row2['hide_email'],
				'dateRegistered' => $row2['date_registered'],
				'ID_GROUP' => $row2['ID_GROUP'],
			);
		}
		$smcFunc['db_free_result']($query2);
		
	}
	
	$context['hof_famers'] = $famers;
}

/* Settings Page.
-------------------- */
function HofSettings() {
	global $context, $mbname, $txt, $smcFunc;
	
	// Again
	isAllowedTo('admin_forum');
	// Layout Setting
	if(isset($_REQUEST['hof_layout'])) {
		$hof_layout = $_REQUEST['hof_layout']==1 ? 1 : 2;
		updateSettings(
			array(
				'hof_layout' => $hof_layout,
			)
		);
	}
	if(isset($_REQUEST['active'])) {
		updateSettings(
			array(
				'hof_active' => $_REQUEST['active'],
			)
		);
	}
	$context['sub_template']  = 'adminset';
	$context['page_title'] = $mbname.' - '.$txt['hof_admin'];	
	
	// Get all the Classes
	$classes = array();
	// Does all the real work.
	$query = $smcFunc['db_query']('', "
	SELECT id_class, title, description
	FROM {db_prefix}hof_classes");
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
	foreach ($classes as $id => $data) {
		
		$query2 = $smcFunc['db_query']('', "
		SELECT 
			m.ID_GROUP, m.avatar, m.ID_MEMBER, m.real_name, m.email_address, m.hide_email, m.posts, m.last_login, m.date_registered, h.id_member, h.date_added, h.id_class
		FROM ({db_prefix}members as m, {db_prefix}hof as h) 
		WHERE h.id_member = m.ID_MEMBER
			AND h.id_class = ".$data['id']."
		ORDER BY h.date_added");
		while ($row2 = $smcFunc['db_fetch_assoc']($query2)) {
			
			$famers[$data['id']][] = array(
				'ID_GROUP' => $row2['ID_GROUP'],
				'avatar' => $row2['avatar'],
				'ID_MEMBER' => $row2['ID_MEMBER'],
				'realName' => $row2['real_name'],
				'emailAddress' => $row2['email_address'],
				'hideEmail' => $row2['hide_email'],
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
/* Edit a Class Page.
------------------------- */
function editClass() {
	global $context, $mbname, $txt, $smcFunc, $scripturl;
	
	// Let's Make Sure we know where we are ye ?
	$context['page_title'] = $txt['hof_edit_class'];
	$context['page_title_html_safe'] = $smcFunc['htmlspecialchars'](un_htmlspecialchars($context['page_title']));
	$context['linktree'][] = array(
  		'url' => $scripturl. '?action=hof;sa=edit_class',
 		'name' => $txt['hof_edit_class'],
	);
	
	isAllowedTo('admin_forum');
	
	$CLASS = (int) $_REQUEST['class'];
	
	$context['sub_template']  = 'editClass';
	
	$class_content = array();
	$query = $smcFunc['db_query']('', "
		SELECT id_class, title, description
		FROM {db_prefix}hof_classes 
		WHERE id_class = ".$CLASS."");
	while($row = $smcFunc['db_fetch_assoc']($query) ) {
		$class_content = array(
			'id' => $row['id_class'],
			'title' => $row['title'],
			'description' => $row['description']
		);
	}
	$smcFunc['db_free_result']($query);
	
	$context['hof_current_class'] = $class_content;
}
/* Security.
----------------- */
function hexToStr($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}
?>