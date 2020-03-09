<?php

/*
  Template Name: Activate Account Page
 */
session_start();
//header("Cache-Control", "no-cache, no-store, must-revalidate");

global $current_user;
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['key'])) {
    $user_login = esc_attr(wp_unslash(trim($_GET['id'])));
    $hash = $_GET['key'];
    $user = get_user_by('login', $user_login);
    if ($user) {
        if (get_user_meta($user->ID, 'user-hash', true) == $hash) {
            $user_id = update_user_meta($user->ID, 'user-activated', 2);
            $account_activated = true;
            if (false == $user_id) {
                $_SESSION["warning_process"] = __("Your account is already activated", "mangeonsafrodomain");
            } else {
                if (!is_user_logged_in()) {
                    $_SESSION["success_process"] = __("Your account has been activated successfully", "mangeonsafrodomain") . ". " . __("Log in now to start using our services", "mangeonsafrodomain");
                } else {
                    $_SESSION["success_process"] = __("Your account has been activated successfully", "mangeonsafrodomain");
                }
            }
        } else {
            $_SESSION["faillure_process"] = __("Activation of your account has failed. Some data are incorrect", "mangeonsafrodomain");
        }
    } else {
        $_SESSION["faillure_process"] = __("This user is not register", "mangeonsafrodomain");
    }
    wp_safe_redirect(get_permalink(get_page_by_path(__('login', 'mangeonsafrodomain'))->ID));
    exit;
} else {
    if (!is_user_logged_in()) {
        wp_safe_redirect(get_permalink(get_page_by_path(__('customer-zone', 'mangeonsafrodomain'))->ID));
        exit;
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID));
        exit;
    }
}


