<?php
require_once 'Mobile_Detect.php';

add_action( 'after_setup_theme', 'theme_setup' );

/*
    Add a wpfts filter hook to search also metafields
*/
add_filter('wpfts_index_post', function($index, $post) {
    global $wpdb;
    $index['pods_fields'] = get_post_meta($post->ID, '_product_content', true);
    return $index;
}, 3, 2);

/*
    Add a pre_get_posts filter to change paging in categories
*/
add_filter('pre_get_posts', function ($query) {
    if ($query->is_category) {
        if (is_category('profile') || is_category('report')) {
            $detect = new Mobile_Detect;
            if ($detect->isMobile()) {
                $query->set('posts_per_archive_page', 14);
            } else {
                $query->set('posts_per_archive_page', 9);
            }
        }
    }
});

/*
    This registers custom sizes of thumbnails
*/
function theme_setup() {
    add_image_size('400px', 400, 9999);
    add_image_size('mobile_small_300px', 300, 169);
}


/*
    This checks if a given category ID has any children
    From: https://wordpress.stackexchange.com/questions/176317/check-if-current-category-has-subcategories
*/
function term_has_children( $term_id = '', $taxonomy = 'category' )
{
    // Check if we have a term value, if not, return false
    if ( !$term_id )
        return false;

    // Get term children
    $term_children = get_term_children( filter_var( $term_id, FILTER_VALIDATE_INT ), filter_var( $taxonomy, FILTER_SANITIZE_STRING ) );

    // Return false if we have an empty array or WP_Error object
    if ( empty( $term_children ) || is_wp_error( $term_children ) )
    return false;

    return true;
}


/*
    This takes raw input from additional post fields for persons (via PODS) and returns formated links
*/
function process_persons($persons, $term) {
    foreach ($persons as $person) {
        $links[] = "<a class=\"video_info\" href=\"/$term/" . $person["slug"] . '">' . $person["name"] . '</a>';
    }
    return "\t\t\t\t" . implode(", \n\t\t\t\t", $links) . "\n\t\t\t";
}


/*
    This takes raw input from additional post fields for galleries (via PODS) and returns formated links
*/
function process_places($places) {
    foreach ($places as $place) {
        $links[] = '<a class="video_info" href="/place/' . $place["slug"] . '">' . $place["name"] . '</a>';
    }
    return "\t\t\t\t" . implode(", \n\t\t\t\t", $links) . "\n\t\t\t";
}


/*
    This takes raw input from additional post field "artists" and returns formated links
    Due to design limits we must limit the "shown" names to 50 chars
*/
function process_artists($artists, $max_length) {
    $length = 0;
    foreach ($artists as $artist) {
        if (($length + strlen($artist["name"])) <= $max_length) {
            $links[] = "\n\t\t\t\t\t\t\t\t" . '<a class="index_link" href="/artist/' . $artist["slug"] . '">' . $artist["name"] . '</a>';
            $length += strlen($artist["name"]);
        } else {
            $links[] = "\n\t\t\t\t\t\t\t" . ' ai.';
            break;
        }
    }
    return implode(", ", $links);
}


/*
    This shows the individual post in the section "New videos" on the index page
*/
function show_index_post($id, $link, $poster, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists) {
    if ($id % 2 == 0) {
        echo "\t\t\t\t" .'<div class="index_video_left" id="' . $id . '" onclick="nav(\'' . $link . '\');">' . "\n";
    } else {
        echo "\t\t\t\t" .'<div class="index_video_right" id="' . $id . '" onclick="nav(\'' . $link . '\');">' . "\n";
    }
    echo "\t\t\t\t\t" . '<img id="thumb_' . $id . '" class="index_video_thumb" src="' . $poster . '">' . "\n";
    echo "\t\t\t\t\t" . '<img class="play" src="' . get_stylesheet_directory_uri() . '/assets/images/play.png">' . "\n";
    echo "\t\t\t\t\t" . '<div class="index_video_overlay">' . "\n";
    echo "\t\t\t\t\t\t" . '<div class="index_video_desc">' . "\n";
    echo "\t\t\t\t\t\t\t" . '<span class="index_video_category_sk"><a class="index_link" href="' . $category_link . '">' . $category_name_sk . '</a> / </span>' . "\n";
    echo "\t\t\t\t\t\t\t" . '<span class="index_video_category_en"><a class="index_link" href="' . $category_link . '">' . $category_name_en . '</a> / </span>' . "\n";
    echo "\t\t\t\t\t\t\t" . '<span class="index_video_title_sk"><a class="index_link" href="' . $link . '">' . $title_sk. '</a></span>' . "\n";
    echo "\t\t\t\t\t\t\t" . '<span class="index_video_title_en"><a class="index_link" href="' . $link . '">' . $title_en. '</a></span>' . "\n";
    echo "\t\t\t\t\t\t\t" . '<p class="index_video_artist">';
    echo process_artists($artists, 100) . "\n";
    echo "\t\t\t\t\t\t\t" . '</p>' . "\n";
    echo "\t\t\t\t\t\t" . '</div>' . "\n";
    echo "\t\t\t\t\t" . '</div>' . "\n";
    echo "\t\t\t\t" . '</div>' . "\n";
}

