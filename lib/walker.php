<?php
/**
 * Created by PhpStorm.
 * User: joris
 * Date: 2017-04-20
 * Time: 4:48 PM
 */

/**
 * Create a nav menu with very basic markup.
 *
 * @author Thomas Scholz http://toscho.de
 * @version 1.0
 */
class Theme_Walker extends Walker_Nav_Menu
{

    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

        $output     .= '<li class="'. esc_attr( $class_names ) . ' ' .  ($depth == 0 ? $args->item_class : $args->subitem_class) . '">';

        $link_class = 'class="' . esc_attr( $class_names ) . ' ' . ($depth == 0 ? $args->link_class : $args->sublink_class) . '"';

        $attributes  = $link_class;
        ! empty ( $item->attr_title )
        // Avoid redundant titles
        and $item->attr_title !== $item->title
        and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';
        ! empty ( $item->url )
        and $attributes .= ' href="' . esc_attr( $item->url ) .'"';
        $attributes  = trim( $attributes );
        $title       = apply_filters( 'the_title', $item->title, $item->ID );
        $item_output = "$args->before<a $attributes>$args->link_before$title</a>"
            . "$args->link_after$args->after";
        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
            ,   $item_output
            ,   $item
            ,   $depth
            ,   $args
        );
    }

    /**
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth
     * @param array $args
     */
    public function start_lvl( &$output, $depth = 0, $args = array() )
    {
        $output .= '<ul class="header-main-navigation-sublist">';
    }
    /**
     * @see Walker::end_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    public function end_lvl( &$output, $depth = 0, $args = array() )
    {
        $output .= '</ul>';
    }
    /**
     * @see Walker::end_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    function end_el( &$output, $item, $depth = 0, $args = array() )
    {
        $output .= '</li>';
    }

}

class Footer_Walker extends Walker_Nav_Menu
{

    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        $output     .= '<li class="'. $args->item_class . '">';

        $link_class = 'class="' .  $args->link_class . '"';

        $attributes  = $link_class;
        ! empty ( $item->attr_title )
        // Avoid redundant titles
        and $item->attr_title !== $item->title
        and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';
        ! empty ( $item->url )
        and $attributes .= ' href="' . esc_attr( $item->url ) .'"';
        $attributes  = trim( $attributes );
        $title       = apply_filters( 'the_title', $item->title, $item->ID );
        $item_output = "$args->before<a $attributes>$args->link_before$title</a>"
            . "$args->link_after$args->after";
        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
            ,   $item_output
            ,   $item
            ,   $depth
            ,   $args
        );
    }

    /**
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth
     * @param array $args
     */
    public function start_lvl( &$output, $depth = 0, $args = array() )
    {
        $output .= '<ul>';
    }
    /**
     * @see Walker::end_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    public function end_lvl( &$output, $depth = 0, $args = array() )
    {
        $output .= '</ul>';
    }
    /**
     * @see Walker::end_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    function end_el( &$output, $item, $depth = 0, $args = array() )
    {
        $output .= '</li>';
    }

}