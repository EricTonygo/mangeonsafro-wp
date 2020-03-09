<?php

/*
  Template Name: Reset Password Page
 */
session_start();
if (!is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['username']) && isset($_POST['new-password']) && $_POST['username']!="" && $_POST['new-password']!="") {
            $user_login = esc_attr($_POST['username']);
            $new_password = esc_attr($_POST['new-password']);
            mangeonsafro_reset_password($user_login, $new_password);
        } else {
            $_SESSION["reset_password_faillure_process"] = __("Some data is missing. Check your form and try again", "mangeonsafrodomain");
            get_header();

            include(locate_template('users-pages/content-reset-password-page.php'));

            get_footer();
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['key'])) {
        $user_login = esc_attr(wp_unslash(trim($_GET['id'])));
        $hash_reset_password = $_GET['key'];
        $user = get_user_by('login', $user_login);
        $reset_password_possible = false;
        if (get_user_meta($user->ID, 'hash-reset-password', true) == $hash_reset_password) {
            // last request reset password was more than 90 minutes ago
            if ((time() - get_user_meta($user->ID, 'last-reset-password-time', true) < 24 * 60 * 60)) {
                get_header();

                include(locate_template('users-pages/content-reset-password-page.php'));

                get_footer();
            } else {
                $_SESSION["reset_password_faillure_process"] = __("This password reset link is expired", "mangeonsafrodomain");
            }
        } else {
            $_SESSION["reset_password_faillure_process"] = __("This password reset link is invalid", "mangeonsafrodomain");
        }
        if (isset($_SESSION["reset_password_faillure_process"])) {
            get_header();

            include(locate_template('users-pages/content-reset-password-error-page.php'));

            get_footer();
        }
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('customer-zone', 'mangeonsafrodomain'))->ID));
        exit;
    }
} else {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['current_password']) && isset($_POST['new_password']) && $_POST['current_password']!="" && $_POST['new_password']!="") {
            $user = get_user_by('id', get_current_user_id());
            $user_login = $current_user->data->user_login;
            $current_password = esc_attr($_POST['current_password']);
            $new_password = esc_attr($_POST['new_password']);
            if ($user && wp_check_password($current_password, $user->data->user_pass, $user->ID)) {
                mangeonsafro_reset_password($user_login, $new_password);
            } else {
                $_SESSION["reset_password_faillure_process"] = __("The current password provided is not correct. Please check it out and try again", "mangeonsafrodomain");
                wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID));
                exit;
            }
        } else {
            $_SESSION["reset_password_faillure_process"] = __("Some data is missing. Check your form and try again", "mangeonsafrodomain");
            wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID));
            exit;
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID));
        exit;
    }
}


