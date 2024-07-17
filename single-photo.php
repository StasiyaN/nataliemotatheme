<?php get_header(); ?>
<div class="single-content">

<?php
if ( have_posts() ) : 
    while ( have_posts() ) : 
        the_post(); 
        
        // Get the terms of the 'formats' taxonomy
        $terms = get_the_terms( get_the_ID(), 'formats' );
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

        <div class="photo-card <?php echo esc_attr($format_class); ?>">
            <h2><?php the_title(); ?></h2>

            <div class="photo-details">
                <p class="ref">Reference : <?php echo esc_html( get_field('reference') ); ?></p>
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

            <div class="photo-image">
                <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                } ?>
            </div>

            <div class="photo-contact">
                <p class="photo-text">Cette photo vous intéresse ?</p>
                <button id="contact-button" data-photo-ref="<?php echo esc_attr( get_field('reference') ); ?>">Contact</button>
            </div>

        </div>

        <?php 
    endwhile; 
endif; 
?>

</div>

<?php get_footer(); ?>
