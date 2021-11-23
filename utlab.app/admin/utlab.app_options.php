<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php';

if ($APPLICATION->GetGroupRight("utlab.app") == "D")
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

// обработка request
$request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();
if ($request->isPost() && $request['btn_save'] && check_bitrix_sessid()) {
    \Utlab\App\Options::setOptions($_REQUEST['params']);
}

// Получаем данные
$optionsData = \Utlab\App\Options::getOptions();

$aTabs = array(
    array("DIV" => "edit1", "TAB" => 'Настройки', "TITLE" => 'Настройки сайта',
    ));
$tabControl = new CAdminTabControl("tabControl", $aTabs);


require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php';
?>

    <form method="post" action="<?= $APPLICATION->GetCurPage(false) ?>" name="post_form">
        <?= bitrix_sessid_post() ?>
        <? $tabControl->Begin(); ?>
        <? $tabControl->BeginNextTab(); ?>
        <tr>
            <td class="adm-detail-content-cell-l" width="40%">Телефон:</td>
            <td class="adm-detail-content-cell-r" width="60%">
                <input autocomplete="off" type="text" size="10" name="params[phone]" value="<?= $optionsData['phone'] ?>"> </td>
        </tr>
        <? $tabControl->Buttons(); ?>
        <input type="submit" name="btn_save" value="Сохранить">
        <? $tabControl->End(); ?>
    </form>

<? require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php';