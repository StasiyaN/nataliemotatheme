<?php
get_header();

while (have_posts()) :
    the_post();
    the_title();

    echo "<br>";

endwhile;


get_footer();