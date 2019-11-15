<?php
/* Template Name: Video Embed
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
 $current_id = filter_var($_REQUEST["id"], FILTER_SANITIZE_NUMBER_INT);
 $post = get_post($current_id);
 $current_title_sk = $post->post_title;
 $current_title_en = get_post_meta($current_id, 'title_en', true);

 // Process video data
 $poster = get_post_meta($current_id, 'poster');
 $poster_small = wp_get_attachment_image_src( $poster[0]["ID"], 'medium' )[0];
 $poster_big = wp_get_attachment_image_src( $poster[0]["ID"], 'full' )[0];
 $slide_image = site_url() . '/assets/video/' . $video_link_txt . '.jpg'; //FIXME
 $matches = array();
 preg_match('~(wp-content.*)\.mp4~', get_attached_file(get_post_meta($current_id, 'video')[0]["ID"]), $matches);
 $video_link = $matches[1];
 $video_share_link = get_permalink($current_id);
 $video_share_embed = '<iframe width="100%" height="100%" src="' . site_url() . '/index.php/v/?id=' . $current_id . '" frameborder="0" allowfullscreen></iframe>';

 // prepare related videos
 $query = new WP_Query( array( 'category_name' => 'video', 'posts_per_page' => 7, 'no_found_rows' => true ) );
 $lid = 0;
 $related_videos_sk = Array();
 $related_videos_en = Array();
 if ( $query->have_posts() ) {
     while ( $query->have_posts() ) {
         $query->the_post();
         /* This might seem strange, but we dont know if the post we are showing
            is included in the last 7 posts. If it is, we correctly show 6 posts.
            If it isnt, we would show 7 posts, so we have to limit this to 6 using lid.
         */
         if ($current_id != get_the_ID() && $lid < 7) {
             $link = wp_make_link_relative(get_permalink($query->theID(), false));
             $poster = get_post_meta(get_the_ID(), 'poster');
             $poster_small = wp_get_attachment_image_src( $poster[0]["ID"], 'thumb' )[0];
             $title_sk = get_the_title();
             $title_en = get_post_meta(get_the_ID(), 'title_en', true);
             $duration = get_post_meta(get_the_ID(), 'duration', true);

             // prepare related videos for Nuevo
             // TODO need to know video duration smh
             $related_videos_sk[] = array('thumb' => $poster_small, 'url' => $link, 'title' => $title_sk, 'duration' => $duration);
             $related_videos_en[] = array('thumb' => $poster_small, 'url' => $link, 'title' => $title_en, 'duration' => $duration);
             $lid += 1;
         }
     }
     /* Restore original Post Data */
     wp_reset_postdata();
 }
 ?>

<html>
<head>
    <meta charset="UTF-8">
	<meta name="description" content="Art You Can Eat je videoportál, ktorý mapuje slovenské súčasné umenie. Art You Can Eat is a new video portal maping the Slovak contemporary art scene." />
	<meta name="keywords" content="slovak contemporary art visual art slovenské súčasné umenie výtvarné umenie" />
	<meta name="revisit-after" content="7 days" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $current_title_sk ?></title>

    <!--- ICONS -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="<?php bloginfo('template_directory'); ?>/assets/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- VIDEOJS (using a nuevo version of video-js.css )-->
    <script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/video-js.css" rel="stylesheet">

    <!-- MOBILE & DESKTOP STYLES -->
    <link rel="stylesheet" media='screen and (min-width: 300px) and (max-width: 340px)' href="<?php bloginfo('template_directory'); ?>/phone_0.css"/>
    <link rel="stylesheet" media='screen and (min-width: 341px) and (max-width: 365px)' href="<?php bloginfo('template_directory'); ?>/phone_0.css"/>
    <link rel="stylesheet" media='screen and (min-width: 370px) and (max-width: 380px)' href="<?php bloginfo('template_directory'); ?>/phone_0.css"/>
    <link rel="stylesheet" media='screen and (min-width: 400px) and (max-width: 1000px)' href="<?php bloginfo('template_directory'); ?>/phone_0.css"/>
    <link rel="stylesheet" media='screen and (min-width: 1001px) and (max-width: 1300px)' href="<?php bloginfo('template_directory'); ?>/style.css"/>
    <link rel="stylesheet" media='screen and (min-width: 1301px) and (max-width: 1599px)' href="<?php bloginfo('template_directory'); ?>/style.css"/>
    <link rel="stylesheet" media='screen and (min-width: 1600px)' href="<?php bloginfo('template_directory'); ?>/style.css"/>
    <style>#landing_video { border-radius: 0 !important; }</style> <!-- Embed popup fix -->

    <!-- MATOMO -->
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
    </script>

</head>
<body>
    <!-- TODO: make poster small everywhere -->
    <!-- TODO: how will poster replacing work ? -->
    <div id="landing_container" style="width: 100%; margin: 0; padding: 0;">
        <video id="landing_video" class="video-js-embed initial video-js vjs-16-9" controls poster="<?php echo $poster_big; ?>" onplay="startlanding()">
        <source src="/<?php echo $video_link; ?>.mp4" type="video/mp4" res="1080" default label="1080p "/>
        <source src="/<?php echo $video_link; ?>_720p.mp4" type="video/mp4" res="720" label="720p "/>
        <source src="/<?php echo $video_link; ?>_480p.mp4" type="video/mp4" res="480" label="480p "/>
        <source src="/<?php echo $video_link; ?>_240p.mp4" type="video/mp4" res="240" label="240p "/>
        <source src="/<?php echo $video_link; ?>.ogg" type="video/ogg"/>
        <p class="vjs-no-js">
            To view this video please enable JavaScript, and consider upgrading to a
            web browser that supports HTML5 video.
        </p>
    </video>
</div>
<script src="<?php bloginfo('template_directory'); ?>/assets/js/nuevo.min.js"></script>
<script>
    // nuevo & video.js setup
    var slide_image = "<?php echo $slide_image; ?>";
    var video_share_link = "<?php echo $video_share_link; ?>";
    var video_share_embed = '<?php echo $video_share_embed; ?>';
    var related_videos = <?php echo json_encode($related_videos_sk); ?>;
    var video_name = "<?php echo $curent_title_sk; ?>";

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
        shareUrl: video_share_link,
        shareEmbed: video_share_embed,
        logo: '<?php bloginfo('template_directory'); ?>/assets/images/logo_transparent_50.png',
        logourl: '//artyoucaneat.sk',
        logoposition: 'RT'
    });
</script>
</body>
</html>
