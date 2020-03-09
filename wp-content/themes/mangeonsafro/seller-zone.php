<?php

/*
  Template Name: SellerZone Page
 */
session_start();
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$user_email = $current_user->user_email;
$display_name = $current_user->display_name;
$first_name = $current_user->first_name;
$last_name = $current_user->last_name;
$roles = $current_user->roles;
if (is_user_logged_in()) {
// Header 
    get_header();
//Content
    // List shops
    $params_arg = array();
    $query_args = array('post_type' => 'shops_cpt', 'posts_per_page' => 5, "post_status" => array('publish', 'trash'), 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id());
    if (isset($_GET['num-page']) && $_GET['num-page'] != "") {
        $num_page = intval(removeslashes(esc_attr(trim($_GET['num-page']))));
        $query_args["paged"] = $num_page;
    } else {
        $num_page = 1;
    }
    $shops = new WP_Query($query_args);
    $total_post_pages = $shops->max_num_pages;
    $page_link = get_permalink();

    //List products
    $params_arg_products = array();
    $query_args_products = array('post_type' => 'products_cpt', 'posts_per_page' => 5, "post_status" => array('publish', 'trash'), 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id());
    if (isset($_GET['num-page-product']) && $_GET['num-page-product'] != "") {
        $num_page_products = intval(removeslashes(esc_attr(trim($_GET['num-page']))));
        $query_args_products["paged"] = $num_page_products;
    } else {
        $num_page_products = 1;
    }
    $products = new WP_Query($query_args_products);
    $total_post_products_pages = $products->max_num_pages;
    $page_link_products = get_permalink();
    include(locate_template('users-pages/content-seller-zone.php'));
//Footer 
    get_footer();
} else {
    wp_safe_redirect(get_permalink(get_page_by_path(__('customer-zone', 'mangeonsafrodomain'))->ID));
    exit;
}