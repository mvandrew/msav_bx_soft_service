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

<div class="advantages_area">
    <div class="container">
        <h2><?=$arParams["DISPLAY_TITLE"]?></h2>

        <?php
        foreach( $arResult["ITEMS"] as $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="advantage_item">
                <h3><i class="fa fa-<?=$arItem['PROPERTIES']['FA_SERVICE_ICON']['VALUE']?>" aria-hidden="true"></i> <?=$arItem["NAME"]?></h3>
                <p><?=$arItem["PREVIEW_TEXT"]?></p>
            </div>
            <?php
        }
        ?>

    </div>
</div> <!-- end of .advantages_area -->
