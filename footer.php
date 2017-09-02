<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
if (defined("_MSAV_TH_TWO_COLUMNS")) {
    echo '</main></div>';
} elseif (defined("_MSAV_TH_NO_CONTAINER")) {
    echo '</div>';
} elseif (defined("_MSAV_TH_NO_SIDEBAR")) {
    echo '</main></div>';
} else {
    echo '</main>'
        .'<aside class="right_sidebar"><p>';
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_RECURSIVE" => "N",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_MODE" => "html",
            "EDIT_TEMPLATE" => "standard.php",
            "PATH" => "/.sidebar_right.php"
        )
    );
    echo '</p></aside>'
        .'</div>';
} ?>
<footer class="main_footer">
	<div class="footer_navi">
		<div class="container">
			<div class="navi_block"><?php $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_RECURSIVE" => "N",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_MODE" => "html",
                "EDIT_TEMPLATE" => "standard.php",
                "PATH" => "/.footer_1.php"
            )
        ); ?>
			</div>
			<div class="navi_block"><?php $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_RECURSIVE" => "N",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_MODE" => "html",
                "EDIT_TEMPLATE" => "standard.php",
                "PATH" => "/.footer_2.php"
            )
        ); ?>
			</div>
			<div class="navi_block"><?php $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_RECURSIVE" => "N",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_MODE" => "html",
                "EDIT_TEMPLATE" => "standard.php",
                "PATH" => "/.footer_3.php"
            )
        ); ?>
			</div>
			<div class="navi_block"><?php $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_RECURSIVE" => "N",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_MODE" => "html",
                "EDIT_TEMPLATE" => "standard.php",
                "PATH" => "/.footer_4.php"
            )
        ); ?>
			</div>
		</div>
	</div>
	<div class="footer_copy">
		<div class="container">
			<div class="right_navi"><?php $APPLICATION->IncludeComponent("bitrix:menu", "simple_list", Array(
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
        "ROOT_MENU_TYPE" => "bottom",	// Тип меню для первого уровня
        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
    ),
    false
); ?>
			</div>
			<div class="footer_info">
				<div class="data_area"><?php $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_RECURSIVE" => "N",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_MODE" => "html",
                "EDIT_TEMPLATE" => "standard.php",
                "PATH" => "/.footer_copy_area.php"
            )
        ); ?>
				</div>
				<div class="data_area"><?php $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_RECURSIVE" => "N",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_MODE" => "html",
                "EDIT_TEMPLATE" => "standard.php",
                "PATH" => "/.footer_designed_area.php"
            )
        );
 ?>
				</div>
			</div>
		</div>
	</div>
</footer><a id="to_top_button" href="#top"></a><?php echo '</body></html>'; ?>