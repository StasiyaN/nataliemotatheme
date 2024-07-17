<?php

//styles & scripts
function nataliemota_enqueue_scripts() {
    wp_enqueue_style('nataliemota-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0', 'all');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), null);
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js');
    //wp_enqueue_script('script1', get_template_directory_uri() . '/assets/js/burger-menu.js');
    //wp_enqueue_script('script2', get_template_directory_uri() . '/assets/js/popup.js');

}
add_action('wp_enqueue_scripts', 'nataliemota_enqueue_scripts');

// min styke css
function dequeue_wp_block_library_css() {
    wp_dequeue_style('wp-block-library');
    wp_deregister_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'dequeue_wp_block_library_css', 100);

function dequeue_admin_bar_css() {
    if (!is_admin()) {
        wp_dequeue_style('admin-bar');
        wp_deregister_style('admin-bar');
    }
}
add_action('wp_enqueue_scripts', 'dequeue_admin_bar_css', 100);

function remove_admin_bar() {
    if (!is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'remove_admin_bar');


// MENUS
add_action('after_setup_theme', function() {
    
    add_theme_support('menus');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // enregistrement des menus de nav
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'nataliemota' ),
        'footer' => __( 'Footer Menu', 'nataliemota' ),
    ) );

});


