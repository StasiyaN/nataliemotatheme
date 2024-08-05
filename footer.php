
            <div id="footer">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                ) );
                ?>
            </div>


            <!-- CREATION DU LIGHTBOX STUCTURE -->
                    <div class="lightbox">
                            <span class="lightbox-close"><i class="fa-solid fa-xmark"></i></span>
                            <span class="lightbox-next"><p>Suivant</p><i class="fa-solid fa-arrow-right-long"></i></span>
                            <span class="lightbox-prev"><i class="fa-solid fa-arrow-left-long"></i><p>Précédent</p></span>
                                <div class="lightbox-container">
                                <!-- <img class="lightbox-image" src="" alt=""> -->
                                <img src="<?php echo get_template_directory_uri() . ('/assets/img/test.jpg'); ?>" alt="" class="">
                                    <div class="lightbox-info">
                                        <div id="lightbox-ref" class="lightbox-ref">refernce</div>
                                        <div id="lightbox-cat" class="lightbox-cat">categorie</div>
                                    </div>
                                </div>
                    </div>




        <?php wp_footer(); ?>
    </body>
</html>