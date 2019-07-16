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
require_once 'lang.php';

// Get category data
$category = get_category( get_query_var( 'cat' ) );
$category_id = $category->cat_ID;
$category_parent_id = $category->parent;
if ($_SESSION["lang"] == "sk") {
    $page_title = 'Art You Can Eat / ' . $category->name;
} else {
    $page_title = 'Art You Can Eat / ' . $category->description;
}
?>

<html>
<head>
    <!-- START HEADER -->
    <?php require_once 'header.php'; ?>
</head>
<body>

<?php include "nav.php"; ?>

<div id="main_container">
    <div id="center_container" class="videos">
        <div id="content_container" class="cf videos">

            <!-- get most recent videos and display them
            TODO: add paging in the future
            -->
            <?php
                // retrieve posts in category
                $args = array(
                    'cat' => $category_id,
                    'orderby' => 'title',
                    'order'   => 'DESC',
                );
                $query = new WP_Query($args);
                // if category has some posts
                if ( $query->have_posts() ) {
                    $lid = 0;
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $link = wp_make_link_relative(get_permalink($query->theID(), false));
                        $poster = types_render_field("poster-image", array("class"=>"index_video_thumb", "alt" => $title, "width" => "400", "proportional" => "true" ));
                        $category_link = get_category_link(get_the_category()[0]->cat_ID);
                        $category_name_sk = get_the_category()[0]->name;
                        $category_name_en = get_the_category()[0]->description;
                        $title_sk = get_the_title();
                        $title_en = types_render_field("en-title",  array("output" => "raw"));
                        $artists = types_render_field("artists", array());
                        show_category_post($lid, $link, $poster, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);
                        $lid += 1;
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                } else { ?>
                    <br/>
                    <div id="title_container_sk">
                        <div class="ordinary_text">Táto sekcia je mo/mentálne prázdna.</div>
                    </div>
                    <div id="title_container_en">
                        <div class="ordinary_text">This section is mo-menta/r/ly empty.</div>
                    </div>
                <?php
                }
                ?>
        </div>

   <!-- START FOOTER -->
   <?php require_once 'footer.php'; ?>

   <!-- START ADDITIONAL JS SCRIPTS -->
   <?php require_once 'footer-category-scripts.php'; ?>

</body>
</html>
