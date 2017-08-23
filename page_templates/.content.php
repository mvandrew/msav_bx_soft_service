<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// IncludeTemplateLangFile(__FILE__);
\Bitrix\Main\Localization\Loc::loadLanguageFile(__FILE__);

$TEMPLATE["standard.php"]   = Array(
    "name"                  => GetMessage("PT_STANDARD"),
    "sort"                  => 1
);
?>