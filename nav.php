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

 <!-- nav panel desktop -->
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
                // TODO - remove shown and make this in one loop
                $top_categories = get_categories(array('orderby' => 'id','parent'  => 0));
                foreach ($top_categories as $top_cat) {
                    echo "\t\t\t" . '<a class="menu_entry menu_entry_top_sk" id="' . $top_cat->cat_ID . '_sk" onclick="cat_unroll('.$top_cat->cat_ID.');">' . $top_cat->name . '</a>' . "\n";
                    echo "\t\t\t" . '<a class="menu_entry menu_entry_top_en" id="' . $top_cat->cat_ID . '_en" onclick="cat_unroll('.$top_cat->cat_ID.');">' . $top_cat->description . '</a>' . "\n";
                    $shown[] = $top_cat->cat_ID;

                    // Get and output all children
                    $child_categories = get_categories(array('orderby' => 'name','parent'  => $top_cat->cat_ID, 'hide_empty' => false));
                    foreach ($child_categories as $child_cat) {
                        echo "\t\t\t" . '<a class="menu_entry_sk menu_entry childof_'.$top_cat->cat_ID.'_sk" id="' . $child_cat->cat_ID . '_sk" href="' . get_category_link($child_cat->cat_ID) . '">' . $child_cat->name . '</a>' . "\n";
                        echo "\t\t\t" . '<a class="menu_entry_en menu_entry childof_'.$top_cat->cat_ID.'_en" id="' . $child_cat->cat_ID . '_en" href="' . get_category_link($child_cat->cat_ID) . '">' . $child_cat->description . '</a>' . "\n";
                        $shown[] = $child_cat->cat_ID;
                    }
                }

                // Output the rest of the categories
                $categories = get_categories(array('hide_empty' => false));
                foreach ($categories as $cat) {
                    if (!in_array($cat->cat_ID, $shown) && ($cat->name != "Uncategorized")) {
                        echo "\t\t\t" . '<a class="menu_entry menu_entry_top_sk" id="' . $cat->cat_ID . '_sk" href="' . get_category_link($cat->cat_ID) . '">' . $cat->name . '</a>' . "\n";
                        echo "\t\t\t" . '<a class="menu_entry menu_entry_top_en" id="' . $cat->cat_ID . '_en" href="' . get_category_link($cat->cat_ID) . '">' . $cat->description . '</a>' . "\n";
                        $shown[] = $cat->cat_ID;
                    }
                }
             ?>
             <img class="menu_entry menu_entry_top" id="menu_entry_search" onclick="nav(/search/)" src="<?php bloginfo('template_directory'); ?>/assets/images/lupa_icon_bk.png">
             <a class="menu_entry menu_entry_top" id="lang_sk_switch" onclick="switch_lang('sk', true, <?php echo $category_id; ?>);">SK</a>
             <a class="menu_entry menu_entry_top" id="lang_en_switch" onclick="switch_lang('en', true, <?php echo $category_id; ?>);">EN</a>
             <br/>
            <a class="menu_entry_top" id="fb_link" href="https://www.facebook.com/artyoucaneat.sk/"><img style="width: 0.9vw; margin-left: -0.1vw; margin-top: 0.5vw;" src="<?php bloginfo('template_directory'); ?>/assets/images/fb.svg" /></a>
         </div>
     </div>
 </div>
 <div id="right_container">
     <div id="logo_container">
         <a href="/"><img id="logo_icon" src="<?php bloginfo('template_directory'); ?>/assets/images/logo/5.png"></a>
     </div>
 </div>

 <!-- nav panel mobile -->
 <!-- TODO deal with new top categories -->
 <!-- TODO deal with new child categories -->
 <div id="mobile_nav_container">
     <div id="mobile_icon_container">
         <img id="mobile_menu_icon" src="<?php bloginfo('template_directory'); ?>/assets/images/menu_icon_bk.png" onclick="menuroll();">
     </div>
     <div id="mobile_main_menu">
         <?php
            // Get and output all top-level categories
            // This might turn out as a problem if there are more categories in the future
            $top_categories = get_categories(array('orderby' => 'id','parent'  => 0, 'hide_empty' => false));
            foreach ($top_categories as $top_cat) {
                if ($top_cat->name != "Uncategorized") {
                    if (term_has_children($top_cat->cat_ID)) {
                        echo "\t\t\t" . '<a class="mobile_menu_entry mobile_menu_entry_top_sk" id="mobile_' . $top_cat->cat_ID . '_sk" onclick="cat_unroll('.$top_cat->cat_ID.');">' . $top_cat->name . '</a>' . "\n";
                        echo "\t\t\t" . '<a class="mobile_menu_entry mobile_menu_entry_top_en" id="mobile_' . $top_cat->cat_ID . '_en" onclick="cat_unroll('.$top_cat->cat_ID.');">' . $top_cat->description . '</a>' . "\n";
                    } else {
                        echo "\t\t\t" . '<a class="mobile_menu_entry mobile_menu_entry_top_sk" id="mobile_' . $top_cat->cat_ID . '_sk" href="' . get_category_link($top_cat->cat_ID) . '">' . $top_cat->name . '</a>' . "\n";
                        echo "\t\t\t" . '<a class="mobile_menu_entry mobile_menu_entry_top_en" id="mobile_' . $top_cat->cat_ID . '_en" href="' . get_category_link($top_cat->cat_ID) . '">' . $top_cat->description . '</a>' . "\n";
                    }
                }
            }
         ?>
         <img id="mobile_menu_entry_search" onclick="nav(/search/)" src="<?php bloginfo('template_directory'); ?>/assets/images/lupa_icon_bk.png">
         <a class="mobile_menu_entry_top" id="mobile_lang_sk_switch" onclick="switch_lang('sk', true, <?php echo $category_id; ?>);">SK</a>
         <a class="mobile_menu_entry_top" id="mobile_lang_en_switch" onclick="switch_lang('en', true, <?php echo $category_id; ?>);">EN</a>
     </div>
     <div id="mobile_logo_container">
         <a href="/"><img id="mobile_logo_icon" src="<?php bloginfo('template_directory'); ?>/assets/images/logo/5.png"></a>
     </div>

     <?php
     // Get and output all children
     foreach ($top_categories as $top_cat) {
         if (term_has_children($top_cat->cat_ID)) {
             echo '<div class="mobile_top_cat_menu" id="mobile_menu_' . $top_cat->cat_ID . '">';
             $child_categories = get_categories(array('orderby' => 'name','parent'  => $top_cat->cat_ID, 'hide_empty' => false));
             foreach ($child_categories as $child_cat) {
                 echo "\t\t\t" . '<a class="mobile_menu_entry_sk mobile_menu_entry mobile_childof_'.$top_cat->cat_ID.'_sk" id="mobile_' . $child_cat->cat_ID . '_sk" href="' . get_category_link($child_cat->cat_ID) . '">' . $child_cat->name . '</a>' . "\n";
                 echo "\t\t\t" . '<a class="mobile_menu_entry_en mobile_menu_entry mobile_childof_'.$top_cat->cat_ID.'_en" id="mobile_' . $child_cat->cat_ID . '_en" href="' . get_category_link($child_cat->cat_ID) . '">' . $child_cat->description . '</a>' . "\n";
             }
             echo "</div>";
         }
     }
     ?>

 </div>
 <!-- nav panels end -->
