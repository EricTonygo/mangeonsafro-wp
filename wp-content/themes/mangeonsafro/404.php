<?php

/*
  Template Name: 404 Page
 */

//Function to redirect to a right language url after selection.
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['lang'])) {
    if (isset($_GET['url'])) {
        wp_safe_redirect($_GET['url']);
    } else {
        wp_safe_redirect(home_url('/'));
    }
    exit;
}

// Header 
get_header();
//Content
include(locate_template('statics-pages/content-404.php'));
//Footer 
get_footer();
