<?php

/*
  Template Name: Account Page
*/

if (is_user_logged_in()) {
    unset($_SESSION['redirect_to']);
    wp_safe_redirect(get_permalink(get_page_by_path(__("account", "booksharedomain")."/".__('profile', 'booksharedomain'))));
    exit;
} else {
    $_SESSION['redirect_to'] = wp_make_link_relative(get_the_permalink());
    $_SESSION['warning_process'] = __("You must be logged in to access to your account", "booksharedomain");
    wp_safe_redirect(get_permalink(get_page_by_path(__("login", "booksharedomain"))->ID));
    exit;
}    