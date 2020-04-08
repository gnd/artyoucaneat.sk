<?php
/* Template Name: Search
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

global $wp_query;
$found = Array();
$people = Array();
$places = Array();
$num = 0;
$q = sanitize_text_field(get_search_query());

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
        <div id="search_container_sk">Hľadať: <?php get_search_form(); ?></div>
        <div id="search_container_en">Search: <?php get_search_form(); ?></div>
        <?php
        if (strlen( trim(get_search_query())) != 0) {
            /*
             * Normal search (WPFTS plugin) + PODS search in title_en and content_en pods_fields
            */
            // Get IDS of posts found via regular search
            if (have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    $found[] = get_the_ID();
                }
                wp_reset_postdata();
            }
            /*
            * PODS search through english content + title
            */
            $q = get_search_query();
            $params = array('where'=> "content_en.meta_value like '%$q%' OR title_en.meta_value like '%$q%' OR artists.name like '%$q%' OR curators.name like '%$q%' OR performers.name like '%$q%'",
                            'limit'   => -1);
            $pods = pods( 'post', $params );
            // Get IDs of posts found via PODS
            while ( $pods->fetch() ) {
                if (! in_array($pods->field('ID'), $found)) {
                    $found[] = $pods->field('ID');
                }
            }
            /*
            * PODS search via people
            */
            $q = get_search_query();
            $params = array('where'=> "t.name like '%$q%'",
                            'limit'   => -1 );
            $people = pods( 'osoby', $params );
            $people_string = "";
            while ( $people->fetch() ) {
                $slug = get_term_by('id', $people->field('ID'), 'osoby')->slug;
                $name = get_term_by('id', $people->field('ID'), 'osoby')->name;
                $people_string .= "<span class=\"found_term\"><a class=\"video_info\" href=\"/people/$slug\">$name</a> </span>";
            }
            /*
            * PODS search via places
            */
            $q = get_search_query();
            $params = array('where'=> "t.name like '%$q%'",
                            'limit'   => -1);
            $places = pods( 'priestory', $params );
            $places_string = "";
            while ( $places->fetch() ) {
                $slug = get_term_by('id', $places->field('ID'), 'priestory')->slug;
                $name = get_term_by('id', $places->field('ID'), 'priestory')->name;
                $places_string .= "<span class=\"found_term\"><a class=\"video_info\" href=\"/place/$slug\">$name</a> </span>";
            }
        ?>

        <div id="search_results_sk">
            <?php
                // Display people results
                if ($people->total() > 0) {
                    echo '<div id="people_found">Osoby: ';
                    echo $people_string;
                    echo "</div>";
                }
                // Display places results
                if ($places->total() > 0) {
                    echo '<div id="places_found">Priestory: ';
                    echo $places_string;
                    echo "</div>";
                }
                // Display post results
                $num = sizeof($found);
                if ($num == 0) {
                    echo 'Žiadne príspevky neboli nájdene.';
                } else {
                    echo 'Príspevky:';
                }
            ?>
        </div>
        <div id="search_results_en">
            <?php
                // Display people results
                if ($people->total() > 0) {
                    echo '<div id="people_found">People: ';
                    echo $people_string;
                    echo "</div>";
                }
                // Display places results
                if ($places->total() > 0) {
                    echo '<div id="places_found">Places: ';
                    echo $places_string;
                    echo "</div>";
                }
                // Display post results
                $num = sizeof($found);
                if ($num == 0) {
                    echo 'No posts found.';
                } else {
                    echo 'Posts:';
                }
            ?>
        </div>

        <div id="content_container" class="cf search">
        <?php
            // Loop and display found posts
            $lid = 0;
            foreach ($found as $id) {
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
                    show_related_in_category($lid, $link, $poster_medium, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);
                    $lid += 1;
                }
            }
            // Only show when no results
            if ($num == 0) {
            ?>
                <!-- RELATED VIDEOS -->
                <div id="title_container_sk" class="single_video">
                    <span id="index_title">INÉ PRÍSPEVKY</span>
                </div>
                <div id="title_container_en" class="single_video">
                    <span id="index_title">OTHER VIDEOS</span>
                </div>
            <?php
                $query = new WP_Query( array( 'category_name' => 'video', 'posts_per_page' => 9, 'no_found_rows' => true ) );
                $lid = 0;
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        if ($current_id != get_the_ID() && $lid < 9) {
                            $link = wp_make_link_relative(get_permalink($query->theID(), false));
                            $poster = get_post_meta(get_the_ID(), 'poster');
                            $poster_small = wp_get_attachment_image_src( $poster[0]["ID"], 'medium' )[0];
                            $category_link = get_category_link(get_the_category()[0]->cat_ID);
                            $category_name_sk = get_the_category()[0]->name;
                            $category_name_en = get_the_category()[0]->description;
                            $title_sk = get_the_title();
                            $title_en = get_post_meta(get_the_ID(), 'title_en', true);
                            $artists = get_post_meta(get_the_ID(), 'artists');
                            $duration = get_post_meta(get_the_ID(), 'duration', true);

                            // show past videos
                            show_related_in_single($lid, $link, $poster_small, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);
                            $lid += 1;
                        }
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                }
            }
        } else {
            echo "<div id=\"content_container\" class=\"cf search\">";
        }
        ?>
        </div>

   <!-- START FOOTER -->
   <?php require_once 'footer.php'; ?>

   <!-- START ADDITIONAL JS SCRIPTS -->
   <script>
        // setup some globals
        site_location = 'search';

        // nastav js podla typu klienta
        detect_client();

        // setup menu
        window.onload = search_setup(<?php echo '"' . $_SESSION["lang"] .'"'; ?>);
    </script>
</body>
</html>
