<?

namespace Utlab\App;

use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use \Bitrix\Main\Config\Option;

/**
 * Класс для работы с настройками модуля
 */
class Options
{
    /**
     * ID модуля
     */
    private static $moduleId = 'utlab_app';

    /**
     * Список доступных полей
     */
    private static $optionsList = array(
        'phone',
    );

    /**
     * Получить значения всех настроек
     */
    public static function getOptions()
    {
        $result = [];
        foreach (self::$optionsList as $option) {
            $result[$option] = self::getOption($option);
        }
        return $result;
    }

    /**
     * Получить значение настройки
     */
    public static function getOption($name)
    {
        try {
            return Option::get(
                self::$moduleId,
                $name
            );
        } catch (ArgumentNullException $e) {
            echo $e;
        } catch (ArgumentOutOfRangeException $e) {
            echo $e;
        }
    }

    /**
     * Сохранить все настройки
     * @throws \Bitrix\Main\ArgumentOutOfRangeException
     */
    public static function setOptions($params)
    {
        foreach ($params as $param => $value) {
            if (in_array($param, self::$optionsList)) {
                self::setOption($param, $value);
            }
        }
    }

    /**
     * Сохранить настройку
     * @throws \Bitrix\Main\ArgumentOutOfRangeException
     */
    public static function setOption($name, $value)
    {
        try {
            Option::set(self::$moduleId, $name, $value);
        } catch (\Bitrix\Main\ArgumentOutOfRangeException $e) {
            echo $e;
        }
    }

}