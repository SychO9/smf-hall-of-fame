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
	global $context, $settings, $options, $txt, $scripturl, $modSettings, $memberContext;

	if(!$modSettings['hof_active'] && !allowedTo('admin_forum'))
		redirectexit('action=forum');

	if((!empty($modSettings['hof_layout']) && $modSettings['hof_layout'] == 1) || empty($modSettings['hof_layout']))
		template_layout1();
	elseif((!empty($modSettings['hof_layout']) && $modSettings['hof_layout'] == 3) || empty($modSettings['hof_layout']))
		template_layout3();
	else
		template_layout2();
}

/**
 * The unusual layout
 */
function template_layout2()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings, $memberContext, $sc;
	
	$permit = allowedTo('admin_forum');
	
	$alter = true;
	if(!empty($context['hof_classes'])) {
		foreach($context['hof_classes'] as $id => $data2) {
			
			echo'
			<div class="windowbg', $alter ? '' : '2', '">
				<span class="topslice"><span></span></span>
				<div class="content">';
			
			echo '
			<div class="hof_class">
				<div class="hof_cheader"><h1>', $data2['title'], '</h1><span class="smalltext">', $data2['description'], '</span></div><hr>';
			
			$FAMERS = count($context['hof_famers'][$data2['id']]);
			if($FAMERS==0)
				continue;
			foreach($context['hof_famers'][$data2['id']] as $id=>$data) {
				
				// Get The Avatar the easy Way
				$hof_member = $data['ID_MEMBER'];
			    loadMemberData($data['ID_MEMBER']);
			    loadMemberContext($data['ID_MEMBER']);
				
				$dateR = explode(', ', timeformat($data['dateRegistered'], false));
				
				echo'
				<div class="hof_member" style="', !empty($modSettings['hof_ewidth']) ? 'width: '.$modSettings['hof_ewidth'].'px' : '', '">
					<div class="hof_mImage">', !empty($memberContext[$hof_member]['avatar']['image']) ? $memberContext[$hof_member]['avatar']['image'] : '<img class="avatar" src="'.$settings['default_theme_url'].'/images/admin/hof_user.png" />', '</div>
					<div class="hof_who"><h4><a href="', $scripturl, '?action=profile;u=', $data['ID_MEMBER'], '">', $data['realName'], '</a></h4><div>', $dateR[0], ', ', $dateR[1], '</div></div>
				</div>';
			}
			
			echo'</div>';
			
			echo'</div>
				<span class="botslice clear_right"><span></span></span>
			</div>';
			$alter = !$alter;
		}
	} else {
		echo'
		<div class="windowbg2">
			<span class="topslice"><span></span></span>
			<div class="content">'.$txt['hof_empty'].'</div>
			<span class="botslice clear_right"><span></span></span>
		</div>';
	}
}

/**
 * The boxy layout
 */
function template_layout1()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings, $sc;
	$permit = allowedTo('admin_forum');
	
	$alter = true;
	if(!empty($context['hof_classes'])) {
		foreach($context['hof_classes'] as $id => $data) {
			// Show Classes.
			echo '
			<div class="windowbg', $alter ? '' : '2', '">
				<span class="topslice"><span></span></span>
				<div class="content features">
					<div class="padding">
						<img class="features_image png_fix" src="', $settings['default_theme_url'], '/images/admin/hof.png" width="65" alt="', $data['title'], '">
						<h4 style="    padding-bottom: 0;">', $data['title'], '</h4>
						<p>', $data['description'], '</p>
						<hr>
						<div class="hof_members">';
						if(!empty($context['hof_famers'][$data['id']]))
							foreach($context['hof_famers'][$data['id']] as $id=>$data) {
								echo '<a href="', $scripturl, '?action=profile;u=', $data['ID_MEMBER'], '" class="titlebg" style="display:inline-block;padding: 3px 5px;border-radius: 2px;margin: 2px 2px;">
										'.$data['realName'].'
									</a>';
							}
						echo'</div>
					</div>
				</div>
				<span class="botslice clear_right"><span></span></span>
			</div>';
			$alter = !$alter;
		}
		
		// Do Not Touch
		echo'<hr><div class="titlebg" style="padding: 6px 12px;border-radius: 4px;font-size: 11px;">', hexToStr($context['key']), '', $permit ? '<span style="float:right"><a href="'.$scripturl.'?action=admin;area=hof;sa=admin;sesc='.$sc.'">Admin Page</a></span>' : '', '</div>';

	} else {
		echo'<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">'.$txt['hof_empty_classes'].'</div>
				<span class="botslice clear_right"><span></span></span>
			</div>';
	}
}

/**
 * The table layout
 */
