<?php
/**
 * Single template file
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
 $artists = get_post_meta($current_id, 'artists');
 $category_link = get_category_link(get_the_category()[0]->cat_ID);
 $category_name_sk = get_the_category()[0]->name;
 $category_name_en = get_the_category()[0]->description;
 $current_title_sk = $post->post_title;
 $content_sk = $post->post_content;
 $current_title_en = get_post_meta($current_id, 'title_en', true);
 $content_en = get_post_meta($current_id, 'content_en', true);

 // Proces page title
 if ($_SESSION["lang"] == "sk") {
    $page_title = 'Art You Can Eat / ' . $current_title_sk;
 } else {
    $page_title = 'Art You Can Eat / ' . $current_title_en;
 }

 // Process $artists
 foreach ($artists as $artist) {
     $links[] = '<a class="video_artist_name" href="/artist/' . $artist["slug"] . '">' . $artist["name"] . '</a>';
 }
 $artist_links = implode(", \n", $links);

// Process content - add a CSS class to <a href
$content_sk = str_replace("<a href=", "<a class='text_link' target='_blank' href=", $content_sk);
$content_en = str_replace("<a href=", "<a class='text_link' target='_blank' href=", $content_en);

// Process the post's additional fields
$curators = get_post_meta($current_id, 'curators');
$curator_links = process_persons($curators, "curator");
$gallery = get_post_meta($current_id, 'gallery');
$gallery_links = process_places($gallery);
$performers = get_post_meta($current_id, 'performers');
$performer_links = process_persons($performers, "performer");
$camera = get_post_meta($current_id, 'camera');
$camera_links = process_persons($camera, "camera");
$sound = get_post_meta($current_id, 'sound');
$sound_links = process_persons($sound, "sound");
$editing = get_post_meta($current_id, 'edit');
$editing_links = process_persons($editing, "editor");
$interviewer = get_post_meta($current_id, 'interviewer');
$interviewer_links = process_persons($interviewer, "interview");
$translation = get_post_meta($current_id, 'translation');
$translation_links = process_persons($translation, "translation");

 // Proces category links
 $category_sk = "\t\t\t\t" . '<a class="video_info" href="' . $category_link . '">' . $category_name_sk . '</a>' . "\n\t\t\t";
 $category_en = "\t\t\t\t" . '<a class="video_info" href="' . $category_link . '">' . $category_name_en . '</a>' . "\n\t\t\t";

 // Process video data
 $poster = get_post_meta($current_id, 'poster');
 $poster_medium = wp_get_attachment_image_src( $poster[0]["ID"], 'medium' )[0];
 $poster_large = wp_get_attachment_image_src( $poster[0]["ID"], 'large' )[0];
 $poster_full = wp_get_attachment_image_src( $poster[0]["ID"], 'full' )[0];
 $matches = array();
 preg_match('~(wp-content.*)\.mp4~', get_attached_file(get_post_meta($current_id, 'video')[0]["ID"]), $matches);
 $video_link = $matches[1];
 preg_match('~(wp-content.*)\.vtt~', get_attached_file(get_post_meta($current_id, 'subtitles_sk')[0]["ID"]), $matches);
 $subtitles_sk = $matches[1];
 preg_match('~(wp-content.*)\.vtt~', get_attached_file(get_post_meta($current_id, 'subtitles_en')[0]["ID"]), $matches);
 $subtitles_en = $matches[1];
 $slide_image = "/" . $video_link . ".jpg";
 $video_share_embed = '<iframe width="100%" height="100%" src="' . site_url() . '/v/?id=' . $current_id . '" frameborder="0" allowfullscreen></iframe>';

 ?>

 <html>
 <head>
     <!-- START HEADER -->
     <?php
         $og_desc = get_post_meta($current_id, 'short_statement_sk')[0];
         $og_url = get_permalink();
         $og_poster = $poster_large;
         require_once 'header.php';
     ?>
 </head>
 <body>

<?php include "nav.php"; ?>
<?php include "embed_popup.php"; ?>

<!-- POST DATA START -->
<div id="main_container">
    <div id="center_container" class="single_video">
        <div id="video_name_sk"><?php echo $current_title_sk; ?></div>
        <div id="video_name_en"><?php echo $current_title_en; ?></div>
        <div id="video_artists_sk">
            <?php
                if (sizeof($artists) > 1) {
                    echo "umelci: ";
                } else {
                    echo "umelec: ";
                }
                echo $artist_links . "\n";
            ?>
        </div>
        <div id="video_artists_en">
            <?php
                if (sizeof($artists) > 1) {
                    echo "artists: ";
                } else {
                    echo "artist: ";
                }
                echo $artist_links . "\n";
            ?>
        </div>

        <div id="landing_container" class="single_video">
            <video id="landing_video" class="video-js vjs-16-9 vjs-default-skin" controls poster="<?php echo $poster_medium; ?>">
                <source src="/<?php echo $video_link; ?>.mp4" type="video/mp4" res="1080" default label="1080p "/>
                <source src="/<?php echo $video_link; ?>_720p.mp4" type="video/mp4" res="720" label="720p "/>
                <source src="/<?php echo $video_link; ?>_480p.mp4" type="video/mp4" res="480" label="480p "/>
                <source src="/<?php echo $video_link; ?>_240p.mp4" type="video/mp4" res="240" label="240p "/>
                <source src="/<?php echo $video_link; ?>.ogg" type="video/ogg"/>
                <?php
                    $default = "default";
                    if (isset($subtitles_sk)) {
                        echo "<track kind='captions' src='/" . $subtitles_sk . ".vtt' srclang='sk' label='Slovak' $default />";
                        $default = "";
                    }
                    if (isset($subtitles_en)) {
                        echo "<track kind='captions' src='/" . $subtitles_en . ".vtt' srclang='en' label='English' $default />";
                    }
                ?>
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that supports HTML5 video.
                </p>
            </video>
        </div>

        <div id="video_info_container_sk">
            <div class="video_info_container_data">
                <span class="video_info">kategória: <?php echo "\n" . $category_sk; ?></span>
                <span class="video_info">
                    <?php
                        if ($curators[0]) {
                            if (sizeof($curators) > 1) {
                                echo "kurátori/ky: \n" . $curator_links;
                            } else {
                                echo "kurátor/ka: \n" . $curator_links;
                            }
                        }
                    ?>
                </span>
                <span class="video_info">
                    <?php
                        if ($gallery[0]) {
                            echo "galéria: \n" . $gallery_links;
                        }
                    ?>
                </span>
                <span class="video_info">
                    <?php
                        if ($performers[0]) {
                            if (sizeof($performers) > 1) {
                                echo "účinkujú: \n" . $performer_links;
                            } else {
                                echo "účinkuje: \n" . $performer_links;
                            }
                        }
                    ?>
                </span>
                <span class="video_info">kamera: <?php echo "\n" . $camera_links; ?></span>
                <span class="video_info">zvuk: <?php echo "\n" . $sound_links; ?></span>
                <span class="video_info">strih: <?php echo "\n" . $editing_links; ?></span>
                <span class="video_info">interview: <?php echo "\n" . $interviewer_links; ?></span>
                <span class="video_info outstanding">
                    <?php
                        if ($translation[0]) {
                            echo "preklad: \n" . $translation_links;
                        }
                    ?>
                </span>
                <span class="video_info outstanding">publikované: <?php echo $date; ?></span>
                <span class="video_info">
                    <a class="video_info" style="text-decoration: underline;" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $og_url; ?>&display=popup', 'sharer', 'top=200,left=400,toolbar=0,status=0,width=600,height=400');" href="javascript: void(0)">
                        Zdieľať
                    </a>
                    <br/>
                    <a class="video_info" style="text-decoration: underline;" onclick="show_embed();"  href="javascript: void(0)">
                        Embed
                    </a>
                </span>
            </div>
        </div>
        <div id="video_info_container_en">
            <div class="video_info_container_data">
                <span class="video_info">category: <?php echo "\n" . $category_en; ?></span>
                <span class="video_info">
                    <?php
                        if ($curators[0]) {
                            if (sizeof($curators) > 1) {
                                echo "curators: \n" . $curator_links;
                            } else {
                                echo "curator: \n" . $curator_links;
                            }
                        }
                    ?>
                </span>
                <span class="video_info">
                    <?php
                        if ($gallery[0]) {
                            echo "gallery: \n" . $gallery_links;
                        }
                    ?>
                </span>
                <span class="video_info">with: <?php echo "\n" . $performer_links; ?></span>
                <span class="video_info">camera: <?php echo "\n" . $camera_links; ?></span>
                <span class="video_info">sound: <?php echo "\n" . $sound_links; ?></span>
                <span class="video_info">editing: <?php echo "\n" . $editing_links; ?></span>
                <span class="video_info">interview: <?php echo "\n" . $interviewer_links; ?></span>
                <span class="video_info outstanding">
                    <?php
                        if ($translation[0]) {
                            echo "translation: \n" . $translation_links;
                        }
                    ?>
                </span>
                <span class="video_info outstanding">published: <?php echo $date; ?></span>
                <span class="video_info">
                    <a class="video_info" style="text-decoration: underline;" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $og_url; ?>&display=popup', 'sharer', 'top=200,left=400,toolbar=0,status=0,width=600,height=400');" href="javascript: void(0)">
                        Share
                    </a>
                    <br/>
                    <a class="video_info" style="text-decoration: underline;" onclick="show_embed();"  href="javascript: void(0)">
                        Embed
                    </a>
                </span>
            </div>
        </div>

        <div id="content_container" class="cf single_video">
            <div id="video_info_text_sk">
                <!--<p class="video_info"> -->
                    <?php echo $content_sk; ?>
                <!--</p>-->
            </div>
            <div id="video_info_text_en">
                <!--<p class="video_info"> -->
                     <?php echo $content_en; ?> 
                <!--</p>-->
            </div>

            <div id="video_info_container_mobile_sk">
                <span class="video_info">kategória: <?php echo "\n\t" . $category_sk . "\t"; ?></span>
                <span class="video_info">
                    <?php
                        if ($curators[0]) {
                            if (sizeof($curators) > 1) {
                                echo "kurátori/ky: \n" . $curator_links;
                            } else {
                                echo "kurátor/ka: \n" . $curator_links;
                            }
                        }
                    ?>
                </span>
                <span class="video_info">
                    <?php
                        if ($gallery[0]) {
                            echo "galéria: \n" . $gallery_links;
                        }
                    ?>
                </span>
                <span class="video_info">
                    <?php
                        if ($performers[0]) {
                            if (sizeof($performers) > 1) {
                                echo "účinkujú: \n" . $performer_links;
                            } else {
                                echo "účinkuje: \n" . $performer_links;
                            }
                        }
                    ?>
                </span>
                <span class="video_info">kamera: <?php echo "\n\t" . $camera_links . "\t"; ?></span>
                <span class="video_info">zvuk: <?php echo "\n\t" . $sound_links . "\t"; ?></span>
                <span class="video_info">strih: <?php echo "\n\t" . $editing_links . "\t"; ?></span>
                <span class="video_info">interview: <?php echo "\n\t" . $interviewer_links . "\t"; ?></span>
                <span class="video_info outstanding">
                    <?php
                        if ($translation[0]) {
                            echo "preklad: \n" . $translation_links . "\t";
                        }
                    ?>
                </span>
                <span class="video_info outstanding">publikované: <?php echo $date; ?></span>
                <span class="video_info">
                    <a class="video_info" style="text-decoration: underline;" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $og_url; ?>&display=popup', 'sharer', 'top=200,left=400,toolbar=0,status=0,width=600,height=400');" href="javascript: void(0)">
                        Zdieľať
                    </a>
                    &nbsp;
                    <a class="video_info" style="text-decoration: underline;" onclick="show_embed();"  href="javascript: void(0)">
                        Embed
                    </a>
                </span>
            </div>
            <div id="video_info_container_mobile_en">
                <span class="video_info">category: <?php echo "\n\t" . $category_en . "\t"; ?></span>
                <span class="video_info">
                    <?php
                        if ($curators[0]) {
                            if (sizeof($curators) > 1) {
                                echo "curators: \n" . $curator_links;
                            } else {
                                echo "curator: \n" . $curator_links;
                            }
                        }
                    ?>
                </span>
                <span class="video_info">
                    <?php
                        if ($gallery[0]) {
                            echo "gallery: \n" . $gallery_links;
                        }
                    ?>
                </span>
                <span class="video_info">with: <?php echo "\n\t" . $performer_links . "\t"; ?></span>
                <span class="video_info">camera: <?php echo "\n\t" . $camera_links . "\t"; ?></span>
                <span class="video_info">sound: <?php echo "\n\t" . $sound_links . "\t"; ?></span>
                <span class="video_info">editing: <?php echo "\n\t" . $editing_links . "\t"; ?></span>
                <span class="video_info">interview: <?php echo "\n\t" . $interviewer_links . "\t"; ?></span>
                <span class="video_info outstanding">
                    <?php
                        if ($translation[0]) {
                            echo "translation: \n" . $translation_links . "\t";
                        }
                    ?>
                </span>
                <span class="video_info outstanding">published: <?php echo $date; ?></span>
                <span class="video_info">
                    <a class="video_info" style="text-decoration: underline;" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $og_url; ?>&display=popup', 'sharer', 'top=200,left=400,toolbar=0,status=0,width=600,height=400');" href="javascript: void(0)">
                        Share
                    </a>
                    &nbsp;
                    <a class="video_info" style="text-decoration: underline;" onclick="show_embed();"  href="javascript: void(0)">
                        Embed
                    </a>
                </span>
            </div>

            <div id="title_container_sk" class="single_video">
                <span id="index_title">POZRITE SI TIEŽ</span>
            </div>
            <div id="title_container_en" class="single_video">
                <span id="index_title">WATCH ALSO</span>
            </div>

            <!-- get most recent videos and display them -->
            <?php
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
                    if ($current_id != get_the_ID() && $lid < 6) {
                        $link = wp_make_link_relative(get_permalink($query->theID(), false));
                        $poster = get_post_meta(get_the_ID(), 'poster');
                        $poster_small = wp_get_attachment_image_src( $poster[0]["ID"], 'mobile_small_300px' )[0];
                        $category_link = get_category_link(get_the_category()[0]->cat_ID);
                        $category_name_sk = get_the_category()[0]->name;
                        $category_name_en = get_the_category()[0]->description;
                        $title_sk = get_the_title();
                        $title_en = get_post_meta(get_the_ID(), 'title_en', true);
                        $artists = get_post_meta(get_the_ID(), 'artists');
                        $duration = get_post_meta(get_the_ID(), 'duration', true);

                        // show past videos
                        show_related_in_single($lid, $link, $poster_small, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);

                        // prepare related videos for Nuevo
                        $related_videos_sk[] = array('thumb' => $poster_small, 'url' => $link, 'title' => $title_sk, 'duration' => $duration);
                        $related_videos_en[] = array('thumb' => $poster_small, 'url' => $link, 'title' => $title_en, 'duration' => $duration);
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
