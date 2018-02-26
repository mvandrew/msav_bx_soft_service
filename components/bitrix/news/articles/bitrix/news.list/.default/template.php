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
<div class="articles-block">

    <?php
    if($arParams["DISPLAY_TOP_PAGER"]) {
        echo $arResult["NAV_STRING"];
    }
    ?>

    <div class="articles-list">

        <?php
        foreach($arResult["ITEMS"] as $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="articles-item">
                <h2><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h2>
                <p><?php echo $arItem["PREVIEW_TEXT"]; ?></p>
                <p class="more_link"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?php echo GetMessage('MSAV_BNL_ELEMENT_MORE'); ?></a></p>
            </div> <!-- end of .articles-item -->
            <?php
        }
        ?>

    </div> <!-- end of .articles-list -->

    <?php
    if($arParams["DISPLAY_BOTTOM_PAGER"]) {
        echo $arResult["NAV_STRING"];
    }
    ?>

</div> <!-- end of .articles-block -->