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

 // get template directory path from root
 $cwd = getcwd() . str_replace(site_url(), "", get_bloginfo('template_directory'));

 ?>
 <title>
         <?php echo $page_title . "\n"; ?>
     </title>

     <meta charset="UTF-8">
     <meta name="description" content="Art You Can Eat je videoportál, ktorý mapuje slovenské súčasné umenie. Art You Can Eat is a new video portal maping the Slovak contemporary art scene." />
	 <meta name="keywords" content="slovak contemporary art visual art slovenské súčasné umenie výtvarné umenie" />
     <meta name="revisit-after" content="7 days" />
     <meta name="viewport" content="width=device-width,initial-scale=1" />

     <!-- OPEN GRAPH -->
     <meta property="og:locale" content="sk_SK" />
     <meta property="og:type" content="article" />
     <meta property="og:title" content="<?php echo $page_title; ?>" />
     <meta property="og:description" content="<?php echo $og_desc; ?>" />
     <meta property="og:url" content="<?php echo $og_url; ?>" />
     <meta property="og:image" content="<?php echo $og_poster; ?>" />
     <meta property="og:image:secure_url" content="<?php echo $og_poster; ?>" />

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
     <script src="<?php bloginfo('template_directory'); ?>/assets/js/jquery.js?v=<?php echo filemtime($cwd . '/assets/js/jquery.js'); ?>"></script>
     <script src="<?php bloginfo('template_directory'); ?>/assets/js/jquery-ui.min.js?v=<?php echo filemtime($cwd . '/assets/js/jquery-ui.min.js'); ?>"></script>
     <script src="<?php bloginfo('template_directory'); ?>/assets/js/auc.js?v=<?php echo filemtime($cwd . '/assets/js/auc.js'); ?>"></script>

     <!-- MOBILE & DESKTOP STYLES -->
     <link rel="stylesheet" media='screen and (min-width: 300px) and (max-width: 1000px)' href="<?php bloginfo('template_directory'); ?>/phone_0.css?v=<?php echo filemtime($cwd . '/phone_0.css'); ?>"/>
     <link rel="stylesheet" media='screen and (min-width: 1001px) and (max-width: 1300px)' href="<?php bloginfo('template_directory'); ?>/style.css?v=<?php echo filemtime($cwd . '/style.css'); ?>"/>
     <link rel="stylesheet" media='screen and (min-width: 1301px) and (max-width: 1599px)' href="<?php bloginfo('template_directory'); ?>/style.css?v=<?php echo filemtime($cwd . '/style.css'); ?>"/>
     <link rel="stylesheet" media='screen and (min-width: 1600px)' href="<?php bloginfo('template_directory'); ?>/style.css?v=<?php echo filemtime($cwd . '/style.css'); ?>"/>

     <!-- VIDEOJS (using a nuevo version of video-js.css )-->
     <script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>
     <link href="<?php bloginfo('template_directory'); ?>/assets/css/video-js.css?v=<?php echo filemtime($cwd . '/assets/css/video-js.css'); ?>" rel="stylesheet">

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
