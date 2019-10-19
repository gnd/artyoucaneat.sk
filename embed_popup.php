<!-- video embed popup -->

<div id="embed_container_bg"></div>
<div id="embed_container">
    <div id="embed_container_left">
        <?php echo $video_share_embed; ?>
    </div>
    <div id="embed_container_right">
        <div id="embed_container_right_header">
            <img class="embed_icon" src="<?php bloginfo('template_directory'); ?>/assets/images/x.png" onclick="hide_embed();">
        </div>
        <div id="embed_container_right_content">
            <span id="embed_sk">Skopírujte nasledovný kód: </span>
            <span id="embed_en">Copy the following code: </span>
            <br/>
            <span id="embed_code">
                <?php echo htmlentities($video_share_embed); ?>
            </span>
            <br/>
            <br/>
            <span id="embed_sk_close" onclick="hide_embed();">Zavrieť</span>
            <span id="embed_en_close" onclick="hide_embed();">Close</span>
        </div>
    </div>
</div>
