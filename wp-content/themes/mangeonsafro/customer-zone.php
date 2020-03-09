<?php

/*
  Template Name: CustomerZone Page
 */
session_start();
if (!is_user_logged_in()) {
// Header 
    get_header();
//Content
    include(locate_template('users-pages/content-customer-zone.php'));
//Footer 
    get_footer();
} else {
    wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID));
    exit;
}