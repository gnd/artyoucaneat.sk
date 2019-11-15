<?php
/* Template Name: Place
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
 if ($_SESSION["lang"] == "sk") {
     $page_title = 'Art You Can Eat / Vyhľadávanie';
 } else {
     $page_title = 'Art You Can Eat / Search';
 }

 $slug = sanitize_text_field($_REQUEST["p"]);
 $term = get_term_by('slug', $slug, 'priestory');
 $params = array('where'=> "gallery.name = '$term->name'");
 $pods = pods( 'post', $params );

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

 <div id="main_container">
     <div id="center_container" class="single_video">
         <div id="video_name_sk">
             <?php
                if ($pods->total() == 0) {
                    echo esc_html(str_replace("-"," ",rtrim($slug, '/')));
                } else {
                    echo $term->name;
                }
             ?>
        </div>
        <div id="video_name_en">
             <?php
                if ($pods->total() == 0) {
                    echo esc_html(str_replace("-"," ",rtrim($slug, '/')));
                } else {
                    echo $term->name;
                }
             ?>
         </div>
         <div id="video_artists_sk">
             <?php //TODO make these div ids custom for the search template
                 // Display post results
                 if ($pods->total() == 0) {
                     echo 'Priestor nieje v databáze.';
                 } else {
                     echo "Príspevky súvisiace s $term->name: ";
                 }
             ?>
         </div>
         <div id="video_artists_en">
             <?php
                 if ($pods->total() == 0) {
                     echo 'Place not in database.';
                 } else {
                     echo "Posts related to $term->name: ";
                 }
             ?>
         </div>

         <div id="content_container" class="cf videos search">
         <?php
             // Loop and display found posts
             $lid = 0;
             while ( $pods->fetch() ) {
                 $id = $pods->field('ID');
                 if (get_post_type($id) == 'post') {
                     $link = wp_make_link_relative(get_permalink($id, false));
                     $poster = get_post_meta($id, 'poster');
                     $poster_medium = wp_get_attachment_image_src( $poster[0]["ID"], 'medium' )[0];
                     $category_link = get_category_link(get_the_category($id)[0]->cat_ID);
                     $category_name_sk = get_the_category($id)[0]->name;
                     $category_name_en = get_the_category($id)[0]->description;
                     $title_sk = get_the_title($id);
                     $title_en = get_post_meta($id, 'title_en', true);
                     $artists = get_post_meta($id, 'artists');
                     show_related_in_single($lid, $link, $poster_medium, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);
                     $lid += 1;
                 }
             }

             ?>
                 <!-- RELATED VIDEOS -->
                 <div id="title_container_sk" class="single_video">
                     <span id="index_title">
                         <?php
                             if ($pods->total == 0) {
                                 echo "INÉ PRÍSPEVKY";
                             } else {
                                 echo "POZRITE SI TIEŽ";
                             }
                         ?>
                     </span>
                 </div>
                 <div id="title_container_en" class="single_video">
                     <span id="index_title">
                         <?php
                             if ($pods->total == 0) {
                                 echo "OTHER VIDEOS";
                             } else {
                                 echo "WATCH ALSO";
                             }
                         ?>
                     </span>
                 </div>
             <?php
                 if ($pods->total == 0) {
                     $posts_per_page = 9;
                 } else {
                     $posts_per_page = 6;
                 }
                 $query = new WP_Query( array( 'category_name' => 'video', 'posts_per_page' => $posts_per_page, 'no_found_rows' => true ) );
                 $lid = 0;
                 if ( $query->have_posts() ) {
                     while ( $query->have_posts() ) {
                         $query->the_post();
                         if ($current_id != get_the_ID() && $lid < 9) {
                             $link = wp_make_link_relative(get_permalink($query->theID(), false));
                             $poster = get_post_meta(get_the_ID(), 'poster');
                             $poster_medium = wp_get_attachment_image_src( $poster[0]["ID"], 'medium' )[0];
                             $category_link = get_category_link(get_the_category()[0]->cat_ID);
                             $category_name_sk = get_the_category()[0]->name;
                             $category_name_en = get_the_category()[0]->description;
                             $title_sk = get_the_title();
                             $title_en = get_post_meta(get_the_ID(), 'title_en', true);
                             $artists = get_post_meta(get_the_ID(), 'artists');
                             $duration = get_post_meta(get_the_ID(), 'duration', true);

                             // show past videos
                             show_related_in_single($lid, $link, $poster_medium, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);
                             $lid += 1;
                         }
                     }
                     /* Restore original Post Data */
                     wp_reset_postdata();
                 }

         ?>
         </div>

    <!-- START FOOTER -->
    <?php require_once 'footer.php'; ?>

    <!-- START ADDITIONAL JS SCRIPTS -->
    <script>
         // setup some globals
         site_location = 'people';

         // nastav js podla typu klienta
         detect_client();

         // setup menu
         window.onload = term_setup(<?php echo '"' . $_SESSION["lang"] .'"'; ?>);
     </script>
 </body>
 </html>
