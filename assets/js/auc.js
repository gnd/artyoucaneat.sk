var menu = false;
var unrolled = Array();
var video_menu = false;
var hide_time = 50;
var active_lang;
var inactive_lang;
var site_location = 'index';
var content_fade = false;
var device_type = "desktop";
var page_title_en = "Art You Can Eat";
var page_title_sk = "Art You Can Eat";

function detect_client() {
    const mq = window.matchMedia('screen and (min-width: 300px) and (max-width: 340px)');
    if (mq.matches) {
        device_type = 'phone';
    }
    const mq2 = window.matchMedia('screen and (min-width: 341px) and (max-width: 365px)');
    if (mq2.matches) {
        device_type = 'phone';
    }
    const mq3 = window.matchMedia('screen and (min-width: 370px) and (max-width: 380px)');
    if (mq3.matches) {
        device_type = 'phone';
    }
    const mq4 = window.matchMedia('screen and (min-width: 400px) and (max-width: 1000px)');
    if (mq4.matches) {
        device_type = 'phone';
    }
};

function nav(src) {
    window.location.href = src;
};

function startlanding() {
    if (device_type == 'desktop') {
        $('#landing_overlay').fadeOut(2000);
        var bpb = document.getElementsByClassName('vjs-big-play-button');
        for (var i = 0; i < bpb.length; ++i) {
            bpb[i].style.top = '30%';
        }
    }
    if (device_type == 'phone') {
        $('#landing_phone_' + active_lang).fadeOut(2000);
        $('#landing_desktop_' + active_lang).fadeIn(2000);
    }
};

