<?php get_header(); ?>

    <?php get_template_part('templates/page', 'header'); ?>



    <style type="text/css">
        #item-nav, #item-header, #public-personal-li{
            display: none;
        }
    </style>

    <div class="container" style="margin-bottom: 15px;">

        <?php if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif; ?>

        <?php
        $userID = bp_displayed_user_id();
        $htmlTemplates = '';
        if (bp_loggedin_user_id() == $userID) {
            if (bp_is_user_profile_edit() || bp_is_user_change_avatar()){
                $htmlTemplates .=
                    '<a class="home-page-development-button" style="float:right; max-width: 300px;" href="' . bp_get_displayed_user_link() . '" class="link-edit-profile">' . __('Retour vers votre page de profil', 'stm_child_domain') . '</a>
						<div style="clear:both;"></div>';
            }

            echo $htmlTemplates;
        }
        ?>

    </div>

<?php get_footer();?>