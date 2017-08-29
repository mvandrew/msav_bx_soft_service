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

if (!empty($arResult)) : ?>
    <div class="footer_menu">
        <h3><?=$arParams["DISPLAY_TITLE"]?></h3>

        <ul>
            <?php foreach ( $arResult["ITEMS"] as $arItem ) : ?>
                <?php $menuText = $arItem["PROPERTIES"]["SERVICE_MENU_TEXT"]["VALUE"] ? $arItem["PROPERTIES"]["SERVICE_MENU_TEXT"]["VALUE"] : $arItem["NAME"]; ?>
                <li><a href="<?=$arItem["PROPERTIES"]["SERVICE_URL"]["VALUE"]?>"><?= $menuText ?></a></li>

            <?php endforeach; ?>
        </ul>
    </div>
<?php endif ?>
