<div class="filter-forms">
    <form id="filter-form">
        <section class="categorie">
            <label for="categorie"></label>
            <select id="categorie" name="categorie">
                <option value="">Categorie</option>
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
            <label for="format">Format:</label>
            <select id="format" name="format">
                <option value="">Select Format</option>
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

        <section class="year">
            <label for="year"></label>
            <select id="year" name="year">
                <option value="">Sort By</option>
                <option value="DESC">Newest First</option>
                <option value="ASC">Oldest First</option>
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
class ="btn" > Load More</button>

