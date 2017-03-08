<?php

// Get current displayed user ID
$userID = bp_displayed_user_id();
$currentUserData = get_userdata($userID);
$currentUserNiceUrl = get_permalink(MEMBER_PAGE_ID) . $currentUserData->user_nicename;

// get current user attributed badges list
$currentUserBadgeList = $GLOBALS['badgefactor']->get_user_achievements($userID);

// Check if current badge is a real badge name attributed

$string = end((explode('/', rtrim($_SERVER['REQUEST_URI'], '/'))));
$find = $currentUserData->user_nicename . '-';

$replace = '';
$slug = preg_replace(strrev("/$find/"),strrev($replace),strrev($string),1);
$slug = strrev($slug);
$badgePost = $GLOBALS['badgefactor']->get_page_by_slug($slug, OBJECT, 'submission');
$is_badgeAchieved = false;
$currentBadgeInfos = '';

$achievement_id = get_post_meta($badgePost->ID, '_badgeos_submission_achievement_id');
if (is_array($achievement_id)) $achievement_id = array_shift($achievement_id);

$organisation_id = get_post_meta($achievement_id, 'organisation');
if (is_array($organisation_id)) $organisation_id = array_shift($organisation_id);
$organisation = get_post($organisation_id);

$endorsers = get_post_meta($achievement_id, 'endorsed_by');
foreach ($endorsers as $i => $endorser)
{
	if (is_array($endorser)) $endorser = array_shift($endorser);
	$endorsers[$i] = get_post($endorser);
}
// Get current badges infos by url name
foreach ($currentUserBadgeList as $singleBadgeId => $singleBadge) {
	if ($singleBadge->badge_id == $badgePost->ID) {
		$is_badgeAchieved = true;
		$currentBadgeInfos = $singleBadge;
	}
}

// Get current Achievement proof

$currentBadgePdfUrl = $GLOBALS['badgefactor']->get_attachment_by_submission_id($currentBadgeInfos->badge_id);

//print_r($currentBadgePdfUrl);

// Redirect to profile if current url is not a badge
// Redirect to profile if current user has not been awarded the badge
if ($is_badgeAchieved == false) {
	wp_redirect($currentUserNiceUrl);
	exit();
}

// Get infos for current badge assertion
if (!empty($currentBadgeInfos)) {
	// Get achievements infos


	$jsonUid = $GLOBALS['badgefactor']->getSslPage($currentBadgeInfos->uid);
	$currentUserAchievementsUid = json_decode($jsonUid);

	// Get badges infos
	$jsonBadge = $GLOBALS['badgefactor']->getSslPage($currentUserAchievementsUid->badge);
	$currentUserBadgeInfos = json_decode($jsonBadge);

	// Get issuer infos
	$jsonBadgeIssuer = $GLOBALS['badgefactor']->getSslPage($currentUserBadgeInfos->issuer);
	$currentUserBadgeIssuer = json_decode($jsonBadgeIssuer);
}

$currentBadgePost = get_post($currentBadgeInfos->achievement_id);
$badgeCriteriaTitle = get_field('badge_criteria_title', $currentBadgePost->ID);
$badgeCriteriaText = get_field('badge_criteria', $currentBadgePost->ID);




if (empty($badgeCriteriaTitle)) {
	$badgeCriteriaTitle = __('Critères', 'stm_child_domain');
}


// Get Informations user can edit
$userDisplayName = get_the_author_meta('display_name', $userID );

// Default Badge image
$badgeImage = get_stylesheet_directory_uri() . '/assets/img/default-badge-image.png';

// Selected Badge image if it exist
if (has_post_thumbnail($currentBadgePost->ID)) {
	$badgeImage = wp_get_attachment_image_src( get_post_thumbnail_id($currentBadgePost->ID), 'single-post-thumbnail' );
	$badgeImage = $badgeImage[0];
}

$htmlTemplate = '';

get_header(); ?>

<?php get_template_part('partials/title_box'); ?>
	<div class="container">
    <?php

    //the page to show a single badge on the profile of a user.

    $htmlTemplate .= 
          '<section class="profile-members-single-badge">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <img class="badge-single-img" src="'.$badgeImage.'" class="profile-members-image" width="100%" />
    
                    <div style="margin-top:15px;text-align:center;">
                        <a href="'.$currentUserNiceUrl.'" style="text-decoration:none; font-size:15px;">'.$currentUserData->user_nicename.'</a><br>
                        <p style="text-align:center;">'.__('a obtenu ce badge', 'badgefactor').'!</p>
                        <h4>Octroyé par</h4>
                        <a href="'.$currentUserBadgeIssuer->url.'" style="text-decoration:none; font-size:15px;">'.$currentUserBadgeIssuer->name.'</a>
                    </div>';

    $htmlTemplate .= '<figcaption class="badges-unique-details">';
    if ($endorsers)
    {
        $htmlTemplate .= '
            <dl class="badges-unique-definition">
                <dt class="badges-unique-definition-term">Endossé par</dt>
                <dd class="badges-unique-definition-description">';

            foreach ($endorsers as $endorser)
            {
              $htmlTemplate .= '
              <ul class="badges-unique-definition-description-list">
                              <li class="badges-unique-definition-description-item">' . $endorser->post_title . '</li>
              </ul>
              ';
            }

        $htmlTemplate .= '</dd></dl>';
    }
    $htmlTemplate .= '</figcaption>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
              <h2>'.$currentBadgePost->post_title.'</h2>
              <h3 class="badges-unique-content-heading">Description</h3>
              <p class="badges-unique-content-text">'. $currentBadgePost->post_content. '</p>
              <h3 class="badges-unique-content-heading">Compétences</h3>
              <ul class="badges-unique-content-comp-list">
                <?php for ($i=0; $i < 4; $i++) { ?>
                  <li class="badges-unique-content-comp-item">
                    <a href="#" class="badges-unique-content-comp-link" title="Neque Porro">Lorem</a>
                  </li>
                  <li class="badges-unique-content-comp-item">
                    <a href="#" class="badges-unique-content-comp-link" title="Neque Porro Quisquam">Ipsum</a>
                  </li>
                  <li class="badges-unique-content-comp-item">
                    <a href="#" class="badges-unique-content-comp-link" title="Quisquam">Quisquam</a>
                  </li>
                <?php } ?>
              </ul>
              <h3 class="badges-unique-content-heading">Critères d\'obtention</h3>
              <p class="badges-unique-content-text">'. $badgeCriteriaText. '</p>
              
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <h3 class="badges-unique-content-heading">Date d\'octroie</h3>
                <span class="badges-unique-granted-date">' . date('d F Y', $currentUserAchievementsUid->issuedOn) . '</span>
              </div>';

              if(!empty($currentBadgePdfUrl)){
                $htmlTemplate .= '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"><a target="_blank" href="'.$currentBadgePdfUrl.'" class="badges-unique-granted-link">Consulter la preuve</a></div>';
              }
              

            $htmlTemplate .= '</div></section>';


		    echo do_shortcode($htmlTemplate);
		?>

	</div>

<?php get_footer(); ?>

