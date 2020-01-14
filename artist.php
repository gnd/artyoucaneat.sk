<?php
/* Template Name: Artist
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

 $slug = sanitize_text_field($_REQUEST["p"]);
 $term = get_term_by('slug', $slug, 'osoby');
 $params = array('where'=> "artists.name = '$term->name'");
 $pods = pods( 'post', $params );
 $page_title = 'Art You Can Eat / ' . $term->name;

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

<!-- START GENERIC PART OF PEOPLE RESULTS -->
<?php require_once 'people_generic.php'; ?>

    <!-- START FOOTER -->
    <?php require_once 'footer.php'; ?>

    <!-- START ADDITIONAL JS SCRIPTS -->
    <script>
         // setup some globals
         site_location = 'terms';
         page_title_sk = '<?php echo 'Art You Can Eat / ' . $term->name; ?>';
         page_title_en = '<?php echo 'Art You Can Eat / ' . $term->name; ?>';

         // nastav js podla typu klienta
         detect_client();

         // setup menu
         window.onload = term_setup(<?php echo '"' . $_SESSION["lang"] .'"'; ?>);
     </script>
 </body>
 </html>
