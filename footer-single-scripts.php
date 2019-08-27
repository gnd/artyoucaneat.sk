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
    // nuevo & video.js setup
    var slide_image = "<?php echo $slide_image; ?>";
    var video_link = "<?php echo $link_txt; ?>";
    var video_share_embed = '<iframe width="100%" height="100%" src="https://paleo.artyoucaneat.sk/embed.php?vid=<?php echo $current_id; ?>" frameborder="0" allowfullscreen></iframe>';
    var related_videos = <?php echo json_encode($related_videos_sk); ?>;
    var video_name = "<?php echo $current_title_sk; ?>";

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
        logo: '//paleo.artyoucaneat.sk/assets/images/logo_transparent_50.png',
        logourl: '//paleo.artyoucaneat.sk',
        logoposition: 'RT'
    });

    // set site location as single_video
    site_location = 'single';

    // set big play button position
    var bpb = document.getElementsByClassName('vjs-big-play-button');
    for (var i = 0; i < bpb.length; ++i) {
        bpb[i].style.top = '30%';
    }

    // nastav js podla typu klienta
    detect_client();

    // jazykova persistencia
    window.onload = allyoucan_setup("<?php echo $_SESSION["lang"]; ?>");
</script>
