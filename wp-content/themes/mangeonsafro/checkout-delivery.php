<?php

/*
  Template Name: Checkout Delivery Page
 */
session_start();
$cart = array();
$orders = array();
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
if (isset($_SESSION['orders']) && !empty($_SESSION['orders'])) {
    $orders = $_SESSION['orders'];
}
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['shippping_method']) && $_POST['shippping_method'] != ""){
        $shippping_method = intval(removeslashes(esc_attr(trim($_POST['shippping_method']))));
        $orders["shippping_method"] = $shippping_method;
        $_SESSION["orders"] = $orders;
        wp_safe_redirect(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('payment', 'mangeonsafrodomain'))->ID));
        exit;
    }else{
        wp_safe_redirect(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('delivery', 'mangeonsafrodomain'))->ID));
        exit;
    }
    
} 
// Header 
get_header();
//Content
include(locate_template('statics-pages/content-checkout.php'));
//Footer 
get_footer();