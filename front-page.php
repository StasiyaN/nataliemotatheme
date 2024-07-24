<?php
get_header(); 
?>
<div class="page-content">
    <div class="hero-header">
        <h1>PHOTOGRAPHE EVENT</h1>
    </div>
    <div class="page-body">
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
                        <?php the_post_thumbnail('photo-thumbnail'); ?>
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