/*
    This shows related posts in the "See also" section in the single video page
*/
function show_related_in_single($id, $link, $poster, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists) {
    if (($id+1) % 3 == 0) {
        echo '<div class="index_video_small_right" id="' . $id . '" onclick="nav(\'' . $link . '\');">' . "\n";
    } else {
        echo '<div class="index_video_small_left" id="' . $id . '" onclick="nav(\'' . $link . '\');">' . "\n";
    }
    echo "\t\t\t\t" . '<img class="index_video_thumb" src="' . $poster . '">' . "\n";
    echo "\t\t\t\t" . '<img class="play" src="' . get_stylesheet_directory_uri() . '/assets/images/play.png">' . "\n";
    echo "\t\t\t\t" . '<div class="index_video_overlay">' . "\n";
    echo "\t\t\t\t\t" . '<div class="video_desc_small">' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_category_small_sk"><a class="index_link" href="' . $category_link . '">' . $category_name_sk . '</a> / </span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_category_small_en"><a class="index_link" href="' . $category_link . '">' . $category_name_en . '</a> / </span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_title_small_sk"><a class="index_link" href="' . $link . '">' . $title_sk. '</a></span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_title_small_en"><a class="index_link" href="' . $link . '">' . $title_en. '</a></span>' . "\n";
    echo "\t\t\t\t\t\t" . '<p class="video_artist">';
    echo process_artists($artists, 55) . "\n";
    echo "\t\t\t\t\t\t" . '</p>' . "\n";
    echo "\t\t\t\t\t" . '</div>' . "\n";
    echo "\t\t\t\t" . '</div>' . "\n";
    echo "\t\t\t" . '</div>' . "\n\n\t\t\t";
}


/*
    This shows video posts in the category template
*/
function show_related_in_category($id, $link, $poster, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists) {
    if ($id % 3 == 2) {
        echo "\t\t\t" .'<div class="index_video_small_right" id="' . $id . '" onclick="nav(\'' . $link . '\');">' . "\n";
    } else {
        echo "\t\t\t" .'<div class="index_video_small_left" id="' . $id . '" onclick="nav(\'' . $link . '\');">' . "\n";
    }
    echo "\t\t\t\t" . '<img class="index_video_thumb" id="thumb_' . $id . '" src="' . $poster . '">' . "\n";
    echo "\t\t\t\t" . '<img class="play" src="' . get_stylesheet_directory_uri() . '/assets/images/play.png">' . "\n";
    echo "\t\t\t\t" . '<div class="index_video_overlay">' . "\n";
    echo "\t\t\t\t\t" . '<div class="video_desc_small">' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_category_sk"><a class="index_link" href="' . $category_link . '">' . $category_name_sk . '</a> / </span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_category_en"><a class="index_link" href="' . $category_link . '">' . $category_name_en . '</a> / </span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="category_video_title_sk"><a class="index_link" href="' . $link . '">' . $title_sk. '</a></span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="category_video_title_en"><a class="index_link" href="' . $link . '">' . $title_en. '</a></span>' . "\n";
    echo "\t\t\t\t\t\t" . '<p class="video_artist">';
    echo process_artists($artists, 70) . "\n";
    echo "\t\t\t\t\t\t" . '</p>' . "\n";
    echo "\t\t\t\t\t" . '</div>' . "\n";
    echo "\t\t\t\t" . '</div>' . "\n";
    echo "\t\t\t" . '</div>' . "\n\n";
}


