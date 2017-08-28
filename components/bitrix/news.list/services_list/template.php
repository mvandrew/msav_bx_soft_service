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
<ul class="services-list">
    <?php foreach ( $arResult["ITEMS"] as $arItem ) : ?>
        <li>
            <div class="services-list-container" style="border-color: <?="#".$arItem["PROPERTIES"]["BG_COLOR"]["VALUE"]?>;">
                <h3 class="services-list-title" style="background-color: <?="#".$arItem["PROPERTIES"]["BG_COLOR"]["VALUE"]?>;"><a href="<?=$arItem["PROPERTIES"]["SERVICE_URL"]["VALUE"]?>"><?=$arItem["NAME"]?></a></h3>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <p class="services-list-descr"><?=$arItem["PREVIEW_TEXT"]?></p>
                <p class="more-area"><a href="<?=$arItem["PROPERTIES"]["SERVICE_URL"]["VALUE"]?>" class="more-button more-button-small"><?=GetMessage('CT_SERVICES_LIST_MORE')?></a></p>
            </div> <!-- end of .services-list-container -->
        </li>
    <?php endforeach; ?>
</ul>
