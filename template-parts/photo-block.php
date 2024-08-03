
<div class="single-image">
    <a href="<?php echo get_permalink(); ?>">
    <img src="<?php the_post_thumbnail_url('photo-thumbnail'); ?>" alt="<?php the_title(); ?>">
    <p><?php the_title(); ?></p>

    <span class="image-category">
            <?php
                $terms = wp_get_post_terms( get_the_ID(), 'categorie' ); 
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                    echo $terms[0]->name;
                }
            ?>
        </span>
</div>
