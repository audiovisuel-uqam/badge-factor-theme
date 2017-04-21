<?php
/**
 * Created by PhpStorm.
 * User: joris
 * Date: 2017-04-20
 * Time: 6:13 PM
 */

// Creating the widget
class HeaderAddressWidget extends \WP_Widget
{

    public function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'bf_header_address_widget',

            // Widget name will appear in UI
            __('Header Address', 'badgefactor'),

            // Widget description
            array('description' => __('Address in the header bar', 'badgefactor'),)
        );
    }

    public static function load_widget()
    {
        register_widget('HeaderAddressWidget');
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget($args, $instance)
    {
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        // This is where you run the code and display the output
        ?>
        <li class="header-main-top-item">
            <span class="glyphicon glyphicon-map-marker header-main-top-icon"></span>
            <a href="http://maps.google.com/?q=<?php echo urlencode($instance['address']); ?>" class="header-main-top-link" target="_blank"><?php echo $instance['address']; ?></a>
        </li>
        <?php

        echo $args['after_widget'];
    }

    // Widget Backend
    public function form($instance)
    {
        if (isset($instance['address'])) {
            $address = $instance['address'];
        } else {
            $address = __('1940 boul. Henri-Bourassa E. Montréal, Québec, Canada', 'badgefactor');
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>"
                   name="<?php echo $this->get_field_name('address'); ?>" type="text"
                   value="<?php echo esc_attr($address); ?>"/>
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['address'] = (!empty($new_instance['address'])) ? strip_tags($new_instance['address']) : '';
        return $instance;
    }
}

add_action( 'widgets_init', array(HeaderAddressWidget::class, 'load_widget') );