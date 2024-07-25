<?php
get_header(); 
?>
<div class="page-content">
<?php if ( get_header_image() ) : ?>
    <div class="custom-header" style="background-image: url('<?php echo esc_url( get_header_image() ); ?>');">

        <h1>PHOTOGRAPHE EVENT</h1> 

    </div> 
    <?php endif; ?>
        <div class="page-body">
            <div class="filters">
            <label for="categorie"></label>
                <select id="categorie" name="categorie">
                    <option value="">Catégories</option>
                    <?php
                    $categories = get_terms('categorie'); // Use the exact taxonomy name
                    if (is_wp_error($categories)) {
                        echo '<option value="">Error retrieving categories</option>';
                    } elseif (empty($categories)) {
                        echo '<option value="">No categories found</option>';
                    } else {
                        foreach ($categories as $categorie) {
                            echo '<option value="' . esc_attr($categorie->slug) . '">' . esc_html($categorie->name) . '</option>';
                        }
                    }
                    ?>
                </select>


                <label for="format"></label>
                <select id="format" name="format">
                    <option value="">Formats</option>
                    <?php
                    $formats = get_terms('format'); // Use the exact taxonomy name
                    if (is_wp_error($formats)) {
                        echo '<option value="">Error retrieving formats</option>';
                    } elseif (empty($formats)) {
                        echo '<option value="">No formats found</option>';
                    } else {
                        foreach ($formats as $format) {
                            echo '<option value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</option>';
                        }
                    }
                    ?>
                </select>

                <?php
                    $current_sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'desc';
                    ?>
                    <label for="sort"></label>
                    <select id="sort" name="sort">
                    <option value="">Trier par</option>

                        <option value="desc" <?php selected($current_sort, 'desc'); ?>>A partir des plus récentes</option>
                        <option value="asc" <?php selected($current_sort, 'asc'); ?>>A partir des plus anciennes</option>
                    </select>

                    <div class="photo-container">
                                            <!-- Photos will be loaded here -->
                    </div>
                    
                        <button id="load-more">Charger plus</button>
        <div>
</div>


<?php
get_footer();
?>