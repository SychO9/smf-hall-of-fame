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

/**
 * Main Page, the layout type is determined here.
 */
function template_main()
{
	global $context, $settings, $txt, $scripturl, $modSettings;

	if (empty($modSettings['hof_active']))
		echo '
	<div class="errorbox">
		', $txt['hof_unactive'], '
	</div>';

	if (!empty($modSettings['hof_border_radius']))
		$border_radius = strpos($modSettings['hof_border_radius'], '%') !== false ? $modSettings['hof_border_radius'] : $modSettings['hof_border_radius'].'px';

	$border_radius = !empty($border_radius) ? 'border-radius:'.$border_radius : '';

	$context['hof_border_radius'] = $border_radius;

	if ((!empty($modSettings['hof_layout']) && $modSettings['hof_layout'] == 1) || empty($modSettings['hof_layout']))
		template_layout1();
	elseif ((!empty($modSettings['hof_layout']) && $modSettings['hof_layout'] == 3) || empty($modSettings['hof_layout']))
		template_layout3();
	// I don't remember why but layout 2 is the default one..
	else
		template_layout2();
}

/**
 * The big avatars layout
 */
function template_layout2()
{
	global $context, $settings, $txt, $scripturl, $modSettings;

	$alter = true;
	if (!empty($context['hof_classes']))
	{
		foreach ($context['hof_classes'] as $class_id => $class)
		{
			// Hide the class if it has no members
			if (empty($context['hof_famers'][$class_id]))
				continue;

			$alter = $alter || $context['is_two_point_one'];

			echo '
			<div class="hof_class">';

			if ($context['is_two_point_one'])
				echo '
				<div class="cat_bar">
					<h3 class="catbg">
						', $class['title'], '
					</h3>
					<div class="desc">', $class['description'], '</div>
				</div>';

			echo'
				<div class="windowbg', $alter ? '' : '2', '">
					<span class="topslice"><span></span></span>
					<div class="content">';

			if (!$context['is_two_point_one'])
				echo '
						<div class="hof_cheader">
							<h1>', $class['title'], '</h1>
							<span class="smalltext">', $class['description'], '</span>
						</div>
						<hr>';

			foreach ($context['hof_famers'][$class_id] as $key => $famer)
			{
				echo'
						<div class="hof_member">
							<div class="hof_mImage">
								<img style="', !empty($modSettings['hof_ewidth']) ? 'width: '.$modSettings['hof_ewidth'].'px;'.(!empty($modSettings['hof_square_avatar']) ? 'height:'.$modSettings['hof_ewidth'].'px;' : '').'' : '', '', $context['hof_border_radius'], '" class="avatar" src="', !empty($famer['avatar']['image']) ?
									$famer['avatar']['href'] :
									$settings['default_theme_url'].'/images/admin/hof_user.png', '" alt="">
							</div>
							<div class="hof_who">
								<h4 class="hof_famer_name">
									<a href="', $scripturl, '?action=profile;u=', $famer['id_member'], '"><strong>', $famer['realName'], '</strong></a>
								</h4>
								<div class="hof_more smalltext">
									', !empty($famer['title']) ? $famer['title'] : '', '
								</div>
							</div>
						</div>';
			}

			echo'
					</div>';

			echo'
				</div>
				<span class="botslice clear_right"><span></span></span>
			</div>';

			$alter = !$alter;
		}
	}
	else
	{
		echo'
		<div class="windowbg">
			<span class="topslice"><span></span></span>
			<div class="content">'.$txt['hof_empty'].'</div>
			<span class="botslice clear_right"><span></span></span>
		</div>';
	}
}

/**
 * The Unusual layout
 */
function template_layout1()
{
	global $context, $settings, $txt, $scripturl, $modSettings;

	$alter = true;
	if (!empty($context['hof_classes']))
	{
		foreach ($context['hof_classes'] as $class_id => $class)
		{
			// Hide the class if it has no members
			if (empty($context['hof_famers'][$class_id]))
				continue;

			$alter = $alter || $context['is_two_point_one'];
			// Show Classes.
			echo '
			<div class="windowbg', $alter ? '' : '2', '">
				<span class="topslice"><span></span></span>
				<div class="content hof_features">
					<div class="hof_feat_ele">
						<img class="features_image png_fix" src="', $settings['default_theme_url'], '/images/admin/hof.png" width="65" alt="', $class['title'], '">
					</div>
					<div class="hof_feat_ele hof_grow">
						<h4 style="padding-bottom: 0;">', $class['title'], '</h4>
						<p>', $class['description'], '</p>
						<hr>
						<div class="hof_members">';

						if (!empty($context['hof_famers'][$class_id]))
						{
							foreach ($context['hof_famers'][$class_id] as $id=>$famer)
							{
								echo '
								<a href="', $scripturl, '?action=profile;u=', $famer['id_member'], '" class="titlebg" style="display:inline-block;padding: 3px 5px;border-radius: 2px;margin: 2px 2px;">
									'.$famer['realName'].'
								</a>';
							}
						}

						echo'
						</div>
					</div>
				</div>
				<span class="botslice clear_right"><span></span></span>
			</div>';

			$alter = !$alter;
		}
	}
	else
		echo '
			<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">'.$txt['hof_empty_classes'].'</div>
				<span class="botslice clear_right"><span></span></span>
			</div>';
}

