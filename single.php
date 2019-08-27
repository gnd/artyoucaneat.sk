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
 include "lang.php";

 // Fetch and process data
 $post = get_post();
 $current_id = $post->ID;
 $date = date("d.m.Y",strtotime($post->post_date));
 $artists = types_render_field("artists", array());
 $category_link = get_category_link(get_the_category()[0]->cat_ID);
 $category_name_sk = get_the_category()[0]->name;
 $category_name_en = get_the_category()[0]->description;
 $current_title_sk = $post->post_title;
 $content_sk = $post->post_content;
 $current_title_en = types_render_field("en-title",  array("output" => "raw"));
 $content_en = types_render_field("en-text");

 // Proces page title
 if ($_SESSION["lang"] == "sk") {
    $page_title = 'Art You Can Eat / ' . $current_title_sk;
 } else {
    $page_title = 'Art You Can Eat / ' . $current_title_en;
 }

 // Process $artists
 $tmp = explode(",", $artists);
 $tmp_links = array();
 foreach ($tmp as $entry) {
     $tmp_links[] = '<a class="video_artist_name" href="#">' . trim($entry) . '</a>';
 }
 $artist_links = implode(", ", $tmp_links);

// Process content
$content_sk = str_replace("<a href=", "<a class='text_link' href=", $content_sk);
$content_en = str_replace("<a href=", "<a class='text_link' href=", $content_en);

// Process the post's field group
$curators = types_render_field("curators",  array("output" => "raw"));
$curator_links = process_video_links($curators);
$performers = types_render_field("performers",  array("output" => "raw"));
$performer_links = process_video_links($performers);
$camera = types_render_field("camera",  array("output" => "raw"));
$camera_links = process_video_links($camera);
$sound = types_render_field("sound",  array("output" => "raw"));
$sound_links = process_video_links($sound);
$editing = types_render_field("editing",  array("output" => "raw"));
$editing_links = process_video_links($editing);
$interviewer = types_render_field("interviewer",  array("output" => "raw"));
$interviewer_links = process_video_links($interviewer);
$translation = types_render_field("translation",  array("output" => "raw"));
$translation_links = process_video_links($translation);

 // Proces category links
 $category_sk = "\t\t\t\t" . '<a class="video_info" href="' . $category_link . '">' . $category_name_sk . '</a>' . "\n\t\t\t";
 $category_en = "\t\t\t\t" . '<a class="video_info" href="' . $category_link . '">' . $category_name_en . '</a>' . "\n\t\t\t";

 // Process video data
 $poster = types_render_field("poster-image", array("output" => "raw"));
 $video_link = substr(types_render_field("video-mp4", array("output" => "raw")),0,-4);

 ?>

 <html>
 <head>
     <!-- START HEADER -->
     <?php
         $og_desc = types_render_field("short-desc",  array("output" => "raw"));
         $og_url = get_permalink();
         $og_poster = $poster;
         require_once 'header.php';
     ?>
 </head>
 <body>

<?php include "nav.php"; ?>

