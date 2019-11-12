<?php

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentDescription = [
    "NAME" => Loc::getMessage('BLANK_COMPONENT_NAME'),
    "DESCRIPTION" => Loc::getMessage('BLANK_COMPONENT_DESCRIPTION'),
    "ICON" => "",
    "CACHE_PATH" => "Y",
    "SORT" => 10,
    "PATH" => [
        "ID" => Loc::getMessage('COMPONENTS_ROOT'),
        "CHILD" => [
            "ID" => "blank_component",
            "NAME" => Loc::getMessage('BLANK_COMPONENT')
        ]
    ]
];