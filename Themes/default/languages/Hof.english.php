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

$txt['hof_admin'] = "HOF Admin Page";
$txt['hof_PageTitle'] = "Hall Of Fame";
$txt['hof'] = "Hall Of Fame";
$txt['hof_famer'] = "User";
$txt['hof_title'] = "Title";
$txt['hof_description'] = "Description, Keep it short !";
$txt['hof_submit'] = "Submit";
$txt['hof_add_famer'] = "Add a User:";
$txt['hof_add_class'] = "Add a Class:";
$txt['hof_edit_class'] = "Edit Class";
$txt['hof_empty'] = "Nothing to Show Yet";
$txt['hof_empty_classes'] = "No Classes to Show.";
$txt['hof_classes'] = "Classes";
$txt['hof_layout'] = "Change HOF Page Layout:";
$txt['hof_delete_class'] = "Delete Class";
$txt['hof_delete_famer'] = "Delete User from This Class";
$txt['hof_error_unknown'] = "Something Went Wrong";
$txt['hof_success'] = "Operation Carried Out Successfully";
$txt['hof_create_class_first'] = "Create a Class To Begin";
$txt['hof_modify'] = "Modify";
$txt['hof_activate'] = "Activate";
$txt['hof_deactivate'] = "Deactivate";
$txt['member_since'] = "Member Since";
$txt['hof_globalTitle'] = "Global Title";

// Who's online list
global $modSettings, $helptxt;
$txt['whoall_hof'] = 'Viewing the <a href="' . $scripturl . '?action=hof">'.$modSettings['hof_globalTitle'].'</a> Page';

// Version 1.2
$txt['hof_active'] = "Show the hall of fame (".$modSettings['hof_globalTitle'].")";
$txt['hof_unactive'] = "This page is currently not visible to the public.";
$txt['hof_square_avatar'] = "Make the avatar's height equal to it's width";
$txt['hof_border_radius'] = "Avatar border radius";
$txt['hof_border_radius_help'] = "in pixels, use 100% for round avatars";
$txt['hof_ewidth'] = "Avatar width";
$txt['hof_layout_1'] = "Boxy";
$txt['hof_layout_2'] = "Large elements";
$txt['hof_layout_3'] = "Table";
$txt['hof_menu_icon'] = "Icon for the menu item";

