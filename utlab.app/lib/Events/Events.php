<?php
namespace Utlab\App\Events;

class Events
{
    /**
     * Регистрация модуля при старте страницы
     */
    private static function registerModule()
    {
        \Bitrix\Main\Loader::includeModule('utlab.app');
    }
}