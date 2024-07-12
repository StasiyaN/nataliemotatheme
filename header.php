<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav id="main">
    <div class="primary-menu-wrapper">
        <div class="logo">
            <?php
                the_custom_logo();
            ?>
        </div>
            <div class="nav">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                ) ); 
                ?>
            </div>
    </div>
</nav>



