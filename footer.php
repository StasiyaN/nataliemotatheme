
    <div id="footer">
        <span class="divider"></span>
    <?php
        wp_nav_menu( array(
            'theme_location' => 'footer',
            'menu_id'        => 'footer-menu',
        ) );
        ?>
    </div>
    <?php wp_footer(); ?>
</body>
</html>