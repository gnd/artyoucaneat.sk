var menu = false;
var video_menu = false;
var hide_time = 50;
var site_lang = 'sk';
var site_location = 'index';
var content_fade = false;
var device_type = "desktop";
var footer_recalc = "default";

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

    /* this is to detect when we should start with the newletter fadein */
    const mq5 = window.matchMedia('screen and (min-width: 700px) and (min-height: 1200px)');
    if (mq5.matches) {
        footer_recalc = "bigphone";
    }
    const mq6 = window.matchMedia('screen and (min-width: 1010px) and (max-height: 850px)');
    if (mq6.matches) {
        footer_recalc = "smalldesk";
    }
    const mq7 = window.matchMedia('screen and (min-width: 1400px) and (min-height: 750px)');
    if (mq7.matches) {
        footer_recalc = "bigdesk";
    }
};

function profile_setup(lang) {

    menu = true;
    video_menu = true;
    site_location = 'profile';
    if (device_type == 'phone') {
        document.getElementById("mobile_video_menu").style.display = "block";
        document.getElementById("mobile_menu_entry_video").style.visibility = "visible";
        if (site_lang == 'sk') {
            var menu_entries = document.getElementsByClassName('mobile_menu_entry_sk');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'inline';
                menu_entries[i].style.visibility = 'visible';
            }
            document.getElementById("mobile_menu_entry_profile_sk").style.textDecoration = "underline";
        }
        if (site_lang == 'en') {
            var menu_entries = document.getElementsByClassName('mobile_menu_entry_en');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'inline';
                menu_entries[i].style.visibility = 'visible';
            }
            document.getElementById("mobile_menu_entry_profile_en").style.textDecoration = "underline";
        }
        document.getElementById("mobile_menu_entry_text").style.visibility = "visible";
        document.getElementById("mobile_menu_entry_search").style.visibility = "visible";
        document.getElementById("mobile_lang_sk_switch").style.visibility = "visible";
        document.getElementById("mobile_lang_en_switch").style.visibility = "visible";
    }
    if (device_type == 'desktop') {
        document.getElementById("menu_entry_video").style.visibility = "visible";
        if (site_lang == 'sk') {
            var menu_entries = document.getElementsByClassName('menu_entry_sk');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'block';
                menu_entries[i].style.visibility = 'visible';
            }
            document.getElementById("menu_entry_profile_sk").style.textDecoration = "underline";
        }
        if (site_lang == 'en') {
            var menu_entries = document.getElementsByClassName('menu_entry_en');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'block';
                menu_entries[i].style.visibility = 'visible';
            }
            document.getElementById("menu_entry_profile_en").style.textDecoration = "underline";
        }
        document.getElementById("menu_entry_text").style.visibility = "visible";
        document.getElementById("menu_entry_search").style.visibility = "visible";
        document.getElementById("lang_sk_switch").style.visibility = "visible";
        document.getElementById("lang_en_switch").style.visibility = "visible";
    }

    // switch lang
    switch_lang(lang, false);

    // setup image sources
    switch_pics();
};

function report_setup(lang) {

    menu = true;
    video_menu = true;
    site_location = 'report';
    if (device_type == 'phone') {
        document.getElementById("mobile_video_menu").style.display = "block";
        document.getElementById("mobile_menu_entry_video").style.visibility = "visible";
        if (site_lang == 'sk') {
            var menu_entries = document.getElementsByClassName('mobile_menu_entry_sk');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'inline';
                menu_entries[i].style.visibility = 'visible';
            }
            document.getElementById("mobile_menu_entryreport_sk").style.textDecoration = "underline";
        }
        if (site_lang == 'en') {
            var menu_entries = document.getElementsByClassName('mobile_menu_entry_en');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'inline';
                menu_entries[i].style.visibility = 'visible';
            }
            document.getElementById("mobile_menu_entry_report_en").style.textDecoration = "underline";
        }
        document.getElementById("mobile_menu_entry_text").style.visibility = "visible";
        document.getElementById("mobile_menu_entry_search").style.visibility = "visible";
        document.getElementById("mobile_lang_sk_switch").style.visibility = "visible";
        document.getElementById("mobile_lang_en_switch").style.visibility = "visible";
    }
    if (device_type == 'desktop') {
        document.getElementById("menu_entry_video").style.visibility = "visible";
        if (site_lang == 'sk') {
            var menu_entries = document.getElementsByClassName('menu_entry_sk');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'block';
                menu_entries[i].style.visibility = 'visible';
            }
            document.getElementById("menu_entry_report_sk").style.textDecoration = "underline";
        }
        if (site_lang == 'en') {
            var menu_entries = document.getElementsByClassName('menu_entry_en');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'block';
                menu_entries[i].style.visibility = 'visible';
            }
            document.getElementById("menu_entry_report_en").style.textDecoration = "underline";
        }
        document.getElementById("menu_entry_text").style.visibility = "visible";
        document.getElementById("menu_entry_search").style.visibility = "visible";
        document.getElementById("lang_sk_switch").style.visibility = "visible";
        document.getElementById("lang_en_switch").style.visibility = "visible";
    }

    // switch lang
    switch_lang(lang, false);

    // setup image sources
    switch_pics();
};

