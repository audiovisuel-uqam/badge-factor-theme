<?php

	if (bp_is_user_profile_edit() || bp_is_user_change_avatar()){
		include 'template-profile-edit.php';
	} else if (strpos($_SERVER['REQUEST_URI'],'badges') !== false) {
		include 'template-badge.php';
	}
	//Check if it is the profile of the user.
	else if( bp_is_my_profile() && strpos($wp->request, 'profile')){
	    include 'template-profile-home.php';
    }
	else {
	    include 'template-profile.php';
	}

