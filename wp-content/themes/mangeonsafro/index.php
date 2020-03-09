<?php

session_start();
wp_reset_postdata();
/*
  Template Name: Home Page
 */
if (is_user_logged_in() && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['logout']) && esc_attr($_GET['logout']) == 'true') {
    wp_logout();
    wp_safe_redirect(home_url('/'));
    exit;
}

//Function to redirect to a right language url after selection.
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['lang'])) {
//    if (isset($_GET['url'])) {
//        wp_safe_redirect($_GET['url']);
//    } else {
        wp_safe_redirect(home_url('/'));
//    }
    exit;
}

// Header 
get_header();
//Content
get_template_part('statics-pages/content-index');
//Footer 
get_footer();
