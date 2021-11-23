<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('main', 'OnBuildGlobalMenu', 'GlobalMenuBuild');

function GlobalMenuBuild(&$aGlobalMenu, &$arModuleMenu)
{
    global $APPLICATION;
    if ($APPLICATION->GetGroupRight("utlab.app") != "D") {
        $aGlobalMenu['global_menu_alkodesign'] = array(
            'menu_id' => 'utlab_app',
            'text' => 'Utlab',
            'title' => 'Utlab',
            'sort' => '9999',
            'items_id' => 'global_menu_utlab_app',
            'items' => array(
                array(
                    'sort' => 10,
                    'text' => 'Настройки сайта',
                    'title' => 'Настройки сайта',
                    'url' => 'utlab.app_options.php',
                    "icon" => "util_menu_icon",
                    "page_icon" => "util_page_icon"
                )
            )
        );
    }
}