// You only have to translate the first line of this :P, thanks
$helptxt['hof_menu_icon'] = 'Each icon is defined by one or more keywords, icons and keywords may differ from one theme to another:<br>
<span class="main_icons help"></span> : help<br>
<span class="main_icons search"></span> : search<br>
<span class="main_icons engines"></span> : engines<br>
<span class="main_icons quick_edit_button"></span> : quick_edit_button<br>
<span class="main_icons modify_button"></span> : modify_button<br>
<span class="main_icons check"></span> : check<br>
<span class="main_icons invalid"></span> : invalid<br>
<span class="main_icons gender_2"></span> : gender_2<br>
<span class="main_icons watch"></span> : watch<br>
<span class="main_icons move"></span> : move<br>
<span class="main_icons next_page"></span> : next_page<br>
<span class="main_icons general"></span> : general<br>
<span class="main_icons topics_views"></span> : topics_views<br>
<span class="main_icons gender_1"></span> : gender_1<br>
<span class="main_icons features"></span> : features<br>
<span class="main_icons posters"></span> : posters<br>
<span class="main_icons replies"></span> : replies<br>
<span class="main_icons topics_replies"></span> : topics_replies<br>
<span class="main_icons history"></span> : history<br>
<span class="main_icons scheduled"></span> : scheduled<br>
<span class="main_icons views"></span> : views<br>
<span class="main_icons last_post"></span> : last_post<br>
<span class="main_icons starters"></span> : starters<br>
<span class="main_icons mlist"></span> : mlist<br>
<span class="main_icons poll"></span> : poll<br>
<span class="main_icons previous_page"></span> : previous_page<br>
<span class="main_icons inbox"></span> : inbox<br>
<span class="main_icons www"></span> : www<br>
<span class="main_icons exit"></span> : exit<br>
<span class="main_icons logout"></span> : logout<br>
<span class="main_icons switch"></span> : switch<br>
<span class="main_icons replied"></span> : replied<br>
<span class="main_icons send"></span> : send<br>
<span class="main_icons im_on"></span> : im_on<br>
<span class="main_icons im_off"></span> : im_off<br>
<span class="main_icons split_desel"></span> : split_desel<br>
<span class="main_icons split_sel"></span> : split_sel<br>
<span class="main_icons mail"></span> : mail<br>
<span class="main_icons warning_mute"></span> : warning_mute<br>
<span class="main_icons alerts"></span> : alerts<br>
<span class="main_icons warning_moderate"></span> : warning_moderate<br>
<span class="main_icons mail_new"></span> : mail_new<br>
<span class="main_icons drafts"></span> : drafts<br>
<span class="main_icons reply_all_button"></span> : reply_all_button<br>
<span class="main_icons warning_watch"></span> : warning_watch<br>
<span class="main_icons calendar_export"></span> : calendar_export<br>
<span class="main_icons calendar"></span> : calendar<br>
<span class="main_icons calendar_modify"></span> : calendar_modify<br>
<span class="main_icons plus"></span> : plus<br>
<span class="main_icons warning"></span> : warning<br>
<span class="main_icons moderate"></span> : moderate<br>
<span class="main_icons themes"></span> : themes<br>
<span class="main_icons support"></span> : support<br>
<span class="main_icons liked_users"></span> : liked_users<br>
<span class="main_icons like"></span> : like<br>
<span class="main_icons unlike"></span> : unlike<br>
<span class="main_icons current_theme"></span> : current_theme<br>
<span class="main_icons stats"></span> : stats<br>
<span class="main_icons right_arrow"></span> : right_arrow<br>
<span class="main_icons left_arrow"></span> : left_arrow<br>
<span class="main_icons smiley"></span> : smiley<br>
<span class="main_icons server"></span> : server<br>
<span class="main_icons ban"></span> : ban<br>
<span class="main_icons ignore"></span> : ignore<br>
<span class="main_icons boards"></span> : boards<br>
<span class="main_icons regcenter"></span> : regcenter<br>
<span class="main_icons posts"></span> : posts<br>
<span class="main_icons sort_down"></span> : sort_down<br>
<span class="main_icons change_menu2"></span> : change_menu2<br>
<span class="main_icons sent"></span> : sent<br>
<span class="main_icons post_moderation_moderate"></span> : post_moderation_moderate<br>
<span class="main_icons sort_up"></span> : sort_up<br>
<span class="main_icons post_moderation_deny"></span> : post_moderation_deny<br>
<span class="main_icons post_moderation_attach"></span> : post_moderation_attach<br>
<span class="main_icons post_moderation_allow"></span> : post_moderation_allow<br>
<span class="main_icons personal_message"></span> : personal_message<br>
<span class="main_icons permissions"></span> : permissions<br>
<span class="main_icons signup"></span> : signup<br>
<span class="main_icons paid"></span> : paid<br>
<span class="main_icons packages"></span> : packages<br>
<span class="main_icons filter"></span> : filter<br>
<span class="main_icons change_menu"></span> : change_menu<br>
<span class="main_icons package_ops"></span> : package_ops<br>
<span class="main_icons reports"></span> : reports<br>
<span class="main_icons news"></span> : news<br>
<span class="main_icons delete"></span> : delete<br>
<span class="main_icons remove_button"></span> : remove_button<br>
<span class="main_icons modifications"></span> : modifications<br>
<span class="main_icons maintain"></span> : maintain<br>
<span class="main_icons admin"></span> : admin<br>
<span class="main_icons administration"></span> : administration<br>
<span class="main_icons home"></span> : home<br>
<span class="main_icons frenemy"></span> : frenemy<br>
<span class="main_icons attachment"></span> : attachment<br>
<span class="main_icons lock"></span> : lock<br>
<span class="main_icons security"></span> : security<br>
<span class="main_icons error"></span> : error<br>
<span class="main_icons disable"></span> : disable<br>
<span class="main_icons languages"></span> : languages<br>
<span class="main_icons members_request"></span> : members_request<br>
<span class="main_icons members_delete"></span> : members_delete<br>
<span class="main_icons members"></span> : members<br>
<span class="main_icons members_watched"></span> : members_watched<br>
<span class="main_icons sticky"></span> : sticky<br>
<span class="main_icons corefeatures"></span> : corefeatures<br>
<span class="main_icons manlabels"></span> : manlabels<br>
<span class="main_icons calendar"></span> : calendar<br>
<span class="main_icons logs"></span> : logs<br>
<span class="main_icons valid"></span> : valid<br>
<span class="main_icons approve"></span> : approve<br>
<span class="main_icons read_button"></span> : read_button<br>
<span class="main_icons close"></span> : close<br>
<span class="main_icons details"></span> : details<br>
<span class="main_icons merge"></span> : merge<br>
<span class="main_icons folder"></span> : folder<br>
<span class="main_icons restore_button"></span> : restore_button<br>
<span class="main_icons split_button"></span> : split_button<br>
<span class="main_icons unapprove_button"></span> : unapprove_button<br>
<span class="main_icons unread_button"></span> : unread_button<br>
<span class="main_icons quote"></span> : quote<br>
<span class="main_icons quote_selected"></span> : quote_selected<br>
<span class="main_icons notify_button"></span> : notify_button<br>
<span class="main_icons select_above"></span> : select_above<br>
<span class="main_icons select_here"></span> : select_here<br>
<span class="main_icons select_below"></span> : select_below';
?>