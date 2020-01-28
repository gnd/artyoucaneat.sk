<?php
/* All You Can template for Artyoucaneat.sk
 *
 * Learn more: {@link https://comms.gnd.sk}
 *
 * Generic part of code for the following templates:
 * - artist.php
 * - camera.php
 * - curator.php
 * - editor.php
 * - interview.php
 * - people.php
 * - performer.php
 * - sound.php
 * - translation.php
 *
 * The same (99.9%) code is used also in places.php - update places when updating this
 *
 * @package WordPress
 * @subpackage All You Can
 * @since 2018
 */

?>
<div id="main_container">
    <div id="center_container" class="single_video">
        <div id="term_name_sk">
            <?php
               if ($pods->total() == 0) {
                   echo esc_html(str_replace("-"," ",rtrim($slug, '/')));
               } else {
                   echo $term->name;
               }
            ?>
       </div>
       <div id="term_name_en">
            <?php
               if ($pods->total() == 0) {
                   echo esc_html(str_replace("-"," ",rtrim($slug, '/')));
               } else {
                   echo $term->name;
               }
            ?>
        </div>
        <div id="term_results_sk">
            <?php
                // Display post results
                if ($pods->total() == 0) {
                    echo 'Osoba nieje v databáze.';
                } else {
                    echo "Príspevky súvisiace s $term->name: ";
                }
            ?>
        </div>
        <div id="term_results_en">
            <?php
                if ($pods->total() == 0) {
                    echo 'Person not in database.';
                } else {
                    echo "Posts related to $term->name: ";
                }
            ?>
        </div>

        <div id="content_container" class="cf search">
        <?php
            // Keep track of posts that were shown, so as not to include them in related posts
            $shown_posts = Array();

            // Loop and display found posts
            $lid = 0;
            while ( $pods->fetch() ) {
                $id = $pods->field('ID');
                if (get_post_type($id) == 'post') {
                    $link = wp_make_link_relative(get_permalink($id, false));
                    $poster = get_post_meta($id, 'poster');
                    $poster_medium = wp_get_attachment_image_src( $poster[0]["ID"], 'mobile_small_300px' )[0];
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
                            show_related_in_single($shown, $link, $poster_medium, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists);
                            $shown += 1;
                        }
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                }
                ?>
</div> <!-- END CONTENT CONTAINER -->
