<?php

/*
  Template Name: Forgot Password Page
 */
session_start();
if (!is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['email'] != "" && $_POST['email'] != "") {
            if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] != "" && verify_use_grecaptcha($_POST['g-recaptcha-response'])) {
                $user_email = removeslashes(esc_attr(trim($_POST['email'])));
                $user = get_user_by('email', $user_email);
                if ($user != null) {
                    if (send_reset_password_link($user_email)) {
                        $_SESSION['success_process'] = __("We sent you a reset passwork link. Please check your inbox and click on the secure link", "mangeonsafrodomain");
                    } else {
                        $_SESSION['faillure_process'] = __("An error occured while sending reset password link. Please correct your email and try again", "mangeonsafrodomain");
                    }
                    get_header();
                    include(locate_template('users-pages/content-forgot-password-response-page.php'));
                    get_footer();
                } else {
                    $_SESSION['faillure_process'] = __("Unknown user e-mail address", "mangeonsafrodomain");
                    wp_safe_redirect(get_the_permalink());
                    exit;
                }
            } else {
                $_SESSION['faillure_process'] = __("We could not verify your security code. Verify it and try again", "mangeonsafrodomain");
                wp_safe_redirect(get_the_permalink());
                exit;
            }
        } else {
                $_SESSION['faillure_process'] = __("Please enter your email address", "mangeonsafrodomain");
                wp_safe_redirect(get_the_permalink());
                exit;
            }
    } else {
        get_header();

        include(locate_template('users-pages/content-forgot-password-page.php'));

        get_footer();
    }
} else {
    wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain'))->ID));
    exit;
}


