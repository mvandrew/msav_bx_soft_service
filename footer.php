<?php if (defined("_MSAV_TH_TWO_COLUMNS")) {
    echo '</main></div>';
} elseif (defined("_MSAV_TH_NO_CONTAINER")) {
    echo '</main>';
} else {
    echo '</main>'
        .'<aside class="right_sidebar"><p>right</p></aside>'
        .'</div>';
}

echo '</body></html>'; ?>