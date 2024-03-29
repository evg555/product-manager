<?php


namespace MyTest;

use Bitrix\Main;


class ElementPropertyTable extends Main\Entity\DataManager{

    public static function getTableName(){
        return 'b_iblock_element_property';
    }

    public static function getMap()
    {
        return array(
            'ID' => new Main\Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true,
                'title' => "ID записи",
            )),
            'IBLOCK_PROPERTY_ID' => new Main\Entity\IntegerField('IBLOCK_PROPERTY_ID', array(
                'title' => "ID свойства",
            )),
            'IBLOCK_ELEMENT_ID' => new Main\Entity\IntegerField('IBLOCK_ELEMENT_ID', array(
                'title' => "ID элемента инфоблока",
            )),
            'VALUE' => new Main\Entity\StringField('VALUE', array(
                'title' => "Значение",
            )),
            'VALUE_TYPE' => new Main\Entity\StringField('VALUE_TYPE', array(
                'title' => "Тип значения",
            )),
            'VALUE_ENUM' => new Main\Entity\StringField('VALUE_ENUM', array(
                'title' => "ID элемента списка в свойстве типа Список",
            )),
            'VALUE_NUM' => new Main\Entity\StringField('VALUE_NUM', array(
                'title' => "VALUE_NUM",
            )),
            'DESCRIPTION' => new Main\Entity\TextField('DESCRIPTION', array(
                'title' => "Описание",
            )),

        );
    }
}