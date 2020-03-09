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
    } elseif (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "add-comment-reply" && isset($_POST["post_id"]) && isset($_POST["comment_parent_id"])) {
        $post_id = intval(removeslashes(esc_attr(trim($_POST['post_id']))));
        $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
        $comment_parent = intval(removeslashes(esc_attr(trim($_POST['comment_parent_id']))));
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
        $comment_reply_data = array(
            'comment_post_ID' => $post_id,
            'comment_author' => $comment_author,
            'comment_author_email' => $comment_author_email,
            'comment_author_url' => $comment_author_url,
            'comment_content' => $comment_content,
            'comment_parent' => $comment_parent,
            'user_id' => $user_id
        );
        $comment_reply_id = add_comment_reply($comment_reply_data);
        if ($comment_reply_id == null || is_wp_error($comment_reply_id)) {
            $json = array("message" => __("Unable to add response to this comment", "mangeonsafrodomain"));
            return wp_send_json_error($json);
        }
        $json = array("message" => __("Successfully replied", "mangeonsafrodomain"));
        return wp_send_json_success($json);
    } elseif (isset($_POST['send-review']) && $_POST['send-review'] == "yes") {
        if (isset($_POST['username']) && $_POST['username'] != "" && isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['review-mark']) && $_POST['review-mark'] != "" && isset($_POST['review-comment']) && $_POST['review-comment'] != "" && isset($_POST['post-id']) && $_POST['post-id'] != "") {
            $username = removeslashes(esc_attr(trim($_POST['username'])));
            $email = removeslashes(esc_attr(trim($_POST['email'])));
            $review_mark = intval(removeslashes(esc_attr(trim($_POST['review-mark']))));
            $review_content = removeslashes(esc_attr(trim($_POST['review-comment'])));
            $post_id = intval(removeslashes(esc_attr(trim($_POST['post-id']))));
            //$review_title = "review of " . $email . " for " . get_post_field('post_title', $post_id);
            $review_data = array(
                "review_content" => $review_content,
                "user_name" => $username,
                "user_email" => $email,
                "review_mark" => $review_mark,
                "post_id" => $post_id
            );
            $send_review_id = saveReview($review_data);
            if (!is_wp_error($send_review_id)) {
//               
//                send_email_new_review_for_product($send_review_id);
//                $owner_phone_number = trim(get_user_meta(get_post_field('post_author', $post_id), "user-country-code", true) . "" . get_user_meta(get_post_field('post_author', $post_id), "user-phone-number", true), '.');
//                if (is_user_logged_in()) {
//                    $nb_prod_review = get_user_meta(get_current_user_id(), 'user-pub-review-nb', true);
//                    if ($nb_prod_review > 0) {
//                        $result_sms = sendSMS($owner_phone_number, 'Un particulier désire avoir votre livre de réf #' . $post_id . '. Vous pouvez le contacter au : ' . $phone_number . '. Plus de details sur http://mangeonsafro.com.'); //Prevoir le test de souscription à un SMS
//                    } else {
//                        // L'utilisateur ne possède pas assez de sms dans son forfait.
//                    }                   
//                }
                $_SESSION['success_process'] = __("Your review has been sent successfully", "mangeonsafrodomain");
            } else {
                $_SESSION['faillure_process'] = __("An error occurred while sending your review", "mangeonsafrodomain");
            }
            wp_safe_redirect(get_permalink());
            exit;
        } else {
            $_SESSION['faillure_process'] = __("Some data is missing while sending a review. Check and Try again", "mangeonsafrodomain");
        }
    } elseif (is_user_logged_in() && is_singular('products_cpt')) {
        $post_author = get_post_field('post_author', get_the_ID());
        if ($post_author == get_current_user_id()) {
            if (isset($_POST['product-name']) && $_POST['product-name'] != "" && isset($_POST['product-category']) && $_POST['product-category'] != "" && isset($_POST['product-city']) && $_POST['product-city'] != "" && isset($_POST['shop-id']) && $_POST['shop-id'] != "") {
                $prod_category = removeslashes(esc_attr(trim($_POST['product-category'])));
                $prod_sub_category = removeslashes(esc_attr(trim($_POST['product-sub-category'])));
                $prod_name = removeslashes(esc_attr(trim($_POST['product-name'])));
                $prod_price = floatval(removeslashes(esc_attr(trim($_POST['product-price']))));
                $prod_delete_price = floatval(removeslashes(esc_attr(trim($_POST['product-delete-price']))));
                $prod_currency_id = removeslashes(esc_attr(trim($_POST['product-currency-id'])));
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
                if($all_shop_categories){
                    foreach ($all_shop_categories as $shop_category) {
                        $post_category = array_merge($post_category, getListAllTranslationsOfTerm(get_category_by_slug($shop_category)->term_id));
                    } 
                }
                $prod_data = array(
                    "ID" => get_the_ID(),
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
                $prod_id = updateProduct($prod_data);
                if (!is_wp_error($prod_id)) {
                    $_SESSION['success_process'] = __("Your product has been edited successfully", "mangeonsafrodomain");
                    wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain"))->ID));
                    exit;
                } else {
                    $_SESSION['faillure_process'] = __("An error occurred while editing your product", "mangeonsafrodomain");
                }
            } else {
                $_SESSION['faillure_process'] = __("Some data is missing. Check your form data and try again", "mangeonsafrodomain");
            }
        } else {
            $_SESSION['warning_process'] = __("You don't have a premission to edit this product", "mangeonsafrodomain");
        }
        get_header();
        include(locate_template('products-pages/content-single-product-edit.php'));
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
                $product_id = wp_update_post($post_args);
                if (!is_wp_error($product_id)) {
                    $_SESSION['success_process'] = __("Your product has been put offline successfully", "mangeonsafrodomain");
                } else {
                    $_SESSION['faillure_process'] = __("An error occurred while puting your product offline", "mangeonsafrodomain");
                }
            } else {
                $_SESSION['warning_process'] = __("You don't have a premission to edit this product", "mangeonsafrodomain");
            }
            wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain"))->ID));
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

        $product = get_post(get_the_ID());
        $product_categories = array_map('intval', wp_get_post_categories(get_the_ID(), array("fields" => "ids")));
        $product_category = null;
        $product_sub_category = null;
        $post_parent_categories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'parent' => 0));
        foreach ($post_parent_categories as $post_parent_category) {
            if (in_array($post_parent_category->term_id, $product_categories, true)) {
                $product_category = $post_parent_category;
                break;
            }
        }
        if ($product_category) {
            $post_sub_parent_categories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'child_of' => $product_category->term_id));
            foreach ($post_sub_parent_categories as $post_sub_parent_category) {
                if (in_array($post_sub_parent_category->term_id, $product_categories, true)) {
                    $product_sub_category = $post_sub_parent_category;
                    break;
                }
            }
        }
        $prod_category = get_post_meta(get_the_ID(), 'product-category', true) != null ? get_category_by_slug(get_post_meta(get_the_ID(), 'product-category', true)) : null;
        $prod_sub_category = get_post_meta(get_the_ID(), 'product-sub-category', true) != null ? get_category_by_slug(get_post_meta(get_the_ID(), 'product-sub-category', true)) : null;
        $prod_name = get_the_title();
        $prod_price = get_post_meta(get_the_ID(), 'product-price', true);
        $prod_delete_price = get_post_meta(get_the_ID(), 'product-delete-price', true);
        $prod_currency = get_post(get_post_meta(get_the_ID(), 'product-currency-id', true));
        $prod_currency_print_left_side = get_post_meta($prod_currency->ID, 'currency-print-left-side', true);
        $prod_currency_print_right_side = get_post_meta($prod_currency->ID, 'currency-print-right-side', true);
        $prod_description = get_the_content();
        $prod_brief_description = get_the_excerpt();
        $prod_additional_informations = get_post_meta(get_the_ID(), 'product-addtional-informations', true);
        $prod_gplace_city = get_post_meta(get_the_ID(), 'product-google-places-city', true);
        $prod_city = get_post_meta(get_the_ID(), 'product-city', true);
        $prod_country = get_post_meta(get_the_ID(), 'product-country', true);
        $prod_thumbnail_image_id = get_post_meta(get_the_ID(), 'product-thubmnail-image-id', true);
        $shop_id = get_post_meta(get_the_ID(), 'shop-id', true);
        $prod_shop = get_post($shop_id);
        if (isset($_GET['action']) && $_GET['action'] == "edit" && is_user_logged_in() && $post_author == get_current_user_id()) {
                $all_shop_categories = wp_get_post_categories($shop_id, array('fields' => 'ids'));
                $shop_category = null;
                $all_parent_categories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'parent' => 0));
                foreach ($all_parent_categories as $parent_category){
                    if (is_array($all_shop_categories) && in_array($parent_category->term_id, $all_shop_categories, true)){
                        $shop_category = $parent_category;
                        break;
                    }
                }
            include(locate_template('products-pages/content-single-product-edit.php'));
        } else {
            if ($post_author != get_current_user_id()) {
                updateProductView(get_the_ID());
            }
            $prod_views = get_post_meta(get_the_ID(), "product-views", true) ? get_post_meta(get_the_ID(), "product-views", true) : 0;
            $all_post_categories = wp_get_post_categories(get_the_ID(), array('fields' => 'ids'));
            $featured_category_id = get_category_by_slug(__('featured', 'mangeonsafrodomain'))->term_id;
            $translated_featured_category_id = pll_get_term($featured_category_id, getOppositeLanguage());
            $post_categories = array_diff($all_post_categories, array($featured_category_id, $translated_featured_category_id));
            $single_product_id = get_the_ID();
            $reviews = new WP_Query(array('post_type' => "reviews_cpt", 'post_per_page' => -1, "post_status" => "publish", 'orderby' => 'post_date', 'order' => 'ASC', "meta_key" => "post-ID", "meta_value" => get_the_ID()));
            $reviews_mean = 0;
            $reviews_count = 0;
            if ($reviews->have_posts()) {
                $reviews_count = $reviews->found_posts;
                while ($reviews->have_posts()) {
                    $reviews->the_post();
                    $reviews_mean += get_post_meta(get_the_ID(), "review-user-mark", true);
                }
                if ($reviews_count > 0) {
                    $reviews_mean /= $reviews_count;
                }
                wp_reset_postdata();
            }
            include(locate_template('products-pages/content-single-product-details.php'));
        }
        //Footer 
        get_footer();
    }
}


