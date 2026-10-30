<?php
/*
    This snippet receives an Ajax call from JS and stores the chosen
    language into $_SESSION["lang"] to make it persistent across the whole web
    */
if ( isset($_POST["lang"]) ) {
    $lang = $_POST["lang"];
    if ($lang === 'sk') {
        $_SESSION["lang"] = 'sk';
    }
    if ($lang === 'en') {
        $_SESSION["lang"] = 'en';
    }
}

// Set default lang as SK
if (!isset($_SESSION["lang"])) {
    $_SESSION["lang"] = 'sk';
}
?>
