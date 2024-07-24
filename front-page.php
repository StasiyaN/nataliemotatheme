<?php
get_header(); 
?>
<div class="page-content">
    <div class="hero-header">
        <h1>PHOTOGRAPHE EVENT</h1>
    </div>
    <div class="page-body">
        <div class="filters">
            <label for="categorie"></label>
                <select id="categorie" name="categorie">
                    <option value="">Catégories</option>
                    <?php
                    $categories = get_terms('categories'); // Adjust taxonomy name if needed
                    foreach ($categories as $category) {
                        echo '<option value="' . esc_attr($categorie->slug) . '">' . esc_html($catgorie->name) . '</option>';
                    }
                    ?>
                </select>
            <label for="format"></label>
                <select id="format" name="format">
                    <option value="">Formats</option>
                    <?php
                    $formats = get_terms('formats'); // Adjust taxonomy name if needed
                    foreach ($formats as $format) {
                        echo '<option value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</option>';
                    }
                    ?>
                </select>
                <label for="sort"></label>
                    <select id="sort" name="sort">
                        <option value="desc">Trier par</option>
                        <option value="desc">Plus récentes</option>
                        <option value="asc">Plus anciennes</option>
                    </select>

        </div>

        <?php
        // Define WP Query parameters
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 8,
        );
        
        // Execute WP Query
        $front_page_query = new WP_Query($args);

        // Loop through posts
        if ($front_page_query->have_posts()) : 
            while ($front_page_query->have_posts()) : 
                $front_page_query->the_post(); 
        ?>
                
                    <div class="photo-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('photo-thumbnail'); ?>
                    </a>

                    </div>
               
        <?php 
            endwhile; 
        else : 
        ?>
            <p><?php _e('No posts found.', 'text-domain'); ?></p>
        <?php 
        endif;

        // Reset post data to the main query
        wp_reset_postdata();
        ?>
    </div>
</div>
<?php
get_footer();
?>