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
// Define the hooks
$hook_functions = array(
	'integrate_pre_include' => '$sourcedir/Subs-Hof.php',
	'integrate_admin_areas' => 'hof_admin_hook',
	'integrate_actions' => 'hof_action_hook',
	'integrate_menu_buttons' => 'hof_menu_hook',
	'integrate_credits' => 'hof_credits',
);
// Only add this hook for 2.1.x versions
if(defined('SMF_VERSION') && strpos(SMF_VERSION, '2.1')!==false)
	$hook_functions['integrate_pre_css_output'] = 'hof_css';

// Adding or removing them?
if (!empty($context['uninstalling']))
	$call = 'remove_integration_function';
else
	$call = 'add_integration_function';

foreach ($hook_functions as $hook => $function)
	$call($hook, $function);