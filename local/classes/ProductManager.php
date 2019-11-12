<?php

namespace MyTest;

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Entity\ReferenceField;

class ProductManager
{
    private $IBLOCK_ID;

    public function __construct($iblock_id)
    {
        $this->IBLOCK_ID = $iblock_id;
    }

    public function Add($fields)
    {
        $iblockElement = new \CIBlockElement();
        $id = $iblockElement->Add([
            'IBLOCK_ID' => $this->IBLOCK_ID,
            'NAME' => $fields['NAME'],
            'ACTIVE' => 'Y',
            'PROPERTY_VALUES' => [
                'COLOR' => $fields['COLOR'],
                'SIZE' => $this->getPropertySize($fields['SIZE'])
            ]
        ]);

        if (!$id) {
            return false;
        }

        return $this->GetInfo($id);
    }

    public function Delete($id)
    {
        $result = \CIBlockElement::Delete($id);

        return $result;
    }

    public function Update($id, $fields)
    {

        $arFields = [
            'PROPERTY_VALUES' => [
                'COLOR' => $fields['COLOR'],
                'SIZE' => $this->getPropertySize($fields['SIZE'])
            ]
        ];

        if (!empty($fields['NAME'])) {
            $arFields['NAME'] = $fields['NAME'];
        }

        $iblockElement = new \CIBlockElement();
        $result = $iblockElement->Update($id, $arFields);

        if (!$result) {
            return false;
        }

        return $this->GetInfo($id);
    }

    public function GetInfo($id)
    {
        $result = [];

        $rows = ElementTable::getList([
            'select' => [
                'ID',
                'NAME',
                'PROPERTY_CODE' => 'PROPERTY.CODE',
                'VALUE' => 'PROPERTY_ELEMENT.VALUE',
                'VALUE_ENUM' => 'PROPERTY_ENUM.VALUE'
            ],
            'filter' => [
                'IBLOCK_ID' => $this->IBLOCK_ID,
                'ID' => $id,
                'ACTIVE' => 'Y'
            ],
            'runtime' => [
                new ReferenceField(
                    'PROPERTY_ELEMENT', '\MyTest\ElementPropertyTable',
                    array(
                        '=this.ID' => 'ref.IBLOCK_ELEMENT_ID'
                    ),
                    array(
                        "join_type" => 'left'
                    )
                ),
                new ReferenceField(
                    'PROPERTY', 'Bitrix\Iblock\PropertyTable',
                    array(
                        '=this.PROPERTY_ELEMENT.IBLOCK_PROPERTY_ID' => 'ref.ID'
                    ),
                    array(
                        "join_type" => 'left'
                    )
                ),
                new ReferenceField(
                    'PROPERTY_ENUM', 'Bitrix\Iblock\PropertyEnumeration',
                    array(
                        '=this.PROPERTY_ELEMENT.VALUE_ENUM' => 'ref.ID'
                    ),
                    array(
                        "join_type" => 'left'
                    )
                ),
            ]
        ])->fetchAll();

        if ($rows) {
            $result = [
                'ID' => current($rows)['ID'],
                'NAME' => current($rows)['NAME']
            ];

            foreach ($rows as $row) {
                if (!empty($row['VALUE_ENUM'])) {
                    $properties[$row['PROPERTY_CODE']] = $row['VALUE_ENUM'];
                } else {
                    $properties[$row['PROPERTY_CODE']] = $row['VALUE'];
                }
            }

            $result['PROPERTIES'] = $properties;
        }

        return $result;
    }

    private function getPropertySize($value)
    {
        $itemID = '';

        if ($value) {
            $propertySize = \CIBlockProperty::GetList(['ID' => 'DESC'], [
                'IBLOCK_ID' => $this->IBLOCK_ID,
                'CODE' => 'SIZE'
            ])->Fetch();

            $propertyItem = \CIBlockProperty::GetPropertyEnum($propertySize['ID'], ['ID' => 'DESC'],[
                    "IBLOCK_ID" => $this->IBLOCK_ID,
                    "VALUE" => $value]
            )->Fetch();

            if (!$propertyItem) {
                $itemID = \CIBlockPropertyEnum::Add([
                    'PROPERTY_ID' => $propertySize['ID'],
                    'VALUE' => $value
                ]);
            } else {
                $itemID = $propertyItem['ID'];
            }
        }

        return $itemID;
    }
}