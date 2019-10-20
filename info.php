<?php
/* Template Name: Infopage */

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
 $date = date("d.m.Y",strtotime($post->post_date));
 $current_title_sk = $post->post_title;
 $content_sk = $post->post_content;
 $current_title_en = types_render_field("en-title",  array("output" => "raw"));

 // Proces page title
 if ($_SESSION["lang"] == "sk") {
    $page_title = 'Art You Can Eat / ' . $current_title_sk;
 } else {
    $page_title = 'Art You Can Eat / ' . $current_title_en;
 }

 // Process content
 $content_sk = str_replace("<a href=", "<a class='text_link' href=", $content_sk);
 $content_en = str_replace("<a href=", "<a class='text_link' href=", $content_en);

 ?>

 <html>
 <head>
     <!-- START HEADER -->
     <?php require_once 'header.php'; ?>
 </head>
 <body>

<?php include "nav.php"; ?>

<!-- POST DATA START -->
<div id="main_container">
    <div id="center_container" class="single_video">
        <div id="content_container" class="cf single_video">
            <img id="info_logo" src="<?php bloginfo('template_directory'); ?>/assets/images/logo/3_big.jpg" />
            <div id="ordinary_text_info_sk">
                <p>
                    Art You Can Eat je nová platforma, ktorá chce formou videa mapovať a informovať o slovenskej výtvarnej scéne,
                    slovenských umelcoch, galériach a umeleckých iniciatívach. Súčasťou Art You Can Eat budú video profily a rozhovory s umelcami a umelkyňami,
                    reportáže z výstav a odborné a teoretické texty.
                </p>

                <br/><p style="margin-bottom: 0.5em;"><b>Redakcia</b></p>
                <span style="display: block; font-size: 0.8em; line-height: 1.3em;">
                    Peter Barényi (peter &#9965; artyoucaneat.sk)<br/>
                    Kata Mach (kata &#9965; artyoucaneat.sk)</br/>
                    Tomáš Storkie Kmeť (tomas &#9965; artyoucaneat.sk)
                </span><br/>

                <p style="margin-bottom: 0.5em;"><b>Kontakt</b></p>
                <span style="display: block; font-size: 0.8em; line-height: 1.3em;">
                    info &#9965; artyoucaneat.sk<br/>
                </span><br/>

                <p style="margin-bottom: 0.5em;"><b>Podporili nás</b></p>
                <p>Z verejných zdrojov podporil Fond na podporu umenia.</p>
                <div style="width: 100%;">
                    <img id="logo_bsk_sk" src="<?php bloginfo('template_directory'); ?>/assets/images/logo_bsk.jpg" />
                    <img id="logo_fpu_sk" src="<?php bloginfo('template_directory'); ?>/assets/images/logo_fpu_sk.svg" />
                </div>
            </div>
            <div id="ordinary_text_info_en">
                <p>
                    Art You Can Eat is a new platform which aims to map and inform about the Slovak contemporary art scene,
                    its artists, galleries and artistic initiatives in the form of video.
                    Art You Can Eat will publish video profiles and interviews with artists, reports from openings and exhibitions and theoretical texts.
                </p>

                <br/><p style="margin-bottom: 0.5em;"><b>Staff</b></p>
                <span style="display: block; font-size: 0.8em; line-height: 1.3em;">
                    Peter Barényi (peter &#9965; artyoucaneat.sk)<br/>
                    Kata Mach (kata &#9965; artyoucaneat.sk)</br/>
                    Tomáš Storkie Kmeť (tomas &#9965; artyoucaneat.sk)
                </span><br/>

                <p style="margin-bottom: 0.5em;"><b>Contact</b></p>
                <span style="display: block; font-size: 0.8em; line-height: 1.3em;">
                    info &#9965; artyoucaneat.sk<br/>
                </span><br/>

                <p style="margin-bottom: 0.5em;"><b>We are supported by</b></p>
                <p>Supported using public funding by Slovak Arts Council</p>
                <div style="width: 100%;">
                    <img id="logo_bsk_en" src="<?php bloginfo('template_directory'); ?>/assets/images/logo_bsk.jpg" />
                    <img id="logo_fpu_en" src="<?php bloginfo('template_directory'); ?>/assets/images/logo_fpu_en.jpg" />
                </div>
            </div>
        </div>
        <!-- POST DATA END -->

<!-- FOOTER STARTS HERE -->
<?php include "footer.php"; ?>

<!-- ADDITIONAL SCRIPTS -->
<?php include "footer-single-scripts.php"; ?>

</body>
</html>
