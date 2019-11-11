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
    <?php
        $page_title = "Art You Can Eat";
        $og_desc = "Art You Can Eat je videoportál, ktorý mapuje slovenské súčasné umenie.";
        $og_url = "https://paleo.artyoucaneat.sk";
        $og_poster = "https://paleo.artyoucaneat.sk/assets/images/logo_big.jpg";
        require_once 'header.php';
    ?>
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
                $poster = get_post_meta(get_the_ID(), 'poster');
                $poster_big = $poster[0]["guid"];
                $matches = array();
                preg_match('~(wp-content.*)\.mp4~', get_attached_file(get_post_meta(get_the_ID(), 'video')[0]["ID"]), $matches);
                $video_link_txt = $matches[1];
                $link_txt = wp_make_link_relative(get_permalink($query->theID(), false));
                $video_share_link = get_permalink(get_the_ID(), false);
                $category_link = get_category_link(get_the_category()[0]->cat_ID);
                $category_name_sk = get_the_category()[0]->name;
                $category_name_en = get_the_category()[0]->description;
                $current_title_sk = get_the_title();
                $statement_sk = get_post_meta(get_the_ID(), 'statement_sk', true);
                $short_statement_sk = get_post_meta(get_the_ID(), 'short_statement_sk', true);
                $current_title_en = get_post_meta(get_the_ID(), 'title_en', true);
                $statement_en = get_post_meta(get_the_ID(), 'statement_en', true);
                $short_statement_en = get_post_meta(get_the_ID(), 'short_statement_en', true);
                $video_share_embed = '<iframe width="100%" height="100%" src="https://paleo.artyoucaneat.sk/index.php/v/?id=' . get_the_ID() . '" frameborder="0" allowfullscreen></iframe>';
                show_landing_post($poster_big, $video_link_txt, $category_link, $link_txt, $category_name_sk, $current_title_sk, $statement_sk, $short_statement_sk, $category_name_en, $current_title_en, $statement_en, $short_statement_en);
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
                            $poster = get_post_meta(get_the_ID(), 'poster');
                            $poster_medium = wp_get_attachment_image_src( $poster[0]["ID"], 'medium' )[0];  //FIXME - 400px custom size
                            $poster_small = wp_get_attachment_image_src( $poster[0]["ID"], 'thumb' )[0];
                            $category_link = get_category_link(get_the_category()[0]->cat_ID);
                            $category_name_sk = get_the_category()[0]->name;
                            $category_name_en = get_the_category()[0]->description;
                            $title_sk = get_the_title();
                            $title_en = get_post_meta(get_the_ID(), 'title_en', true);
                            $artists = get_post_meta(get_the_ID(), 'artists');

                            // show past video
                            show_index_post($lid, $link, $poster_medium, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);

                            // prepare related videos for Nuevo
                            // TODO need to know video duration smh
                            $related_videos_sk[] = array('thumb' => $poster_small, 'url' => $link, 'title' => $title_sk, 'duration' => '15:00'); //FIXME - real duration
                            $related_videos_en[] = array('thumb' => $poster_small, 'url' => $link, 'title' => $title_en, 'duration' => '15:00'); //FIXME - real duration
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