/*
    This shows the main, rotated post, the so-called landing video on the index page
*/
function show_landing_post($poster, $video_link_txt, $subtitles_sk, $subtitles_en, $category_link, $link_txt, $category_name_sk, $title_sk, $statement_sk, $short_statement_sk, $category_name_en, $title_en, $statement_en, $short_statement_en) {
    echo '<div id="landing_container">' . "\n";
    echo "\t\t" . '<video id="landing_video" class="initial video-js vjs-16-9" controls poster="' . $poster . '" onplay="startlanding()">' . "\n";
    echo "\t\t\t" . '<source src="/' . $video_link_txt . '.mp4" type="video/mp4" res="1080" default label="1080p " />' . "\n";
    echo "\t\t\t" . '<source src="/' . $video_link_txt . '_720p.mp4" type="video/mp4" res="720" label="720p " />' . "\n";
    echo "\t\t\t" . '<source src="/' . $video_link_txt . '_480p.mp4" type="video/mp4" res="480" label="480p " />' . "\n";
    echo "\t\t\t" . '<source src="/' . $video_link_txt . '_240p.mp4" type="video/mp4" res="240" label="240p " />' . "\n";
    echo "\t\t\t" . '<source src="/' . $video_link_txt . '.ogg" type="video/ogg" />' . "\n";
    // subtitles
    $default = "default";
    if (isset($subtitles_sk)) {
        echo "\t\t\t" . "<track kind='captions' src='/" . $subtitles_sk . ".vtt' srclang='sk' label='Slovak' $default />" . "\n";
        $default = "";
    }
    if (isset($subtitles_en)) {
        echo "\t\t\t" . "<track kind='captions' src='/" . $subtitles_en . ".vtt' srclang='en' label='English' $default />" . "\n";
    }
    echo "\t\t\t" . '<p class="vjs-no-js">' . "\n";
    echo "\t\t\t\t" . 'To view this video please enable JavaScript, and consider upgrading to a' . "\n";
    echo "\t\t\t\t" . 'web browser that supports HTML5 video.' . "\n";
    echo "\t\t\t" . '</p>' . "\n";
    echo "\t\t" . '</video>' . "\n";
    echo "\t\t" . '<div id="landing_overlay">' . "\n";
    echo "\t\t\t" . '<div id="landing_overlay_text_sk">' . "\n";
    echo "\t\t\t\t" . '<a class="landing_category" href="' . $category_link . '">' . $category_name_sk . '</a>' . "\n";
    echo "\t\t\t\t" . '/' . "\n";
    echo "\t\t\t\t" . '<a class="landing_title" href="' . $link_txt. '">' . $title_sk. '</a>' . "\n";
    echo "\t\t\t\t" . '<p class="landing_video_desc" id="landing_desktop_sk">' . $statement_sk. '</p>' . "\n";
    echo "\t\t\t\t" . '<p class="landing_video_desc" id="landing_phone_sk">' . $short_statement_sk. '</p>' . "\n";
    echo "\t\t\t" . '</div>' . "\n";
    echo "\t\t\t" . '<div id="landing_overlay_text_en">' . "\n";
    echo "\t\t\t\t" . '<a class="landing_category" href="' . $category_link . '">' . $category_name_en . '</a>' . "\n";
    echo "\t\t\t\t" . '/' . "\n";
    echo "\t\t\t\t" . '<a class="landing_title" href="' . $link_txt. '">' . $title_en. '</a>' . "\n";
    echo "\t\t\t\t" . '<p class="landing_video_desc" id="landing_desktop_en">' . $statement_en. '</p>' . "\n";
    echo "\t\t\t\t" . '<p class="landing_video_desc" id="landing_phone_en">' . $short_statement_en. '</p>' . "\n";
    echo "\t\t\t" . '</div>' . "\n";
    echo "\t\t" . '</div>' . "\n";
    echo "\t" . '</div>' . "\n";
}

?>
