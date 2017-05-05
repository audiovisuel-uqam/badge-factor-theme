<?php get_header(); ?>



    <style type="text/css">
        #item-nav, #item-header, #public-personal-li{
            display: none;
        }
    </style>

    <div class="container" style="margin-bottom: 15px;">

        <?php         
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif; 
        



        $user = wp_get_current_user();
        $userMeta = get_usermeta($user->ID);

        

        $currentEmail = $user->user_email;

        if(isset( $_POST['submitBase'])){
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $nickname = $_POST['nickname'];
            $inputEmail = $_POST['email'];
            $url = $_POST['url'];
            $description = $_POST['description'];
            $facebook = $_POST['facebook'];
            $linkedin = $_POST['linkedin'];
            $twitter = $_POST['twitter'];
            $google = $_POST['google'];
            $country = $_POST['country'];
            $organisation = $_POST['organisation'];
            $job = $_POST['job'];


            $metas = array(
                'facebook' => $facebook,
                'linkedin' => $linkedin,
                'twitter' => $twitter,
                'google' => $google,
                'country' => $country,
                'organisation' => $organisation,
                'job' => $job,
            );



            $return = wp_update_user( array( 
                'ID'         => $user->ID,
                'user_email' => $inputEmail,
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'nickname'   => $nickname,
                'user_url'   => $url,
                'description'=> $description
            ));

            foreach($metas as $key => $value) {
                update_user_meta( $user->ID, $key, $value );
            }

            $user = wp_get_current_user();
            $userMeta = get_usermeta($user->id);
        }

        

        if(isset( $_POST['submitPassword'])){

            $user = wp_get_current_user();

            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            if($newPassword == $confirmPassword){
                $validPassword = wp_check_password( $oldPassword, $user->user_pass, $user->ID );
                if($validPassword){

                    wp_set_password( $newPassword, $user->ID );
                    $redirectURL = get_permalink( $GLOBALS["badgefactor"]->bf_login_page() );
                    echo'<script>window.location.replace("'.$redirectURL.'");</script>';
                }
            }
        }

        ?>


        <?php if(substr($_SERVER['REQUEST_URI'], -2,1) == 1){  ?>

           <div id="buddypress">
                <form class="standard-form" method="post">
                    <div>
                        <label>Prénom</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="first_name" type="text" value="<?php echo $firstName ?>">
                         <?php }else{ ?>
                             <input name="first_name" type="text" value="<?php echo $user->first_name ?>">
                        <?php } ?>

                    </div>

                    <div>
                        <label>Nom de famille</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="last_name" type="text" value="<?php echo $lastName ?>">
                         <?php }else{ ?>
                             <input name="last_name" type="text" value="<?php echo $user->last_name ?>">
                        <?php } ?>

                    </div>

                    <div>
                        <label>Nickname</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="nickname" type="text" value="<?php echo $nickname ?>">
                         <?php }else{ ?>
                             <input name="nickname" type="text" value="<?php echo $user->nickname ?>">
                        <?php } ?>

                    </div>

                    <div>
                        <label>Adresse courriel</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="email" type="text" value="<?php echo $inputEmail ?>">
                         <?php }else{ ?>
                             <input name="email" type="text" value="<?php echo $user->user_email ?>">
                        <?php } ?>

                    </div>

                    <div>
                        <label>Site internet</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="url" type="text" value="<?php echo $url ?>">
                         <?php }else{ ?>
                             <input name="url" type="text" value="<?php echo $user->user_url ?>">
                        <?php } ?>

                    </div>

                    <div>
                        <label>Biographie</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <textarea name="description"><?php echo $description ?></textarea>
                         <?php }else{ ?>
                             <textarea name="description"><?php echo $user->description ?></textarea>
                        <?php } ?>

                    </div>

                    <div>
                        <label>Facebook</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="facebook" type="text" value="<?php echo $facebook ?>">
                         <?php }else{ ?>
                             <input name="facebook" type="text" value="<?php echo get_user_meta($user->ID, 'facebook', true);?>">
                        <?php } ?>

                    </div>
                    <div>
                        <label>LinkedIn</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="linkedin" type="text" value="<?php echo $linkedin ?>">
                         <?php }else{ ?>
                             <input name="linkedin" type="text" value="<?php echo get_user_meta($user->ID, 'linkedin', true) ?>">
                        <?php } ?>

                    </div>
                    <div>
                        <label>Twitter</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="twitter" type="text" value="<?php echo $twitter ?>">
                         <?php }else{ ?>
                             <input name="twitter" type="text" value="<?php echo get_user_meta($user->ID, 'twitter', true) ?>">
                        <?php } ?>

                    </div>
                    <div>
                        <label>Google +</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="google" type="text" value="<?php echo $google ?>">
                         <?php }else{ ?>
                             <input name="google" type="text" value="<?php echo get_user_meta($user->ID, 'google', true) ?>">
                        <?php } ?>

                    </div>
                    <div>
                        <label>Country</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="country" type="text" value="<?php echo $country ?>">
                         <?php }else{ ?>
                             <input name="country" type="text" value="<?php echo get_user_meta($user->ID, 'country', true) ?>">
                        <?php } ?>

                    </div>
                    <div>
                        <label>Organisation</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="organisation" type="text" value="<?php echo $organisation ?>">
                         <?php }else{ ?>
                             <input name="organisation" type="text" value="<?php echo get_user_meta($user->ID, 'organisation', true) ?>">
                        <?php } ?>

                    </div>
                    <div>
                        <label>Job</label>

                        <?php if( isset( $_POST['submitBase']) ){ ?>
                             <input name="job" type="text" value="<?php echo $job ?>">
                         <?php }else{ ?>
                             <input name="job" type="text" value="<?php echo get_user_meta($user->ID, 'job', true) ?>">
                        <?php } ?>

                    </div>

                    <div class="submit">
                        <input type="submit" name="submitBase" value="Save changes">
                    </div>

                </form>
            </div>
        <div id="buddypress">
            <!--id and classes serves to apply same CSS rules on both forms -->
                <form class="standard-form" method="post">
                    <div>
                        <label>Ancien mot de passe</label>
                        <input name="oldPassword" type="password">
                    </div>
                    <div>
                        <label>Nouveau mot de passe</label>
                        <input name="newPassword" type="password">
                    </div>
                    <div>
                        <label>Confirmer mot de passe</label>
                        <input name="confirmPassword" type="password">
                    </div>
                    
                    <div class="submit">
                        <input type="submit" name="submitPassword" value="Save changes">
                    </div>

                </form>
            </div>
        <?php } ?>


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