function template_layout3()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings, $sc, $memberContext;
	$permit = allowedTo('admin_forum');
	
	if(!empty($context['hof_classes'])) {
		foreach($context['hof_classes'] as $id => $data)
		{
			// Show Classes.
			echo '
			<table width="100%" cellspacing="0" class="hof_table table_grid">
				<thead>
					<tr class="" align="left">
						<th colspan="2">
							<div class="cat_bar">
								<h3 class="catbg">
									', $data['title'], '
								</h3>
							</div>
						</th>
					</tr>
				</thead>
				<tbody>
					', !empty($data['description']) ? '<tr class="windowbg hof_description"><td colspan="2"><smalltext>'.$data['description'].'</smalltext></td></tr>' : '';
				$alter = true;
				if(!empty($context['hof_famers'][$data['id']]))
					foreach($context['hof_famers'][$data['id']] as $id=>$data2) {
						// Get The Avatar the easy Way
						$hof_member = $data2['ID_MEMBER'];
						loadMemberData($data2['ID_MEMBER']);
						loadMemberContext($data2['ID_MEMBER']);
						$dateR = explode(', ', timeformat($data2['dateRegistered'], false));
						
						echo '
						<tr class="windowbg', $alter ? 2 : '', '">
							<td>
								<a href="', $scripturl, '?action=profile;u=', $data2['ID_MEMBER'], '">
									', !empty($memberContext[$hof_member]['avatar']['image']) ? $memberContext[$hof_member]['avatar']['image'] : '<img class="avatar" src="'.$settings['default_theme_url'].'/images/admin/hof_user.png" />', '
									<span class="nam">'.$data2['realName'].'<br><smalltext class="hof_show" style="font-size:12px">', $dateR[0], ', ', $dateR[1], '</smalltext></span>
								</a>
							</td>
							<td align="right" class="hof_reg">', $txt['member_since'], ': <strong>', $dateR[0], ', ', $dateR[1], '</strong></td>
						</tr>';
						$alter = !$alter;
					}
			echo'</tbody>
			</table>';
			
		}
	}
	else
	{
		echo'<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">'.$txt['hof_empty_classes'].'</div>
				<span class="botslice clear_right"><span></span></span>
			</div>';
	}
}

/**
 * Admin Page
 */
