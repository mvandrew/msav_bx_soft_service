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
<div class="sidebar_block services_menu_block">
    <h3><?= GetMessage('CT_BNL_SERVICES_MENU_TITLE') ?></h3>
    <ul>
        <?php
        foreach($arResult["ITEMS"] as $arItem) {
            $menuText = $arItem["PROPERTIES"]["SERVICE_MENU_TEXT"]["VALUE"] ? $arItem["PROPERTIES"]["SERVICE_MENU_TEXT"]["VALUE"] : $arItem["NAME"];
            printf('<li><a href="%1$s" title="%2$s"><i class="fa fa-%3$s" aria-hidden="true"></i> %2$s</a></li>',
                $arItem["PROPERTIES"]["SERVICE_URL"]["VALUE"],
                $menuText,
                $arItem["PROPERTIES"]["FA_ICON_CLASS"]["VALUE"]
            );
        }
        ?>
    </ul>
</div>
