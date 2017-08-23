<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?><!DOCTYPE html><html lang="ru">
<head>
	<meta name="yandex-verification" content="58b41ef854fc984a">
	<link rel="shortcut icon" href="/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<meta charset="utf-8">
	<title><?php $APPLICATION->ShowTitle(); ?></title><?php $APPLICATION->ShowHead();
\Bitrix\Main\Page\Asset::getInstance()->addCss( SITE_TEMPLATE_PATH . '/css/vendor-css.min.css' ); ?>
</head><?php echo '<body class="'
    .(CSite::InDir('/index.php') ? 'frontpage ' : '')
    .'">'; ?><a id="top"></a>
<div class="panel"><?php $APPLICATION->ShowPanel(); ?></div>
<header id="main_header">
	<div class="container">
		<div class="header_logo"><a class="logo_image" href="/"><img src="<?php echo SITE_TEMPLATE_PATH; ?>/img/header-logo.jpg"></a>
			<div class="phone"><?php $APPLICATION->IncludeComponent(
                "msav:msav.contact.item",
                "",
                array(
                    "CONTACT_ITEM" => "phone",
                    "SHOW_ICON" => "Y"
                )
        );
 ?>
			</div>
		</div>
		<div class="header_navi">
			<ul class="header_contacts">
				<li class="email"><?php $APPLICATION->IncludeComponent(
                "msav:msav.contact.item",
                "",
                array(
                    "CONTACT_ITEM" => "email",
                    "SHOW_ICON" => "Y"
                )
        ); ?>
				</li>
				<li class="skype"><?php $APPLICATION->IncludeComponent(
                "msav:msav.contact.item",
                "",
                array(
                    "CONTACT_ITEM" => "skype",
                    "SHOW_ICON" => "Y"
                )
        ); ?>
				</li>
				<li class="telegram"><?php $APPLICATION->IncludeComponent(
                "msav:msav.contact.item",
                "",
                array(
                    "CONTACT_ITEM" => "telegram",
                    "SHOW_ICON" => "Y"
                )
        ); ?>
				</li>
			</ul>
			<nav class="main_menu"><?php $APPLICATION->IncludeComponent("bitrix:menu", "top_menu", Array(
    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
        "DELAY" => "N",	// Откладывать выполнение шаблона меню
        "MAX_LEVEL" => "1",	// Уровень вложенности меню
        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
            0 => "",
        ),
        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
        "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
    ),
    false
);
 ?>
			</nav>
		</div>
	</div>
</header><?php if ( !CSite::InDir('/index.php') ): ?>
<div class="breadcrumb">
	<div class="container"><?php $APPLICATION->IncludeComponent("bitrix:breadcrumb", "msav_breadcrumb", Array(
                                "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                                "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                                "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                                "COMPONENT_TEMPLATE" => ".default"
                            ),
                            false
                        ); ?>
	</div>
</div><?php endif; ?>