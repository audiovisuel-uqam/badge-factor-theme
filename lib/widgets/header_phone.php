<?php
/**
 * Created by PhpStorm.
 * User: joris
 * Date: 2017-04-20
 * Time: 6:15 PM
 */

// Creating the widget
class HeaderPhoneWidget extends \WP_Widget
{

    public function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'bf_header_phone_widget',

            // Widget name will appear in UI
            __('Header Phone', 'badgefactor'),

            // Widget description
            array('description' => __('Phone in the header bar', 'badgefactor'),)
        );
    }

    public static function load_widget()
    {
        register_widget('HeaderPhoneWidget');
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
            <span class="glyphicon glyphicon-earphone header-main-top-icon"></span>
            <a href="tel:<?php echo preg_replace("/[^0-9+]/", "", $instance['phone']); ?>" class="header-main-top-link"><?php echo $instance['phone'];?></a>
        </li>
        <?php

        echo $args['after_widget'];
    }

    // Widget Backend
    public function form($instance)
    {
        if (isset($instance['phone'])) {
            $phone = $instance['phone'];
        } else {
            $phone = __('555-555-5555', 'badgefactor');
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone number:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>"
                   name="<?php echo $this->get_field_name('phone'); ?>" type="text"
                   value="<?php echo esc_attr($phone); ?>"/>
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['phone'] = (!empty($new_instance['phone'])) ? strip_tags($new_instance['phone']) : '';
        return $instance;
    }
}

add_action( 'widgets_init', array(HeaderPhoneWidget::class, 'load_widget') );

