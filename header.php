<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?><!DOCTYPE html><html lang="ru">
<head>
	<link rel="shortcut icon" href="/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<meta name="yandex-verification" content="58b41ef854fc984a">
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
	<title><?php $APPLICATION->ShowTitle(false); ?></title><?php $APPLICATION->ShowHead();
\Bitrix\Main\Page\Asset::getInstance()->addCss( SITE_TEMPLATE_PATH . '/css/vendor-css.min.css' );
\Bitrix\Main\Page\Asset::getInstance()->addJs( SITE_TEMPLATE_PATH . '/js/vendor-js.min.js' );
\Bitrix\Main\Page\Asset::getInstance()->addJs( SITE_TEMPLATE_PATH . '/js/script.min.js' ); ?>
</head><?php echo '<body class="'
    .(CSite::InDir('/index.php') ? 'frontpage ' : '')
    .'">'; ?><a id="top"></a>
<div class="panel"><?php $APPLICATION->ShowPanel(); ?></div>
<div id="main_header">
	<div class="container">
		<div class="header_logo"><a class="logo_image" href="/"><img src="<?php echo SITE_TEMPLATE_PATH; ?>/img/header-logo.jpg" alt=""></a>
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
				<li class="phone"><?php $APPLICATION->IncludeComponent(
                "msav:msav.contact.item",
                "",
                array(
                    "CONTACT_ITEM" => "phone",
                    "SHOW_ICON" => "Y"
                )
        ); ?>
				</li>
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
			<nav class="main_menu">
				<div class="toggle_button">
					<div class="toggle_line toggle_line_top"></div>
					<div class="toggle_line toggle_line_middle"></div>
					<div class="toggle_line toggle_line_bottom"></div>
				</div><?php $APPLICATION->IncludeComponent("bitrix:menu", "top_menu", Array(
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
</div><?php if ( !CSite::InDir('/index.php') ): ?>
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
</div>
<header id="title_area">
	<div class="container">
		<h1><?php $APPLICATION->ShowTitle(false); ?></h1>
	</div>
</header><?php endif;

if (defined("_MSAV_TH_TWO_COLUMNS")) {
    // Для двухколоночного макета
    echo '<div class="container"><main class="two_columns_container">';
} elseif (defined("_MSAV_TH_NO_CONTAINER")) {
    // Для макета без контейнера
    echo '<div class="no_container">';
} elseif (defined("_MSAV_TH_NO_SIDEBAR")) {
    // Для макета без боковой панели
    echo '<div class="container"><main class="no_sidebar">';
} else {
    // По-умолчанию, с правым сайдбаром
    echo '<div class="container"><main class="right_sidebar_container">';
} ?>