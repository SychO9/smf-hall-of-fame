<?php
//S.M
//SychO

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
  require_once(dirname(__FILE__) . '/SSI.php');
// Hmm... no SSI.php and no SMF?
elseif (!defined('SMF'))
  die('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php.');



// Hofamers Table
$smcFunc['db_query']('', "CREATE TABLE IF NOT EXISTS {db_prefix}hof
(id_member mediumint(8) unsigned NOT NULL,
date_added int(11) unsigned NOT NULL, id_class mediumint(8) unsigned NOT NULL)");

// Hof Classes Table
$smcFunc['db_query']('', "CREATE TABLE IF NOT EXISTS {db_prefix}hof_classes
(id_class mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
title varchar(256), description varchar(256),
PRIMARY KEY (id_class))");

// Insert the settings
$smcFunc['db_query']('', "INSERT IGNORE INTO {db_prefix}settings VALUES ('hof_layout', '2')");
$smcFunc['db_query']('', "INSERT IGNORE INTO {db_prefix}settings VALUES ('hof_active', '1')");
?>