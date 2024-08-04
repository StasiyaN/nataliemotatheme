
<div class="single-image">
    <a href="<?php echo get_permalink(); ?>">
        <img src="<?php the_post_thumbnail_url('photo-thumbnail'); ?>" alt="<?php the_title(); ?>">
            <div class="hover-effect">
                <span class ="image-title "><?php the_title(); ?></span> 
                    <span class="image-category">
                            <?php
                                $terms = wp_get_post_terms( get_the_ID(), 'categorie' ); 
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    echo $terms[0]->name;
                                }
                            ?>
                        </span>
                        <span class="icon-eye"><i class="fas fa-eye"></i></span>
                            <span class="show-full"><i class="fa-solid fa-expand"></i></span>
            </div>
</div>
