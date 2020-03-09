<?php

/*
  Template Name: Checkout Address Page
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
    if (isset($_POST['fullname_invoice']) && $_POST['fullname_invoice'] != "" && isset($_POST['emailaddres_invoice']) && $_POST['emailaddres_invoice'] != "" && isset($_POST['street_invoice']) && $_POST['street_invoice'] != "" && isset($_POST['city_invoice']) && $_POST['city_invoice'] != "" && isset($_POST['zip_invoice']) && $_POST['zip_invoice'] != "" && isset($_POST['state_invoice']) && $_POST['state_invoice'] != "" && isset($_POST['phonenumber_invoice']) && $_POST['phonenumber_invoice'] != "") {
        $fullname_invoice = removeslashes(esc_attr(trim($_POST['fullname_invoice'])));
        $emailaddres_invoice = removeslashes(esc_attr(trim($_POST['emailaddres_invoice'])));
        $street_invoice = removeslashes(esc_attr(trim($_POST['street_invoice'])));
        $city_invoice = removeslashes(esc_attr(trim($_POST['city_invoice'])));
        $zip_invoice = removeslashes(esc_attr(trim($_POST['zip_invoice'])));
        $state_invoice = removeslashes(esc_attr(trim($_POST['state_invoice'])));
        $phonenumber_invoice = removeslashes(esc_attr(trim($_POST['phonenumber_invoice'])));
        $orders["invoice_address"] = array(
            "fullname_invoice" => $fullname_invoice,
            "emailaddres_invoice" => $emailaddres_invoice,
            "city_invoice" => $city_invoice,
            "zip_invoice" => $zip_invoice,
            "state_invoice" => $state_invoice,
            "phonenumber_invoice" => $phonenumber_invoice
        );

        if (isset($_POST['phonenumber_invoice']) && $_POST['phonenumber_invoice'] != "") {
            $show_shipping_address = removeslashes(esc_attr(trim($_POST['show_shipping_address'])));
            if ($show_shipping_address == true) {
                $street_shipping = removeslashes(esc_attr(trim($_POST['street_shipping'])));
                $city_shipping = removeslashes(esc_attr(trim($_POST['city_shipping'])));
                $zip_shipping = removeslashes(esc_attr(trim($_POST['zip_shipping'])));
                $state_shipping = removeslashes(esc_attr(trim($_POST['state_shipping'])));
                $phonenumber_shipping = removeslashes(esc_attr(trim($_POST['phonenumber_shipping'])));
                $orders["invoice_address"] = array(
                    "street_shipping" => $street_shipping,
                    "city_shipping" => $city_shipping,
                    "zip_shipping" => $zip_shipping,
                    "state_shipping" => $state_shipping,
                    "phonenumber_shipping" => $phonenumber_shipping
                );
            }
        }

        $_SESSION["orders"] = $orders;
        wp_safe_redirect(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('delivery', 'mangeonsafrodomain'))->ID));
        exit;
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID));
        exit;
    }
} 
// Header 
get_header();
//Content
include(locate_template('statics-pages/content-checkout.php'));
//Footer 
get_footer();
