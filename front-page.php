<?php get_header(); ?>

<div class="page-content">
   <div class="banner">
    <?php echo do_shortcode('[random_hero_image]'); ?>
    </div>

    <div class="gallery">
    <?php get_template_part( 'template-parts/photo-gallery' );?>
    </div>


<?php get_footer(); ?>