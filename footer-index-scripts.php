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

<script src="<?php bloginfo('template_directory'); ?>/assets/js/nuevo.min.js"></script>
<script>
    // nastav js podla typu klienta
    detect_client();

    // nuevo & video.js setup
    var slide_image = "<?php echo $slide_image; ?>";
    var video_link = "<?php echo $video_share_link; ?>";
    var video_share_embed = '<?php echo $video_share_embed; ?>';
    var related_videos = <?php echo json_encode($related_videos_sk); ?>;
    var video_name = "<?php echo $current_title_sk; ?>";
    var logo = "";
    if (device_type == 'desktop') {
        var logo = '<?php bloginfo('template_directory'); ?>/assets/images/logo_transparent_50.png';
    }

    if ("<?php echo $_SESSION["lang"]; ?>" == "en") {
        var related_videos = <?php echo json_encode($related_videos_en); ?>;
        var video_name = "<?php echo $current_title_en; ?>";
    }

    // video.js start
    var options = {};
    var player = videojs('landing_video', options);
    player.nuevoPlugin({
        qualityButton: true,
        relatedMenu: true,
        shareMenu: true,
        zoomMenu: false,
        rateMenu: false,
        related: related_videos,
        slideImage: slide_image,
        slideType: 'vertical',
        shareTitle: video_name,
        shareUrl: video_link,
        shareEmbed: video_share_embed,
        logo: logo,
        logourl: '//artyoucaneat.sk',
        logoposition: 'RT'
    });

    // jazykova persistencia
    window.onload = allyoucan_setup("<?php echo $_SESSION["lang"]; ?>");
</script>
