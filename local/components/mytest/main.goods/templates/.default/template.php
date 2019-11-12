<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */

/** @var CBitrixComponent $component */

$this->setFrameMode(true);

CJSCore::Init(["jquery"]);
?>

<div id="main-goods" data-iblock="<?=$arParams['IBLOCK_ID']?>">
    <h2><?= Loc::getMessage("TITLE") ?></h2>

    <form action="" method="post">
        <label for="id">ID</label>
        <input type="number" name="id">

        <label for="name"><?= Loc::getMessage("NAME") ?></label>
        <input type="text" name="name">

        <label for="color"><?= Loc::getMessage("COLOR") ?></label>
        <input type="text" name="color">

        <label for="size"><?= Loc::getMessage("SIZE") ?></label>
        <input type="text" name="size">

        <select name="action">
            <option value="add">Add</option>
            <option value="delete">Delete</option>
            <option value="update">Update</option>
            <option value="get">GetInfo</option>
        </select>

        <input type="submit" value="<?= Loc::getMessage("MAKE") ?>">

        <p class="message"></p>
        <p class="result"></p>
    </form>
</div>


