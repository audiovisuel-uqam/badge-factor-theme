<?php use Roots\Sage\Extras; ?>


<footer class="footer-main">
    <div class="container">
        <div class="footer-main-wrap">

            <?php dynamic_sidebar('sidebar-footer-column-1'); ?>

            <?php dynamic_sidebar('sidebar-footer-column-2'); ?>

            <?php dynamic_sidebar('sidebar-footer-column-3'); ?>

            <?php dynamic_sidebar('sidebar-footer-column-4'); ?>

        </div>
        <div class="footer-bottom-wrap">
            <div class="footer-copyright-wrap">
                <p class="footer-copyright-content-text">Tous droits réservés © 2016  <?php //echo Extras\site_brand(); ?></p>
            </div>
            <div class="footer-navigation-wrap">
                <nav class="footer-navigation">
                    <ul class="footer-navigation-list">
                        <?php
                            if (has_nav_menu('footer_navigation')) {
                                wp_nav_menu( array(
                                        'theme_location'    => 'footer_navigation',
                                        'depth'             => 1,
                                        'container'         => false,
                                        'items_wrap'        => '%3$s',
                                        'fallback_cb' => false,
                                        'walker' => new Footer_Walker(),
                                        'item_class' => 'footer-navigation-list-item',
                                        'link_class' => 'footer-navigation-link',
                                    )
                                );
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</footer>
