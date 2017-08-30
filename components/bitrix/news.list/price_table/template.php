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
<table class="table">
    <tr>
        <th width="40%"><?= GetMessage("CT_BNL_PRICE_TABLE_HEADER_NAME") ?></th>
        <th width="30%"><?= GetMessage("CT_BNL_PRICE_TABLE_HEADER_PRICE") ?></th>
        <th width="30%"><?= GetMessage("CT_BNL_PRICE_TABLE_HEADER_MIN_ORDER") ?></th>
    </tr>
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <tr>
            <td>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_PRICE_TABLE_ELEMENT_DELETE_CONFIRM')));
                ?>
                <?= $arItem["NAME"] ?>
            </td>
            <td><?= $arItem["PROPERTIES"]["PRICE"]["VALUE"] ?> <i class="fa fa-rub" aria-hidden="true"></i>/<?= GetMessage("CT_BNL_PRICE_TABLE_HOUR") ?></td>
            <td><?= $arItem["PROPERTIES"]["MIN_ORDER"]["VALUE"] ?></td>
        </tr>
    <?endforeach;?>
</table>
