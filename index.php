<?php
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
get_template_part( 'home-page' ); //PAS SUR DU TOUT

endwhile; endif;

get_footer();