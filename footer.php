<?php if (defined("_MSAV_TH_TWO_COLUMNS")) {
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
            "PATH" => "/sidebar_right.php"
        )
    );
    echo '</p></aside>'
        .'</div>';
}

echo '</body></html>'; ?>