function video_setup(lang) {

    menu = true;
    video_menu = true;
    site_location = 'video';
    if (device_type == 'phone') {
        document.getElementById("mobile_menu_entry_video").style.visibility = "visible";
        document.getElementById("mobile_menu_entry_video").style.textDecoration = "underline";
        if (site_lang == 'sk') {
            var menu_entries = document.getElementsByClassName('mobile_menu_entry_sk');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.visibility = 'visible';
            }
        }
        if (site_lang == 'en') {
            var menu_entries = document.getElementsByClassName('mobile_menu_entry_en');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'inline';
                menu_entries[i].style.visibility = 'visible';
            }
        }
        document.getElementById("mobile_menu_entry_text").style.visibility = "visible";
        document.getElementById("mobile_menu_entry_search").style.visibility = "visible";
        document.getElementById("mobile_lang_sk_switch").style.visibility = "visible";
        document.getElementById("mobile_lang_en_switch").style.visibility = "visible";
    }
    if (device_type == 'desktop') {
        document.getElementById("menu_entry_video").style.visibility = "visible";
        document.getElementById("menu_entry_video").style.textDecoration = "underline";
        if (site_lang == 'sk') {
            var menu_entries = document.getElementsByClassName('menu_entry_sk');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.visibility = 'visible';
            }
        }
        if (site_lang == 'en') {
            var menu_entries = document.getElementsByClassName('menu_entry_en');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'block';
                menu_entries[i].style.visibility = 'visible';
            }
        }
        document.getElementById("menu_entry_text").style.visibility = "visible";
        document.getElementById("menu_entry_search").style.visibility = "visible";
        document.getElementById("lang_sk_switch").style.visibility = "visible";
        document.getElementById("lang_en_switch").style.visibility = "visible";
    }

    // switch lang
    switch_lang(lang, false);

    // setup image sources
    switch_pics();
};

function text_setup(lang) {

    menu = false;
    site_location = 'text';
    if (device_type == 'phone') {
        document.getElementById("mobile_menu_entry_text").style.textDecoration = "underline";
    }
    if (device_type == 'desktop') {
        document.getElementById("menu_entry_text").style.textDecoration = "underline";
    }

    // switch lang
    switch_lang(lang, true);

    // setup image sources
    switch_pics();
};

function info_setup(lang) {

    menu = true;
    site_location = 'info';
    if (device_type == 'phone') {
        document.getElementById("mobile_menu_entry_video").style.visibility = "visible";
        if (site_lang == 'sk') {
            var menu_entries = document.getElementsByClassName('mobile_menu_entry_sk');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.visibility = 'visible';
            }
        }
        if (site_lang == 'en') {
            var menu_entries = document.getElementsByClassName('mobile_menu_entry_en');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'inline';
                menu_entries[i].style.visibility = 'visible';
            }
        }
        document.getElementById("mobile_menu_entry_text").style.visibility = "visible";
        document.getElementById("mobile_menu_entry_search").style.visibility = "visible";
        document.getElementById("mobile_lang_sk_switch").style.visibility = "visible";
        document.getElementById("mobile_lang_en_switch").style.visibility = "visible";
    }
    if (device_type == 'desktop') {
        document.getElementById("menu_entry_video").style.visibility = "visible";
        if (site_lang == 'sk') {
            var menu_entries = document.getElementsByClassName('menu_entry_sk');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.visibility = 'visible';
            }
        }
        if (site_lang == 'en') {
            var menu_entries = document.getElementsByClassName('menu_entry_en');
            for (var i = 0; i < menu_entries.length; ++i) {
                menu_entries[i].style.display = 'block';
                menu_entries[i].style.visibility = 'visible';
            }
        }
        document.getElementById("menu_entry_text").style.visibility = "visible";
        document.getElementById("menu_entry_search").style.visibility = "visible";
        document.getElementById("lang_sk_switch").style.visibility = "visible";
        document.getElementById("lang_en_switch").style.visibility = "visible";
    }

    // switch lang
    switch_lang(lang, true);

};

