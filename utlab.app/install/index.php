<?

use Bitrix\Main\ModuleManager;
use \Bitrix\Main\EventManager;

class utlab_app extends CModule
{
    const MODULE_ID = "utlab.app";
    const MODULE_NAME = 'UtlabApp';
    const MODULE_DESCRIPTION = 'Модуль компании Utlab';
    const MODULE_GROUP_RIGHTS = 'N';
    const MODULE_CLASS_EVENTS = 'Utlab\App\Events\Events';
    private $PATH_INSTALL;


    public function __construct()
    {
        $this->SetInstallPath();
        $arModuleVersion = [];
        include __DIR__ . '/version.php';
        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        $this->MODULE_ID = self::MODULE_ID;
        $this->MODULE_NAME = self::MODULE_NAME;
        $this->MODULE_DESCRIPTION = self::MODULE_DESCRIPTION;
        $this->MODULE_GROUP_RIGHTS = self::MODULE_GROUP_RIGHTS;
    }

    public function DoInstall()
    {
        global $APPLICATION;
        if(CheckVersion(ModuleManager::getVersion("main"), "14.00.00")) {
            ModuleManager::registerModule($this->MODULE_ID);
            $this->InstallEvents();
            $this->InstallFiles();
            $APPLICATION->IncludeAdminFile(GetMessage('MODULE_INSTALLED'), $this->PATH_INSTALL . '/step.php');
        } else {
            $APPLICATION->ThrowException('Версия ядра меньше 14.00.00');
        }
    }

    public function DoUninstall()
    {
        global $APPLICATION;
        $this->UnInstallFiles();
        $this->UnInstallEvents();
        ModuleManager::unRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile(GetMessage('MODULE_UNINSTALLED'), $this->PATH_INSTALL . '/unstep.php');
    }


    public function InstallEvents()
    {
        EventManager::getInstance()->registerEventHandler(
            "main",
            "OnPageStart",
            self::MODULE_ID,
            self::MODULE_CLASS_EVENTS,
            'registerModule'
        );
    }


    public function UnInstallEvents()
    {
        // удаляем наш обработчик события
        EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnPageStart',
            self::MODULE_ID,
            self::MODULE_CLASS_EVENTS,
            'registerModule'
        );
    }

    public function InstallFiles()
    {
        CopyDirFiles(__DIR__.'/admin/', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin', true);
    }

    public function UnInstallFiles()
    {
        DeleteDirFiles(__DIR__.'/admin/', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin');
    }

    private function SetInstallPath() {
        $this->PATH_INSTALL = str_replace("\\", '/', __FILE__);
        $this->PATH_INSTALL = substr($this->PATH_INSTALL, 0, strlen($this->PATH_INSTALL) - strlen('/index.php'));
    }


}
