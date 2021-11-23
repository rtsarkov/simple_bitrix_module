<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

if ($APPLICATION->GetGroupRight("utlab.app") != "D") {
    $aMenu = array(
        'menu_id' => 'global_menu_utlab_app',
        'text' => 'Utlab',
        'title' => 'Utlab 123',
        'sort' => 1000,
        'items_id' => 'global_menu_utlab_app_items',
        'icon' => 'imi_max',
        'items' => array(
            'sort'        => 10,
            'text'        => 'Настройки сайта',
            'title'       => 'Настройки сайта',
            'url'         => 'utlab.app_options.php',
            "icon" => "util_menu_icon",
            "page_icon" => "util_page_icon"
        )
    );
    return $aMenu;
}

return false;