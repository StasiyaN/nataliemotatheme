<?php get_header(); ?>

<div class="page-content">
    <div class="banner">
        <?php echo do_shortcode('[random_hero_image]'); ?>
    </div>

    <div class="gallery">
        <div class="custom-dropdown">
                <div class="dropdown">
                    <button id = "categorie" class="dropdown-btn filters" data-default="Catégories">Catégories
                    <!-- <span class="dropdown-arrow"></span> -->
                    </button>
                    <ul class="dropdown-list">
                        <li id="categorie" data-value="" class="dropdown-list-item">Catégories</li>
                        <?php
                            $categories = get_terms('categorie');
                            foreach ($categories as $categorie) {
                                echo '<li class="dropdown-list-item" data-value="' . esc_attr($categorie->slug) . '">' . esc_html($categorie->name) . '</li>';
                            }
                        ?>
                    </ul>
                    <input type="hidden" name="categorie" class="option-val">
                </div>
                    <div class="dropdown">
                        <button id = "format"class="dropdown-btn filters" data-default="Formats">Formats
                        <!-- <span class="dropdown-arrow"></span> -->
                        </button>
                        <ul class="dropdown-list">
                            <li id="format" data-value="" class="dropdown-list-item">Formats</li>
                            <?php
                                $formats = get_terms('format');
                                foreach ($formats as $format) {
                                    echo '<li class="dropdown-list-item" data-value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</li>';
                                }
                            ?>
                        </ul>
                        <input type="hidden" name="format" class="option-val">
                    </div>
                        <div class="dropdown">
                            <button class="dropdown-btn filters" data-default="Trier par">Trier par
                            <!-- <span class="dropdown-arrow"></span> -->
                            </button>
                            <ul class="dropdown-list">
                            <li class="dropdown-list-item" data-value="">Trier par</li>
                                <li class="dropdown-list-item" data-value="desc">à partir des plus récentes</li>
                                <li class="dropdown-list-item" data-value="asc">à partir des plus anciennes</li>
                            </ul>
                            <input type="hidden" name="sort" class="option-val">
                        </div>
                    </div>
                        <!-- <div class="no-photos-message">
                                <p>Aucune photo ne correspond à votre recherche</p>
                            </div> -->


                                <?php get_template_part( 'template-parts/photo-gallery');?>
                                    <button id="load-more" class = "btn">Charger plus</button>
    </div>
</div>

<?php get_footer(); ?>
