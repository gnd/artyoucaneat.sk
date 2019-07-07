<?php
/**
 * The template footer-index file
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

 ?>

<script>
    // setup some globals
    menu = true;
    site_location = '<?php echo strtolower($category->name); ?>';
    <?php
        if ($category_parent_id = $video_id) {
            echo "video_menu = true;";
        }
    ?>

    // nastav js podla typu klienta
    detect_client();

    window.onload = category_setup("<?php echo $_SESSION["lang"]; ?>");
</script>
