<?php
    $query = esc_html(get_search_query());
?>

<form role="search" method="get" id="searchform" action="/search/">
        <input type="text" value="<?php echo $query; ?>" name="s" id="s" />
        <!--<input type="submit" id="searchsubmit" value="OK" />-->
</form>
