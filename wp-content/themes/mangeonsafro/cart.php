<?php

/*
  Template Name: Cart Page
 */
session_start();
$cart = array();
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == "update-item-quantity" && isset($_POST['item-number']) && $_POST['item-number'] != "" && isset($_POST['product-item-quantity']) && $_POST['product-item-quantity'] != "") {
        $i = intval(removeslashes(esc_attr(trim($_POST['item-number']))));
        $product_item_quantity = intval(removeslashes(esc_attr(trim($_POST['product-item-quantity']))));
        if ($product_item_quantity == 0) {
            $_SESSION['faillure_process'] = __("You can not add a product with zero quantity in shopping cart", "mangeonsafrodomain");
        } elseif ($product_item_quantity < 0) {
            $_SESSION['faillure_process'] = __("You can not add a product with negative quantity in shopping cart", "mangeonsafrodomain");
        } else {
            if ($cart[$i]) {
                $cart[$i]["product-item-quantity"] = $product_item_quantity;
                $_SESSION['cart'] = $cart;
            }
        }
        wp_safe_redirect(get_permalink());
        exit;
    } elseif (isset($_POST['product-id']) && $_POST['product-id'] != "" && isset($_POST['product-item-quantity']) && $_POST['product-item-quantity'] != "") {
        $product_id = intval(removeslashes(esc_attr(trim($_POST['product-id']))));
        $product_delivery_mode = removeslashes(esc_attr(trim($_POST['product-delivery-mode'])));
        $product_item_quantity = intval(removeslashes(esc_attr(trim($_POST['product-item-quantity']))));
        $product = get_post($product_id);
        $cart_product_data = array(
            "product-id" => $product_id,
            "product-delivery-mode" => $product_delivery_mode,
            "product-item-quantity" => $product_item_quantity,
        );
        if ($product_item_quantity == 0) {
            $_SESSION['faillure_process'] = __("You can not add a product with zero quantity in shopping cart", "mangeonsafrodomain");
            if ($product) {
                wp_safe_redirect(get_permalink($product->ID));
                exit;
            } else {
                wp_safe_redirect(get_permalink(get_page_by_path(__('our-products', 'mangeonsafrodomain'))->ID));
                exit;
            }
        } elseif ($product_item_quantity < 0) {
            $_SESSION['faillure_process'] = __("You can not add a product with negative quantity in shopping cart", "mangeonsafrodomain");
            if ($product) {
                wp_safe_redirect(get_permalink($product->ID));
                exit;
            } else {
                wp_safe_redirect(get_permalink(get_page_by_path(__('our-products', 'mangeonsafrodomain'))->ID));
                exit;
            }
        } else {
            $i = 0;
            $product_exist_in_cart = false;
            foreach ($cart as $cart_item) {
                if ($cart_item["product-id"] == $product_id) {
                    $product_exist_in_cart = true;
                    break;
                }
                $i++;
            }
            if ($product_exist_in_cart) {
                $cart[$i]["product-item-quantity"] += $product_item_quantity;
            } else {
                $cart[] = $cart_product_data;
            }
            $_SESSION['cart'] = $cart;
        }
        wp_safe_redirect(get_permalink(get_page_by_path(__('cart', 'mangeonsafrodomain'))->ID));
        exit;
    }
} elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['action']) && $_GET['action'] == "delete-item" && isset($_GET['item-number']) && $_GET['item-number'] != "") {
        $item_number = intval(removeslashes(esc_attr(trim($_GET['item-number']))));
        $remaining_cart = array();
        for ($i = 0; $i < count($cart); $i++) {
            if ($i != $item_number) {
                $remaining_cart[] = $cart[$i];
            }
        }

        $_SESSION['cart'] = $remaining_cart;
        wp_safe_redirect(get_permalink(get_page_by_path(__('cart', 'mangeonsafrodomain'))->ID));
        exit;
    }
    $cart_items_count = count($cart);
// Header 
    get_header();
//Content
    include(locate_template('statics-pages/content-cart.php'));
//Footer 
    get_footer();
}
