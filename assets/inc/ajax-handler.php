<?php
function filter_photos_ajax_handler() {
    // Check the nonce for security
    check_ajax_referer('nm-nonce', 'security');

    // Retrieve the parameters
    $categorie = isset($_POST['categorie']) ? sanitize_text_field($_POST['categorie']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $sort = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : '';
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

    // Set up the query arguments
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8, // Number of photos per page
        'offset' => $offset,
        'meta_query' => array(),
        'tax_query' => array('relation' => 'AND')
    );

    if (!empty($categorie)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $categorie,
        );
    }

    if (!empty($format)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $format,
        );
    }

    if (!empty($sort)) {
        $args['orderby'] = 'date';
        $args['order'] = $sort;
    }

    $query = new WP_Query($args);

    $photos = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $photos[] = array(
                'src' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
                'title' => get_the_title(),
                'ref' => get_post_meta(get_the_ID(), 'reference', true),
                'categorie' => wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names')),
                'url' => get_permalink()
            );
        }
        wp_send_json_success(array('photos' => $photos));
    } else {
        wp_send_json_error(array('message' => 'No photos found.'));
    }

    wp_die();
}

add_action('wp_ajax_filter_photos', 'filter_photos_ajax_handler');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_ajax_handler');

function load_related_photos_ajax_handler() {
    // Check the nonce for security
    check_ajax_referer('nm-nonce', 'security');

    $main_photo_id = isset($_POST['main_photo_id']) ? intval($_POST['main_photo_id']) : 0;

    if ($main_photo_id) {
        // Fetch the terms of the custom taxonomy 'categorie'
        $categorie_terms = get_the_terms($main_photo_id, 'categorie');
        if ($categorie_terms && !is_wp_error($categorie_terms)) {
            $categorie_ids = array();
            foreach ($categorie_terms as $term) {
                $categorie_ids[] = $term->term_id;
            }

            // Query for related posts
            $related_args = array(
                'post_type' => 'photo',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie',
                        'field'    => 'term_id',
                        'terms'    => $categorie_ids,
                    ),
                ),
                'post__not_in' => array($main_photo_id),
                'posts_per_page' => 2,
            );

            $related_query = new WP_Query($related_args);
            $related_photos = array();

            if ($related_query->have_posts()) {
                while ($related_query->have_posts()) {
                    $related_query->the_post();
                    $related_photos[] = array(
                        'src' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
                        'title' => get_the_title(),
                        'ref' => get_post_meta(get_the_ID(), 'reference', true),
                        'categorie' => wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names')),
                        'url' => get_permalink()
                    );
                }
                wp_send_json_success(array('related_photos' => $related_photos));
            } else {
                wp_send_json_error(array('message' => 'No related photos found.'));
            }

            wp_reset_postdata();
        } else {
            wp_send_json_error(array('message' => 'No categories found.'));
        }
    } else {
        wp_send_json_error(array('message' => 'Invalid main photo ID.'));
    }

    wp_die();
}

add_action('wp_ajax_load_related_photos', 'load_related_photos_ajax_handler');
add_action('wp_ajax_nopriv_load_related_photos', 'load_related_photos_ajax_handler');

// Fetch all photos handler
function fetch_all_photos_ajax_handler() {
    // Check nonce
    check_ajax_referer('nm-nonce', 'security');

    // Query arguments to fetch all photos
    $args_allphotos = array(
        'post_type' => 'photo',
        'posts_per_page' => -1, // Fetch all posts
    );

    $query_allphotos = new WP_Query($args_allphotos);
    $all_photos = array();

    if ($query_allphotos->have_posts()) {
        while ($query_allphotos->have_posts()) {
            $query_allphotos->the_post();
            $all_photos[] = array(
                'src' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
                'title' => get_the_title(),
                'ref' => get_post_meta(get_the_ID(), 'reference', true),
                'categorie' => wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names')),
                'url' => get_permalink()
            );
        }
        wp_send_json_success(array('all_photos' => $all_photos));
    } else {
        wp_send_json_error(array('message' => 'couldn\'t load all photos'));
    }

    wp_die();
}

add_action('wp_ajax_fetch_all_photos', 'fetch_all_photos_ajax_handler');
add_action('wp_ajax_nopriv_fetch_all_photos', 'fetch_all_photos_ajax_handler');

?>
