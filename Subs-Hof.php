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

// Action Hook
function hof_action_hook(&$actionArray) {
	
	global $sourcedir, $modSettings;
	
	$actionArray += array('hof' => array('Hof.php', 'Hof'));
}
// Admin Area Hook
function hof_admin_hook(&$admin_areas) {
   
	global $txt, $modSettings, $scripturl, $sc;
	
    $admin_areas['config']['areas'] += array(
		'hof' => array(
			'label' => $txt['hof'],
			'file' => 'Hof.php',
			'function' => 'Hof',
			'custom_url' => $scripturl . '?action=admin;area=hof;sa=admin;sesc=' . $sc,
			'icon' => 'themes.gif',
		),
	);
}
// Menu Button Hook
function hof_menu_hook(&$menu_buttons) {
	
	global $sourcedir, $modSettings, $scripturl, $txt;
	
	$hof = array(
		'hof' => array(
			'title' => !empty($modSettings['hof_globalTitle']) ? $modSettings['hof_globalTitle'] : $txt['hof'],
			'href' => $scripturl . '?action=hof',
			'show' => allowedTo('view_mlist') && $modSettings['hof_active'],
			'icon' => '',
		),
	);
	
	$pos = array_search('login', array_keys($menu_buttons));
	// Just incase someone decided that removing login array is a good idea -.-
	if($pos===false) {
		$menu_buttons = array_merge($hof, $menu_buttons);
	} else {
		$menu_buttons = array_merge(
			array_slice($menu_buttons, 0, $pos),
			$hof,
			array_slice($menu_buttons, $pos)
		);
	}
	
	/*$menu_buttons['hof'] = array(
		'title' => !empty($modSettings['hof_globalTitle']) ? $modSettings['hof_globalTitle'] : $txt['hof'],
		'href' => $scripturl . '?action=hof',
		'show' => allowedTo('view_mlist') && $modSettings['hof_active'],
		'icon' => '',
	);*/
}

?>