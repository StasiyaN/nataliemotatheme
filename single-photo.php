<?php get_header(); ?>
<div class="single-photo">
    <div class="single-photo-content">
        <?php
        if ( have_posts() ) : 
            while ( have_posts() ) : 
                the_post(); 
                
                // Get the terms of the 'formats' taxonomy
                $terms = get_the_terms( get_the_ID(), 'format' );
                $format_class = '';
        
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                    foreach ( $terms as $term ) {
                        if ( $term->slug == 'paysage' ) {
                            $format_class = 'paysage';
                        } elseif ( $term->slug == 'portrait' ) {
                            $format_class = 'portrait';
                        }
                    }
                }
                ?>

                <div class="info-photo-block">
                    <div class="info-block">
                        <div class="photo-details">
                            <h2 id="photo-title"><?php the_title(); ?></h2>
                            <p class="ref">Référence : <?php echo esc_html( get_field('reference') ); ?></p>
                            <p>Format : 
                                <?php
                                    // Get the terms associated with the 'formats' taxonomy
                                    if ( $terms && ! is_wp_error( $terms ) ) {
                                        $format_names = array();
                                        foreach ( $terms as $term ) {
                                            $format_names[] = esc_html( $term->name );
                                        }
                                        echo implode(', ', $format_names);
                                    } else {
                                        echo 'No format';
                                    }
                                ?>
                            </p>
                            <p>Type : <?php echo esc_html( get_field('type') ); ?></p>
                            <p>Année : <?php echo esc_html( get_field('annee') ); ?></p>
                        </div>
                    </div>

                        <div class="photo-block">
                        <?php
                            // Display the custom image size for the post thumbnail
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'portrait' ); 
                            }
                            ?>
                        </div>
                    </div>

                    <div class="contact-block">
                        <p class="photo-text">Cette photo vous intéresse ?</p>
                        <button id="contact-button" data-photo-ref="<?php echo esc_attr( get_field('reference') ); ?>">Contact</button>
                            <div class="image-preview">
                                
                            </div>
                                <div class="navigation-arrows">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/arrow-left.png';?>" alt="" class="arrows arrow-left">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/arrow-right.png';?>" alt="" class="arrows arrow-right">
                                </div>
                    </div>
                </div>

                

                <?php 
            endwhile; 
        else :
            echo '<p>No posts found</p>';
        endif; 
        ?>
    </div>
</div>

<?php get_footer(); ?>
