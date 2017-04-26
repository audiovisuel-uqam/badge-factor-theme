<?php get_header(); ?>

    <?php get_template_part('templates/page', 'header'); ?>



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
        $currentEmail = $user->user_email;

        if(isset( $_POST['submitBase'])){
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $nickname = $_POST['nickname'];
            $inputEmail = $_POST['email'];
            $url = $_POST['url'];
            $description = $_POST['description'];
            


            if($currentEmail != $inputEmail && filter_var($inputEmail, FILTER_VALIDATE_EMAIL)){

                $return = wp_update_user( array( 
                    'ID'         => $user->ID,
                    'user_email' => $inputEmail,
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'nickname'   => $nickname,
                    'user_url'   => $url,
                    'description'=> $description
                ));

                $user = wp_get_current_user();
            }
        }

        $user = wp_get_current_user();


        if(isset( $_POST['submitPassword'])){
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            if($newPassword == $confirmPassword){
                $validPassword = wp_check_password( $oldPassword, $user->user_pass, $user->ID );
                if($validPassword){
                    wp_set_password( $newPassword, $user->ID );
                }
            }
        }

        //var_dump($user);

        ?>


        <?php if(substr($_SERVER['REQUEST_URI'], -2,1) == 1){  ?>
           <div id="buddypress">
            <!--id and classes serves to apply same CSS rules on both forms -->
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


                    <div class="submit">
                        <input type="submit" name="submitBase" value="Save changes">
                    </div>

                </form>
            </div>
        <?php } ?>

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