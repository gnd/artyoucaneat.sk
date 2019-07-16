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
    site_location = '<?php echo ($_SESSION["lang"] == 'sk') ? strtolower($category->name) : strtolower($category->description); ?>';
    <?php echo ($category_parent_id == $video_id) ? "video_menu = true;" : ""; ?>

    // nastav js podla typu klienta
    detect_client();

    // setup menu
    window.onload = category_setup(<?php echo '"' . $_SESSION["lang"] . '", ' . $category_parent_id . ', ' . $category_id; ?>);
</script>
