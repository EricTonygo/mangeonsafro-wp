<?php

/*
  Template Name: Products Page
 */
session_start();
if (is_user_logged_in()) {
    unset($_SESSION['redirect_to']);
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain") . "/" . __("new-product", "mangeonsafrodomain"))->ID)) {
            if (isset($_POST['product-name']) && $_POST['product-name'] != "" && isset($_POST['product-category']) && $_POST['product-category'] != "" && isset($_POST['product-city']) && $_POST['product-city'] != "" && isset($_POST['shop-id']) && $_POST['shop-id'] != "") {
                $prod_category = removeslashes(esc_attr(trim($_POST['product-category'])));
                $prod_sub_category = removeslashes(esc_attr(trim($_POST['product-sub-category'])));
                $prod_name = removeslashes(esc_attr(trim($_POST['product-name'])));
                $prod_price = floatval(removeslashes(esc_attr(trim($_POST['product-price']))));
                $prod_delete_price = floatval(removeslashes(esc_attr(trim($_POST['product-delete-price']))));
                $prod_currency_id = intval(removeslashes(esc_attr(trim($_POST['product-currency-id']))));
                $prod_description = removeslashes(esc_attr(trim($_POST['product-description'])));
                $prod_brief_description = removeslashes(esc_attr(trim($_POST['product-brief-description'])));
                $prod_additional_informations = removeslashes(esc_attr(trim($_POST['product-additional-informations'])));
                $prod_gplace_city = removeslashes(esc_attr(trim($_POST['product-city'])));
                $localisation_data = getCountryRegionCityInformations($prod_gplace_city);
                $prod_city = $localisation_data["city"];
                $prod_region = $localisation_data["region"];
                $prod_country = $localisation_data["country"];
                $shop_id = intval(removeslashes(esc_attr(trim($_POST['shop-id']))));
                $prod_thumbnail_image = $_FILES['product-thumbnail-image'];
                if (is_array($prod_thumbnail_image) && $_FILES['product-thumbnail-image']['error'] == 0) {
                    $prod_thumbnail_image_id = upload_file($prod_thumbnail_image);
                } else {
                    $prod_thumbnail_image_id = removeslashes(esc_attr(trim($_POST['product-thumbnail-image-id'])));
                }
                $post_category = array();
                $post_sub_category = array();
                if ($prod_category) {
                    $post_category = getListAllTranslationsOfTerm(get_category_by_slug($prod_category)->term_id);
                }
                if ($prod_sub_category) {
                    $post_sub_category = getListAllTranslationsOfTerm(get_category_by_slug($prod_sub_category)->term_id);
                    $post_category = array_merge($post_category, $post_sub_category);
                }
                $all_shop_categories = wp_get_post_categories($shop_id, array('fields' => 'ids'));
                if ($all_shop_categories) {
                    foreach ($all_shop_categories as $shop_category) {
                        $post_category = array_merge($post_category, getListAllTranslationsOfTerm(get_category_by_slug($shop_category)->term_id));
                    }
                }
                $prod_data = array(
                    "product_name" => $prod_name,
                    "product_category" => $prod_category,
                    "product_sub_category" => $prod_sub_category,
                    "product_price" => $prod_price,
                    "product_delete_price" => $prod_delete_price,
                    "product_description" => $prod_description,
                    "product_brief_description" => $prod_brief_description,
                    "product_additional_informations" => $prod_additional_informations,
                    "product_thumbnail_image_id" => $prod_thumbnail_image_id,
                    "product_gplace_city" => $prod_gplace_city,
                    "product_city" => $prod_city,
                    "product_region" => $prod_region,
                    "product_country" => $prod_country,
                    "shop_id" => $shop_id,
                    "product_currency_id" => $prod_currency_id,
                    "post_category" => $post_category,
                    "product_language" => pll_current_language("slug")
                );

                $prod_id = saveProduct($prod_data);
                if (!is_wp_error($prod_id)) {
                    $_SESSION['success_process'] = __("Your product has been published successfully", "mangeonsafrodomain");
                    wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain"))->ID));
                    exit;
                } else {
                    $_SESSION['faillure_process'] = __("An error occurred while publishing your product", "mangeonsafrodomain");
                }
            } else {
                $_SESSION['faillure_process'] = __("Some data is missing. Check your form data and try again", "mangeonsafrodomain");
            }
            // Header 
            get_header();
            //Content
            include(locate_template('products-pages/content-new-product.php'));
            //Footer 
            get_footer();
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['action']) && $_GET['action'] == 'put-online' && isset($_GET['ID'])) {
            $prod_id = intval(removeslashes(esc_attr(trim($_GET['ID']))));
            $post_author = get_post_field('post_author', $prod_id);
            if (is_user_logged_in()) {
                if (get_current_user_id() == $post_author) {
                    $post_args = array(
                        "ID" => $prod_id,
                        "post_status" => 'publish'
                    );
                    $product_id = wp_update_post($post_args);
                    if (!is_wp_error($product_id)) {
                        $_SESSION['success_process'] = __("Your product has been put online successfully", "mangeonsafrodomain");
                    } else {
                        $_SESSION['faillure_process'] = __("An error occurred while puting your product online", "mangeonsafrodomain");
                    }
                } else {
                    $_SESSION['warning_process'] = __("You don't have a premission to edit this product", "mangeonsafrodomain");
                }
                wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain"))->ID));
                exit;
            } else {
                $_SESSION['redirect_to'] = esc_url(add_query_arg(array('action' => 'put-online', 'ID' => $prod_id), wp_make_link_relative(get_the_permalink())));
                wp_safe_redirect(get_permalink(get_page_by_path(__("custmer-zone", "mangeonsafrodomain"))->ID));
                exit;
            }
        } elseif (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['ID'])) {
            $prod_id = intval(removeslashes(esc_attr(trim($_GET['ID']))));
            $post_author = get_post_field('post_author', $prod_id);
            if (is_user_logged_in()) {
                if (get_current_user_id() == $post_author) {
                    $deleled_product = wp_delete_post($prod_id, true);
                    if ($deleled_product) {
                        $_SESSION['success_process'] = __("Your product has been deleted successfully", "mangeonsafrodomain");
                    } else {
                        $_SESSION['faillure_process'] = __("An error occurred while deleting your product", "mangeonsafrodomain");
                    }
                } else {
                    $_SESSION['warning_process'] = __("You don't have a premission to delete this product", "mangeonsafrodomain");
                }
                wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain"))->ID));
                exit;
            } else {
                $_SESSION['redirect_to'] = esc_url(add_query_arg(array('action' => 'delete'), wp_make_link_relative(get_the_permalink())));
                wp_safe_redirect(get_permalink(get_page_by_path(__("custmer-zone", "mangeonsafrodomain"))->ID));
                exit;
            }
        } else {
            // Header 
            get_header();
            //Content
            if (is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain"))->ID)) {
                $params_arg = array();
                $query_args = array('post_type' => 'products_cpt', 'posts_per_page' => 12, "post_status" => array('publish', 'trash'), 'orderby' => 'post_date', 'order' => 'DESC');
                if (isset($_GET['num-page']) && $_GET['num-page'] != "") {
                    $num_page = intval(removeslashes(esc_attr(trim($_GET['num-page']))));
                    $query_args["paged"] = $num_page;
                } else {
                    $num_page = 1;
                }
                if (isset($_GET['shop-id']) && $_GET['shop-id'] != "") {
                    $shop_id = intval(removeslashes(esc_attr(trim($_GET['shop-id']))));
                    $prod_shop = get_post($shop_id);
                    $query_args["meta_query"] = array(
                        array(
                            "key" => 'shop-id',
                            "value" => $shop_id,
                            "compare" => '='
                        )
                    );
                } else {
                    $query_args['author'] = get_current_user_id();
                }

                $products = new WP_Query($query_args);
                $total_post_pages = $products->max_num_pages;
                $page_link = get_permalink();
                include(locate_template('products-pages/content-products.php'));
            } elseif (is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain") . "/" . __("new-product", "mangeonsafrodomain"))->ID) && isset($_GET['shop-id']) && $_GET['shop-id'] != "") {
                $shop_id = intval(removeslashes(esc_attr(trim($_GET['shop-id']))));
                $shop_currency_id = get_post_meta($shop_id, 'shop-currency-id', true);
                $prod_currency_id = $shop_currency_id;
                $all_shop_categories = wp_get_post_categories($shop_id, array('fields' => 'ids'));
                $shop_category = null;
                $all_parent_categories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'parent' => 0));
                foreach ($all_parent_categories as $parent_category) {
                    if (is_array($all_shop_categories) && in_array($parent_category->term_id, $all_shop_categories, true)) {
                        $shop_category = $parent_category;
                        break;
                    }
                }

                include(locate_template('products-pages/content-new-product.php'));
            }
            if (isset($_SESSION['save_success_message'])) {
                unset($_SESSION['save_success_message']);
            } elseif (isset($_SESSION['save_error_message'])) {
                unset($_SESSION['save_error_message']);
            }
            //Footer 
            get_footer();
        }
    }
} else {
    $_SESSION['redirect_to'] = wp_make_link_relative(get_the_permalink());
    $_SESSION['warning_process'] = __("Log in to create your product", "mangeonsafrodomain");
    wp_safe_redirect(get_permalink(get_page_by_path(__("custmer-zone", "mangeonsafrodomain"))->ID));
    exit;
}    