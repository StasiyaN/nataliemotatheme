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
                            the_post_thumbnail( 'single-page-photo' ); 
                        }
                        ?>
                    </div>
                </div>

                <div class="contact-block">
                    <p class="photo-text">Cette photo vous intéresse ?</p>
                    <button id="single-page-button" data-photo-ref="<?php echo esc_attr( get_field('reference') ); ?>">Contact</button>
                    
                    <div class="navigation-arrows">
                              <?php
                                $prev_post = get_previous_post();
                                if (!empty($prev_post)) : ?>
                                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/arrow-left.png';?>" alt="Previous post" class="arrows arrow-left">
                                    </a>
                                <?php endif; ?>

                                <?php
                                $next_post = get_next_post();
                                if (!empty($next_post)) : ?>
                                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/arrow-right.png';?>" alt="Next post" class="arrows arrow-right">
                                    </a>
                                <?php endif; ?>
                             
                    </div>
                </div>
                <h3>Vous aimerez aussi</h3>
                <div class="other-photos">
                   
                    
                    <?php
                    // Fetch the terms of the custom taxonomy 'categorie'
                    $categorie_terms = get_the_terms( get_the_ID(), 'categorie' );
                    if ( $categorie_terms && ! is_wp_error( $categorie_terms ) ) {
                        $categorie_ids = array();
                        foreach ( $categorie_terms as $term ) {
                            $categorie_ids[] = $term->term_id;
                        }

                        // Query for related posts
                        $related_args = array(
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'categorie',
                                    'field'    => 'term_id',
                                    'terms'    => $categorie_ids,
                                ),
                            ),
                            'post__not_in' => array( get_the_ID() ),
                            'posts_per_page' => 2,
                            'ignore_sticky_posts' => 1,
                        );

                        $related_query = new WP_Query( $related_args );

                        if ( $related_query->have_posts() ) {
                            while ( $related_query->have_posts() ) {
                                $related_query->the_post();
                                ?>
                                <div class="related-photo">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('photo-thumbnail'); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p>No related photos found.</p>';
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<p>No related photos found.</p>';
                    }
                    ?>
                </div>

            <?php 
            endwhile; 
        endif; 
        ?>
    </div>
</div>

<?php get_footer(); ?>
