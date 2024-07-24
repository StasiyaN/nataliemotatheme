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
                            foreach ($categories as $categorie) {
                                echo '<option value="' . esc_attr($categorie->slug) . '">' . esc_html($categorie->name) . '</option>';
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

                    <div class="photo-container">
                                            <!-- Photos will be loaded here -->
                    </div>
                    
                        <button id="load-more">Charger plus</button>
        <div>
</div>


<?php
get_footer();
?>