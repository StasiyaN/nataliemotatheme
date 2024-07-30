<?php
var_dump('ajax php ok');
//creation de la fonction de filtes 
// function filter_photos {
//         // Verify nonce
//         if (!wp_verify_nonce($_REQUEST['nonce'], 'ajax-nonce')) {
//             // If nonce verification fails, send an error response and terminate
//             wp_send_json_error(array('message' => 'Nonce verification failed'));
//             wp_die();
//         }
    
//     // Sanitize and retrieve data from the request
//     $categorie = sanitize_text_field($_POST['categorie']);
//     $format = sanitize_text_field($_POST['format']);
//     $sort = sanitize_text_field($_POST['sort']);
//     $offset = intval($_POST['offset']); // Ensure it's an integer
// }