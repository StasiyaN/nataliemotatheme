<?php

//styles & scripts
function nataliemota_enqueue_scripts() {
    wp_enqueue_style('nataliemota-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0', 'all');
//fonction exprès wp pour garder le bon fonctionnement de la réponse sur une commentraire
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('commenrt-reply');
    }
}

add_action('wp_enqueue_scripts', 'nataliemota_enqueue_scripts');


// MENUS
add_action('after_setup_theme', function() {
 // Creation of arrays with parameters for add_theme_support
  

    // add_theme_support('admin-bar'); // conflict with C:\xampp\htdocs\NathalieMota\wp-includes\class-wp-admin-bar.php on line 63
    add_theme_support('custom-background');
    add_theme_support('custom-header');
    add_theme_support('menus');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');

    // enregistrement des menus de nav
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'nataliemota' ),
        'footer' => __( 'Footer Menu', 'nataliemota' ),
    ) );

});


