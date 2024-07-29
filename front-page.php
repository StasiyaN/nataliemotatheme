<?php get_header();?>

<div class="page-content">
    <!-- custom wp_query function pour recuperer les parametres des photos en aleatoire -->
    <?php 
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'orderby' => 'rand'
    );
    
    $banner_image_query = new WP_Query($args);

    if ($banner_image_query->have_posts()) {
        while ($banner_image_query->have_posts()) {
            $banner_image_query->the_post();
            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'banner');
        }
        wp_reset_postdata();
    }
    ?>

    <div class="banner">
        <img src="<?php echo esc_url($image_url); ?>" alt="banniere du site" class="banner-img">
        <h1>PHOTOGRAPHE EVENT</h1> 
    </div> 
</div>

    
 <?php get_footer();?>