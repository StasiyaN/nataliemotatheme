<div class="filter-wrapper">
    <form id="filter-form">
        <section class="categorie">
            <label for="categorie"></label>
            <select id="categorie" name="categorie" class = "dropdown-box">
                <option value="">Catégorie</option>
                <?php 
                $categories = get_terms(array(
                    'taxonomy' => 'categorie',
                    'hide_empty' => false,
                ));
                foreach ($categories as $cat) {
                    echo '<option value="' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</option>';
                }
                ?>
            </select>
        </section>

        <section class="format">
            <label for="format"></label>
            <select id="format" name="format" class = "dropdown-box">
                <option value="">Format</option>
                <?php 
                $formats = get_terms(array(
                    'taxonomy' => 'format',
                    'hide_empty' => false,
                ));
                foreach ($formats as $format) {
                    echo '<option value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</option>';
                }
                ?>
            </select>
        </section>

        <section class="sort">
            <label for="year"></label>
            <select id="year" name="year" class = "dropdown-box">
                <option value="">Trier par</option>
                <option value="DESC">à partir des plus récentes</option>
                <option value="ASC">à partir des plus anciennes</option>
            </select>
        </section>
    </form>
</div>

<!-- Photo Container -->
<div id="photo-container">
    <!-- Photos will be loaded here -->



</div>

    <!-- Load More Button -->
    <button id="load-more" 
data-nonce="<?php echo wp_create_nonce('nm-nonce'); ?>"
data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>"
class ="btn" > Charger plus</button>

