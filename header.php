<!DOCTYPE html>
    <html <?php language_attributes(); ?>>
        <head>
            <meta charset="<?php bloginfo( 'charset' ); ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <?php wp_head(); ?>
        </head>

            <body <?php body_class(); ?>>
                <?php wp_body_open(); ?>
                    <nav id="main">
                        <div class="primary-menu-wrapper">
                            <div class="logo">
                                <?php the_custom_logo();?>
                            </div>
                                <div class="burger-menu">
                                    <span></span>
                                </div>
                                    <div class="nav">
                                        <?php
                                        wp_nav_menu(array(
                                            'theme_location' => 'primary',
                                            'menu_id' => 'primary-menu',
                                        ));
                                        ?>
                                        <div class="contact-btn">
                                            <p id="contactBtn">contact</p>
                                        </div>
                                    </div>
                        </div>
                    </nav>
            <?php get_template_part('/template-parts/contact-popup'); ?>
