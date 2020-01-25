<?php
/**
 * The template pagination snippet
 *
 * All You Can template for Artyoucaneat.sk
 *
 * Learn more: {@link https://comms.gnd.sk}
 *
 * @package WordPress
 * @subpackage All You Can
 * @since 2018
 */

// pagination
$pagination_string = get_the_posts_pagination(array('screen_reader_text' => ' ','next_text' => '>>','prev_text' => '<<'));
?>
<div id="pagination_container">
    <!-- HIDDEN FOR NOW - need to fix the mobile version first
    <?php echo $pagination_string; ?>
    -->
</div>
