<?php




// MENUS
add_action('after_setup_theme', function() {
    // Creation des massives avec les parametres pour les add_theme_support
    $nmLogo = [
        'height' => 14,
        'width' => 216,
        'flex-height' => false,
        'flex-width' => false,
    ];

    // add_theme_support('admin-bar'); // conflict with C:\xampp\htdocs\NathalieMota\wp-includes\class-wp-admin-bar.php on line 63
    add_theme_support('custom-background');
    add_theme_support('custom-header');
    add_theme_support('menus');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', $nmLogo);
});



