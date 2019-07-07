<?php

/*
    This shows the individual post in the section "New videos" on the index page
*/
function show_index_post($id, $link, $poster, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists) {
    if ($id % 2 == 0) {
        echo "\t\t\t" .'<div class="index_video_left" id="' . $id . '" onclick="nav(\'' . $link . '\');">' . "\n";
    } else {
        echo "\t\t\t" .'<div class="index_video_right" id="' . $id . '" onclick="nav(\'' . $link . '\');">' . "\n";
    }
    echo "\t\t\t\t" . $poster . "\n";
    echo "\t\t\t\t" . '<img class="play" src="' . get_stylesheet_directory_uri() . '/assets/images/play.png">' . "\n";
    echo "\t\t\t\t" . '<div class="index_video_overlay">' . "\n";
    echo "\t\t\t\t\t" . '<div class="index_video_desc">' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_category_sk"><a class="index_link" href="' . $category_link . '">' . $category_name_sk . '</a> / </span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_category_en"><a class="index_link" href="' . $category_link . '">' . $category_name_en . '</a> / </span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_title_sk"><a class="index_link" href="' . $link . '">' . $title_sk. '</a></span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_title_en"><a class="index_link" href="' . $link . '">' . $title_en. '</a></span>' . "\n";
    echo "\t\t\t\t\t\t" . '<p class="index_video_artist">';
    $artists = explode(",",$artists);
    $artists_links = array();
    foreach ($artists as $artist) {
        $artists_links[] = "\n\t\t\t\t\t\t\t" . '<a class="index_link" href="#">' . trim($artist) . '</a>';
    }
    $artists_links = implode(",", $artists_links);
    echo $artists_links . "\n";
    echo "\t\t\t\t\t\t" . '</p>' . "\n";
    echo "\t\t\t\t\t" . '</div>' . "\n";
    echo "\t\t\t\t" . '</div>' . "\n";
    echo "\t\t\t" . '</div>' . "\n\n";
}

/*
    This shows the individual post in a category page.
    The difference to show_index_post is almost nil
*/
function show_category_post($id, $link, $poster, $category_link, $category_name_sk, $category_name_en, $title_sk, $title_en, $artists) {
    if ($id % 3 == 2) {
        echo "\t\t\t" .'<div class="index_video_small_right" id="' . $id . '" onclick="nav(\'' . $link . '\');">' . "\n";
    } else {
        echo "\t\t\t" .'<div class="index_video_small_left" id="' . $id . '" onclick="nav(\'' . $link . '\');">' . "\n";
    }
    echo "\t\t\t\t" . $poster . "\n";
    echo "\t\t\t\t" . '<img class="play" src="' . get_stylesheet_directory_uri() . '/assets/images/play.png">' . "\n";
    echo "\t\t\t\t" . '<div class="index_video_overlay">' . "\n";
    echo "\t\t\t\t\t" . '<div class="index_video_desc_small">' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_category_sk"><a class="index_link" href="' . $category_link . '">' . $category_name_sk . '</a> / </span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_category_en"><a class="index_link" href="' . $category_link . '">' . $category_name_en . '</a> / </span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_title_sk"><a class="index_link" href="' . $link . '">' . $title_sk. '</a></span>' . "\n";
    echo "\t\t\t\t\t\t" . '<span class="index_video_title_en"><a class="index_link" href="' . $link . '">' . $title_en. '</a></span>' . "\n";
    echo "\t\t\t\t\t\t" . '<p class="video_artist">';
    $artists = explode(",",$artists);
    $artists_links = array();
    foreach ($artists as $artist) {
        $artists_links[] = "\n\t\t\t\t\t\t\t" . '<a class="index_link" href="#">' . trim($artist) . '</a>';
    }
    $artists_links = implode(",", $artists_links);
    echo $artists_links . "\n";
    echo "\t\t\t\t\t\t" . '</p>' . "\n";
    echo "\t\t\t\t\t" . '</div>' . "\n";
    echo "\t\t\t\t" . '</div>' . "\n";
    echo "\t\t\t" . '</div>' . "\n\n";
}


/*
    This shows the main, rotated post, the so-called landing video on the index page
*/
function show_landing_post($poster, $video_link_txt, $category_link, $link_txt, $category_name_sk, $title_sk, $statement_sk, $short_statement_sk, $category_name_en, $title_en, $statement_en, $short_statement_en) {
    echo '<div id="landing_container">' . "\n";
    echo "\t" . '<video id="landing_video" class="initial video-js vjs-16-9" controls poster="' . $poster . '" onplay="startlanding()">' . "\n";
    echo "\t\t" . '<source src="' . $video_link_txt . '.mp4" type="video/mp4" res="1080" default label="1080p " />' . "\n";
    echo "\t\t" . '<source src="' . $video_link_txt . '_720p.mp4" type="video/mp4" res="720" default label="720p " />' . "\n";
    echo "\t\t" . '<source src="' . $video_link_txt . '_480p.mp4" type="video/mp4" res="480" default label="480p " />' . "\n";
    echo "\t\t" . '<source src="' . $video_link_txt . '_240p.mp4" type="video/mp4" res="240" default label="240p " />' . "\n";
    echo "\t\t" . '<source src="' . $video_link_txt . '.ogg" type="video/ogg" />' . "\n";
    echo "\t\t" . '<p class="vjs-no-js">' . "\n";
    echo "\t\t\t" . 'To view this video please enable JavaScript, and consider upgrading to a' . "\n";
    echo "\t\t\t" . 'web browser that supports HTML5 video.' . "\n";
    echo "\t\t" . '</p>' . "\n";
    echo "\t" . '</video>' . "\n";
    echo "\t" . '<div id="landing_overlay">' . "\n";
    echo "\t\t" . '<div id="landing_overlay_text_sk">' . "\n";
    echo "\t\t\t" . '<a class="landing_category" href="' . $category_link . '">' . $category_name_sk . '</a>' . "\n";
    echo "\t\t\t" . '/' . "\n";
    echo "\t\t\t" . '<a class="landing_title" href="' . $link_txt. '">' . $title_sk. '</a>' . "\n";
    echo "\t\t\t" . '<p class="landing_video_desc" id="landing_desktop">' . $statement_sk. '</p>' . "\n";
    echo "\t\t\t" . '<p class="landing_video_desc" id="landing_phone">' . $short_statement_sk. '</p>' . "\n";
    echo "\t\t" . '</div>' . "\n";
    echo "\t\t" . '<div id="landing_overlay_text_en">' . "\n";
    echo "\t\t\t" . '<a class="landing_category" href="' . $category_link . '">' . $category_name_en . '</a>' . "\n";
    echo "\t\t\t" . '/' . "\n";
    echo "\t\t\t" . '<a class="landing_title" href="' . $link_txt. '">' . $title_en. '</a>' . "\n";
    echo "\t\t\t" . '<p class="landing_video_desc" id="landing_desktop">' . $statement_en. '</p>' . "\n";
    echo "\t\t\t" . '<p class="landing_video_desc" id="landing_phone">' . $short_statement_en. '</p>' . "\n";
    echo "\t\t" . '</div>' . "\n";
    echo "\t" . '</div>' . "\n";
    echo '</div>' . "\n";
}

?>
