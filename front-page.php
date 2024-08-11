<?php get_header(); ?>

<div class="page-content">
    <div class="banner">
        <?php echo do_shortcode('[random_hero_image]'); ?>
    </div>

    <div class="gallery">
        <div class="filter-wrapper">
            <form id="filter-form">
                <label for="categorie"></label>
                <select id="categorie" name="categorie" class ="dropdown-box">
                    <option value="">Catégories</option>
                    <?php
                    $categories = get_terms('categorie');
                    foreach ($categories as $categorie) {
                        echo '<option value="' . esc_attr($categorie->slug) . '">' . esc_html($categorie->name) . '</option>';
                    }
                    ?>
                </select>

                <label for="format"></label>
                <select id="format" name="format" class ="dropdown-box">
                    <option value="">Formats</option>
                    <?php
                    $formats = get_terms('format'); 
                    foreach ($formats as $format) {
                        echo '<option value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</option>';
                    }
                    ?>
                </select>

                <label for="sort"></label>
                <select id="sort" name="sort" class ="dropdown-box">
                    <option value="">Trier par</option>
                    <option value="desc">à partir des plus récentes</option>
                    <option value="asc">à partir des plus anciennes</option>
                </select>
            </form>

            </div>
        <?php get_template_part( 'template-parts/photo-gallery');?>
        <button id="load-more" class = "btn">Charger plus</button>
    </div>
</div>

<?php get_footer(); ?>
