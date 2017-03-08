<?php
/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

	// Get current displayed user ID
	$userID = bp_displayed_user_id();

	// Get Profile page 
	$userId = get_current_user_id(); 
	$currentUserData = get_userdata($userId);
	$currentUserNiceUrl = get_permalink(MEMBER_PAGE_ID) . bp_members_get_user_nicename($userId);
	$currentUserEditUrl = $currentUserNiceUrl . '/profile/edit';

	// Get Informations user can edit
	$userDisplayName = get_the_author_meta('display_name', $userID );
	$userBio =  bp_get_profile_field_data( array( 'field' => 'Bio', 'user_id' => bp_displayed_user_id()));
	$userWebsite = bp_get_profile_field_data( array( 'field' => 'Site internet', 'user_id' => bp_displayed_user_id()));
	$userCountry = bp_get_profile_field_data( array( 'field' => 'Lieu', 'user_id' => bp_displayed_user_id()));
	$userOrganisation = bp_get_profile_field_data( array( 'field' => 'Organisation', 'user_id' => bp_displayed_user_id()));
	$userJob = bp_get_profile_field_data( array( 'field' => 'Emploi', 'user_id' => bp_displayed_user_id()));

	$userFacebook = bp_get_profile_field_data( array( 'field' => 'Facebook', 'user_id' => bp_displayed_user_id()));
	$userLinkedin = bp_get_profile_field_data( array( 'field' => 'Linkedin', 'user_id' => bp_displayed_user_id()));
	$userTwitter = bp_get_profile_field_data( array( 'field' => 'Twitter', 'user_id' => bp_displayed_user_id()));
	$userGooglePlus = bp_get_profile_field_data( array( 'field' => 'Google +', 'user_id' => bp_displayed_user_id()));
	$htmlTemplates = '';
	
?>

<?php

/**
 * Fires before the display of a member's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_member_header' ); ?>

<?php
	if (bp_loggedin_user_id() == $userID) {

		if (bp_is_user_profile_edit() || bp_is_user_change_avatar()){
			$htmlTemplates .= 
				'<a class="link-edit-profile vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-color-primary" href="' . bp_get_displayed_user_link() . '" class="link-edit-profile">' . __('Retour à votre page de profil', 'stm_child_domain') . '</a>
				<div style="clear:both;"></div>';
		} else {
			$htmlTemplates .= 
				'<a class="link-edit-profile vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-color-primary" href="' . $currentUserEditUrl . '" class="link-edit-profile">' . __('Paramètres de votre compte', 'stm_child_domain') . '</a>
				<div style="clear:both;"></div>';
		}
	}
?>

<?php 
	/* 
		First row
		------------------------------------
		Thumbnail
		User name
		Bio
	*/

	// Show user bio
	if (!empty($userBio)) {
		$htmlTemplates .= $userBio;
	}

	/* 
		Second row
		------------------------------------
		User URL
		Country
		Job title
		Organisation
	*/
	
	// Open user infos row
	if (!empty($userWebsite) || !empty($userCountry) || !empty($userJob) || !empty($userOrganisation)) 
	{
		$htmlTemplates .= 
			'[vc_row]';

		// User job
		if (!empty($userJob)) {
			$htmlTemplates .=
				'[vc_column width="1/4"]
					[vc_column_text]
						<h4>' . __('Profession:', 'stm_child_domain') . '</h4>
						' . $userJob . '
					[/vc_column_text]
				[/vc_column]';
		}

		// User organisation
		if (!empty($userOrganisation) && !empty($userWebsite)) {
			$htmlTemplates .=
				'[vc_column width="1/4"]
					[vc_column_text]
						<h4>' . __('Organisation:', 'stm_child_domain') . '</h4>
						<a href="' . $GLOBALS['badgefactor']->addhttp($userWebsite) . '">' . $userOrganisation . '</a>
					[/vc_column_text]
				[/vc_column]';
		} else if (!empty($userWebsite)) {
			$htmlTemplates .= 
				'[vc_column width="1/4"]
					[vc_column_text]
						<h4>' . __('Organisation:', 'stm_child_domain') . '</h4>
						<a href="' . $GLOBALS['badgefactor']->addhttp($userWebsite) . '">' . $userWebsite . '</a>
					[/vc_column_text]
				[/vc_column]';
		} else if (!empty($userOrganisation)) {
			$htmlTemplates .= 
				'[vc_column width="1/4"]
					[vc_column_text]
						<h4>' . __('Organisation:', 'stm_child_domain') . '</h4>
						' . $userOrganisation . '
					[/vc_column_text]
				[/vc_column]';
		}

		// User Country 
		if (!empty($userCountry)) { 
			$htmlTemplates .= 
				'[vc_column width="1/4"]
					[vc_column_text]
						<h4>' . __('Lieu:', 'stm_child_domain') . '</h4>
						' . $userCountry . '
					[/vc_column_text]
				[/vc_column]';
		}

		// Close user infos row
		$htmlTemplates .= '[/vc_row]';
	}

	//echo do_shortcode($htmlTemplates);
?>
	
	<div class="sharing-ext">
		<div class="sharing-ext-linkedin">
			<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: fr_FR</script><script type="IN/Share"></script>
		</div>

		<div class="sharing-ext-facebook">
			<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button"></div>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/fr_CA/sdk.js#xfbml=1&version=v2.5";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		</div>

		<div class="sharing-ext-twitter">
			<a href="https://twitter.com/share" class="twitter-share-button"{count}>Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
	</div>