function template_adminset()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings, $smcFunc;
	$STATE = !empty($_REQUEST['state']) ? $_REQUEST['state'] : null;
	$MESSAGE = !empty($_REQUEST['message']) ? $smcFunc['htmlspecialchars']($_REQUEST['message']) : null;
	if(!empty($STATE)) {
		if($STATE == "success")
			echo'<div class="windowbg" id="profile_success">
					', $txt['hof_success'], '
				</div>';
		else {
			echo'<div class="errorbox">';
				if(!empty($MESSAGE))
					echo'<strong>', $MESSAGE, '</strong><br/>';
				else 
					echo'<strong>', $txt['hof_error_unknown'], '</strong><br/>';
					
				echo'
				</div>';
		}
	}
	
	echo'<div class="hof_admin">';
	
	echo'<div class="cat_bar">
			<h3 class="catbg">
				', $txt['hof_classes'], '
			</h3>
		</div>';
			$alter = true;
			if(!empty($context['hof_classes']))
				foreach($context['hof_classes'] as $id => $data)
				{
					// Show Classes.
					echo '
					<div class="windowbg', $alter ? '' : '2', '">
						<span class="topslice"><span></span></span>
						<div class="content features">
							<img class="features_image png_fix" src="', $settings['default_theme_url'], '/images/admin/hof.png" width="65" alt="', $data['title'], '">
							<div class="features_switch" id="js_feature_cd" style="">
								<a href="', $scripturl, '?action=hof;sa=remove_class;id=', $data['id'],'">
									<img src="', $settings['default_theme_url'], '/images/admin/hof_remove.png" id="switch_cd" style="margin-top: 1.3em;" alt="', $txt['hof_delete_class'], '" title="', $txt['hof_delete_class'], '">
								</a>
							</div>
							<h4 style="padding-top: 5px">', $data['title'], '
								<a href="', $scripturl, '?action=hof;sa=edit;class=', $data['id'],'">
									<img src="', $settings['default_theme_url'], '/images/icons/modify_inline.gif" id="switch_cd" style="vertical-align:middle" alt="', $txt['hof_modify'], '" title="', $txt['hof_modify'], '">
								</a>
							</h4>
							<p>', $data['description'], '<br/>';
							if(!empty($context['hof_famers'][$data['id']]))
								foreach($context['hof_famers'][$data['id']] as $id=>$data) {
									echo '<div class="titlebg" style="display:inline-block;padding: 3px 5px;border-radius: 2px;margin: 2px 2px;">'.$data['realName'].'
									<a href="', $scripturl, '?action=hof;sa=remove_famer;id=', $data['ID_MEMBER'], ';class=', $data['class'], '"><img src="', $settings['theme_url'], '/images/pm_recipient_delete.gif" alt="', $txt['hof_delete_famer'], '" title="', $txt['hof_delete_famer'], '" style="margin: 0 0 0 4px;" /></a></div>';
								}
							echo'</p>
						</div>
						<span class="botslice clear_right"><span></span></span>
					</div>';
					$alter = !$alter;
				}
			else
			{
				echo'<div class="windowbg">
						<span class="topslice"><span></span></span>
						<div class="content">
							', $txt['hof_empty_classes'], '
						</div>
						<span class="botslice clear_right"><span></span></span>
					</div>';
			}
			
						// Add a Class.
						echo'
						<div class="modblock_left">
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
									<input id="submit" name="submit" type="submit" value="', $txt['hof_submit'], '"/>
								</form>
								</div>
								<span class="botslice"><span></span></span>
							</div>
						</div>';
						
						// Add a User.
						echo'
						<div class="modblock_right">
							<div class="cat_bar">
								<h3 class="catbg">
									', $txt['hof_add_famer'], '
								</h3>
							</div>
							<div class="windowbg">
								<span class="topslice"><span></span></span>
								<div class="content">';
								if(!empty($context['hof_classes'])) {
									echo'
									<form action="', $scripturl, '?action=hof;sa=add_famer" method="post">
										<input id="famer" name="famer" type="text" maxlength="50" placeholder="', $txt['hof_famer'], '" required/>
										<div id="famer_container"></div><br/>
										<input id="id" name="id" type="hidden" />
										<input id="date" name="date" type="hidden" value="', forum_time(false), '"/>
										<select name="class">';
											foreach($context['hof_classes'] as $id=>$data) {
												echo'<option value="', $data['id'], '" id="', $data['id'], '">', $data['title'], '</option>';
											}
										echo'
										</select><br/>
										<input id="submit" name="submit" type="submit" value="', $txt['hof_submit'], '"/>
									</form>'; 
								} else 
									echo $txt['hof_create_class_first'];
								echo'
								</div>
								<span class="botslice"><span></span></span>
							</div>
						</div>';
			echo'<div class="clear"></div>';
			echo'
			<div class="cat_bar">
				<h3 class="catbg">
					', $txt['settings'], '
				</h3>
			</div>
			<div class="windowbg2">
				<span class="topslice"><span></span></span>
				<div class="content">';
			// Change Global Title "Hall Of Fame", for other uses.
			echo'<fieldset id="globalTitle" class="hof_inline">
					<legend>', $txt['hof_change_globalTitle'], ' (', $txt['hof'], ')</legend>
					<form action="', $scripturl, '?action=hof;sa=hofeditSettings" method="post"><input type="text" name="globalTitle" id="globalTitle" value="', !empty($modSettings['hof_globalTitle']) ? $modSettings['hof_globalTitle'] : $txt['hof'], '" placeholder="', $txt['hof_globalTitle'], '" required/><input type="submit" name="submit" value="', $txt['hof_submit'], '"/></form>
				</fieldset>';			
			// Activate/Deactivate Page.
			$active = $modSettings['hof_active'];
			echo $txt['hof_act_deact'].' <a href="'.$scripturl.'?action=admin;area=hof;sa=admin;active=', $active ? 0 : 1, '">', $active ? $txt['hof_deactivate'] : $txt['hof_activate'], '</a><br/>';
			echo'<hr>';
			// Theme Selection
			$layout1 = (!empty($modSettings['hof_layout']) && $modSettings['hof_layout']==1) || empty($modSettings['hof_layout']);
			$layout2 = !empty($modSettings['hof_layout']) && $modSettings['hof_layout']==2;
			$layout3 = !empty($modSettings['hof_layout']) && $modSettings['hof_layout']==3;
			echo '<fieldset id="hof_layout" class="hof_inline">
					<legend>', $txt['hof_layout'], '</legend>
					<div class="hof_layout">
						<a href="', $scripturl, '?action=admin;area=hof;sa=admin;hof_layout=1" class="', $layout1 ? 'active' : '', '"><img src="', $settings['default_theme_url'], '/images/admin/hof_list.png" alt="List" /></a>
						<a href="', $scripturl, '?action=admin;area=hof;sa=admin;hof_layout=2" class="', $layout2 ? 'active' : '', '"><img src="', $settings['default_theme_url'], '/images/admin/hof_grid.png" alt="Grid" /></a>
						<a href="', $scripturl, '?action=admin;area=hof;sa=admin;hof_layout=3" class="', $layout3 ? 'active' : '', '"><img src="', $settings['default_theme_url'], '/images/admin/hof_table.png" alt="Table" /></a>';
					if($layout2)
					echo'<br/>
						<form action="', $scripturl, '?action=hof;sa=hofeditSettings" method="post">', $txt['hof_ewidth'], '<input type="number" name="ewidth" id="ewidth" placeholder="170" value="', !empty($modSettings['hof_ewidth']) ? $modSettings['hof_ewidth'] : '170', '"/><input type="submit" name="submit" value="', $txt['hof_submit'], '"/></form>';
					echo'
					</div>
				</fieldset>';
				
				echo'
				</div>
				<span class="botslice"><span></span></span>
			</div>
		</div>';
			
			// JS !!!
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
	global $context, $settings, $options, $txt, $scripturl, $modSettings;
	echo'<div class="cat_bar">
			<h3 class="catbg">
				', $context['hof_current_class']['title'], '
			</h3>
		</div>
	<div class="windowbg2">
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