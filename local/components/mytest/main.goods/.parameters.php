<?php

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "DATA_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage('BLANK_COMPONENT_PARAMETER_DATA_TYPE'),
            "TYPE" => "LIST",
            "DEFAULT" => "html",
            'VALUES' => array(
                'html' => Loc::getMessage('BLANK_COMPONENT_PARAMETER_HTML'),
                'json' => Loc::getMessage('BLANK_COMPONENT_PARAMETER_JSON')
            )
        ],
    ],
];