<?php

/*
  Template Name:  Contents Categories
 */

// Header 
get_header();
//Content
if (cat_is_ancestor_of(get_category_by_slug(__('actualites-conseils', 'mangeonsafrodomain'))->term_id, get_category(get_query_var('cat'))->term_id)) {
    $query_args = array('posts_per_page' => 12, "post_status" => 'publish', 'orderby' => 'post_date', 'category_name' => get_category(get_query_var('cat'))->slug, 'order' => 'DESC');
    if (isset($_GET['num-page']) && $_GET['num-page'] != "") {
        $num_page = intval(removeslashes(esc_attr(trim($_GET['num-page']))));
        $query_args["paged"] = $num_page;
    } else {
        $num_page = 1;
    }
    $params_arg = array();
    $category_posts = new WP_Query($query_args);
    $total_post_pages = $category_posts->max_num_pages;
    $page_link = get_permalink();
    include(locate_template('blog/content-post-category-page.php'));
} else {
    $params_arg = array();
    $posts_per_page = 12;
    if (isset($_GET["posts-per-page"]) && $_GET["posts-per-page"] != "") {
        $posts_per_page = intval(removeslashes(esc_attr(trim($_GET['posts-per-page']))));
        $params_arg["posts-per-page"] = $posts_per_page;
    }
    $query_args = array('posts_per_page' => $posts_per_page, "post_status" => 'publish', 'category_name' => get_category(get_query_var('cat'))->slug, 'orderby' => 'post_date', 'order' => 'DESC');
    if (isset($_GET['post-type']) && $_GET['post-type'] == "shops") {
        $pub_type = "shops";
        $query_args["post_type"] = "shops_cpt";
        $params_arg["post-type"] = "shops";
    } else {
        $pub_type = "products";
        $query_args["post_type"] = "products_cpt";
//        $params_arg["post-type"] = "products";
    }


    if (isset($_GET['post-user']) && $_GET['post-user'] != "") {
        $post_user = removeslashes(esc_attr(trim($_GET['post-user'])));
        $user = get_user_by('login', $post_user);
        $author = $user->ID;
        $query_args["author"] = $author;
        $user_bookstore = $user->data->user_login;
        $params_arg["post-user"] = $user_bookstore;
    }

    if (isset($_GET['page']) && $_GET['page'] != "") {
        $num_page = intval(removeslashes(esc_attr(trim($_GET['page']))));
        $query_args["paged"] = $num_page;
    } else {
        $num_page = 1;
    }

    if (cat_is_ancestor_of(get_category_by_slug(__('textbooks', 'mangeonsafrodomain'))->term_id, get_category(get_query_var('cat'))->term_id) && isset($_GET['product-subject']) && $_GET['product-subject'] != "") {
        $product_subject_slug = removeslashes(esc_attr(trim($_GET['product-subject'])));
        $query_args["tax_query"] = array(
            array(
                "taxonomy" => 'product_subject',
                "field" => "slug",
                "terms" => array($product_subject_slug)
            )
        );
        $params_arg["product-subject"] = $product_subject_slug;
    }

    if (isset($_GET['product-state']) && $_GET['product-state'] != "") {
        $product_state_slug = removeslashes(esc_attr(trim($_GET['product-state'])));
        if ($product_subject_slug) {
            $query_args["tax_query"] = array(
                "relation" => "AND",
                array(
                    "taxonomy" => 'product_subject',
                    "field" => "slug",
                    "terms" => array($product_subject_slug)
                ),
                array(
                    "taxonomy" => 'product_state',
                    "field" => "slug",
                    "terms" => array($product_state_slug)
                )
            );
        } else {
            $query_args["tax_query"] = array(
                array(
                    "taxonomy" => 'product_state',
                    "field" => "slug",
                    "terms" => array($product_state_slug)
                )
            );
        }
        $params_arg["product-state"] = $product_state_slug;
    }

    if (isset($_GET['product-city']) && $_GET['product-city'] != "") {
        $product_city = removeslashes(esc_attr(trim($_GET['product-city'])));
        if (isset($_GET['product-type']) && $_GET['product-type'] == "shops") {
            $query_args["meta_query"] = array(
                'relation' => 'OR',
                array(
                    "key" => 'shop-city',
                    "value" => $product_city,
                    "compare" => 'LIKE'
                ),
                array(
                    "key" => 'shop-google-places-city',
                    "value" => $product_city,
                    "compare" => 'LIKE'
                )
            );
        } else {
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
        }
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
    $page_link = get_category_link(get_category(get_query_var('cat'))->term_id);
    if (isset($_GET['post-type']) && $_GET['post-type'] == "shops") {
        include(locate_template('shops-pages/content-archive-shops_cpt.php'));
    } else {
        include(locate_template('products-pages/content-archive-products_cpt.php'));
    }
}
//Footer 
get_footer();
