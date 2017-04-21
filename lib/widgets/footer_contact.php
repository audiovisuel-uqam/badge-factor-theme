<?php
/**
 * Created by PhpStorm.
 * User: joris
 * Date: 2017-04-20
 * Time: 6:11 PM
 */

// Creating the widget
class FooterContactWidget extends \WP_Widget
{

    public function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'bf_footer_contact_widget',

            // Widget name will appear in UI
            __('Footer Contact', 'badgefactor'),

            // Widget description
            array('description' => __('Contact information in the footer', 'badgefactor'),)
        );
    }

    public static function load_widget()
    {
        register_widget('FooterContactWidget');
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget($args, $instance)
    {
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        // This is where you run the code and display the output
        ?>

        <h4 class="footer-contact-heading-title"><?php _e('Contact us'); ?></h4>
        <ul class="footer-contact-info-list">
            <li class="footer-contact-info-list-item">
                <span class="glyphicon glyphicon-earphone footer-contact-info-icon"></span>
                <a href="tel:<?php echo preg_replace("/[^0-9+]/", "", $instance['phone']); ?>" class="footer-contact-info-link"><?php echo $instance['phone'];?></a>
            </li>
            <li class="footer-contact-info-list-item">
                <span class="glyphicon glyphicon-map-marker footer-contact-info-icon"></span>
                <a href="http://maps.google.com/?q=<?php echo urlencode($instance['address']); ?>" class="footer-contact-info-link" target="_blank"><?php echo $instance['address']; ?></a>
            </li>
            <li class="footer-contact-info-list-item">
                <span class="glyphicon glyphicon-envelope footer-contact-info-icon"></span>
                <a href="mailto:<?php echo $instance['email']; ?>" class="footer-contact-info-link"><?php echo $instance['email']; ?></a>
            </li>
        </ul>

        <?php

        echo $args['after_widget'];
    }

    // Widget Backend
    public function form($instance)
    {

        $phone   = isset($instance['phone']) ? $instance['phone'] : __('555-555-5555', 'badgefactor');
        $address = isset($instance['address']) ? $instance['address'] : __('1940 boul. Henri-Bourassa E. Montréal, Québec, Canada', 'badgefactor');
        $email   = isset($instance['email']) ? $instance['email'] : __('jacques.cool@cadre21.org');

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone number:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>"
                   name="<?php echo $this->get_field_name('phone'); ?>" type="text"
                   value="<?php echo esc_attr($phone); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>"
                   name="<?php echo $this->get_field_name('address'); ?>" type="text"
                   value="<?php echo esc_attr($address); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email address:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>"
                   name="<?php echo $this->get_field_name('email'); ?>" type="text"
                   value="<?php echo esc_attr($email); ?>"/>
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['phone'] = (!empty($new_instance['phone'])) ? strip_tags($new_instance['phone']) : '';
        $instance['address'] = (!empty($new_instance['address'])) ? strip_tags($new_instance['address']) : '';
        $instance['email'] = (!empty($new_instance['email'])) ? strip_tags($new_instance['email']) : '';


        return $instance;
    }
}

add_action( 'widgets_init', array(FooterContactWidget::class, 'load_widget') );

