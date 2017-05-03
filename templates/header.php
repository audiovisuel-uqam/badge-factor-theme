<?php use Roots\Sage\Extras; ?>

<?php /*

<header class="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"></a>
    <nav class="nav-primary">

    </nav>
  </div>
</header>  */ ?>

<header class="header-main">
    <div class="wrap container">
        <span class="glyphicon glyphicon-menu-hamburger header-main-menu-mobile-icon menu-trigger"></span>
        <div class="header-main-logo">
            <a href="<?php echo get_home_url(); ?>" class="header-main-logo-link">
                <?php echo Extras\site_brand(); ?>
            </a>
        </div>
        <nav class="header-main-navigation">
            <div class="header-main-menu-wrap">
                <ul class="header-main-navigation-list">
                    <li class="header-main-navigation-item">
                        <form role="search" method="get" class="header-main-search-form" action="/">
                            <fieldset class="header-main-search-input-wrap">
                                <input type="search" class="header-main-search-input-text" placeholder="Rechercher" value="" name="s">
                                <button type="submit" name="name" class="header-main-search-submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </fieldset>
                            <input type="hidden" name="lang" value="fr">
                        </form>
                    </li>


                    <?php
                        if (has_nav_menu('primary_navigation')) {
                            wp_nav_menu( array(
                                    'theme_location'    => 'primary_navigation',
                                    'depth'             => 3,
                                    'container'         => false,
                                    'items_wrap'        => '%3$s',
                                    'fallback_cb' => false,
                                    'walker' => new Theme_Walker(),
                                    'item_class' => 'header-main-navigation-item',
                                    'subitem_class' => 'header-main-navigation-sublist-item',
                                    'link_class' => 'header-main-navigation-link',
                                    'sublink_class' => 'header-main-navigation-sublist-link'
                                )
                            );
                        }
                    ?>
                </ul>
            </div>
            <div class="header-main-secondary-menu-wrap">
                <ul class="header-main-top-list">
                    <?php dynamic_sidebar('sidebar-header'); ?>
                </ul>
            </div>
        </nav>
    </div>
</header>




