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
    var related_videos = [
            <?php echo $related_videos_sk; ?>
        ];
    var video_name = "<?php echo $name_sk; ?>";

    if ("<?php echo $_SESSION["lang"]; ?>" == "en") {
        var related_videos = [
            <?php echo $related_videos_en; ?>
        ];
        var video_name = "<?php echo $name_en; ?>";
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
        shareEmbed: 'not implemented yet'
    });

    // nastav js podla typu klienta
    detect_client();

    // jazykova persistencia
    window.onload = allyoucan_setup("<?php echo $_SESSION["lang"]; ?>");

    // fejdi to
    var target = $('#newsletter');
    $(document).scroll(function(e){
        var rect = document.getElementById("newsletter").getBoundingClientRect();
        var opacity = 0;
        switch(footer_recalc) {
            case "bigphone":
                opacity = (1800 - rect.top) / 1000;
                break;
            case "smalldesk":
                opacity = (800 - rect.top) / 500;
                break;
            case "bigdesk":
                opacity = (1200 - rect.top) / 800;
                break;
            default:
                opacity = (700 - rect.top) / 600;
        }
        if (opacity >= 0){
            document.getElementById("newsletter").style.opacity = opacity;
        }
        // testing only
        //var span = document.getElementById("opa");
        //span.textContent = "top: " + rect.top + ", opacity: " + opacity;
        if ((opacity < 0.6) && (content_fade)) {
            $("#logo_big").fadeOut(200);
            $("#content_container").fadeIn(1000);
            if (device_type == 'phone') {
                $("#mobile_nav_container").fadeIn(1000);
            }
            if (device_type == 'desktop') {
                $("#left_container").fadeIn(1000);
                $("#right_container").fadeIn(1000);
            }
            content_fade = false;
        }
        if ((opacity > 0.6) && (!content_fade)) {
            document.getElementById("logo_big").style.opacity = 1;
            $("#logo_big").fadeIn(1000);
            $("#content_container").fadeOut(1000);
            if (device_type == 'phone') {
                $("#mobile_nav_container").fadeOut(1000);
            }
            if (device_type == 'desktop') {
                $("#left_container").fadeOut(1000);
                $("#right_container").fadeOut(1000);
            }
            content_fade = true;
        }
    });
</script>
