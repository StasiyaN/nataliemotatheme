<?php wp_footer(); ?>
    <div id="footer-menu">
    <?php
        wp_nav_menu( array(
            'theme_location' => 'footer',
            'menu_id'        => 'footer-menu',
        ) );
        ?>
    </div>
</body>
</html>