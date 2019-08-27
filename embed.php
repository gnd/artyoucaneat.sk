<?php
/**
 * The main template file
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
 $post_id = filter_var($REQUEST["vid"], FILTER_SANITIZE_NUMBER_INT);

 ?>

<html>
<head>
    <meta charset="UTF-8">
	<meta name="description" content="Art You Can Eat je videoportál, ktorý mapuje slovenské súčasné umenie. Art You Can Eat is a new video portal maping the Slovak contemporary art scene." />
	<meta name="keywords" content="slovak contemporary art visual art slovenské súčasné umenie výtvarné umenie" />
	<meta name="revisit-after" content="7 days" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $name_sk ?></title>

    <!--- ICONS -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="assets/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- MOBILE & DESKTOP STYLES -->
    <link rel="stylesheet" media='screen and (min-width: 300px) and (max-width: 340px)' href="phone_0.css"/>
    <link rel="stylesheet" media='screen and (min-width: 341px) and (max-width: 365px)' href="phone_0.css"/>
    <link rel="stylesheet" media='screen and (min-width: 370px) and (max-width: 380px)' href="phone_0.css"/>
    <link rel="stylesheet" media='screen and (min-width: 400px) and (max-width: 1000px)' href="phone_0.css"/>
    <link rel="stylesheet" media='screen and (min-width: 1001px) and (max-width: 1300px)' href="style.css"/>
    <link rel="stylesheet" media='screen and (min-width: 1301px) and (max-width: 1599px)' href="style.css"/>
    <link rel="stylesheet" media='screen and (min-width: 1600px)' href="style.css"/>

    <!-- VIDEOJS (using a nuevo version of video-js.css )-->
    <script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>
    <link href="assets/css/video-js.css" rel="stylesheet">

    <!-- MATOMO
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//stats.artyoucaneat.sk/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script> -->

</head>
<body>
<div id="landing_container" style="width: 100%; margin: 0; padding: 0;">
    <video id="landing_video" class="initial video-js vjs-16-9" controls poster="assets/images/poster_<?php echo $poster_txt; ?>_p0.jpg" onplay="startlanding()">
        <source src="https://artyoucaneat.sk/assets/video/<?php echo $video_link_txt; ?>.mp4" type="video/mp4" res="1080" default label="1080p "/>
        <source src="https://artyoucaneat.sk/assets/video/<?php echo $video_link_txt; ?>_720p.mp4" type="video/mp4" res="720" label="720p "/>
        <source src="https://artyoucaneat.sk/assets/video/<?php echo $video_link_txt; ?>_480p.mp4" type="video/mp4" res="480" label="480p "/>
        <source src="https://artyoucaneat.sk/assets/video/<?php echo $video_link_txt; ?>_240p.mp4" type="video/mp4" res="240" label="240p "/>
        <source src="https://artyoucaneat.sk/assets/video/<?php echo $video_link_txt; ?>.ogg" type="video/ogg"/>
        <p class="vjs-no-js">
            To view this video please enable JavaScript, and consider upgrading to a
            web browser that supports HTML5 video.
        </p>
    </video>
</div>
<script src="assets/js/nuevo.min.js"></script>
<script>
    // nuevo & video.js setup
    var slide_image = "<?php echo $slide_image; ?>";
    var video_link = "<?php echo $link_txt; ?>";
    var video_share_embed = '<?php echo $video_share_embed; ?>';
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
        shareEmbed: video_share_embed,
        logo: '//paleo.artyoucaneat.sk/assets/images/logo_transparent_50.png',
        logourl: '//paleo.artyoucaneat.sk',
        logoposition: 'RT',
    });
</script>
</body>
</html>
