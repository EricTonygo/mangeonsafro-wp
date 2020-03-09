<?php

/*
  Template Name: Login Page
 */
session_start();
if (!is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password']) && isset($_POST['username'])) {
        if ($_POST['username'] != "" && $_POST['password'] != "") {
            $login = removeslashes(esc_attr(trim($_POST['username'])));
            if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] != "" && verify_use_grecaptcha($_POST['g-recaptcha-response'])) {
                global $current_user;
                $password = $_POST['password'];
                $user_login = null;
                if (filter_var($login, FILTER_VALIDATE_EMAIL) && get_user_by('email', $login)) {
                    $user_login = get_user_by('email', $login);
                    $check_password = wp_check_password($password, $user_login->data->user_pass, $user_login->ID);
                } elseif (get_user_by('login', $login)) {
                    $user_login = get_user_by('login', $login);
                    $check_password = wp_check_password($password, $user_login->data->user_pass, $user_login->ID);
                }

                if ($user_login == null) {
                    $_SESSION['faillure_process'] = __("Unknow user", "mangeonsafrodomain");
                } elseif ($user_login && !$check_password) {
                    $_SESSION['faillure_process'] = __("Incorrect password", "mangeonsafrodomain");
                } elseif ($user_login && $check_password && get_user_meta($user_login->ID, "user-activated", true) == 1) {
                    $_SESSION['faillure_process'] = __("Your account is not activated. Check your e-mail inbox and click on activation link", "mangeonsafrodomain");
                } else {
                    $remember = removeslashes(esc_attr(trim($_POST['_remember'])));
                    if ($remember == 'on') {
                        $remember = true;
                    } else {
                        $remember = false;
                    }
                    $creds = array('user_login' => $user_login->data->user_login, 'user_password' => $password, 'remember' => $remember);
                    $secure_cookie = is_ssl() ? true : false;
                    $user = wp_signon($creds, $secure_cookie);
                    $redirect_to = $_POST['redirect_to'];
                    if ($redirect_to) {
                        wp_safe_redirect($redirect_to);
                    } else {
                        wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID));
                    }
                    exit;
                }
                wp_safe_redirect(get_permalink(get_page_by_path(__("customer-zone", "mangeonsafrodomain"))->ID));
                exit;
            } else {
                $_SESSION['faillure_process'] = __("We could not verify your recaptcha security code. Check it and try again", "mangeonsafrodomain");
                wp_safe_redirect(get_permalink(get_page_by_path(__("customer-zone", "mangeonsafrodomain"))->ID));
                exit;
            }
        } else {
            if ($_POST['username'] == "" && $_POST['password'] == "") {
                $_SESSION['faillure_process'] = __("Enter your username or e-mail and password", "mangeonsafrodomain");
            } elseif ($_POST['username'] == "") {
                $_SESSION['faillure_process'] = __("Enter your username or e-mail", "mangeonsafrodomain");
            } else {
                $_SESSION['faillure_process'] = __("Enter your password", "mangeonsafrodomain");
            }
            wp_safe_redirect(get_permalink(get_page_by_path(__("customer-zone", "mangeonsafrodomain"))->ID));
            exit;
        }
    } else {
        if (isset($_GET['redirect_to'])) {
            $_SESSION['redirect_to'] = removeslashes(esc_attr(trim($_GET['redirect_to'])));
        }
        wp_safe_redirect(get_permalink(get_page_by_path(__("customer-zone", "mangeonsafrodomain"))->ID));
        exit;
    }
} else {
    wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID));
    exit;
}    