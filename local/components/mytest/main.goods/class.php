<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class MainGoodsComponent extends \CBitrixComponent
{
    
    public function onPrepareComponentParams($arParams)
    {
        $arParams = parent::onPrepareComponentParams($arParams);

        $arParams["DATA_TYPE"] = (isset($arParams["DATA_TYPE"]) && in_array($arParams["DATA_TYPE"], ['html', 'json'])) ? $arParams["DATA_TYPE"] : 'html';
        $arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);

        return $arParams;
    }

    public function executeComponent()
    {
        if ($this->arParams['DATA_TYPE'] === 'json') {
            $this->showTemplate('ajax');
            return;
        }

        $this->showTemplate();
    }

    public function showTemplate($templateName = '')
    {
        $this->includeComponentTemplate($templateName);
    }
}