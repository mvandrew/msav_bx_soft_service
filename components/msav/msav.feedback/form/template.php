<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="form">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
    echo '<div class="warning_area">';
	foreach($arResult["ERROR_MESSAGE"] as $v)
		printf('<p>%s.</p>', $v);
	echo '</div>';
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="confirm_area"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>
    <div class="field_row">
        <div class="field_label"><label for="user_name"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?> class="req"<?endif?>><?=GetMessage("MFT_NAME")?></label></div>
        <div class="field_area">
            <div class="field_container"><input type="text" name="user_name" id="user_name" placeholder="<?=GetMessage("MFT_NAME")?>" value="<?=$arResult["AUTHOR_NAME"]?>"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?> required<?endif?>></div>
        </div>
    </div>

    <div class="field_row">
        <div class="field_label"><label for="user_phone"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?> class="req"<?endif?>><?=GetMessage("MFT_PHONE")?></label></div>
        <div class="field_area">
            <div class="field_container"><input type="text" name="user_phone" id="user_phone" placeholder="<?=GetMessage("MFT_PHONE")?>" value="<?=$arResult["AUTHOR_PHONE"]?>"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?> required<?endif?>></div>
        </div>
    </div>

    <div class="field_row">
        <div class="field_label"><label for="user_email"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?> class="req"<?endif?>><?=GetMessage("MFT_EMAIL")?></label></div>
        <div class="field_area">
            <div class="field_container"><input type="text" name="user_email" id="user_email" placeholder="<?=GetMessage("MFT_EMAIL")?>" value="<?=$arResult["AUTHOR_EMAIL"]?>"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?> required<?endif?>></div>
        </div>
    </div>

    <div class="field_row">
        <div class="field_label"><label for="MESSAGE"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?> class="req"<?endif?>><?=GetMessage("MFT_MESSAGE")?></label></div>
        <div class="field_area">
            <div class="field_container"><textarea name="MESSAGE" id="MESSAGE"><?=$arResult["MESSAGE"]?></textarea></div>
        </div>
    </div>

	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
        <div class="field_row">
            <div class="field_label"><label><?=GetMessage("MFT_CAPTCHA")?></label></div>
            <div class="field_area">
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
                <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
            </div>
        </div>

        <div class="field_row">
            <div class="field_label"><label for="captcha_word" class="req"><?=GetMessage("MFT_CAPTCHA_CODE")?></label></div>
            <div class="field_area">
                <div class="field_container"><input type="text" name="captcha_word" id="captcha_word" placeholder="<?=GetMessage("MFT_CAPTCHA_CODE")?>" value="" required></div>
            </div>
        </div>
	<?endif;?>

    <div class="field_row"><input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>"></div>

	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">

</form>
</div>