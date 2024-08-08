
            <div id="footer">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                ) );
                ?>
            </div>


          <!-- lightbox -->
           
          <?php get_template_part( 'template-parts/lightbox');?>



        <?php wp_footer(); ?>
    </body>
</html>