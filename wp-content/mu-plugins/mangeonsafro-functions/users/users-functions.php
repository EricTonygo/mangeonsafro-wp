<?php

//Function of registration user account from siogive front-end website.
function register_user($user_data = null) {
    $new_user_data = array(
        'user_login' => $user_data['user_login'],
        'user_pass' => $user_data['user_pass'],
        'user_email' => $user_data['user_email'],
        'first_name' => $user_data['first_name'],
        'last_name' => $user_data['last_name'],
        'role' => $user_data['role']
    );
    $user_id = wp_insert_user($new_user_data);
    if (!is_wp_error($user_id)) {
        update_user_meta($user_id, 'registration-completed', 1);
        //update_user_meta($user_id, 'user-activated', 1);
        update_user_meta($user_id, 'user-identified', 1);
        mangeonsafro_send_activate_link($user_id);
        return $user_id;
    } else {
        return null;
    }
}

//add_action('user_register', 'mangeonsafro_registration_save', 10, 1);
//
//function mangeonsafro_registration_save($user_id) {
//    $user_activated = get_user_meta($user_id, "user-activated", true);
//    if ($user_activated == null || $user_activated == 1) {
//        mangeonsafro_send_activate_link($user_id);
//    }
//}
//Function of updating user account from mangeonsafro front-end website.
function update_user($user_data = null) {
    $new_user_data = array(
        'ID' => get_current_user_id(),
        'user_email' => $user_data['user_email'],
        'first_name' => $user_data['first_name'],
        'last_name' => $user_data['last_name'],
        'display_name' => $user_data['display_name'],
        'role' => $user_data['role']
    );
    $user_id = wp_update_user($new_user_data);
    if (!is_wp_error($user_id)) {
        update_user_meta($user_id, 'registration-completed', 2);
        update_user_meta($user_id, 'user-country-code', $user_data['country_code']);
        update_user_meta($user_id, 'user-phone-number', $user_data['phone_number']);
        update_user_meta($user_id, 'user-localisation', $user_data['localisation']);
        update_user_meta($user_id, 'user-localisation-city', $user_data['localisation_city']);
        update_user_meta($user_id, 'user-localisation-region', $user_data['localisation_city']);
        update_user_meta($user_id, 'user-localisation-country', $user_data['localisation_country']);
        update_user_meta($user_id, 'user-city', $user_data['user_city']);
        update_user_meta($user_id, 'user-zip', $user_data['user_zip']);
        update_user_meta($user_id, 'user-seller-name', $user_data['user_seller_name']);
        update_user_meta($user_id, 'user-seller-pro-phone-number', $user_data['user_seller_pro_phone_number']);
        update_user_meta($user_id, 'user-seller-pro-email', $user_data['user_seller_pro_email']);
        $user_activated = get_user_meta($user_id, "user-activated", true);
        if ($user_activated == null || $user_activated == 1) {
            mangeonsafro_send_activate_link($user_id);
        }
        return $user_id;
    } else {
        return null;
    }
}

//add_action('profile_update', 'my_profile_update', 10, 2);
//
//function my_profile_update($user_id, $old_user_data) {
//    $user_activated = get_user_meta($user_id, "user-activated", true);
//    if ($user_activated == null || $user_activated == 1) {
//        mangeonsafro_send_activate_link($user_id);
//    }
//}

function update_user_school_informations($user_data) {
    $user_id = get_current_user_id();
    if (!is_wp_error($user_id)) {
        update_user_meta($user_id, 'user-school-name', $user_data['school_name']);
        update_user_meta($user_id, 'user-school-city', $user_data['school_city']);
        update_user_meta($user_id, 'user-school-class', $user_data['school_class']);
        return $user_id;
    } else {
        return null;
    }
}

function mangeonsafro_send_activate_link($user_id) {
    $hash = sha1(uniqid(mt_rand(), true));
    update_user_meta($user_id, 'user-hash', $hash);
    update_user_meta($user_id, 'user-activated', 1);
    $user_data = get_userdata($user_id);
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Mangeons Afro <infos@mangeonsafro.gpdeal.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $subject = "Mangeons Afro - " . __("Account activation", "mangeonsafrodomain");
    ob_start();
    ?>

    <div style="font-size: 12.8px;"><?php _e("Welcome to Mangeons Afro", "mangeonsafrodomain"); ?> !</div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("You have just registered on our site and we thank you for your confidence", "mangeonsafrodomain"); ?>. </div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("For security reasons, you must activate your account by clicking on the activation link opposite", "mangeonsafrodomain"); ?> <a href="<?php echo esc_url(add_query_arg(array('id' => $user_data->user_login, 'key' => get_user_meta($user_data->ID, "user-hash", true)), get_permalink(get_page_by_path(__('activate-account', 'mangeonsafrodomain'))))); ?>"><?php _e("activate my Mangeons Afro account", "mangeonsafrodomain"); ?></a>.</div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("Do not hesitate to <a href='mailto:contact@mangeonsafro.gpdeal.com'>contact us</a> if you encounter difficulties during this activation", "mangeonsafrodomain"); ?> !</div>
    <div><br></div>
    <div>
        <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Best regards", "mangeonsafrodomain"); ?>,</p>
        <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your Mangeons Afro Team", "mangeonsafrodomain"); ?> </p>
    </div>

    <?php
    $body = ob_get_contents();
    ob_end_clean();
    wp_mail($user_data->user_email, $subject, $body, $headers);
}

