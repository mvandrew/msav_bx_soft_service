<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$curModuleId = 'msav.contacts';

$contactValues = array();
$curEmail = COption::GetOptionString($curModuleId, 'email');
$curSkype = COption::GetOptionString($curModuleId, 'skype');
$curTelegram = COption::GetOptionString($curModuleId, 'telegram');
$curPhone = COption::GetOptionString($curModuleId, 'phone_num');

if ($curPhone) {
    $contactValues['phone'] = array(
        'value'     => $curPhone,
        'icon'      => 'phone'
    );
}

if ($curEmail) {
    $contactValues['email'] = array(
        'value'     => sprintf('<a href="mailto:%1$s">%1$s</a>', $curEmail),
        'icon'      => 'envelope-o'
    );
}

if ($curSkype) {
    $contactValues['skype'] = array(
        'value'     => sprintf('<a href="skype:%1$s?call">%1$s</a>', $curSkype),
        'icon'      => 'skype'
    );
}

if ($curTelegram) {
    $contactValues['telegram'] = array(
        'value'     => sprintf('<a href="https://t.me/%1$s">@%1$s</a>', $curTelegram),
        'icon'      => 'telegram'
    );
}

echo '<div class="clearfix"></div><div class="msav_all_contacts">';
printf('<h2><span>%s</span></h2>', GetMessage('CT_MCI_ALL_CONTACTS_TITLE') );
echo '<div class="msav_all_contacts_body">';
foreach ($contactValues as $itemClass => $curValue) {
    printf('<p class="%2$s"><i class="fa fa-%1$s" aria-hidden="true"></i>&nbsp;<span class="contact_%2$s">%3$s</span>%4$s</p>',
        $curValue['icon'],
        $itemClass,
        $curValue['value'],
        $itemClass == 'phone' ? ' <em>('.GetMessage('CT_MCI_ALL_CONTACTS_MESS').')</em>' : ''
    );
}
echo '</div></div>';
