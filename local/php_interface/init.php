<?
require "vendor/autoload.php";
include "local/php_interface/Parser.php";
CModule::IncludeModule("iblock");


function parseInfo()
{
    $parser = new Parser(10);
    $allNewsArray = $parser->GetNews();
    $element = new CIBlockElement;

    if (count($allNewsArray) != 0) {
        foreach ($allNewsArray as $news) {
            // Свойства инфоблока
            $newProperty = array(
                //"TITLE" => $news->title,
                "PREVIEW_TEXT" => $news->shortDescription,
                "DETAIL_PICTURE" => $news->picture,
                "DETAIL_TEXT" => $news->detailText,
                "LINK" => $news->link
            );

            // Создание элемента на добавление в инфоблок
            $arLoadProductArray = array(
                'MODIFIED_BY' => $GLOBALS['USER']->GetID(), // элемент изменен текущим пользователем
                'IBLOCK_SECTION_ID' => false, // элемент лежит в корне раздела
                'IBLOCK_ID' => 3,
                'PROPERTY_VALUES' => $newProperty,
                'NAME' => $news->title,
                'ACTIVE' => 'Y', // активен
                'PREVIEW_TEXT' => $news->shortDescription,
                'DETAIL_TEXT' => $news->detailText,
                'DETAIL_PICTURE' => CFile::MakeFileArray($news->picture)
            );

            if ($PRODUCT_ID = $element->Add($arLoadProductArray)) {
                echo 'New ID: ' . $PRODUCT_ID;
            } else {
                echo 'Error: ' . $element->LAST_ERROR;
            }
        }
    }

    return "parseInfo();";
}