function send_lang(lang) {

    // initiate xhttp
    if (window.XMLHttpRequest) {
       xhttp = new XMLHttpRequest();
    } else {
       xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    // post client resolution
    xhttp.open("POST", "/index.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("lang=" + lang);

};

function switch_pics() {
    if (device_type == 'desktop') {
        if (document.getElementById("landing_video")) {
            //document.getElementById("landing_video").poster = document.getElementById("landing_video").poster.replace('_p0','');
            var poster = player.poster();
            poster = poster.replace('-300x169','');
            player.poster(poster);
        }
        for (var i=0; i<10; i++) {
            if (document.getElementById("thumb_"+i)) {
                console.log("replacing " + "thumb_"+i);
                document.getElementById("thumb_"+i).src = document.getElementById("thumb_"+i).src.replace('300x169','768x432');
            }
        }
    }
};

function switch_lang(lang, send, id) {
    if (lang == 'sk') {
        active_lang = 'sk';
        inactive_lang = 'en';
        document.title = page_title_sk;
    } else {
        active_lang = 'en';
        inactive_lang = 'sk';
        document.title = page_title_en;
    }

    // TODO - once everything works make desktop / mobile into one
    if (device_type == 'desktop') {
        // Indicate language regardless of menu rolled or unrolled
        document.getElementById('lang_' + active_lang + '_switch').style.fontWeight = 'bold';
        document.getElementById('lang_' + inactive_lang + '_switch').style.fontWeight = 'normal';

        if (menu) {
            // Show menu top entries in active language
            var shown = document.getElementsByClassName('menu_entry_top_' + active_lang);
            for (var i = 0; i < shown.length; ++i) {
                shown[i].style.display = "block";
                shown[i].style.visibility = "visible";
            }
            // Show all children in active language
            for (var i=0; i < unrolled.length; i++) {
                var child_class = 'childof_' + String(unrolled[i]) + '_' + active_lang;
                var children = document.getElementsByClassName(child_class);
                for (var j = 0; j < children.length; j++) {
                    children[j].style.visibility = "visible";
                    children[j].style.display = "block";
                }
            }
            // Underline active child category
            if (id > 0) {
                console.log('adding class to ' + id + "_" + active_lang);
                $('#' + id + "_" + active_lang).addClass("underline");
            }
            // Hide menu top entries in inactiva language
            var hidden = document.getElementsByClassName('menu_entry_top_' + inactive_lang);
            for (var i = 0; i < hidden.length; ++i) {
                hidden[i].style.display = "none";
            }
            // Hide the rest of menu entries in inactive language
            hidden = document.getElementsByClassName('menu_entry_' + inactive_lang);
            for (var i = 0; i < hidden.length; ++i) {
                hidden[i].style.display = "none";
            }
        }
    }
    if (device_type == 'phone') {
        if (menu) {
            // Show menu top entries in active language
            var shown = document.getElementsByClassName('mobile_menu_entry_top_' + active_lang);
            for (var i = 0; i < shown.length; ++i) {
                shown[i].style.display = "inline";
                shown[i].style.visibility = "visible";
            }
            // Show all children in active language
            for (var i=0; i < unrolled.length; i++) {
                var child_class = 'mobile_childof_' + String(unrolled[i]) + '_' + active_lang;
                var children = document.getElementsByClassName(child_class);
                for (var j = 0; j < children.length; j++) {
                    children[j].style.visibility = "visible";
                    children[j].style.display = "inline";
                }
            }
            // Make active top category bold
            for (i=0; i < unrolled.length; i++) {
                document.getElementById('mobile_' + String(unrolled[i]) + "_" + active_lang).style.fontWeight = 'bold';
                document.getElementById('mobile_' + String(unrolled[i]) + "_" + inactive_lang).style.fontWeight = 'normal';
            }
            // Underline the active child category
            if (id > 0) {
                $('#mobile_' + id + "_" + active_lang).addClass("underline");
            }
            // Hide menu top entries in inactiva language
            var hidden = document.getElementsByClassName('mobile_menu_entry_top_' + inactive_lang);
            for (var i = 0; i < hidden.length; i++) {
                hidden[i].style.display = "none";
            }
            // Hide the rest of menu entries in inactive language
            hidden = document.getElementsByClassName('mobile_menu_entry_' + inactive_lang);
            for (var i = 0; i < hidden.length; i++) {
                hidden[i].style.display = "none";
            }
        }
        // Indicate language
        document.getElementById('mobile_lang_' + active_lang + '_switch').style.fontWeight = 'bold';
        document.getElementById('mobile_lang_' + inactive_lang + '_switch').style.fontWeight = 'normal';
        // Show or hide video info data
        if (document.getElementById("video_info_container_mobile_" + active_lang)) {
            document.getElementById("video_info_container_mobile_" + active_lang).style.display = 'block';
        }
        if (document.getElementById("video_info_container_mobile_" + inactive_lang)) {
            document.getElementById("video_info_container_mobile_" + inactive_lang).style.display = 'none';
        }
    }
    // TODO - make sk / eng one
    if (lang == 'sk') {
        if (document.getElementById("landing_overlay_text_sk")) {
            document.getElementById("landing_overlay_text_sk").style.display = 'block';
        }
        if (document.getElementById("landing_overlay_text_en")) {
            document.getElementById("landing_overlay_text_en").style.display = 'none';
        }
        var index_video_titles_sk = document.getElementsByClassName('index_video_title_sk');
        for (var i = 0; i < index_video_titles_sk.length; ++i) {
            index_video_titles_sk[i].style.display = 'inline';
        }
        var index_video_titles_en = document.getElementsByClassName('index_video_title_en');
        for (var i = 0; i < index_video_titles_en.length; ++i) {
            index_video_titles_en[i].style.display = 'none';
        }
        var index_video_titles_small_sk = document.getElementsByClassName('index_video_title_small_sk');
        for (var i = 0; i < index_video_titles_small_sk.length; ++i) {
            index_video_titles_small_sk[i].style.display = 'inline';
        }
        var index_video_titles_small_en = document.getElementsByClassName('index_video_title_small_en');
        for (var i = 0; i < index_video_titles_small_en.length; ++i) {
            index_video_titles_small_en[i].style.display = 'none';
        }
        var index_video_category_sk = document.getElementsByClassName('index_video_category_sk');
        for (var i = 0; i < index_video_category_sk.length; ++i) {
            index_video_category_sk[i].style.display = 'inline';
        }
        var index_video_category_en = document.getElementsByClassName('index_video_category_en');
        for (var i = 0; i < index_video_category_en.length; ++i) {
            index_video_category_en[i].style.display = 'none';
        }
        var index_video_category_small_sk = document.getElementsByClassName('index_video_category_small_sk');
        for (var i = 0; i < index_video_category_small_sk.length; ++i) {
            index_video_category_small_sk[i].style.display = 'inline';
        }
        var index_video_category_small_en = document.getElementsByClassName('index_video_category_small_en');
        for (var i = 0; i < index_video_category_small_en.length; ++i) {
            index_video_category_small_en[i].style.display = 'none';
        }
        if (document.getElementById("title_container_sk")) {
            document.getElementById("title_container_sk").style.display = 'inline-block';
        }
        if (document.getElementById("title_container_en")) {
            document.getElementById("title_container_en").style.display = 'none';
        }
        if (document.getElementById("video_info_text_sk")) {
            document.getElementById("video_info_text_sk").style.display = 'inline-block';
        }
        if (document.getElementById("video_info_text_en")) {
            document.getElementById("video_info_text_en").style.display = 'none';
        }
        if (document.getElementById("video_name_sk")) {
            document.getElementById("video_name_sk").style.display = 'block';
        }
        if (document.getElementById("video_name_en")) {
            document.getElementById("video_name_en").style.display = 'none';
        }
        if (document.getElementById("video_artists_sk")) {
            document.getElementById("video_artists_sk").style.display = 'block';
        }
        if (document.getElementById("video_artists_en")) {
            document.getElementById("video_artists_en").style.display = 'none';
        }
        if (document.getElementById("video_info_container_sk")) {
            document.getElementById("video_info_container_sk").style.display = 'block';
        }
        if (document.getElementById("video_info_container_en")) {
            document.getElementById("video_info_container_en").style.display = 'none';
        }
        if (document.getElementById("search_results_sk")) {
            document.getElementById("search_results_sk").style.display = 'block';
        }
        if (document.getElementById("search_results_en")) {
            document.getElementById("search_results_en").style.display = 'none';
        }
        if (document.getElementById("search_container_sk")) {
            document.getElementById("search_container_sk").style.display = 'block';
        }
        if (document.getElementById("search_container_en")) {
            document.getElementById("search_container_en").style.display = 'none';
        }
        if (document.getElementById("term_name_sk")) {
            document.getElementById("term_name_sk").style.display = 'block';
        }
        if (document.getElementById("term_name_en")) {
            document.getElementById("term_name_en").style.display = 'none';
        }
        if (document.getElementById("term_results_sk")) {
            document.getElementById("term_results_sk").style.display = 'block';
        }
        if (document.getElementById("term_results_en")) {
           document.getElementById("term_results_en").style.display = 'none';
        }
        if (document.getElementById("ordinary_text_info_sk")) {
            document.getElementById("ordinary_text_info_sk").style.display = 'block';
        }
        if (document.getElementById("ordinary_text_info_en")) {
            document.getElementById("ordinary_text_info_en").style.display = 'none';
        }
        if (document.getElementById("newsletter_text_sk")) {
            document.getElementById("newsletter_text_sk").style.display = 'block';
        }
        if (document.getElementById("newsletter_text_en")) {
            document.getElementById("newsletter_text_en").style.display = 'none';
        }
        if (document.getElementById("footer_text_sk")) {
            document.getElementById("footer_text_sk").style.display = 'block';
        }
        if (document.getElementById("footer_text_en")) {
            document.getElementById("footer_text_en").style.display = 'none';
        }
        if (document.getElementById("footer_license_sk")) {
            document.getElementById("footer_license_sk").style.display = 'block';
        }
        if (document.getElementById("footer_license_en")) {
            document.getElementById("footer_license_en").style.display = 'none';
        }
        if (send) {
            send_lang(lang);
        }
    }
    if (lang == 'en') {
        if (document.getElementById("landing_overlay_text_en")) {
            document.getElementById("landing_overlay_text_en").style.display = 'block';
        }
        if (document.getElementById("landing_overlay_text_sk")) {
            document.getElementById("landing_overlay_text_sk").style.display = 'none';
        }
        var index_video_titles_en = document.getElementsByClassName('index_video_title_en');
        for (var i = 0; i < index_video_titles_en.length; ++i) {
            index_video_titles_en[i].style.display = 'inline';
        }
        var index_video_titles_sk = document.getElementsByClassName('index_video_title_sk');
        for (var i = 0; i < index_video_titles_sk.length; ++i) {
            index_video_titles_sk[i].style.display = 'none';
        }
        var index_video_titles_small_en = document.getElementsByClassName('index_video_title_small_en');
        for (var i = 0; i < index_video_titles_small_en.length; ++i) {
            index_video_titles_small_en[i].style.display = 'inline';
        }
        var index_video_titles_small_sk = document.getElementsByClassName('index_video_title_small_sk');
        for (var i = 0; i < index_video_titles_small_sk.length; ++i) {
            index_video_titles_small_sk[i].style.display = 'none';
        }
        var index_video_category_en = document.getElementsByClassName('index_video_category_en');
        for (var i = 0; i < index_video_category_en.length; ++i) {
            index_video_category_en[i].style.display = 'inline';
        }
        var index_video_category_sk = document.getElementsByClassName('index_video_category_sk');
        for (var i = 0; i < index_video_category_sk.length; ++i) {
            index_video_category_sk[i].style.display = 'none';
        }
        var index_video_category_small_en = document.getElementsByClassName('index_video_category_small_en');
        for (var i = 0; i < index_video_category_small_en.length; ++i) {
            index_video_category_small_en[i].style.display = 'inline';
        }
        var index_video_category_small_sk = document.getElementsByClassName('index_video_category_small_sk');
        for (var i = 0; i < index_video_category_small_sk.length; ++i) {
            index_video_category_small_sk[i].style.display = 'none';
        }
        if (document.getElementById("title_container_sk")) {
            document.getElementById("title_container_sk").style.display = 'none';
        }
        if (document.getElementById("title_container_en")) {
            document.getElementById("title_container_en").style.display = 'inline-block';
        }
        if (document.getElementById("video_name_en")) {
            document.getElementById("video_name_en").style.display = 'block';
        }
        if (document.getElementById("video_name_sk")) {
            document.getElementById("video_name_sk").style.display = 'none';
        }
        if (document.getElementById("video_info_text_sk")) {
            document.getElementById("video_info_text_sk").style.display = 'none';
        }
        if (document.getElementById("video_info_text_en")) {
            document.getElementById("video_info_text_en").style.display = 'inline-block';
        }
        if (document.getElementById("video_artists_sk")) {
            document.getElementById("video_artists_sk").style.display = 'none';
        }
        if (document.getElementById("video_artists_en")) {
            document.getElementById("video_artists_en").style.display = 'block';
        }
        if (document.getElementById("video_info_container_sk")) {
            document.getElementById("video_info_container_sk").style.display = 'none';
        }
        if (document.getElementById("video_info_container_en")) {
            document.getElementById("video_info_container_en").style.display = 'block';
        }
        if (document.getElementById("search_results_sk")) {
            document.getElementById("search_results_sk").style.display = 'none';
        }
        if (document.getElementById("search_results_en")) {
            document.getElementById("search_results_en").style.display = 'block';
        }
        if (document.getElementById("search_container_sk")) {
            document.getElementById("search_container_sk").style.display = 'none';
        }
        if (document.getElementById("search_container_en")) {
            document.getElementById("search_container_en").style.display = 'block';
        }
        if (document.getElementById("term_name_sk")) {
            document.getElementById("term_name_sk").style.display = 'none';
        }
        if (document.getElementById("term_name_en")) {
            document.getElementById("term_name_en").style.display = 'block';
        }
        if (document.getElementById("term_results_sk")) {
            document.getElementById("term_results_sk").style.display = 'none';
        }
        if (document.getElementById("term_results_en")) {
            document.getElementById("term_results_en").style.display = 'block';
        }
        if (document.getElementById("ordinary_text_info_en")) {
            document.getElementById("ordinary_text_info_en").style.display = 'block';
        }
        if (document.getElementById("ordinary_text_info_sk")) {
            document.getElementById("ordinary_text_info_sk").style.display = 'none';
        }
        if (document.getElementById("newsletter_text_en")) {
            document.getElementById("newsletter_text_en").style.display = 'block';
        }
        if (document.getElementById("newsletter_text_sk")) {
            document.getElementById("newsletter_text_sk").style.display = 'none';
        }
        if (document.getElementById("footer_text_sk")) {
            document.getElementById("footer_text_sk").style.display = 'none';
        }
        if (document.getElementById("footer_text_en")) {
            document.getElementById("footer_text_en").style.display = 'block';
        }
        if (document.getElementById("footer_license_sk")) {
            document.getElementById("footer_license_sk").style.display = 'none';
        }
        if (document.getElementById("footer_license_en")) {
            document.getElementById("footer_license_en").style.display = 'block';
        }
        if (send) {
            send_lang(lang);
        }
    }
};

function allyoucan_setup(lang) {
    // hide video controls
    if (document.getElementById("landing_video")) {
        document.getElementById("landing_video").removeAttribute("controls");
    }
    // switch lang
    switch_lang(lang, false, 0);
    // setup image sources
    switch_pics();
};

function category_setup(lang, parent_id, category_id) {
    if (lang == 'sk') {
        active_lang = 'sk';
        inactive_lang = 'en';
    } else {
        active_lang = 'en';
        inactive_lang = 'sk';
    }
    // unroll menu
    menuroll();
    // unroll category
    cat_unroll(parent_id);
    // switch lang
    switch_lang(lang, true, category_id);
    // setup image sources
    switch_pics();
};


function search_setup(lang) {
    if (lang == 'sk') {
        active_lang = 'sk';
        inactive_lang = 'en';
    } else {
        active_lang = 'en';
        inactive_lang = 'sk';
    }
    // unroll menu
    menuroll();
    // switch lang
    switch_lang(lang, true, 0);
    // setup image sources
    switch_pics();
};


function term_setup(lang) {
    if (lang == 'sk') {
        active_lang = 'sk';
        inactive_lang = 'en';
    } else {
        active_lang = 'en';
        inactive_lang = 'sk';
    }
    // unroll menu
    menuroll();
    // switch lang
    switch_lang(lang, true, 0);
    // setup image sources
    switch_pics();
};

// show / hide the menu according to device_type
function menuroll() {
    if (menu) {
        if (device_type == 'phone') {
            $('.mobile_menu_entry_top').fadeOut(hide_time);
            $('.mobile_menu_entry_top_' + active_lang).fadeOut(hide_time);
            $('.mobile_menu_entry_top_' + inactive_lang).fadeOut(hide_time);
            for (var i = 0; i < unrolled.length; i++) {
                $('#mobile_menu_' + String(unrolled[i])).fadeOut(hide_time);
                var child_class = 'mobile_childof_' + String(unrolled[i]) + '_' + active_lang;
                $('.' + child_class).fadeOut(hide_time);
            }
            // make content jump up a bit when we close the whole menu with unrolled categories
            if (unrolled.length > 0) {
                if (site_location == 'index') {
                    if (document.getElementById("landing_container")) {
                        document.getElementById("landing_container").style.paddingTop = "10em";
                    }
                }
                if ((site_location == 'single') || (site_location == 'terms') || (site_location == 'search')) {
                    if (document.getElementById("center_container")) {
                        document.getElementById("center_container").style.paddingTop = "10em";
                    }
                }
                if ((site_location == 'profiles') || (site_location == 'reports')) {
                    if (document.getElementById("content_container")) {
                        document.getElementById("content_container").style.marginTop = "6em";
                    }
                }
            }
        }
        if (device_type == 'desktop') {
            $('.menu_entry_top').hide( "clip", {direction: "horizontal"}, hide_time );
            $('.menu_entry_top_' + active_lang).hide( "clip", {direction: "horizontal"}, hide_time );
            $('.menu_entry_top_' + inactive_lang).hide( "clip", {direction: "horizontal"}, hide_time );
            for (var i = 0; i < unrolled.length; i++) {
                var child_class = 'childof_' + String(unrolled[i]) + '_' + active_lang;
                $('.' + child_class).hide( "clip", {direction: "horizontal"}, hide_time);
            }
        }
        menu = false;
    } else {
        if (device_type == 'phone') {
            // TODO - make simpler and maybe remove simple menu_entry_top
            $('.mobile_menu_entry_top').fadeIn(hide_time);
            var menu_top_items = document.getElementsByClassName('mobile_menu_entry_top');
            for (var i = 0; i < menu_top_items.length; ++i) {
                menu_top_items[i].style.visibility = "visible";
            }
            $('.mobile_menu_entry_top_' + active_lang).fadeIn(hide_time);
            var menu_top_items = document.getElementsByClassName('mobile_menu_entry_top_' + active_lang);
            for (var i = 0; i < menu_top_items.length; ++i) {
                menu_top_items[i].style.visibility = "visible";
            }
            for (var i = 0; i < unrolled.length; i++) {
                $('#mobile_menu_' + String(unrolled[i])).fadeIn(hide_time);
                var child_class = 'mobile_childof_' + String(unrolled[i]) + '_' + active_lang;
                $('.' + child_class).fadeIn(hide_time);
                var children = document.getElementsByClassName(child_class);
                for (var j = 0; j < children.length; ++j) {
                    children[j].style.visibility = "visible";
                }
            }
            // make sure the content jumps lower in case we formerly put it back up on menu closeure with unrolled categories
            if (unrolled.length > 0) {
                if (site_location == 'index') {
                    if (document.getElementById("landing_container")) {
                        document.getElementById("landing_container").style.paddingTop = "13.5em";
                    }
                }
                if ((site_location == 'single') || (site_location == 'terms') || (site_location == 'search')) {
                    if (document.getElementById("center_container")) {
                        document.getElementById("center_container").style.paddingTop = "13.5em";
                    }
                }
                if ((site_location == 'profiles') || (site_location == 'reports')) {
                    if (document.getElementById("content_container")) {
                        document.getElementById("content_container").style.marginTop = "9.5em";
                    }
                }
            }
        }
        if (device_type == 'desktop') {
            // TODO - make simpler and maybe remove simple menu_entry_top
            $('.menu_entry_top').show( "clip", {direction: "horizontal"}, hide_time, function() {
                var menu_top_items = document.getElementsByClassName('menu_entry_top');
                for (var i = 0; i < menu_top_items.length; ++i) {
                    menu_top_items[i].style.visibility = "visible";
                }
            });
            $('.menu_entry_top_' + active_lang).show( "clip", {direction: "horizontal"}, hide_time, function() {
                var menu_top_items = document.getElementsByClassName('menu_entry_top_' + active_lang);
                for (var i = 0; i < menu_top_items.length; ++i) {
                    menu_top_items[i].style.visibility = "visible";
                    menu_top_items[i].style.display = "block";
                }
            });
            for (var i = 0; i < unrolled.length; i++) {
                var child_class = 'childof_' + String(unrolled[i]) + '_' + active_lang;
                $('.' + child_class).show( "clip", {direction: "horizontal"}, hide_time, function() {
                    var children = document.getElementsByClassName(child_class);
                    for (var j = 0; j < children.length; ++j) {
                        children[j].style.visibility = "visible";
                        children[i].style.display = "block";
                    }
                } );
            }
        }
        menu = true;
    }
};

// show / hide subcategories according to device_type
function cat_unroll(id) {
    var child_class = 'childof_' + String(id) + '_' + active_lang;

    if (unrolled.indexOf(id) > -1) {
        if (device_type == 'phone') {
            if (site_location == 'index') {
                if (document.getElementById("landing_container")) {
                    document.getElementById("landing_container").style.paddingTop = "10em";
                }
                var children = document.getElementsByClassName("index_first");
                if (typeof children[0] != "undefined") {
                    children[0].style.marginTop = "6em";
                }
            }
            if ((site_location == 'single') || (site_location == 'terms') || (site_location == 'search')) {
                if (document.getElementById("center_container")) {
                    document.getElementById("center_container").style.paddingTop = "10em";
                }
            }
            if ((site_location == 'profiles') || (site_location == 'reports')) {
                if (document.getElementById("content_container")) {
                    document.getElementById("content_container").style.marginTop = "6em";
                }
            }
            $('#mobile_menu_' + String(id)).fadeOut(hide_time);
            $('.mobile_' + child_class).fadeOut(hide_time);
            document.getElementById("mobile_" + String(id) + "_" + active_lang).style.fontWeight = "normal";
        }
        if (device_type == 'desktop') {
            $('.' + child_class).hide( "clip", {direction: "horizontal"}, hide_time );
        }
        // remove the category from the unrolled array
        unrolled.splice(unrolled.indexOf(id), 1);
    } else {
        if (device_type == 'phone') {
            if (site_location == 'index') {
                if (document.getElementById("landing_container")) {
                    document.getElementById("landing_container").style.paddingTop = "13.5em";
                }
                var children = document.getElementsByClassName("index_first");
                if (typeof children[0] != "undefined") {
                    children[0].style.marginTop = "9.5em";
                }
            }
            if ((site_location == 'single') || (site_location == 'terms') || (site_location == 'search')) {
                if (document.getElementById("center_container")) {
                    document.getElementById("center_container").style.paddingTop = "13.5em";
                }
            }
            if ((site_location == 'profiles') || (site_location == 'reports')) {
                if (document.getElementById("content_container")) {
                    document.getElementById("content_container").style.marginTop = "9.5em";
                }
            }
            $('#mobile_menu_' + String(id)).fadeIn(hide_time);
            $('.mobile_' + child_class).show( "clip", {direction: "horizontal"}, hide_time*2, function() {
                var children = document.getElementsByClassName("mobile_" + child_class);
                for (var i = 0; i < children.length; ++i) {
                    children[i].style.visibility = "visible";
                    children[i].style.display = "inline";
                }
            } );
            document.getElementById("mobile_" + String(id) + "_" + active_lang).style.fontWeight = "bold";
        }
        if (device_type == 'desktop') {
            $('.' + child_class).show( "clip", {direction: "horizontal"}, hide_time*2, function() {
                var children = document.getElementsByClassName(child_class);
                for (var i = 0; i < children.length; ++i) {
                    children[i].style.visibility = "visible";
                    children[i].style.display = "block";
                }
            } );
        }
        // add the category to the unrolled array
        unrolled.push(id);
    }
};

// Show video embed popup
function show_embed() {
    console.log('active_lang');
    document.getElementById("embed_container").style.display = "block";
    document.getElementById("embed_container_bg").style.display = "block";
    document.getElementById('embed_' + active_lang).style.display = "block";
    document.getElementById('embed_' + inactive_lang).style.display = "none";
    // Add a Close option for mobile
    if (device_type == 'phone') {
        document.getElementById("embed_" + active_lang + "_close").style.display = "block";
        document.getElementById("embed_" + inactive_lang + "_close").style.display = "none";
    }
};

// Hide video embed popup
function hide_embed() {
    document.getElementById("embed_container").style.display = "none";
    document.getElementById("embed_container_bg").style.display = "none";
};
