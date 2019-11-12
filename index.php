<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Главная страница");
?>

<?
$APPLICATION->IncludeComponent(
    "mytest:main.goods",
    "",
    [
        'IBLOCK_ID' => 1,
        'DATA_TYPE' => "html",
    ],
    false
);?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>