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
?>

<html>
<head>
    <!-- START HEADER -->
    <?php $page_title = "Art You Can Eat"; ?>
    <?php require_once 'header.php'; ?>
</head>
<body>
    <!-- START LANDING VIDEO -->
    <?php
    $args = array(
        'category_name' => 'video',
    	'orderby' => 'date',
    	'order'   => 'ASC',
        'posts_per_page' => -1,
    );
    $query = new WP_Query($args);
    $rnd = rand(0, 4);
    $i = 0;
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            if ($i == $rnd) {
                $poster = types_render_field("poster-image", array("output" => "raw"));
                $video_link_txt = substr(types_render_field("video-mp4", array("output" => "raw")),0,-4);
                $link_txt = wp_make_link_relative(get_permalink($query->theID(), false));
                $category_link = get_category_link(get_the_category()[0]->cat_ID);
                $category_name_sk = get_the_category()[0]->name;
                $category_name_en = get_the_category()[0]->description;
                $current_title_sk = get_the_title();
                $statement_sk = types_render_field("default-desc",  array("output" => "raw"));
                $short_statement_sk = types_render_field("short-desc",  array("output" => "raw"));
                $current_title_en = types_render_field("en-title",  array("output" => "raw"));
                $statement_en = types_render_field("en-default-desc",  array("output" => "raw"));
                $short_statement_en = types_render_field("en-short-desc",  array("output" => "raw"));
                show_landing_post($poster, $video_link_txt, $category_link, $link_txt, $category_name_sk, $current_title_sk, $statement_sk, $short_statement_sk, $category_name_en, $current_title_en, $statement_en, $short_statement_en);
                break;
            }
            $i++;
        }
        wp_reset_postdata();
    } ?>

    <!-- START NAVIGATION PANEL -->
    <?php require_once "nav.php"; ?>

    <!-- START MAIN CONTENT -->
    <div id="main_container">
        <div id="center_container">
            <div id="content_container" class="cf">
                <div id="title_container_sk">
                    <span id="index_title_sk">NOVÉ VIDEÁ</span>
                </div>
                <div id="title_container_en">
                    <span id="index_title_en">NEW VIDEOS</span>
                </div>
                <!-- get most recent videos and display them
                TODO: add paging in the future
                -->
                <?php
                // start showing past videos
                $query = new WP_Query( array( 'category_name' => 'video' ) );
                $lid = 0;
                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            $link = wp_make_link_relative(get_permalink($query->theID(), false));
                            $poster = types_render_field("poster-image", array("class"=>"index_video_thumb", "alt" => $title, "width" => "400", "proportional" => "true" ));
                            $poster_nuevo = types_render_field("poster-image",  array("output" => "raw"));
                            $category_link = get_category_link(get_the_category()[0]->cat_ID);
                            $category_name_sk = get_the_category()[0]->name;
                            $category_name_en = get_the_category()[0]->description;
                            $title_sk = get_the_title();
                            $title_en = types_render_field("en-title",  array("output" => "raw"));
                            $artists = types_render_field("artists", array());

                            // show past video
                            show_index_post($lid, $link, $poster, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);

                            // prepare related videos for Nuevo
                            // TODO need to know video duration smh
                            $related_videos_sk[] = array('thumb' => $poster_nuevo, 'url' => $link, 'title' => $title_sk, 'duration' => '15:00');
                            $related_videos_en[] = array('thumb' => $poster_nuevo, 'url' => $link, 'title' => $title_en, 'duration' => '15:00');
                            $lid += 1;
                        }
                        /* Restore original Post Data */
                        wp_reset_postdata();
                    }
                ?>
             </div>
             <div id="logo_big">
                 <img id="img_logo_big" src="<?php bloginfo('template_directory'); ?>/assets/images/logo_big.jpg">
             </div>

    <!-- START FOOTER -->
    <?php require_once 'footer-index.php'; ?>

    <!-- START ADDITIONAL JS SCRIPTS -->
    <?php require_once 'footer-index-scripts.php'; ?>

</body>
</html>