function allyoucan_setup(lang) {

    // hide video controls
    document.getElementById("landing_video").removeAttribute("controls");

    // switch lang
    switch_lang(lang, false);

    // setup image sources
    switch_pics();
};

function switch_pics() {
    if (device_type == 'desktop') {
        if (document.getElementById("landing_video")) {
            //document.getElementById("landing_video").poster = document.getElementById("landing_video").poster.replace('_p0','');
            var poster = player.poster();
            poster = poster.replace('_p0','');
            player.poster(poster);
        }
        for (var i=0; i<10; i++) {
            if (document.getElementById("video_"+i)) {
                document.getElementById("video_"+i).src = document.getElementById("video_"+i).src.replace('_p0','');
            }
        }
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
        $('#landing_phone').fadeOut(2000);
        $('#landing_desktop').fadeIn(2000);
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
    xhttp.open("POST", "index.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("lang=" + lang);

};

function switch_lang(lang, send) {
    if (lang == 'sk') {
        site_lang = 'sk';
        if (device_type == 'phone') {
            if (video_menu) {
                document.getElementById("mobile_menu_entry_profile_sk").style.visibility = 'visible';
                document.getElementById("mobile_menu_entry_report_sk").style.visibility = 'visible';
                if (site_location == 'profile') {
                    document.getElementById("mobile_menu_entry_profile_sk").style.textDecoration = 'underline';
                }
                if (site_location == 'report') {
                    document.getElementById("mobile_menu_entry_report_sk").style.textDecoration = 'underline';
                }
            }
            document.getElementById("mobile_menu_entry_profile_sk").style.display = 'inline';
            document.getElementById("mobile_menu_entry_profile_en").style.display = 'none';
            document.getElementById("mobile_menu_entry_report_sk").style.display = 'inline';
            document.getElementById("mobile_menu_entry_report_en").style.display = 'none';
            document.getElementById("mobile_lang_sk_switch").style.fontWeight = 'bold';
            document.getElementById("mobile_lang_en_switch").style.fontWeight = 'normal';
            if (document.getElementById("video_info_container_mobile_sk")) {
                document.getElementById("video_info_container_mobile_sk").style.display = 'block';
            }
            if (document.getElementById("video_info_container_mobile_en")) {
                document.getElementById("video_info_container_mobile_en").style.display = 'none';
            }
        }
        if (device_type == 'desktop') {
            if (video_menu) {
                document.getElementById("menu_entry_profile_sk").style.display = 'block';
                document.getElementById("menu_entry_profile_en").style.display = 'none';
                document.getElementById("menu_entry_report_sk").style.display = 'block';
                document.getElementById("menu_entry_report_en").style.display = 'none';
                document.getElementById("menu_entry_profile_sk").style.visibility = 'visible';
                document.getElementById("menu_entry_report_sk").style.visibility = 'visible';
                if (site_location == 'profile') {
                    document.getElementById("menu_entry_profile_sk").style.textDecoration = 'underline';
                }
                if (site_location == 'report') {
                    document.getElementById("menu_entry_report_sk").style.textDecoration = 'underline';
                }
            }
            document.getElementById("lang_sk_switch").style.fontWeight = 'bold';
            document.getElementById("lang_en_switch").style.fontWeight = 'normal';
            if (document.getElementById("video_info_container_sk")) {
                document.getElementById("video_info_container_sk").style.display = 'inline';
            }
            if (document.getElementById("video_info_container_en")) {
                document.getElementById("video_info_container_en").style.display = 'none';
            }
        }
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
        site_lang = 'en';
        if (device_type == 'phone') {
            if (video_menu) {
                document.getElementById("mobile_menu_entry_profile_en").style.visibility = 'visible';
                document.getElementById("mobile_menu_entry_report_en").style.visibility = 'visible';
                if (site_location == 'profile') {
                    document.getElementById("mobile_menu_entry_profile_en").style.textDecoration = 'underline';
                }
                if (site_location == 'report') {
                    document.getElementById("mobile_menu_entry_report_en").style.textDecoration = 'underline';
                }
            }
            document.getElementById("mobile_menu_entry_profile_en").style.display = 'inline';
            document.getElementById("mobile_menu_entry_profile_sk").style.display = 'none';
            document.getElementById("mobile_menu_entry_report_en").style.display = 'inline';
            document.getElementById("mobile_menu_entry_report_sk").style.display = 'none';
            document.getElementById("mobile_lang_sk_switch").style.fontWeight = 'normal';
            document.getElementById("mobile_lang_en_switch").style.fontWeight = 'bold';
            if (document.getElementById("video_info_container_mobile_sk")) {
                document.getElementById("video_info_container_mobile_sk").style.display = 'none';
            }
            if (document.getElementById("video_info_container_mobile_en")) {
                document.getElementById("video_info_container_mobile_en").style.display = 'block';
            }
        }
        if (device_type == 'desktop') {
            if (video_menu) {
                document.getElementById("menu_entry_profile_en").style.display = 'block';
                document.getElementById("menu_entry_profile_sk").style.display = 'none';
                document.getElementById("menu_entry_report_en").style.display = 'block';
                document.getElementById("menu_entry_report_sk").style.display = 'none';
                document.getElementById("menu_entry_profile_en").style.visibility = 'visible';
                document.getElementById("menu_entry_report_en").style.visibility = 'visible';
                if (site_location == 'profile') {
                    document.getElementById("menu_entry_profile_en").style.textDecoration = 'underline';
                }
                if (site_location == 'report') {
                    document.getElementById("menu_entry_report_en").style.textDecoration = 'underline';
                }
            }
            document.getElementById("lang_sk_switch").style.fontWeight = 'normal';
            document.getElementById("lang_en_switch").style.fontWeight = 'bold';
            if (document.getElementById("video_info_container_sk")) {
                document.getElementById("video_info_container_sk").style.display = 'none';
            }
            if (document.getElementById("video_info_container_en")) {
                document.getElementById("video_info_container_en").style.display = 'inline';
            }
        }
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

// show / hide the menu according to device_type
function menuroll() {
    if (menu) {
        if (device_type == 'phone') {
            $('#mobile_video_menu').fadeOut(hide_time);
            $('#mobile_menu_entry_video').fadeOut(hide_time);
            if (site_lang == 'sk') {
                $('#mobile_menu_entry_profile_sk').fadeOut(hide_time);
                $('#mobile_menu_entry_report_sk').fadeOut(hide_time);
            }
            if (site_lang == 'en') {
                $('#mobile_menu_entry_profile_en').fadeOut(hide_time);
                $('#mobile_menu_entry_report_en').fadeOut(hide_time);
            }
            $('#mobile_menu_entry_text').fadeOut(hide_time);
            $('#mobile_menu_entry_search').fadeOut(hide_time);
            $('#mobile_lang_sk_switch').fadeOut(hide_time);
            $('#mobile_lang_en_switch').fadeOut(hide_time);
        }
        if (device_type == 'desktop') {
            $('#menu_entry_video').hide( "clip", {direction: "horizontal"}, hide_time );
            if (site_lang == 'sk') {
                $('#menu_entry_profile_sk').hide( "clip", {direction: "horizontal"}, hide_time );
                $('#menu_entry_report_sk').hide( "clip", {direction: "horizontal"}, hide_time );
            }
            if (site_lang == 'en') {
                $('#menu_entry_profile_en').hide( "clip", {direction: "horizontal"}, hide_time );
                $('#menu_entry_report_en').hide( "clip", {direction: "horizontal"}, hide_time );
            }
            $('#menu_entry_text').hide( "clip", {direction: "horizontal"}, hide_time );
            $('#menu_entry_search').hide( "clip", {direction: "horizontal"}, hide_time );
            $('#lang_sk_switch').hide( "clip", {direction: "horizontal"}, hide_time );
            $('#lang_en_switch').hide( "clip", {direction: "horizontal"}, hide_time );
        }
        menu = false;
    } else {
        if (device_type == 'phone') {
            document.getElementById("mobile_menu_entry_video").style.visibility = "visible";
            document.getElementById("mobile_menu_entry_text").style.visibility = "visible";
            document.getElementById("mobile_menu_entry_search").style.visibility = "visible";
            document.getElementById("mobile_lang_sk_switch").style.visibility = "visible";
            document.getElementById("mobile_lang_en_switch").style.visibility = "visible";
            $('#mobile_menu_entry_video').fadeIn(hide_time);
            $('#mobile_menu_entry_text').fadeIn(hide_time);
            $('#mobile_menu_entry_search').fadeIn(hide_time);
            $('#mobile_lang_sk_switch').fadeIn(hide_time);
            $('#mobile_lang_en_switch').fadeIn(hide_time);
            if (video_menu) {
                $('#mobile_video_menu').fadeIn(hide_time);
                if (site_lang == 'sk') {
                    $('#mobile_menu_entry_profile_sk').fadeIn(hide_time);
                    $('#mobile_menu_entry_report_sk').fadeIn(hide_time);
                    document.getElementById("mobile_menu_entry_profile_sk").style.visibility = "visible";
                    document.getElementById("mobile_menu_entry_report_sk").style.visibility = "visible";
                }
                if (site_lang == 'en') {
                    $('#mobile_menu_entry_profile_en').fadeIn(hide_time);
                    $('#mobile_menu_entry_report_en').fadeIn(hide_time);
                    document.getElementById("mobile_menu_entry_profile_en").style.visibility = "visible";
                    document.getElementById("mobile_menu_entry_report_en").style.visibility = "visible";
                }
            }
        }
        if (device_type == 'desktop') {
            document.getElementById("menu_entry_video").style.visibility = "visible";
            document.getElementById("menu_entry_text").style.visibility = "visible";
            document.getElementById("menu_entry_search").style.visibility = "visible";
            document.getElementById("lang_sk_switch").style.visibility = "visible";
            document.getElementById("lang_en_switch").style.visibility = "visible";
            $('#menu_entry_video').show( "clip", {direction: "horizontal"}, hide_time );
            $('#menu_entry_text').show( "clip", {direction: "horizontal"}, hide_time );
            $('#menu_entry_search').show( "clip", {direction: "horizontal"}, hide_time );
            $('#lang_sk_switch').show( "clip", {direction: "horizontal"}, hide_time );
            $('#lang_en_switch').show( "clip", {direction: "horizontal"}, hide_time );
            if (video_menu) {
                if (site_lang == 'sk') {
                    document.getElementById("menu_entry_profile_sk").style.visibility = "visible";
                    document.getElementById("menu_entry_report_sk").style.visibility = "visible";
                    $('#menu_entry_profile_sk').show( "clip", {direction: "horizontal"}, hide_time );
                    $('#menu_entry_report_sk').show( "clip", {direction: "horizontal"}, hide_time );
                }
                if (site_lang == 'en') {
                    document.getElementById("menu_entry_profile_en").style.visibility = "visible";
                    document.getElementById("menu_entry_report_en").style.visibility = "visible";
                    $('#menu_entry_profile_en').show( "clip", {direction: "horizontal"}, hide_time );
                    $('#menu_entry_report_en').show( "clip", {direction: "horizontal"}, hide_time );
                }
            }
        }
        menu = true;
    }
};



// show / hide video subcategories according to device_type
function videoroll() {
    //if ((site_location == 'profile') || (site_location == 'report')) {
    //    window.location.href = "/";
    //}
    if (video_menu) {
        if (device_type == 'phone') {
            if (site_location == 'index') {
                if (document.getElementById("landing_container")) {
                    document.getElementById("landing_container").style.paddingTop = "10em";
                }
            }
            if (site_location == 'single') {
                if (document.getElementById("center_container")) {
                    document.getElementById("center_container").style.paddingTop = "10em";
                }
            }
            if ((site_location == 'profile') || (site_location == 'report')) {
                if (document.getElementById("content_container")) {
                    document.getElementById("content_container").style.marginTop = "6em";
                }
            }
            $('#mobile_video_menu').fadeOut(hide_time);
            if (site_lang == 'sk') {
                $('#mobile_menu_entry_profile_sk').fadeOut(hide_time);
                $('#mobile_menu_entry_report_sk').fadeOut(hide_time);
            }
            if (site_lang == 'en') {
                $('#mobile_menu_entry_profile_en').fadeOut(hide_time);
                $('#mobile_menu_entry_report_en').fadeOut(hide_time);
            }
            document.getElementById("mobile_menu_entry_video").style.fontWeight = "normal";
        }
        if (device_type == 'desktop') {
            if (site_lang == 'sk') {
                $('#menu_entry_profile_sk').hide( "clip", {direction: "horizontal"}, hide_time );
                $('#menu_entry_report_sk').hide( "clip", {direction: "horizontal"}, hide_time );
            }
            if (site_lang == 'en') {
                $('#menu_entry_profile_en').hide( "clip", {direction: "horizontal"}, hide_time );
                $('#menu_entry_report_en').hide( "clip", {direction: "horizontal"}, hide_time );
            }
        }
        video_menu = false;
    } else {
        if (device_type == 'phone') {
            if (site_location == 'index') {
                if (document.getElementById("landing_container")) {
                    document.getElementById("landing_container").style.paddingTop = "13.5em";
                }
            }
            if (site_location == 'single') {
                if (document.getElementById("center_container")) {
                    document.getElementById("center_container").style.paddingTop = "13.5em";
                }
            }
            if ((site_location == 'profile') || (site_location == 'report')) {
                if (document.getElementById("content_container")) {
                    document.getElementById("content_container").style.marginTop = "9.5em";
                }
            }
            $('#mobile_video_menu').fadeIn(hide_time);
            if (site_lang == 'sk') {
                document.getElementById("mobile_menu_entry_profile_sk").style.visibility = "visible";
                document.getElementById("mobile_menu_entry_report_sk").style.visibility = "visible";
                $('#mobile_menu_entry_profile_sk').show( "clip", {direction: "horizontal"}, hide_time*2, function() {document.getElementById("mobile_menu_entry_profile_sk").style.display = "inline";} );
                $('#mobile_menu_entry_report_sk').show( "clip", {direction: "horizontal"}, hide_time*2, function() {document.getElementById("mobile_menu_entry_report_sk").style.display = "inline";});
            }
            if (site_lang == 'en') {
                document.getElementById("mobile_menu_entry_profile_en").style.visibility = "visible";
                document.getElementById("mobile_menu_entry_report_en").style.visibility = "visible";
                $('#mobile_menu_entry_profile_en').show( "clip", {direction: "horizontal"}, hide_time*2, function() {document.getElementById("mobile_menu_entry_profile_en").style.display = "inline";} );
                $('#mobile_menu_entry_report_en').show( "clip", {direction: "horizontal"}, hide_time*2, function() {document.getElementById("mobile_menu_entry_report_en").style.display = "inline";});
            }
            document.getElementById("mobile_menu_entry_video").style.fontWeight = "bold";
        }
        if (device_type == 'desktop') {
            if (site_lang == 'sk') {
                document.getElementById("menu_entry_profile_sk").style.visibility = "visible";
                document.getElementById("menu_entry_report_sk").style.visibility = "visible";
                $('#menu_entry_profile_sk').show( "clip", {direction: "horizontal"}, hide_time*2, function() {document.getElementById("menu_entry_profile_sk").style.display = "block";} );
                $('#menu_entry_report_sk').show( "clip", {direction: "horizontal"}, hide_time*2, function() {document.getElementById("menu_entry_report_sk").style.display = "block";});
            }
            if (site_lang == 'en') {
                document.getElementById("menu_entry_profile_en").style.visibility = "visible";
                document.getElementById("menu_entry_report_en").style.visibility = "visible";
                $('#menu_entry_profile_en').show( "clip", {direction: "horizontal"}, hide_time*2, function() {document.getElementById("menu_entry_profile_en").style.display = "block";} );
                $('#menu_entry_report_en').show( "clip", {direction: "horizontal"}, hide_time*2, function() {document.getElementById("menu_entry_report_en").style.display = "block";});
            }
        }
        video_menu = true;
    }
};
