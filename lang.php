<?php
/*
    This snippet receives an Ajax call from JS and stores the chosen
    language into $_SESSION["lang"] to make it persistent across the whole web
    */
if ( isset($_POST["lang"]) ) {
    $lang = $_POST["lang"];
    if (strcmp('sk', $lang) == 0) {
        $_SESSION["lang"] = 'sk';
    }
    if (strcmp('en', $lang) == 0) {
        $_SESSION["lang"] = 'en';
    }
}
?>
