<?php
/**
 * The template header file
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
    <meta charset="UTF-8">
 	<meta name="description" content="Art You Can Eat is a new video portal maping the Slovak contemporary art scene. Art You Can Eat je videoportál, ktorý mapuje slovenské súčasné umenie." />
 	<meta name="keywords" content="slovak contemporary art visual art slovenske sucasne umenie vytvarne umenie" />
 	<meta name="revisit-after" content="7 days" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $page_title; ?></title>

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

     <!-- GOOGLE FONTS -->
     <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">

     <!-- JQUERY & SITE JS -->
     <script src="<?php bloginfo('template_directory'); ?>/assets/js/jquery.js"></script>
     <script src="<?php bloginfo('template_directory'); ?>/assets/js/jquery-ui.min.js"></script>
     <script src="<?php bloginfo('template_directory'); ?>/assets/js/auc.js"></script>

     <!-- MOBILE & DESKTOP STYLES -->
     <link rel="stylesheet" media='screen and (min-width: 300px) and (max-width: 340px)' href="<?php bloginfo('template_directory'); ?>/phone_0.css"/>
     <link rel="stylesheet" media='screen and (min-width: 341px) and (max-width: 365px)' href="<?php bloginfo('template_directory'); ?>/phone_0.css"/>
     <link rel="stylesheet" media='screen and (min-width: 370px) and (max-width: 380px)' href="<?php bloginfo('template_directory'); ?>/phone_0.css"/>
     <link rel="stylesheet" media='screen and (min-width: 400px) and (max-width: 1000px)' href="<?php bloginfo('template_directory'); ?>/phone_0.css"/>
     <link rel="stylesheet" media='screen and (min-width: 1001px) and (max-width: 1300px)' href="<?php bloginfo('template_directory'); ?>/style.css"/>
     <link rel="stylesheet" media='screen and (min-width: 1301px) and (max-width: 1599px)' href="<?php bloginfo('template_directory'); ?>/style.css"/>
     <link rel="stylesheet" media='screen and (min-width: 1600px)' href="<?php bloginfo('template_directory'); ?>/style.css"/>

     <!-- VIDEOJS (using a nuevo version of video-js.css )-->
     <script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>
     <link href="<?php bloginfo('template_directory'); ?>/assets/css/video-js.css" rel="stylesheet">

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
