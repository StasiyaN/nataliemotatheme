<?php get_header(); ?>

<div class="page-content">
    <div class="banner">
        <?php echo do_shortcode('[random_hero_image]'); ?>
    </div>

    <div class="gallery">
        <div class="filters">
            <form id="filter-form">
                <label for="categorie">Catégories</label>
                <select id="categorie" name="categorie">
                    <option value="">Toutes les catégories</option>
                    <?php
                    $categories = get_terms('categorie'); // Adjust taxonomy name if needed
                    foreach ($categories as $categorie) {
                        echo '<option value="' . esc_attr($categorie->slug) . '">' . esc_html($categorie->name) . '</option>';
                    }
                    ?>
                </select>

                <label for="format">Formats</label>
                <select id="format" name="format">
                    <option value="">Tous les formats</option>
                    <?php
                    $formats = get_terms('format'); // Adjust taxonomy name if needed
                    foreach ($formats as $format) {
                        echo '<option value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</option>';
                    }
                    ?>
                </select>

                <label for="sort">Trier par</label>
                <select id="sort" name="sort">
                    <option value="desc">Plus récentes</option>
                    <option value="asc">Plus anciennes</option>
                </select>
            </form>

            </div>
        <?php get_template_part( 'template-parts/photo-gallery');?>
        <button id="load-more">Load more</button>
    </div>
</div>

<?php get_footer(); ?>