/* * **************************Customize email send to user when his email change********************************************* */

// define the send_email_change_email callback 
function filter_send_email_change_email($true, $user, $userdata) {
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Mangeons Afro <infos@mangeonsafro.gpdeal.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $subject = "Mangeons Afro - " . __("E-mail changing notification", "mangeonsafrodomain");
    ob_start();
    ?>

    <div style="font-size: 12.8px;"><?php _e("Hello", "mangeonsafrodomain"); ?> <?php echo $user['user_login'] ?> !</div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("The modification of your e-mail address has been considered on our website", "mangeonsafrodomain"); ?>. </div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("The e-mail registered for your transactions is now", "mangeonsafrodomain"); ?> <a href="mailto:<?php echo $userdata['user_email']; ?>"><?php echo $userdata['user_email']; ?></a>.</div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("If you are not the owner of this action, please contact the site administrator at", "mangeonsafrodomain"); ?> <a href="mailto:<?php echo get_bloginfo("admin_email"); ?>"><?php echo get_bloginfo("admin_email"); ?></a></div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("Thank you for your loyalty", "mangeonsafrodomain"); ?>.</div>
    <div><br></div>
    <div>
        <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Best regards", "mangeonsafrodomain"); ?>,</p>
        <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your Mangeons Afro Team", "mangeonsafrodomain"); ?></p>
    </div>
    <?php
    $body = ob_get_contents();
    ob_end_clean();
    wp_mail($user['user_email'], $subject, $body, $headers);
}

// add the filter for e-mail changing
add_filter('send_email_change_email', 'filter_send_email_change_email', 10, 3);

function send_reset_password_link($user_email) {
    $user = get_user_by('email', $user_email);
    $hash_reset_password = sha1(uniqid(mt_rand(), true)) . '' . sha1(uniqid(mt_rand(), true)) . '' . sha1(uniqid(mt_rand(), true));
    update_user_meta($user->ID, 'hash-reset-password', $hash_reset_password);
    update_user_meta($user->ID, 'last-reset-password-time', time());
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Mangeons Afro <infos@mangeonsafro.gpdeal.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $subject = "Mangeons Afro - " . __("Resetting your password", "mangeonsafrodomain");
    ob_start();
    ?>
    <div style="font-size: 12.8px;"><?php _e("Modify your password and you can continue", "mangeonsafrodomain"); ?>.</div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("To change your Mangeons Afro password", "mangeonsafrodomain"); ?>, <?php _e("click", "mangeonsafrodomain"); ?> <a href="<?php echo esc_url(add_query_arg(array('id' => $user->user_login, 'key' => get_user_meta($user->ID, "hash-reset-password", true)), get_permalink(get_page_by_path(__('reset-password', 'mangeonsafrodomain'))->ID))); ?>"><?php _e("here", "mangeonsafrodomain"); ?></a>
        <?php _e("or paste the following link into your browser", "mangeonsafrodomain"); ?> :</div>
    <div><br></div>
    <div><?php echo esc_url(add_query_arg(array('id' => $user->user_login, 'key' => get_user_meta($user->ID, "hash-reset-password", true)), get_permalink(get_page_by_path(__('reset-password', 'mangeonsafrodomain'))))); ?></div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("This link will expire in 24 hours, be sure to use it soon", "mangeonsafrodomain"); ?>.</div>
    <div><br></div>
    <div>
        <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Best regards", "mangeonsafrodomain"); ?>,</p>
        <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your Mangeons Afro Team", "mangeonsafrodomain"); ?></p>
    </div>
    <?php
    $body = ob_get_contents();
    ob_end_clean();
    return wp_mail($user_email, $subject, $body, $headers);
}


//Function for getting forgot password of user
function mangeonsafro_reset_password($login, $new_password) {
    if ($login != "" && $new_password) {
        $user = get_user_by('login', $login);
        if ($user) {
            wp_set_password($new_password, $user->ID);
            $hash_reset_password = sha1(uniqid(mt_rand(), true)) . '' . sha1(uniqid(mt_rand(), true)) . '' . sha1(uniqid(mt_rand(), true));
            update_user_meta($user->ID, 'hash-reset-password', $hash_reset_password);
            if (is_user_logged_in()) {
                $creds = array('user_login' => $user->data->user_login, 'user_password' => $new_password, 'remember' => false);
                $secure_cookie = is_ssl() ? true : false;
                $user = wp_signon($creds, $secure_cookie);
                $_SESSION["success_process"] = __("Your password has been changed successfully", "mangeonsafrodomain");
                wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain'))->ID));
            } else {
                $_SESSION["success_process"] = __("Your password has been resetted successfully", "mangeonsafrodomain") . "! " . __("Log in now to start using our services", "mangeonsafrodomain");
                wp_safe_redirect(get_permalink(get_page_by_path(__('customer-zone', 'mangeonsafrodomain'))->ID));
            }
            exit;
        } else {
            $_SESSION['faillure_process'] = __("Unable to reset password. Incorrect user", "mangeonsafrodomain");
            wp_safe_redirect(get_permalink(get_page_by_path(__('reset-password', 'mangeonsafrodomain'))->ID));
            exit;
        }
    } else {
        wp_safe_redirect(home_url('/'));
        exit;
    }
}