<?php

session_start();
wp_reset_postdata();
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "add-comment" && isset($_POST["post_id"])) {
        global $current_user;
        $post_id = intval(removeslashes(esc_attr(trim($_POST['post_id']))));
        $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
        $comment_parent = 0;
        if (!is_user_logged_in()) {
            $comment_author = removeslashes(esc_attr(trim($_POST['comment_author'])));
            $comment_author_email = removeslashes(esc_attr(trim($_POST['comment_author_email'])));
            $comment_author_url = 'http://www.mangeonsafro.com';
            $user_id = -1;
        } else {
            $comment_author = $current_user->user_login;
            $comment_author_email = $current_user->user_email;
            $comment_author_url = 'http://www.mangeonsafro.com';
            $user_id = $current_user->ID;
        }
        $comment_data = array(
            'comment_post_ID' => $post_id,
            'comment_author' => $comment_author,
            'comment_author_email' => $comment_author_email,
            'comment_author_url' => $comment_author_url,
            'comment_content' => $comment_content,
            'comment_parent' => $comment_parent,
            'user_id' => $user_id
        );
        $comment_id = add_post_comment($comment_data);
        if ($comment_id == null || is_wp_error($comment_id)) {
            $json = array("message" => __("Unable to add comment to this post", "mangeonsafrodomain"));
            return wp_send_json_error($json);
        }
        $json = array("message" => __("Comment added successfully", "mangeonsafrodomain"));
        return wp_send_json_success($json);
    } elseif (isset($_POST['send-message']) && $_POST['send-message'] == "yes") {
        if (isset($_POST['username']) && $_POST['username'] != "" && isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['country-code']) && $_POST['country-code'] != "" && isset($_POST['phone-number']) && $_POST['phone-number'] != "" && isset($_POST['message']) && $_POST['message'] != "" && isset($_POST['post-id']) && $_POST['post-id'] != "") {
            $username = removeslashes(esc_attr(trim($_POST['username'])));
            $email = removeslashes(esc_attr(trim($_POST['email'])));
            $phone_number = removeslashes(esc_attr(trim($_POST['country-code']))) . removeslashes(esc_attr(trim($_POST['phone-number'])));
            $message_content = removeslashes(esc_attr(trim($_POST['message'])));
            $post_id = intval(removeslashes(esc_attr(trim($_POST['post-id']))));
            //$message_title = "message of " . $email . " for " . get_post_field('post_title', $post_id);
            $message_data = array(
                "message_content" => $message_content,
                "user_name" => $username,
                "user_email" => $email,
                "user_phone_number" => $phone_number,
                "post_id" => $post_id
            );
            $send_message_id = saveMessage($message_data);
            if (!is_wp_error($send_message_id)) {
                $_SESSION['success_process'] = __("Your message has been sent successfully", "mangeonsafrodomain");
                send_email_new_message_for_shop($send_message_id);
            } else {
                $_SESSION['faillure_process'] = __("An error occurred while sending your message", "mangeonsafrodomain");
            }
            wp_safe_redirect(get_permalink());
            exit;
        } else {
            $_SESSION['faillure_process'] = __("Some data is missing while sending a message. Check and Try again", "mangeonsafrodomain");
        }
    } elseif (is_user_logged_in() && is_singular("shops_cpt")) {
        $post_author = get_post_field('post_author', get_the_ID());
        if ($post_author == get_current_user_id()) {
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
                if ($shop_category) {
                    $post_category = getListAllTranslationsOfTerm(get_category_by_slug($shop_category)->term_id);
                }
                $shop_data = array(
                    "ID" => get_the_ID(),
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
                $shop_id = updateShop($shop_data);
//                $shop_id = init_currency_db();
                if (!is_wp_error($shop_id)) {
                    $_SESSION['success_process'] = __("Your modifications have been saved successfully", "mangeonsafrodomain");
                    wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("shops", "mangeonsafrodomain"))->ID));
                    exit;
                } else {
                    $_SESSION['faillure_process'] = __("An error occurred while editing your shop", "mangeonsafrodomain");
                }
            } else {
                $_SESSION['faillure_process'] = __("Some data is missing. Check your form data and try again", "mangeonsafrodomain");
            }
        } else {
            $_SESSION['warning_process'] = __("You don't have a premission to edit this shop", "mangeonsafrodomain");
            wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("profile", "mangeonsafrodomain"))->ID));
            exit;
        }
        // Header 
        get_header();
        //Content
        include(locate_template('shops-pages/content-single-shop-edit.php'));
        //Footer 
        get_footer();
    } else {
        wp_safe_redirect(get_permalink(get_page_by_path(__("customer-zone", "mangeonsafrodomain"))->ID));
        exit;
    }
} elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $post_author = get_post_field('post_author', get_the_ID());
    if (isset($_GET['action']) && $_GET['action'] == 'put-offline') {
        if (is_user_logged_in()) {
            if (get_current_user_id() == $post_author) {
                $post_args = array(
                    "ID" => get_the_ID(),
                    "post_status" => 'trash'
                );
                $shop_id = wp_update_post($post_args);
                if (!is_wp_error($shop_id)) {
                    $_SESSION['success_process'] = __("Your shop has been put offline successfully", "mangeonsafrodomain");
                } else {
                    $_SESSION['faillure_process'] = __("An error occurred while puting your shop offline", "mangeonsafrodomain");
                }
            } else {
                $_SESSION['warning_process'] = __("You don't have a premission to edit this shop", "mangeonsafrodomain");
                wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("profile", "mangeonsafrodomain"))->ID));
                exit;
            }
            wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("shops", "mangeonsafrodomain"))->ID));
            exit;
        } else {
            $_SESSION['redirect_to'] = esc_url(add_query_arg(array('action' => 'put-offline'), wp_make_link_relative(get_the_permalink())));
            wp_safe_redirect(get_permalink(get_page_by_path(__("customer-zone", "mangeonsafrodomain"))->ID));
            exit;
        }
    } else {
        // Header 
        get_header();
        //Content
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        $current_user_email = $current_user->user_email;
        $current_user_first_name = $current_user->first_name;
        $current_user_last_name = $current_user->last_name;
        $current_user_country_code = get_user_meta($user_id, "user-country-code", true);
        $current_user_phone_number = get_user_meta($user_id, "user-phone-number", true);

        $shop = get_post(get_the_ID());
        $post_category = array_map('intval', wp_get_post_categories(get_the_ID(), array("fields" => "ids")));
        $shop_name = get_the_title();
        $shop_description = get_the_content();
        $shop_city_google_map = get_post_meta(get_the_ID(), 'shop-google-places-city', true);
        $shop_city = get_post_meta(get_the_ID(), 'shop-city', true);
        $shop_country = get_post_meta(get_the_ID(), 'shop-country', true);
        $shop_type_barter = get_post_meta(get_the_ID(), 'shop-region', true);
        $shop_views = get_post_meta(get_the_ID(), "shop-views", true) ? get_post_meta(get_the_ID(), "shop-views", true) : 0;
        $all_post_categories = wp_get_post_categories(get_the_ID(), array('fields' => 'ids'));
        $featured_category_id = get_category_by_slug(__('featured', 'mangeonsafrodomain'))->term_id;
        $translated_featured_category_id = pll_get_term($featured_category_id, getOppositeLanguage());
        $post_categories = array_diff($all_post_categories, array($featured_category_id, $translated_featured_category_id));
        $single_shop_id = get_the_ID();
        $shop_currency_id = get_post_meta(get_the_ID(), 'shop-currency-id', true);
        $params_arg_products = array();
        $query_args_products = array('post_type' => 'products_cpt', 'posts_per_page' => 5, "post_status" => array('publish', 'trash'), 'orderby' => 'post_date', 'order' => 'DESC');
        if (isset($_GET['num-page-product']) && $_GET['num-page-product'] != "") {
            $num_page_products = intval(removeslashes(esc_attr(trim($_GET['num-page']))));
            $query_args_products["paged"] = $num_page_products;
        } else {
            $num_page_products = 1;
        }
        $query_args_products["meta_query"] = array(
            array(
                "key" => 'shop-id',
                "value" => $single_shop_id,
                "compare" => '='
            )
        );
        $products = new WP_Query($query_args_products);
        $total_post_products_pages = $products->max_num_pages;
        $page_link_products = get_permalink();
        if (isset($_GET['action']) && $_GET['action'] == "edit" && is_user_logged_in() && $post_author == get_current_user_id()) {
            include(locate_template('shops-pages/content-single-shop-edit.php'));
        } elseif (isset($_GET['action']) && $_GET['action'] == "list-products" && is_user_logged_in() && $post_author == get_current_user_id()) {
            include(locate_template('shops-pages/content-single-shop-list-products.php'));
        } elseif (isset($_GET['action']) && $_GET['action'] == "add-product" && is_user_logged_in() && $post_author == get_current_user_id()) {
            $shop_id = $single_shop_id;
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
        } elseif (isset($_GET['action']) && $_GET['action'] == "edit-product" && is_user_logged_in() && $post_author == get_current_user_id()) {
            include(locate_template('shops-pages/content-single-shop-edit-products.php'));
        } else {
            if ($post_author != get_current_user_id()) {
                //updateShopView(get_the_ID());
            }

            include(locate_template('shops-pages/content-single-shop-details.php'));
        }
        //Footer 
        get_footer();
    }
}
   