/**
 * The table layout
 */
function template_layout3()
{
	global $context, $settings, $txt, $scripturl, $modSettings;

	if (!empty($context['hof_classes']))
	{
		foreach ($context['hof_classes'] as $class_id => $class)
		{
			// Hide the class if it has no members
			if (empty($context['hof_famers'][$class_id]))
				continue;

			// Show Classes.
			echo '
			<table width="100%" cellspacing="0" class="hof_table table_grid">
				<thead>
					<tr class="" align="left">
						<th colspan="2">
							<div class="cat_bar">
								<h3 class="catbg">
									', $class['title'], '
								</h3>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
					', !empty($class['description']) ? '<tr class="windowbg hof_description"><td colspan="2"><smalltext>'.$class['description'].'</smalltext></td></tr>' : '';

				$alter = true;

				foreach ($context['hof_famers'][$class_id] as $id=>$data2)
				{
					$alter = $alter || $context['is_two_point_one'];
					$dateR = explode(', ', timeformat($data2['dateRegistered'], false));

					echo '
					<tr class="windowbg', $alter ? '' : '2', '">
						<td class="hof_features">
								<img style="', $context['hof_border_radius'], '" class="avatar" src="', !empty($data2['avatar']['image']) ?
									$data2['avatar']['href'] :
									$settings['default_theme_url'].'/images/admin/hof_user.png', '" alt="">
								<div class="hof_table_det">
									<div class="nam"><a href="', $scripturl, '?action=profile;u=', $data2['id_member'], '">'.$data2['realName'].'</a></div>
									<div class="smalltext">', $data2['title'], '</div>
								</div>
						</td>
						<td align="right" class="hof_reg">', $txt['member_since'], ': <strong>', $dateR[0], ', ', $dateR[1], '</strong></td>
					</tr>';
					$alter = !$alter;
				}

			echo '
				</tbody>
			</table>';
		}
	}
	else
		echo '
			<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">'.$txt['hof_empty_classes'].'</div>
				<span class="botslice clear_right"><span></span></span>
			</div>';
}

/**
 * Admin Page
 */
