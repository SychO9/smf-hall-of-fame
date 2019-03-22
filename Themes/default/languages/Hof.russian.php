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
 * Russian translation by digger
 * https://mysmf.net (c) 2018
 */

$txt['hof_admin']              = "Настройки зала славы";
$txt['hof_PageTitle']          = "Зал славы";
$txt['hof']                    = "Зал славы";
$txt['hof_famer']              = "Пользователь";
$txt['hof_title']              = "Название";
$txt['hof_description']        = "Короткое описание.";
$txt['hof_submit']             = "Сохранить";
$txt['hof_add_famer']          = "Добавить пользователя:";
$txt['hof_add_class']          = "Добавить раздел:";
$txt['hof_edit_class']         = "Редактировать раздел";
$txt['hof_empty']              = "Показывать нечего";
$txt['hof_empty_classes']      = "Нет разделов.";
$txt['hof_classes']            = "Разделы";
$txt['hof_layout']             = "Изменить вид страницы:";
$txt['hof_delete_class']       = "Удалить раздел";
$txt['hof_delete_famer']       = "Убрать пользователя из этого раздела";
$txt['hof_error_unknown']      = "Что-то пошло не так!";
$txt['hof_success']            = "Успешно выполнено";
$txt['hof_create_class_first'] = "Сначала добавьте разделы.";
$txt['hof_modify']             = "Редактировать";
$txt['member_since']           = "Зарегистрирован";
$txt['hof_globalTitle']        = "Название страницы";
// Who's online list
global $modSettings;
$txt['whoall_hof'] = 'Просматривает <a href="' . $scripturl . '?action=hof">' . $modSettings['hof_globalTitle'] . '.</a>';

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
?>