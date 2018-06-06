<?php
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

/* Main Page Template.
----------------------- */
function template_main() {
	global $context, $settings, $options, $txt, $scripturl, $modSettings, $memberContext;
	
	if(!$modSettings['hof_active'] && !allowedTo('admin_forum'))
		redirectexit('action=forum');
	
	if((!empty($modSettings['hof_layout']) && $modSettings['hof_layout'] == 1) || empty($modSettings['hof_layout']))
		template_layout2();
	else
		template_layout1();
}
/* Our First Layout.
------------------------ */
function template_layout1() {
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
				<div class="hof_member">
					<div class="hof_mImage">', !empty($memberContext[$hof_member]['avatar']['image']) ? $memberContext[$hof_member]['avatar']['image'] : '<img src="'.$settings['default_theme_url'].'/images/admin/hof_user.png" />', '</div>
					<div class="hof_who"><h4><a href="', $scripturl, '?action=profile;id=', $data['ID_MEMBER'], '">', $data['realName'], '</a></h4><div>', $dateR[0], ', ', $dateR[1], '</div></div>
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
	
	// Do Not Touch
	echo'<div class="titlebg" style="padding: 6px 12px;border-radius: 4px;font-size: 11px;">', hexToStr($context['key']), '', $permit ? '<span style="float:right"><a href="'.$scripturl.'?action=admin;area=hof;sa=admin;sesc='.$sc.'">Admin Page</a></span>' : '', '</div>';
	
	echo'
	<style>
		.hof_cheader h1 {font-size: 16px;padding: 10px 0 5px 0;}
		.hof_member {display: inline-block;margin: 8px;padding: 0;background: #acacac;width: 170px;vertical-align: top;}
		.hof_class {text-align: center;}
		.hof_mImage {background: #bcbcbc;}
		.hof_who {padding: 10px 0;}
		.hof_who div {font-size: 11px;}
		.hof_member:hover .hof_mImage img {opacity: 1;}
		.hof_mImage img {width: 100%;height: 100%;opacity: 0.8;}
	</style>';
}
/* Our Second Layout.
------------------------ */
function template_layout2() {
	global $context, $settings, $options, $txt, $scripturl, $modSettings;
	
	$permit = allowedTo('admin_forum');
	
	echo'<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/admin.css?fin20" />';
	
	$alter = true;
	if(!empty($context['hof_classes'])) {
		foreach($context['hof_classes'] as $id => $data) {
			// Show Classes.
			echo '
			<div class="windowbg', $alter ? '' : '2', '">
				<span class="topslice"><span></span></span>
				<div class="content features">
					<img class="features_image png_fix" src="', $settings['default_theme_url'], '/images/admin/hof.png" width="65" alt="', $data['title'], '">
					<h4 style="    padding-bottom: 0;">', $data['title'], '</h4>
					<p>', $data['description'], '</p>
					<hr>
					<div class="hof_members">';
					if(!empty($context['hof_famers'][$data['id']]))
						foreach($context['hof_famers'][$data['id']] as $id=>$data) {
							echo '
							<a href="', $scripturl, '?action=profile;id=', $data['ID_MEMBER'], '" class="titlebg" style="display:inline-block;padding: 3px 5px;border-radius: 2px;margin: 2px 2px;">
								'.$data['realName'].'
							</a>';
						}
					echo'</div>
				</div>
				<span class="botslice clear_right"><span></span></span>
			</div>';
			$alter = !$alter;
		}
		
		// Do Not Touch
		echo'<div class="titlebg" style="padding: 6px 12px;border-radius: 4px;font-size: 11px;">', hexToStr($context['key']), '', $permit ? '<span style="float:right"><a href="'.$scripturl.'?action=admin;area=hof;sa=admin;sesc='.$sc.'">Admin Page</a></span>' : '', '</div>';

	} else {
		echo'<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">'.$txt['hof_empty_classes'].'</div>
				<span class="botslice clear_right"><span></span></span>
			</div>';
		// Do Not Touch
		echo'<div class="titlebg" style="padding: 6px 12px;border-radius: 4px;font-size: 11px;">', hexToStr($context['key']), '', $permit ? '<span style="float:right"><a href="'.$scripturl.'?action=admin;area=hof;sa=admin;sesc='.$sc.'">Admin Page</a></span>' : '', '</div>';

	}
}
/* Admin Page.
------------------------ */
function template_adminset() {
	global $context, $settings, $options, $txt, $scripturl, $modSettings;
	
	echo'<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/admin.css?fin20" />';
	
	$STATE = !empty($_REQUEST['state']) ? $_REQUEST['state'] : null;
	$MESSAGE = !empty($_REQUEST['message']) ? $_REQUEST['message'] : null;
	if(!empty($STATE)) {
		if($STATE == "success")
			echo'<div class="windowbg" id="profile_success">
					', $txt['hof_success'], '
				</div>';
		else {
			echo'<div class="errorbox">';
				if(!empty($MESSAGE))
					echo'<strong>', str_replace("%20", " " , $MESSAGE), '</strong><br/>';
				else 
					echo'<strong>', $txt['hof_error_unknown'], '</strong><br/>';
					
				echo'
				</div>';
		}
	}
	
	echo'<div class="cat_bar">
			<h3 class="catbg">
				', $txt['hof_classes'], '
			</h3>
		</div>';
			$alter = true;
			if(!empty($context['hof_classes'])) {
				foreach($context['hof_classes'] as $id => $data) {
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
			} else {
				echo'<div class="windowbg">
						<span class="topslice"><span></span></span>
						<div class="content">';
				echo $txt['hof_empty_classes'];
				echo'</div>
						<span class="botslice clear_right"><span></span></span>
					</div>';
			}
			
			echo'
			<div class="windowbg2">
				<span class="topslice"><span></span></span>
				<div class="content">';
						// Add a Class.
						echo'<div style="width:40%;display:inline-block;vertical-align:top;">
								<h3>', $txt['hof_add_class'], ' </h3>
								<form action="', $scripturl, '?action=hof;sa=add_class" method="post">
									<input id="title" name="title" type="text" maxlength="50" placeholder="', $txt['hof_title'], '" required/><br/>
									<textarea id="description" name="description" placeholder="', $txt['hof_description'], '"></textarea><br/>
									<input id="submit" name="submit" type="submit" />
								</form>
							</div>';
						// Add a User.
						echo'<div style="width:40%;display:inline-block;vertical-align:top;">
								<h3>', $txt['hof_add_famer'], ' </h3>';
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
										<input id="submit" name="submit" type="submit" />
									</form>'; 
								} else 
									echo $txt['hof_create_class_first'];
								echo'
							</div>';
			echo'<hr>';
			// Activate/Deactivate Page.
			$active = $modSettings['hof_active'];
			echo $txt['hof_act_deact'].' <a href="'.$scripturl.'?action=admin;area=hof;sa=admin;active=', $active ? 0 : 1, '">', $active ? $txt['hof_deactivate'] : $txt['hof_activate'], '</a><br/>';
			// Theme Selection
			$layout1 = (!empty($modSettings['hof_layout']) && $modSettings['hof_layout']==1) || empty($modSettings['hof_layout']);
			$layout2 = !empty($modSettings['hof_layout']) && $modSettings['hof_layout']==2;
			echo $txt['hof_layout'].'
				<div class="hof_layout">
					<a href="', $scripturl, '?action=hof;sa=admin;hof_layout=1" style="display: inline-block;', $layout1 ? 'background:lime' : '', '"><img src="', $settings['default_theme_url'], '/images/admin/hof_list.png" alt="List" /></a>
					<a href="', $scripturl, '?action=hof;sa=admin;hof_layout=2" style="display: inline-block;', $layout2 ? 'background:lime' : '', '"><img src="', $settings['default_theme_url'], '/images/admin/hof_grid.png" alt="Grid" /></a>
				</div>';
				
				echo'</div>
				<span class="botslice"><span></span></span>
			</div>';
			// Do Not Touch
			echo'<div class="titlebg" style="padding: 6px 12px;border-radius: 4px;font-size: 11px;">', hexToStr($context['key']), '</div>';

			
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
/* Editing a Class.
------------------------ */
function template_editClass() {
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
?>