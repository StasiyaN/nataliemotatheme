<?php
var_dump('ajax php ok');
//ajout d'un hook wp ajax
add_action('wp_ajax_filtre_load_photos', 'load_photos');
add_action('wp_ajax_nopriv_filtre_load_photos', 'load_photos');
//creation de la fonction load photos
function load_photos() {
    // Check if the nonce field is empty
    if ( empty($_POST['nonce'])) {
        wp_die('0');
    }

    // Check the nonce value for security
    if ( ! check_ajax_referer('natalie-mota-nonce', 'security', false)) {
        wp_die('error', 403);
    }
       // If nonce is valid, proceed with loading photos (add your code here)

}