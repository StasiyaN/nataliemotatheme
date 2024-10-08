<?php
    // récupere les infos : image mise en avant(thumbnail_url), url du post, titre, categorie, réf
    $thumbnail_url = get_the_post_thumbnail_url();
    $post_url = get_permalink();
    $photo_reference = get_post_meta(get_the_ID(), 'reference', true);
    $categories = get_the_terms(get_the_ID(), 'categorie');
    // Fetch the terms of the custom taxonomy 'categorie'
    $categorie_terms = get_the_terms(get_the_ID(), 'categorie');
    if ($categorie_terms && !is_wp_error($categorie_terms)) {
        $categorie_ids = array();
        foreach ($categorie_terms as $term) {
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
            'post__not_in' => array(get_the_ID()),
            'posts_per_page' => 2,
        );

        $related_query = new WP_Query($related_args);
        
        if ($related_query->have_posts()) {
            while ($related_query->have_posts()) {
                $related_query->the_post(); ?>
                <div class="related-photo">
                <?php if ( has_post_thumbnail() ) { ?>
                    <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('photo-thumbnail'); ?>
                    </a>
                    <?php } ?>
                    </div>
                    <?php }
                    // End the related posts loop
                    wp_reset_postdata();
                } else {
                    echo '<p>No related photos found.</p>';
                }
            }
?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        