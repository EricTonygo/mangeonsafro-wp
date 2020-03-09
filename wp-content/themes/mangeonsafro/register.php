<?php

/*
  Template Name: Register Page
 */
session_start();
if (!is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password']) && isset($_POST['email']) && $_POST['email'] != "" && $_POST['password'] != "") {
        if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] != "" && verify_use_grecaptcha($_POST['g-recaptcha-response'])) {
            if (isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['username']) && $_POST['username'] != "") {
                global $current_user;
                $user_pass = esc_attr($_POST['password']);
                $user_email = removeslashes(esc_attr(trim($_POST['email'])));
                $user_login = removeslashes(esc_attr(trim($_POST['username'])));
                $my_user_role = isset($_POST['role']) && $_POST['role'] != "" ? removeslashes(esc_attr(trim($_POST['role']))): "particular";
                $user_data = array(
                    'user_login' => $user_login,
                    'user_pass' => $user_pass,
                    'user_email' => $user_email,
                    'first_name' => "",
                    'last_name' => "",
                    'role' => $my_user_role
                );
                if (get_user_by('login', $user_login)) {
                    $_SESSION['registration_faillure_process'] = __("A user with this username already exists", "mangeonsafrodomain");
                } elseif (filter_var($user_email, FILTER_VALIDATE_EMAIL) && get_user_by('email', $user_email)) {
                    $_SESSION['registration_faillure_process'] = __("A user with this email already exists", "mangeonsafrodomain");
                } else {
                    $user_id = register_user($user_data);
                    if (!is_wp_error($user_id)) {
                        $_SESSION['registration_success_process'] = __("Your account has been successfully created. An activation link has been sent by email to your account email", "mangeonsafrodomain");
                        wp_safe_redirect(get_permalink(get_page_by_path(__("customer-zone", "mangeonsafrodomain"))->ID));
                        exit;
                    } else {
                        $_SESSION['registration_faillure_process'] = __("An error occurred while creating your account", "mangeonsafrodomain");
                    }
                }
            } else {
                $_SESSION['registration_faillure_process'] = __("Some form data is missing. Check it and try again", "mangeonsafrodomain");
            }
        } else {
            $_SESSION['registration_faillure_process'] = __("We could not verify your recaptcha security code. Check it and try again", "mangeonsafrodomain");
        }
        wp_safe_redirect(get_permalink(get_page_by_path(__("customer-zone", "mangeonsafrodomain"))->ID));
        exit;
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__("customer-zone", "mangeonsafrodomain"))->ID));
        exit;
    }
} else {
    wp_safe_redirect(home_url('/'));
    exit;
}

// Header 
get_header();
//Content
include(locate_template('users-pages/content-customer-zone.php'));
//Footer 
get_footer();
