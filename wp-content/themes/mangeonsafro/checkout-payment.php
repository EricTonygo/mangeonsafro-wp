<?php

/*
  Template Name: Checkout Payment Page
 */
session_start();
$cart = array();
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['card_name']) && $_POST['card_name'] != "" && isset($_POST['card_number']) && $_POST['card_number'] != "" && isset($_POST['card_expiry_date']) && $_POST['card_expiry_date'] != "" 
            && isset($_POST['card_cvv']) && $_POST['card_cvv'] != "" && isset($_POST['card_zip']) && $_POST['card_zip'] != ""){
        $card_name = removeslashes(esc_attr(trim($_POST['card_name'])));
        $card_number = removeslashes(esc_attr(trim($_POST['card_number'])));
        $card_expiry_date = removeslashes(esc_attr(trim($_POST['card_expiry_date'])));
        $card_cvv = removeslashes(esc_attr(trim($_POST['card_cvv'])));
        $card_zip = removeslashes(esc_attr(trim($_POST['card_zip'])));
        $orders["payment_method"] = 1;
        $orders["payment_card"] = array(
            "card_name" => $card_name,
            "card_number" => $card_number,
            "card_expiry_date" => $card_expiry_date,
            "card_cvv" => $card_cvv,
            "card_zip" => $card_zip,
        );
        $_SESSION["orders"] = $orders;
        wp_safe_redirect(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('review-checkout', 'mangeonsafrodomain'))->ID));
    exit;
    }elseif (isset($_POST['payment_method']) && $_POST['payment_method'] != ""){
        $payment_method = intval(removeslashes(esc_attr(trim($_POST['payment_method']))));
        $orders["payment_method"] = $payment_method;
        $_SESSION["orders"] = $orders;
        wp_safe_redirect(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('review-checkout', 'mangeonsafrodomain'))->ID));
    exit;
    }else{
        wp_safe_redirect(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('payment', 'mangeonsafrodomain'))->ID));
        exit;
    }
    
}
// Header 
get_header();
//Content
include(locate_template('statics-pages/content-checkout.php'));
//Footer 
get_footer();
