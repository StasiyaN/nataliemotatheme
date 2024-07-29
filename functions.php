<?php

//styles & scripts
function nataliemota_enqueue_scripts() {
    wp_enqueue_style('nataliemota-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0', 'all');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), null);
  //  wp_enqueue_style('normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css');
	wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js');
	//wp_enqueue_script('test-script', get_template_directory_uri() . '/assets/js/test.js');
    wp_enqueue_script('ajax-handler', get_template_directory_uri() . '/assets/js/ajax-handler.js', array('jquery'), null, true);
    wp_localize_script('ajax-handler', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));

    //wp_enqueue_script('script1', get_template_directory_uri() . '/assets/js/burger-menu.js');
    //wp_enqueue_script('script2', get_template_directory_uri() . '/assets/js/popup.js');

}
add_action('wp_enqueue_scripts', 'nataliemota_enqueue_scripts');

// getting rid of other styles
// function remove_wp_block_library_css(){
//     wp_dequeue_style('wp-block-library');
//     wp_dequeue_style('wp-block-library-theme');
//     wp_dequeue_style('wc-block-style'); // If using WooCommerce and its blocks
// }
// add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);



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

function disable_wp_emoji() {
    // Remove the emoji script
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    // Remove emojis from the TinyMCE editor
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');

    // Remove the emoji script from the frontend
    remove_action('wp_head', 'print_emoji_script');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Remove the emoji DNS prefetch
    remove_action('wp_head', 'wp_resource_hints', 2, 99);
}
add_action('init', 'disable_wp_emoji');

function disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    }
    return array();
}

function remove_wp_presets_css() {
    // Remove the inline style tag with wp-presets
    remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles_render_block');
}
add_action('wp_enqueue_scripts', 'remove_wp_presets_css', 20);

function remove_wp_presets_inline_styles($buffer) {
    $buffer = preg_replace('/<style id=\'global-styles-inline-css\'[^>]*>.*?<\/style>/is', '', $buffer);
    return $buffer;
}

function buffer_start() { ob_start('remove_wp_presets_inline_styles'); }
function buffer_end() { ob_end_flush(); }

add_action('wp_head', 'buffer_start', 1);
add_action('wp_footer', 'buffer_end', 100);




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

// formats photos
function custom_image_sizes () {
    add_image_size('single-page-photo', 563, 844, true);
    add_image_size ('miniature', 81, 71, true);
    add_image_size ('photo-thumbnail', 546, 495, true);
}

add_action( 'after_setup_theme', 'custom_image_sizes' );

