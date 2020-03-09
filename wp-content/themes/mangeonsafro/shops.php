<?php

/*
  Template Name: Shops Page
 */

session_start();
if (is_user_logged_in()) {
    unset($_SESSION['redirect_to']);
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("shops", "mangeonsafrodomain") . "/" . __("new-shop", "mangeonsafrodomain"))->ID)) {
            if (isset($_POST['shop-name']) && $_POST['shop-name'] != "" && isset($_POST['shop-category']) && $_POST['shop-category'] != "" && isset($_POST['shop-city']) && $_POST['shop-city'] != "") {
                $shop_category = removeslashes(esc_attr(trim($_POST['shop-category'])));
                $shop_name = removeslashes(esc_attr(trim($_POST['shop-name'])));
                $shop_description = removeslashes(esc_attr(trim($_POST['shop-description'])));
                $shop_currency_id = intval(removeslashes(esc_attr(trim($_POST['shop-currency-id']))));
                $shop_gplace_city = removeslashes(esc_attr(trim($_POST['shop-city'])));
                $shop_street_number = removeslashes(esc_attr(trim($_POST['shop-street-number'])));
                $shop_street_name = removeslashes(esc_attr(trim($_POST['shop-street-name'])));
                $shop_zip = removeslashes(esc_attr(trim($_POST['shop-zip'])));
                $shop_supplement_address = removeslashes(esc_attr(trim($_POST['shop-supplement-address'])));
                $shop_country_code = removeslashes(esc_attr(trim($_POST['shop-country'])));
                $localisation_data = getCountryRegionCityInformations($shop_gplace_city);
                $shop_city = $localisation_data["city"];
                $shop_region = $localisation_data["region"];
                $shop_country = $localisation_data["country"];
                $post_category = array();
                if ($shop_category){
                    $post_category = getListAllTranslationsOfTerm(get_category_by_slug($shop_category)->term_id);
                }
                $shop_data = array(
                    "shop_name" => $shop_name,
                    "post_category" => $post_category,
                    "shop_description" => $shop_description,
                    "shop_currency_id" => $shop_currency_id,
                    "shop_gplace_city" => $shop_gplace_city,
                    "shop_city" => $shop_city,
                    "shop_region" => $shop_region,
                    "shop_country" => $shop_country,
                    "shop_street_number" => $shop_street_number,
                    "shop_street_name" => $shop_street_name,
                    "shop_zip" => $shop_zip,
                    "shop_supplement_address" => $shop_supplement_address,
                    "shop_country_code" => $shop_country_code,
                    "shop_language" => pll_current_language("slug")
                );
                $shop_id = saveShop($shop_data);
                if (!is_wp_error($shop_id)) {
                    $_SESSION['success_process'] = __("Your shop has been published successfully", "mangeonsafrodomain");
                    wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain"). "/" . __("shops", "mangeonsafrodomain"))->ID));
                    exit;
                } else {
                    $_SESSION['faillure_process'] = __("An error occurred while publishing your shop", "mangeonsafrodomain");
                }
            } else {
                $_SESSION['faillure_process'] = __("Some data is missing. Check your form data and try again", "mangeonsafrodomain");
            }
            // Header 
            get_header();
            //Content
            include(locate_template('shops-pages/content-new-shop.php'));
            //Footer 
            get_footer();
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['action']) && $_GET['action'] == 'put-online' && isset($_GET['ID'])) {
            $shop_id = intval(removeslashes(esc_attr(trim($_GET['ID']))));
            $post_author = get_post_field('post_author', $shop_id);
            if (is_user_logged_in()) {
                if (get_current_user_id() == $post_author) {
                    $post_args = array(
                        "ID" => $shop_id,
                        "post_status" => 'publish'
                    );
                    $shop_id = wp_update_post($post_args);
                    if (!is_wp_error($shop_id)) {
                        $_SESSION['success_process'] = __("Your shop has been put online successfully", "mangeonsafrodomain");
                    } else {
                        $_SESSION['faillure_process'] = __("An error occurred while puting your shop online", "mangeonsafrodomain");
                    }
                } else {
                    $_SESSION['warning_process'] = __("You don't have a premission to edit this shop", "mangeonsafrodomain");
                }
                wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain'). "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("shops", "mangeonsafrodomain"))->ID));
                exit;
            } else {
                $_SESSION['redirect_to'] = esc_url(add_query_arg(array('action' => 'put-online', 'ID' => $shop_id), wp_make_link_relative(get_the_permalink())));
                wp_safe_redirect(get_permalink(get_page_by_path(__('customer-zone', 'mangeonsafrodomain'))->ID));
                exit;
            }
        } elseif (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['ID'])) {
            $shop_id = intval(removeslashes(esc_attr(trim($_GET['ID']))));
            $post_author = get_post_field('post_author', $shop_id);
            if (is_user_logged_in()) {
                if (get_current_user_id() == $post_author) {
                    $deleted_shop = wp_delete_post($shop_id, true);
                    if (!is_wp_error($deleted_shop)) {
                        $_SESSION['success_process'] = __("Your shop has been put deleted successfully", "mangeonsafrodomain");
                    } else {
                        $_SESSION['faillure_process'] = __("An error occurred while deleting your shop", "mangeonsafrodomain");
                    }
                } else {
                    $_SESSION['warning_process'] = __("You don't have a premission to delete this shop", "mangeonsafrodomain");
                }
                wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain"). "/" . __("shops", "mangeonsafrodomain"))->ID));
                exit;
            } else {
                $_SESSION['redirect_to'] = esc_url(add_query_arg(array('action' => 'delete'), wp_make_link_relative(get_the_permalink())));
                wp_safe_redirect(get_permalink(get_page_by_path(__('customer-zone', 'mangeonsafrodomain'))->ID));
                exit;
            }
        }
        // Header 
        get_header();
        //Content
        if (is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("shops", "mangeonsafrodomain"))->ID)) {
            $params_arg = array();
            $query_args = array('post_type' => 'shops_cpt', 'posts_per_page' => 12, "post_status" => array('publish', 'trash'), 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id());
            if (isset($_GET['num-page']) && $_GET['num-page'] != "") {
                $num_page = intval(removeslashes(esc_attr(trim($_GET['num-page']))));
                $query_args["paged"] = $num_page;
            } else {
                $num_page = 1;
            }
            $shops = new WP_Query($query_args);
            $total_post_pages = $shops->max_num_pages;
            $page_link = get_permalink();
            include(locate_template('shops-pages/content-shops.php'));
        } elseif (is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain"). "/" . __("shops", "mangeonsafrodomain") . "/" . __("new-shop", "mangeonsafrodomain"))->ID)) {
            include(locate_template('shops-pages/content-new-shop.php'));
        }
        if (isset($_SESSION['save_success_message'])) {
            unset($_SESSION['save_success_message']);
        } elseif (isset($_SESSION['save_error_message'])) {
            unset($_SESSION['save_error_message']);
        }
        //Footer 
        get_footer();
    }
} else {
    $_SESSION['redirect_to'] = wp_make_link_relative(get_the_permalink());
    $_SESSION['warning_process'] = __("Log in to publish your shop", "mangeonsafrodomain");
    wp_safe_redirect(get_permalink(get_page_by_path(__('customer-zone', 'mangeonsafrodomain'))->ID));
    exit;
}    