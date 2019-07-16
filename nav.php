<?php
/**
 * NAvigation panel
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

 ?>

 <!-- nav panels desktop & mobile -->
 <div id="left_container">
     <div id="menu_container">
         <div id="menu_icon_container">
             <img id="menu_icon" src="<?php bloginfo('template_directory'); ?>/assets/images/menu_icon_bk.png" onclick="menuroll();">
         </div>
         <div id="menu">
             <?php
                // Array of already shown $categories
                $shown = array();

                // Get and output all top-level categories
                $top_categories = get_categories(array('orderby' => 'id','parent'  => 0));
                foreach ($top_categories as $top_cat) {
                    echo '<a class="menu_entry menu_entry_top_sk" id="menu_entry_' . strtolower($top_cat->name). '_sk" onclick="cat_unroll('.$top_cat->cat_ID.');">' . $top_cat->name . '</a>' . "\n";
                    echo '<a class="menu_entry menu_entry_top_en" id="menu_entry_' . strtolower($top_cat->description). '_en" onclick="cat_unroll('.$top_cat->cat_ID.');">' . $top_cat->description . '</a>' . "\n";
                    $shown[] = $top_cat->cat_ID;

                    // Get and output all children
                    $child_categories = get_categories(array('orderby' => 'name','parent'  => $top_cat->cat_ID));
                    foreach ($child_categories as $child_cat) {
                        // TODO are ids needed ?
                        echo "\t\t\t" . '<a class="menu_entry menu_entry_sk childof_'.$top_cat->cat_ID.'_sk" id="menu_entry_' . strtolower($child_cat->name) . '_sk" href="' . get_category_link($child_cat->cat_ID) . '">' . $child_cat->name . '</a>' . "\n";
                        echo "\t\t\t" . '<a class="menu_entry menu_entry_en childof_'.$top_cat->cat_ID.'_en" id="menu_entry_' . strtolower($child_cat->description) . '_en" href="' . get_category_link($child_cat->cat_ID) . '">' . $child_cat->description . '</a>' . "\n";
                        $shown[] = $child_cat->cat_ID;
                    }
                }

                // Output the rest of the categories
                $categories = get_categories(array('hide_empty' => false));
                foreach ($categories as $cat) {
                    if (!in_array($cat->cat_ID, $shown) && ($cat->name != "Uncategorized")) {
                        echo "\t\t\t" . '<a class="menu_entry menu_entry_top_sk" id="menu_entry_' . strtolower($cat->name) . '_sk" href="' . get_category_link($cat->cat_ID) . '">' . $cat->name . '</a>' . "\n";
                        echo "\t\t\t" . '<a class="menu_entry menu_entry_top_en" id="menu_entry_' . strtolower($cat->description) . '_en" href="' . get_category_link($cat->cat_ID) . '">' . $cat->description . '</a>' . "\n";
                        $shown[] = $cat->cat_ID;
                    }
                }
             ?>
             <img class="menu_entry menu_entry_top" id="menu_entry_search" src="<?php bloginfo('template_directory'); ?>/assets/images/white.png">
             <!-- no such functionality
             <img id="menu_entry_search" src="assets/images/lupa_icon_bk.png">
             -->
             <a class="menu_entry menu_entry_top" id="lang_sk_switch" onclick="switch_lang('sk', true);">SK</a>
             <a class="menu_entry menu_entry_top" id="lang_en_switch" onclick="switch_lang('en', true);">EN</a>
         </div>
     </div>
 </div>
 <div id="right_container">
     <div id="logo_container">
         <a href="/"><img id="logo_icon" src="<?php bloginfo('template_directory'); ?>/assets/images/logo/5.png"></a>
     </div>
 </div>


 <div id="mobile_nav_container">
     <div id="mobile_icon_container">
         <img id="mobile_menu_icon" src="<?php bloginfo('template_directory'); ?>/assets/images/menu_icon_bk.png" onclick="menuroll();">
     </div>
     <div id="mobile_main_menu">
         <?php
            // Array of already shown $categories
            $shown = array();

            /*  Output Video
                Output looks like:
                    <a class="mobile_menu_entry" id="mobile_menu_entry_video" onclick="videoroll();">Video</a>
            */
            foreach ($categories as $cat) {
                if ($cat->name == "Video") {
                    $video_id = $cat->cat_ID;
                    echo '<a class="mobile_menu_entry" id="mobile_menu_entry_video" onclick="videoroll();">Video</a>' . "\n";
                    $shown[] = $cat->cat_ID;
                }
            }
            /*  Output the rest of the categories
                Output looks like:
                    <a class="mobile_menu_entry" id="mobile_menu_entry_text" href="text">Text</a>
            */
            foreach ($categories as $cat) {
                if (!in_array($cat->cat_ID, $shown) && ($cat->name != "Uncategorized") && ($cat->parent != $video_id)) {
                    echo "\t\t\t" . '<a class="mobile_menu_entry mobile_menu_entry_sk" id="mobile_menu_entry_' . strtolower($cat->name) . '_sk" href="' . get_category_link($cat->cat_ID) . '">' . $cat->name . '</a>' . "\n";
                    echo "\t\t\t" . '<a class="mobile_menu_entry mobile_menu_entry_en" id="mobile_menu_entry_' . strtolower($cat->description) . '_en" href="' . get_category_link($cat->cat_ID) . '">' . $cat->description . '</a>' . "\n";
                    $shown[] = $cat->cat_ID;
                }
            }
         ?>
         <img id="mobile_menu_entry_search" src="<?php bloginfo('template_directory'); ?>/assets/images/white.png">
         <!-- no such functionality
         <img id="menu_entry_search" src="assets/images/lupa_icon_bk.png">
         -->
         <a class="mobile_menu_entry" id="mobile_lang_sk_switch" onclick="switch_lang('sk', true);">SK</a>
         <a class="mobile_menu_entry" id="mobile_lang_en_switch" onclick="switch_lang('en', true);">EN</a>
     </div>
     <div id="mobile_logo_container">
         <a href="/"><img id="mobile_logo_icon" src="<?php bloginfo('template_directory'); ?>/assets/images/logo/5.png"></a>
     </div>
     <div id="mobile_video_menu">
         <?php
             /* Output children of Video
                Output looks like:
                 <a class="mobile_menu_entry" id="mobile_menu_entry_profile_sk" href="profile">Profily</a>
                 <a class="mobile_menu_entry" id="mobile_menu_entry_profile_en" href="profile">Profiles</a>
                 <a class="mobile_menu_entry" id="mobile_menu_entry_report_sk" href="report">Reporty</a>
                 <a class="mobile_menu_entry" id="mobile_menu_entry_report_en" href="report">Reports</a>
             */
             foreach ($categories as $cat) {
                 if ($cat->parent == $video_id) {
                     echo "\t\t\t" . '<a class="mobile_menu_entry mobile_menu_entry_sk" id="mobile_menu_entry_' . strtolower($cat->name) . '_sk" href="' . get_category_link($cat->cat_ID) . '">' . $cat->name . '</a>' . "\n";
                     echo "\t\t\t" . '<a class="mobile_menu_entry mobile_menu_entry_en" id="mobile_menu_entry_' . strtolower($cat->description) . '_en" href="' . get_category_link($cat->cat_ID) . '">' . $cat->description . '</a>' . "\n";
                 }
             }
         ?>
     </div>
 </div>
 <!-- nav panels end -->
