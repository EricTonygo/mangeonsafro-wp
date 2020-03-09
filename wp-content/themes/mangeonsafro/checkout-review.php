<?php

/*
  Template Name: Checkout Review Page
 */
session_start();
$cart = array();
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
} elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['confirmed-order']) && $_GET['confirmed-order'] == "true") {
        wp_safe_redirect(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('confirmation', 'mangeonsafrodomain'))->ID));
        exit;
    }
}
// Header 
get_header();
//Content
include(locate_template('statics-pages/content-checkout.php'));
//Footer 
get_footer();
