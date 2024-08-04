<?php
add_action('wp_ajax_load_photos', 'load_photos');
add_action('wp_ajax_nopriv_load_photos', 'load_photos');

function load_photos() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nm-nonce')) {
        wp_send_json_error(array('message' => 'Invalid nonce.'));
        wp_die();
    }

    // Sanitize and validate input
    $categorie = isset($_POST['categorie']) ? sanitize_text_field($_POST['categorie']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $year = isset($_POST['year']) ? sanitize_text_field($_POST['year']) : '';
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

    // Set up query arguments
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'offset' => $offset,
        'orderby' => 'date',
        'order' => $year === 'ASC' ? 'ASC' : 'DESC',
        'tax_query' => array(
            'relation' => 'AND',
        ),
    );

    // Add category filter if provided
    if ($categorie) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $categorie,
        );
    }

    // Add format filter if provided
    if ($format) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    // Perform the query
    $query = new WP_Query($args);

    // Prepare the response
    $response = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $categories = wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names'));
            $photo_reference = get_post_meta(get_the_ID(), 'photo_reference', true); // Fetch custom field
            $response[] = array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'photo-thumbnail'),
                'categorie' => implode(', ', $categories), 
                'reference ' => $photo_reference
              
            );
        }
        wp_send_json_success($response);
    } else {
        wp_send_json_error(array('message' => 'No photos found.'));
    }

    wp_reset_postdata();
    wp_die();
}
