<?php

session_start();
wp_reset_postdata();
$author = null;
$search_keyword= null;
$product_category = null;
$product_subject = null;
$product_state = null;
$product_city = null;
$params_arg = array();
$posts_per_page = 12;
if(isset($_GET["posts-per-page"]) && $_GET["posts-per-page"]!=""){
    $posts_per_page = intval(removeslashes(esc_attr(trim($_GET['posts-per-page']))));
    $params_arg["posts-per-page"] = $posts_per_page;
}
$query_args = array('post_type' => 'products_cpt', 'posts_per_page' =>$posts_per_page, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC');

if(isset($_GET["q"])){
    $search_keyword = removeslashes(esc_attr(trim($_GET['q'])));
    $query_args["s"] = $search_keyword;
}

if (isset($_GET['post-user']) && $_GET['post-user'] != "") {
    $post_user = removeslashes(esc_attr(trim($_GET['post-user'])));
    $user = get_user_by('login', $post_user);
    $author = $user->ID;
    $query_args["author"] = $author;
    $user_mangeonsafro = $user->data->user_login;
    $user_display_name = $user->data->display_name; 
    $params_arg["post-user"]= $user_mangeonsafro;
}

if (isset($_GET['page']) && $_GET['page']!= "") {
    $num_page = intval(removeslashes(esc_attr(trim($_GET['page']))));
    $query_args["paged"] = $num_page;
}else{
    $num_page = 1;
}

if (isset($_GET['product-category']) && $_GET['product-category']!= "") {
    $product_category = removeslashes(esc_attr(trim($_GET['product-category'])));
    $query_args["category_name"] = $product_category;
    $params_arg["product-category"] = $product_category;
}

if (isset($_GET['product-subject']) && $_GET['product-subject']!= "") {
    $product_subject_slug = removeslashes(esc_attr(trim($_GET['product-subject'])));
    $query_args["tax_query"] = array(
        array(
            "taxonomy" => 'product_subject',
            "field" => "slug",
            "terms" => $product_subject_slug
        )
    );
    $params_arg["product-subject"] = $product_subject_slug;
}

if (isset($_GET['product-state']) && $_GET['product-state'] != "") {
    $product_state_slug = removeslashes(esc_attr(trim($_GET['product-state'])));
    $query_args["tax_query"] = array(
        array(
            "taxonomy" => 'product_state',
            "field" => "slug",
            "terms" => $product_state_slug
        )
    );
    $params_arg["product-state"] = $product_state_slug;
}

if (isset($_GET['product-city']) && $_GET['product-city'] != "") {
    $product_city = removeslashes(esc_attr(trim($_GET['product-city'])));
    $query_args["meta_query"] = array(
        'relation' => 'OR',
        array(
            "key" => 'product-city',
            "value" => $product_city,
            "compare" => 'LIKE'
        ),
        array(
            "key" => 'product-google-places-city',
            "value" => $product_city,
            "compare" => 'LIKE'
        )
    );
    $params_arg["product-city"] = $product_city;
}
if (isset($_GET['shop']) && $_GET['shop'] != "") {
    $shop_id = intval(removeslashes(esc_attr(trim($_GET['shop']))));
    $query_args["meta_query"] = array(
        array(
            "key" => 'shop-id',
            "value" => $shop_id,
            "compare" => '='
        )
    );
    $params_arg["shop"] = $shop_id;
    $shop = get_post($shop_id);
}
$products = new WP_Query($query_args);
$total_post_pages = $products->max_num_pages;
$page_link = get_post_type_archive_link( 'products_cpt' );
// Header 
get_header();
//Content
include(locate_template('products-pages/content-archive-products_cpt.php'));
//Footer 
get_footer();