<!-- POST DATA START -->
<div id="main_container">
    <div id="center_container" class="single_video">
        <div id="video_name_sk"><?php echo $current_title_sk; ?></div>
        <div id="video_name_en"><?php echo $current_title_en; ?></div>
        <div id="video_artists_sk">
            umelci:
            <?php echo $artist_links . "\n"; ?>
        </div>
        <div id="video_artists_en">
            artists:
            <?php echo $artist_links . "\n"; ?>
        </div>

        <div id="landing_container" class="single_video">
            <video id="landing_video" class="video-js vjs-16-9 vjs-default-skin" controls poster="<?php echo $poster; ?>">
                <source src="<?php echo $video_link; ?>.mp4" type="video/mp4" res="1080" default label="1080p "/>
                <source src="<?php echo $video_link; ?>_720p.mp4" type="video/mp4" res="720" label="720p "/>
                <source src="<?php echo $video_link; ?>_480p.mp4" type="video/mp4" res="480" label="480p "/>
                <source src="<?php echo $video_link; ?>_240p.mp4" type="video/mp4" res="240" label="240p "/>
                <source src="<?php echo $video_link; ?>.ogg" type="video/ogg"/>
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that supports HTML5 video.
                </p>
            </video>
        </div>

        <div id="video_info_container_sk">
            <div class="video_info_container_data">
                <span class="video_info">kategória: <?php echo "\n" . $category_sk; ?></span>
                <span class="video_info">kurátori: <?php echo "\n" . $curator_links; ?></span>
                <span class="video_info">účinkuje: <?php echo "\n" . $performer_links; ?></span>
                <span class="video_info">kamera: <?php echo "\n" . $camera_links; ?></span>
                <span class="video_info">zvuk: <?php echo "\n" . $sound_links; ?></span>
                <span class="video_info">strih: <?php echo "\n" . $editing_links; ?></span>
                <span class="video_info">interview: <?php echo "\n" . $interviewer_links; ?></span>
                <span class="video_info outstanding">preklad: <?php echo "\n" . $translation_links; ?></span>
                <span class="video_info">publikované: <?php echo $date; ?></span>
            </div>
        </div>
        <div id="video_info_container_en">
            <div class="video_info_container_data">
                <span class="video_info">category: <?php echo "\n" . $category_en; ?></span>
                <span class="video_info">curators: <?php echo "\n" . $curator_links; ?></span>
                <span class="video_info">with: <?php echo "\n" . $performer_links; ?></span>
                <span class="video_info">camera: <?php echo "\n" . $camera_links; ?></span>
                <span class="video_info">sound: <?php echo "\n" . $sound_links; ?></span>
                <span class="video_info">editing: <?php echo "\n" . $editing_links; ?></span>
                <span class="video_info">interview: <?php echo "\n" . $interviewer_links; ?></span>
                <span class="video_info outstanding">translation: <?php echo "\n" . $curator_links; ?></span>
                <span class="video_info">published: <?php echo $date; ?></span>
            </div>
        </div>

        <div id="content_container" class="cf single_video">
            <div id="video_info_text_sk">
                <p class="video_info">
                    <?php echo $content_sk; ?>
                </p>
            </div>
            <div id="video_info_text_en">
                <p class="video_info">
                     <?php echo $content_en; ?> 
                </p>
            </div>

            <div id="video_info_container_mobile_sk">
                <span class="video_info">kategória: <?php echo "\n\t" . $category_sk . "\t"; ?></span>
                <span class="video_info">kurátori: <?php echo "\n\t" . $curator_links . "\t"; ?></span>
                <span class="video_info">účinkuje: <?php echo "\n\t" . $performer_links . "\t"; ?></span>
                <span class="video_info">kamera: <?php echo "\n\t" . $camera_links . "\t"; ?></span>
                <span class="video_info">zvuk: <?php echo "\n\t" . $sound_links . "\t"; ?></span>
                <span class="video_info">strih: <?php echo "\n\t" . $editing_links . "\t"; ?></span>
                <span class="video_info">interview: <?php echo "\n\t" . $interviewer_links . "\t"; ?></span>
                <span class="video_info">preklad: <?php echo "\n\t" . $translation_links . "\t"; ?></span>
                <span class="video_info">publikované: <?php echo $date; ?></span>
            </div>
            <div id="video_info_container_mobile_en">
                <span class="video_info">category: <?php echo "\n\t" . $category_en . "\t"; ?></span>
                <span class="video_info">curators: <?php echo "\n\t" . $curator_links . "\t"; ?></span>
                <span class="video_info">with: <?php echo "\n\t" . $performer_links . "\t"; ?></span>
                <span class="video_info">camera: <?php echo "\n\t" . $camera_links . "\t"; ?></span>
                <span class="video_info">sound: <?php echo "\n\t" . $sound_links . "\t"; ?></span>
                <span class="video_info">editing: <?php echo "\n\t" . $editing_links . "\t"; ?></span>
                <span class="video_info">interview: <?php echo "\n\t" . $interviewer_links . "\t"; ?></span>
                <span class="video_info">translation: <?php echo "\n\t" . $curator_links . "\t"; ?></span>
                <span class="video_info">published: <?php echo $date; ?></span>
            </div>

            <div id="title_container_sk" class="single_video">
                <span id="index_title">POZRITE SI TIEŽ</span>
            </div>
            <div id="title_container_en" class="single_video">
                <span id="index_title">WATCH ALSO</span>
            </div>

            <!-- get most recent videos and display them -->
            <?php
            // start showing past videos
            // TODO - dont show current post
            // TODO: show only last 6 videos
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
                        $poster = types_render_field("poster-image", array("class"=>"index_video_thumb", "alt" => $title, "width" => "400", "proportional" => "true" ));
                        $poster_nuevo = types_render_field("poster-image", array("output" => "raw"));
                        $category_link = get_category_link(get_the_category()[0]->cat_ID);
                        $category_name_sk = get_the_category()[0]->name;
                        $category_name_en = get_the_category()[0]->description;
                        $title_sk = get_the_title();
                        $title_en = types_render_field("en-title",  array("output" => "raw"));
                        $artists = types_render_field("artists", array());

                        // show past video
                        show_single_post($lid, $link, $poster, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);

                        // prepare related videos for Nuevo
                        // TODO need to know video duration smh
                        $related_videos_sk[] = array('thumb' => $poster_nuevo, 'url' => $link, 'title' => $title_sk, 'duration' => '15:00');
                        $related_videos_en[] = array('thumb' => $poster_nuevo, 'url' => $link, 'title' => $title_en, 'duration' => '15:00');
                        $lid += 1;
                    }
                }
                /* Restore original Post Data */
                wp_reset_postdata();
            }
            ?>
        </div>
        <!-- POST DATA END -->

<!-- FOOTER STARTS HERE -->
<?php include "footer.php"; ?>

<!-- ADDITIONAL SCRIPTS -->
<?php include "footer-single-scripts.php"; ?>

</body>
</html>
