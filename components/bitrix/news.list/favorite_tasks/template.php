<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>

<div class="clearfix"></div>
<ul class="favorite_tasks">
    <li class="task_row task_row_header">
        <div class="name_cell header_name"><span><?= GetMessage('CT_BNL_FAVORITE_TASKS_HEADER_NAME') ?></span></div>
        <div class="time_cell header_time"><span><?= GetMessage('CT_BNL_FAVORITE_TASKS_HEADER_TIME') ?></span></div>
    </li>
    <?php foreach( $arResult["ITEMS"] as $arItem ) : ?>
        <li class="task_row task_row_item">
            <div class="name_cell task_descr">
                <div class="task_icon icon_<?=$arItem["PROPERTIES"]["FA_SERVICE_ICON"]["VALUE"]?>"></div>
                <h3><?= $arItem["NAME"] ?></h3>
                <p><?= $arItem["DETAIL_TEXT"] ?></p>
                <?php
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
            </div>
            <div class="time_cell task_time"><?= $arItem["PROPERTIES"]["SERVICE_HOURS"]["VALUE"] ?></div>
        </li>
    <?php endforeach; ?>
</ul>
<div class="clearfix"></div>
<p class="favorite_tasks_note"><?= GetMessage('CT_BNL_FAVORITE_TASKS_HEADER_TIME_NOTE') ?></p>
