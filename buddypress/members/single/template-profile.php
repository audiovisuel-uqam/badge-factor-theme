<?php

	// Get current displayed user ID
	$userID = bp_displayed_user_id();
	$currentUserBadgeList = $GLOBALS['badgefactor']->get_user_achievements($userID);
	$currentUserData = get_userdata($userID);
	$currentUserNiceUrl = get_permalink(get_option('bp-pages')['members']) . $currentUserData->user_nicename;

	get_header();
?>

<?php get_template_part('partials/title_box'); ?>
<div class="container row">
    <section class="profile-members-badges">
        <div class="profile-members-badges-heading">
            <h3 class="profile-members-badges-heading-title"><?php _e('Badges Portfolio'); ?></h3>
        </div>
        <ul class="profile-members-badges-list">

            <?php
                $htmlTemplates = '';
                foreach ($GLOBALS['badgefactor']->get_user_achievements($userID) as $achievement) {

                    $submission = $GLOBALS['badgefactor']->get_submission($achievement->ID, $userID);

                    if (!$GLOBALS['badgefactor']->is_achievement_private($submission->badge_id) || $userID == get_current_user_id())
                    {
                        $badgePost = get_post($achievement->badge_id);

                        $currentBadgeUrl = $currentUserNiceUrl . 'badges/' . $badgePost->post_name;

                        $htmlTemplates .= '<li class="profile-members-badge"><figure class="profile-members-badge-figure">
                            <a href="' . $currentBadgeUrl . '">' . badgeos_get_achievement_post_thumbnail( $achievement->achievement_id ) . '</a>
                            <figcaption class="profile-members-badge-details">
                                <span class="profile-members-badge-description">'.get_the_title( $achievement->achievement_id ) .'</span>
                            </figcaption>';
                             if ( bp_is_my_profile() )
                             {
                                 switch ($GLOBALS['badgefactor']->is_achievement_private($submission->ID))
                                 {
                                     case true:
                                         $htmlTemplates .= '<button class="private-status private" data-achievement-id="'. $submission->ID . '"><span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></button>';
                                         break;
                                     case false:
                                     default:
                                         $htmlTemplates .= '<button class="private-status public" data-achievement-id="'. $submission->ID . '"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>';
                                         break;
                                 }
                             }
                        $htmlTemplates .= '</figure></li>';
                    }
                }
                echo do_shortcode($htmlTemplates);
            ?>
        </ul>
    </section>
</div>

<?php get_footer();?>
