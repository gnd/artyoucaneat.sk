<?php
/**
 * The 404 template file
 *
 * All You Can template for Artyoucaneat.sk
 *
 * Learn more: {@link https://comms.gnd.sk}
 *
 * @package WordPress
 * @subpackage All You Can
 * @since 2018
 */

session_start();
require_once 'lang.php';
$page_title = 'Art You Can Eat / 404';

?>

<html>
<head>
    <!-- START HEADER -->
    <?php
        $og_desc = "Art You Can Eat je videoportál, ktorý mapuje slovenské súčasné umenie.";
        $og_url = get_permalink();
        $og_poster = get_bloginfo('template_directory') . "/assets/images/logo_big.jpg";
        require_once 'header.php';
    ?>
</head>
<body>

<?php include "nav.php"; ?>

<div id="main_container">
    <div id="center_container" class="videos">
        <div id="content_container" class="cf videos">
            <br/>
            <div id="title_container_sk">
                <div class="ordinary_text">404: Obsah nenájdený.</div>
            </div>
            <div id="title_container_en">
                <div class="ordinary_text">404: Content not found.</div>
            </div>
        </div>

   <!-- START FOOTER -->
   <?php require_once 'footer.php'; ?>

   <!-- START ADDITIONAL JS SCRIPTS -->
   <script>
        // setup some globals
        site_location = 'index';

        // nastav js podla typu klienta
        detect_client();

        // jazykova perzistencia
        window.onload = allyoucan_setup("<?php echo $_SESSION["lang"]; ?>");
    </script>
</body>
</html>
