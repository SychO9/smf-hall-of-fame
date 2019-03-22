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
if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
  require_once(dirname(__FILE__) . '/SSI.php');
// Hmm... no SSI.php and no SMF?
elseif (!defined('SMF'))
  die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php.');

	db_extend('packages');
  
	// Install Settings.
	updateSettings(array('hof_layout' => 2));
	updateSettings(array('hof_active' => 1));
	updateSettings(array('hof_globalTitle' => 'Hall Of Fame'));
	updateSettings(array('hof_ewidth' => '120'));
	updateSettings(array('hof_border_radius' => '100%'));
	updateSettings(array('hof_square_avatar' => 1));
	
	// Create 'hof' Table which contains all members added to any classes.
	$db_columns = array(
			array(
					'name' => 'id_member',
					'type' => 'mediumint',
					'size' => 8,
					'null' => false,
					'unsigned' => true,
					'default' => ''
			),
			array(
					'name' => 'date_added',
					'type' => 'int',
					'size' => 11,
					'null' => false,
					'unsigned' => true,
					'default' => ''
			),
			array(
					'name' => 'id_class',
					'type' => 'mediumint',
					'size' => 8,
					'null' => false,
					'unsigned' => true,
					'default' => ''
			),
	);
	$smcFunc['db_create_table']('{db_prefix}hof', $db_columns, array(), array(), 'ignore', 'fatal');
	
	// Create 'hof_classes' Table which contains all Classes Created.
	$db_columns2 = array(
			array(
					'name' => 'id_class',
					'type' => 'mediumint',
					'size' => 8,
					'null' => false,
					'unsigned' => true,
					'default' => null,
					'auto' => true
			),
			array(
					'name' => 'title',
					'type' => 'varchar',
					'size' => 256,
					'null' => false,
					'default' => ''
			),
			array(
					'name' => 'description',
					'type' => 'varchar',
					'size' => 256,
					'null' => false,
					'default' => ''
			),
	);
	$db_indexes2 = array(
		array(
			'type' => 'primary',
			'columns' => array('id_class')
		),
	);
	$smcFunc['db_create_table']('{db_prefix}hof_classes', $db_columns2, $db_indexes2, array(), 'ignore', 'fatal');
?>