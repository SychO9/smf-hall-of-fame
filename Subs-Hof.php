<?php
/**
 * @package SMF Hall Of Fame (HOF)
 * @author SychO (M.S) http://sycho.22web.org
 * @version 1.2
 * @license Copyright 2019
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
 * Adds ?action=hof to the actions list
 * Called By
 *		integrate_actions
 */
function hof_action_hook(&$actionArray)
{
	global $sourcedir, $modSettings;
	loadLanguage('Hof');
	$actionArray += array('hof' => array('Hof.php', 'Hof'));
}

/**
 * Adds an admin area, ?action=admin;area=hof
 * Called By
 *		integrate_admin_areas
 */
function hof_admin_hook(&$admin_areas)
{
	global $txt, $modSettings, $scripturl, $sc;

	$icon = 'posters';
	if(!defined('SMF_VERSION') || (defined('SMF_VERSION') && strpos(SMF_VERSION, '2.1')===false))
		$icon = 'themes.gif';

	if(!empty($modSettings['hof_menu_icon']))
		$icon = $modSettings['hof_menu_icon'];

	$admin_areas['config']['areas'] += array(
		'hof' => array(
			'label' => $txt['hof'],
			'file' => 'Hof.php',
			'function' => 'Hof',
			'custom_url' => $scripturl . '?action=admin;area=hof;sa=admin',
			'icon' => $icon,
		),
	);
}

/**
 * Adds a button to the main menu
 * Called By
 *		integrate_menu_buttons
 */
function hof_menu_hook(&$menu_buttons)
{
	global $sourcedir, $modSettings, $scripturl, $txt;
	
	$hof = array(
		'hof' => array(
			'title' => !empty($modSettings['hof_globalTitle']) ? $modSettings['hof_globalTitle'] : $txt['hof'],
			'href' => $scripturl . '?action=hof',
			'show' => !empty($modSettings['hof_active']),
			'icon' => !empty($modSettings['hof_menu_icon']) ? $modSettings['hof_menu_icon'] : 'posters',
		),
	);
	
	$pos = array_search('login', array_keys($menu_buttons));
	// Just incase someone decided that removing login array is a good idea -.-
	if($pos===false) {
		$menu_buttons = array_merge($menu_buttons, $hof);
	} else {
		$menu_buttons = array_merge(
			array_slice($menu_buttons, 0, $pos),
			$hof,
			array_slice($menu_buttons, $pos)
		);
	}
}

/**
 * Loads the css file for 2.1.x
 * Called By
 *		integrate_pre_css_output
 */
function hof_css()
{
	loadCSSFile('hof.css', array('force_current'=>false, 'minimize'=>true), 'smf_hof');
}

/**
 * Credits the author
 * Called By
 *		integrate_credits
 */
function hof_credits()
{
	global $context;
	$context['copyrights']['mods'][] = '<a href="http://custom.simplemachines.org/mods/index.php?mod=4185" target="_blank" class="new_win" rel="noopener">SMF Hall Of Fame</a> v1.1, by <a href="https://github.com/SychO9">SychO</a> &copy; 2019';
}