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
	
	// DROP 'hof' Table which contains all members added to any classes.
	$smcFunc['db_drop_table']('{db_prefix}hof', array('no_prefix' => true),array('ignore' => true));
	
	// DROP 'hof_classes' Table which contains all Classes Created.
	$smcFunc['db_drop_table']('{db_prefix}hof_classes', array('no_prefix' => true),array('ignore' => true));
?>