function template_adminset()
{
	global $context, $settings, $txt, $scripturl, $modSettings, $smcFunc;

	// Success
	if (isset($context['success_save']) && $context['success_save'])
		echo'
	<div class="infobox" id="profile_success">
		', $txt['hof_success'], '
	</div>';
	// Error
	elseif (isset($context['success_save']) && !$context['success_save'])
		echo'
	<div class="errorbox">
		<strong>', $txt['hof_error_unknown'], '</strong><br/>
	</div>';

	echo'
	<div class="hof_admin">
		<div class="hof_upper_admin', $context['is_two_point_one'] ? '' : ' two_o', '">
			<div class="hof_class_list">
				<div class="cat_bar">
					<h3 class="catbg">
						', $txt['hof_classes'], '
					</h3>
				</div>';

	$alter = true;
	if (!empty($context['hof_classes']))
	{
		foreach ($context['hof_classes'] as $class_id => $class)
		{
			$alter = $alter || $context['is_two_point_one'];

			// Show Classes.
			echo '
				<div class="windowbg', $alter ? '' : '2', '">
					<span class="topslice"><span></span></span>
					<div class="content features hof_features">
						<div class="hof_feat_ele">
							<img class="hof_feat_img" src="', $settings['default_theme_url'], '/images/admin/hof.png" width="65" alt="', $class['title'], '">
						</div>
						<div class="hof_feat_ele hof_grow">
							<h4>
								', $class['title'], '
								<a href="', $scripturl, '?action=hof;sa=edit;class=', $class_id,'">
									', $context['is_two_point_one'] ? '<span class="main_icons quick_edit_button"></span>' : '<img src="'.$settings['default_theme_url'].'/images/icons/modify_inline.gif" id="switch_cd" style="vertical-align:middle" alt="'.$txt['hof_modify'].'" title="'.$txt['hof_modify'].'">', '
								</a>
							</h4>
							<p>', $class['description'], '<br/>';

					if (!empty($context['hof_famers'][$class_id]))
					{
						foreach ($context['hof_famers'][$class_id] as $famer_id => $famer)
						{
							echo '
								<div class="titlebg" style="display:inline-block;padding: 3px 5px;border-radius: 2px;margin: 2px 2px;">'.$famer['realName'].'
									<a href="', $scripturl, '?action=hof;sa=remove_famer;id=', $famer_id, ';class=', $class_id, '">
										', $context['is_two_point_one'] ? '<span class="main_icons delete"></span>' : '<img src="'.$settings['theme_url'].'/images/pm_recipient_delete.gif" alt="'.$txt['hof_delete_famer'].'" title="'.$txt['hof_delete_famer'].'"/>', '
									</a>
								</div>';
						}
					}

			echo'
							</p>
						</div>
						<div class="hof_feat_ele">
							<a href="', $scripturl, '?action=hof;sa=remove_class;id=', $class_id,'">
								<img src="', $settings['default_theme_url'], '/images/admin/hof_remove.png" id="switch_cd" alt="', $txt['hof_delete_class'], '" title="', $txt['hof_delete_class'], '">
							</a>
						</div>
					</div>
					<span class="botslice clear_right"><span></span></span>
				</div>';

			$alter = !$alter;
		}
	else
		echo'
				<div class="windowbg">
					<span class="topslice"><span></span></span>
					<div class="content">
						', $txt['hof_empty_classes'], '
					</div>
					<span class="botslice clear_right"><span></span></span>
				</div>';

	// Add a Class.
	echo'
			</div>
			<div class="hof_manage_ui">
				<div class="hof_add_class">
					<div class="cat_bar">
						<h3 class="catbg">
							', $txt['hof_add_class'], '
						</h3>
					</div>
					<div class="windowbg">
						<span class="topslice"><span></span></span>
						<div class="content">
							<form action="', $scripturl, '?action=hof;sa=add_class" method="post">
							<input id="title" name="title" type="text" maxlength="50" placeholder="', $txt['hof_title'], '" required/><br/>
							<textarea id="description" name="description" placeholder="', $txt['hof_description'], '"></textarea><br/>
							<input class="button active" id="submit" name="submit" type="submit" value="', $txt['hof_submit'], '"/>
						</form>
						</div>
						<span class="botslice"><span></span></span>
					</div>
				</div>';

	// Add a User.
	echo'
				<div class="hof_add_famer">
					<div class="cat_bar">
						<h3 class="catbg">
							', $txt['hof_add_famer'], '
						</h3>
					</div>
					<div class="windowbg">
						<span class="topslice"><span></span></span>
						<div class="content">';

						if (!empty($context['hof_classes']))
						{
							echo'
							<form action="', $scripturl, '?action=hof;sa=add_famer" method="post">
								<input id="famer" name="famer" type="text" maxlength="50" placeholder="', $txt['hof_famer'], '" required/>
								<div id="famer_container"></div><br/>
								<input id="id" name="id" type="hidden" />
								<input id="date" name="date" type="hidden" value="', forum_time(false), '"/>
								<select name="class">';

							foreach ($context['hof_classes'] as $class_id => $class)
							{
								echo'
									<option value="', $class_id, '" id="', $class_id, '">', $class['title'], '</option>';
							}

								echo'
								</select><br/>
								<input class="button active" id="submit" name="submit" type="submit" value="', $txt['hof_submit'], '"/>
							</form>';
						}
						else
							echo $txt['hof_create_class_first'];

						echo'
						</div>
						<span class="botslice"><span></span></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>';

	// Generic templates rock !
	template_show_settings();

	// AutoSuggest Js
	echo'
	<script type="text/javascript" src="', $settings['default_theme_url'], '/scripts/suggest.js?fin20"></script>
	<script type="text/javascript"><!-- // --><![CDATA[
		var oModeratorSuggest = new smc_AutoSuggest({
			sSelf: \'oModeratorSuggest\',
			sSessionId: \'', $context['session_id'], '\',
			sSessionVar: \'', $context['session_var'], '\',
			sSuggestId: \'famer\',
			sControlId: \'famer\',
			sSearchType: \'member\',
			bItemList: false,
			sPostName: \'famer_single\',
			sURLMask: \'action=profile;u=%item_id%\',
			sTextDeleteItem: \'', $txt['autosuggest_delete_item'], '\',
			sItemListContainerId: \'famer_container\',
			aListItems: [],
		});
	// ]]></script>';
}

/**
 * Editing a Class.
 */
function template_editClass()
{
	global $context, $txt, $scripturl;

	echo '
	<div class="cat_bar">
			<h3 class="catbg">
				', $context['hof_current_class']['title'], '
			</h3>
		</div>
	<div class="windowbg">
		<span class="topslice"><span></span></span>
		<div class="content features">
			<form action="', $scripturl, '?action=hof;sa=update_class" method="post">
				<input type="hidden" name="id" value="', $context['hof_current_class']['id'], '" />
				<input id="title" name="title" type="text" maxlength="50" placeholder="', $txt['hof_title'], '" required value="', $context['hof_current_class']['title'], '"/><br/>
				<textarea id="description" name="description" placeholder="', $txt['hof_description'], '">', $context['hof_current_class']['description'], '</textarea><br/>
				<input id="submit" name="submit" type="submit" />
			</form>
		</div>
		<span class="botslice"><span></span></span>
	</div>';
}