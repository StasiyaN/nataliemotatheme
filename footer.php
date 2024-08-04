
            <div id="footer">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                ) );
                ?>
            </div>
            <!-- CREATION DU LIGHTBOX STUCTURE -->
                    <div id="lightbox-overlay" class="lightbox-overlay">
                        <div class="lightbox-content">
                            <span id="lightbox-close" class="lightbox-close"><i class="fa-solid fa-xmark"></i></span>
                                <img id="lightbox-image" class="lightbox-image" src="" alt="">
                                <div class="lightbox-info">
                                    <div id="lightbox-ref" class="lightbox-ref"></div>
                                    <div id="lightbox-cat" class="lightbox-cat"></div>
                                    <snap id="lightbox-prev" class="lightbox-nav"><i class="fa-solid fa-arrow-left-long"></i>Précédent</span>
                                    <span id="lightbox-next" class="lightbox-nav">Suivant<i class="fa-solid fa-arrow-right-long"></i></span>
                                </div>
                        </div>
                    </div>




        <?php wp_footer(); ?>
    </body>
</html>