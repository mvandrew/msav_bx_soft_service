<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult)) : ?>
    <div class="footer_menu">
        <h3><?=$arParams["DISPLAY_TITLE"]?></h3>

        <ul>
            <?php
            foreach($arResult as $arItem):
                if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                if($arItem["SELECTED"]) : ?>
                    <li><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
                <?else:?>
                    <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <?endif?>

            <?endforeach?>

        </ul>

    </div>
<?php endif ?>