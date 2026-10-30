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
 require_once 'lang.php';

 $slug = sanitize_text_field($_REQUEST["p"] ?? '');
 $term = get_term_by('slug', $slug, 'priestory');
 $term_name = $term ? $term->name : '';
 $term_name_sql = escape_sql_value($term_name);
 $params = array('where'=> "gallery.name = '$term_name_sql'");
 $pods = pods( 'post', $params );
 $page_title = 'Art You Can Eat / ' . $term_name;

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
         <div id="term_name_sk">
             <?php
                if ($pods->total() == 0) {
                    echo esc_html(str_replace("-"," ",rtrim($slug, '/')));
                } else {
                    echo $term_name;
                }
             ?>
        </div>
        <div id="term_name_en">
             <?php
                if ($pods->total() == 0) {
                    echo esc_html(str_replace("-"," ",rtrim($slug, '/')));
                } else {
                    echo $term_name;
                }
             ?>
         </div>
         <div id="term_results_sk">
             <?php
                 // Display post results
                 if ($pods->total() == 0) {
                     echo 'Priestor nieje v databáze.';
                 } else {
                     echo "Príspevky súvisiace s $term_name: ";
                 }
             ?>
         </div>
         <div id="term_results_en">
             <?php
                 if ($pods->total() == 0) {
                     echo 'Place not in database.';
                 } else {
                     echo "Posts related to $term_name: ";
                 }
             ?>
         </div>

         <div id="content_container" class="cf videos search">
         <?php
            // Keep track of posts that were shown, so as not to include them in related posts
            $shown_posts = Array();

             // Loop and display found posts
             $lid = 0;
             while ( $pods->fetch() ) {
                 $id = $pods->field('ID');
                 if (get_post_type($id) == 'post') {
                     $link = wp_make_link_relative(get_permalink($id, false));
                     $poster_medium = get_poster_src($id, 'medium');
                     $category_link = get_category_link(get_the_category($id)[0]->cat_ID);
                     $category_name_sk = get_the_category($id)[0]->name;
                     $category_name_en = get_the_category($id)[0]->description;
                     $title_sk = get_the_title($id);
                     $title_en = get_post_meta($id, 'title_en', true);
                     $artists = get_post_meta($id, 'artists');
                     show_related_in_single($lid, $link, $poster_medium, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);
                     $shown_posts[] = $id;
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
                     $show_max = 9;
                     $posts_per_page = 9;
                 } else {
                     $show_max = 6;
                     $posts_per_page = 9; // This should be 6, but ask for more because some vids might get excluded
                 }
                 $query = new WP_Query( array( 'category_name' => 'video', 'posts_per_page' => $posts_per_page, 'no_found_rows' => true ) );
                 $shown = 0;
                 if ( $query->have_posts() ) {
                     while ( $query->have_posts() ) {
                         $query->the_post();
                         if (!in_array(get_the_ID(), $shown_posts) && $shown < $show_max) {
                             $link = wp_make_link_relative(get_permalink(get_the_ID(), false));
                             $poster_medium = get_poster_src(get_the_ID(), 'mobile_small_300px');
                             $category_link = get_category_link(get_the_category()[0]->cat_ID);
                             $category_name_sk = get_the_category()[0]->name;
                             $category_name_en = get_the_category()[0]->description;
                             $title_sk = get_the_title();
                             $title_en = get_post_meta(get_the_ID(), 'title_en', true);
                             $artists = get_post_meta(get_the_ID(), 'artists');
                             $duration = get_post_meta(get_the_ID(), 'duration', true);

                             // show past videos
                             show_related_in_single($shown, $link, $poster_medium, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);
                             $shown += 1;
                         }
                     }
                     /* Restore original Post Data */
                     wp_reset_postdata();
                 }

         ?>
    </div> <!-- END CONTENT CONTAINER -->

    <!-- START FOOTER -->
    <?php require_once 'footer.php'; ?>

    <!-- START ADDITIONAL JS SCRIPTS -->
    <script>
         // setup some globals
         site_location = 'terms';
         page_title_sk = '<?php echo 'Art You Can Eat / ' . $term_name; ?>';
         page_title_en = '<?php echo 'Art You Can Eat / ' . $term_name; ?>';

         // nastav js podla typu klienta
         detect_client();

         // setup menu
         window.onload = term_setup(<?php echo '"' . $_SESSION["lang"] .'"'; ?>);
     </script>
 </body>
 </html>
