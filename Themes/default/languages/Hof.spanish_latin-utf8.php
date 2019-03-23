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
 *
 * Spanish translation by Rock Lee 
 * https://www.bombercode.net Copyright 2014-2019
 */

$txt['hof_admin'] = "Salón de la Fama administración";
$txt['hof_PageTitle'] = "Salón de la Fama";
$txt['hof'] = "Salón de la Fama";
$txt['hof_famer'] = "Usuario";
$txt['hof_title'] = "Título";
$txt['hof_description'] = "Descripción, ¡hazlo corto!";
$txt['hof_add_famer'] = "Agrega un usuario:";
$txt['hof_submit'] = "Enviar";
$txt['hof_add_class'] = "Añadir una clase:";
$txt['hof_edit_class'] = "Editar clase";
$txt['hof_empty'] = "Nada que mostrar aún";
$txt['hof_empty_classes'] = "No hay clases para mostrar.";
$txt['hof_classes'] = "Clases";
$txt['hof_layout'] = "Cambiar el diseño de página de Salón de la Fama:";
$txt['hof_delete_class'] = "Eliminar clase";
$txt['hof_delete_famer'] = "Eliminar usuario de esta clase";
$txt['hof_error_unknown'] = "Algo salió mal :(";
$txt['hof_success'] = "Operación llevada a cabo con éxito";
$txt['hof_create_class_first'] = "Crear una clase para comenzar";
$txt['hof_modify'] = "Modificar";
$txt['member_since'] = "Miembro desde";
$txt['hof_globalTitle'] = "Título de la página";
// Who's Online list
global $modSettings, $helptxt;
$txt['whoall_hof'] = 'Viendo el <a href="' . $scripturl . '?action=hof">'.$modSettings['hof_globalTitle'].'</a> Page';

// Version 1.2
$txt['hof_active'] = "Mostrar el salón de la fama (".$modSettings['hof_globalTitle'].")";
$txt['hof_unactive'] = "Esta página actualmente no es visible para el público.";
$txt['hof_square_avatar'] = "Haz que la altura del avatar sea igual a su ancho";
$txt['hof_border_radius'] = "Radio del borde del avatar";
$txt['hof_border_radius_help'] = "en píxeles, utilizar 100% para avatares redondos";
$txt['hof_ewidth'] = "Ancho del avatar";
$txt['hof_layout_1'] = "Cajas";
$txt['hof_layout_2'] = "Grandes elementos";
$txt['hof_layout_3'] = "Tabla";
$txt['hof_menu_icon'] = "Icono para el elemento del menú";

// You only have to translate the first line of this :P, thanks
$helptxt['hof_menu_icon'] = 'Cada icono está definido por una o más palabras clave, los iconos y las palabras clave pueden diferir de un tema a otro:<br>
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