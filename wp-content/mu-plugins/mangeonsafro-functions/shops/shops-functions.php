<?php
function saveShop($shop_data) {
    $post_args = array(
        'post_title' => wp_strip_all_tags($shop_data["shop_name"]),
        'post_type' => 'shops_cpt',
        'post_content' => $shop_data["shop_description"],
        'post_author' => get_current_user_id(),
        'post_status' => 'publish',
        'post_category' => $shop_data["post_category"],
        'tax_input' => array("shop_type" => $shop_data["shop_type"]),
        'meta_input' => array(
            'shop-google-places-city' => $shop_data["shop_gplace_city"],
            'shop-city' => $shop_data["shop_city"],
            'shop-region' => $shop_data["shop_region"],
            'shop-country' => $shop_data["shop_country"],
            'shop-longitude' => $shop_data["shop_longitude"],
            'shop-latitude' => $shop_data["shop_latitude"],
            'shop-phone-number' => $shop_data["shop_phone_number"],
            'shop-opening-program' => $shop_data["shop_opening_program"],
            'shop-website' => $shop_data["shop_website"],
            'shop-address' => $shop_data["shop_address"],
            'shop-views' => 0,
            'shop-manager-name' => $shop_data["shop_manager_name"],
            'shop-taxe-percent' => $shop_data["shop_taxe_percent"],
            'shop-email' => $shop_data["shop_email"],
            'shop-po-box' => $shop_data["shop_po_box"],
            'shop-verified' => true,
            'shop-language' => $shop_data['shop_language'],
            'shop-currency-id' => $shop_data["shop_currency_id"],
            'shop-currency-code' => $shop_data["shop_currency_code"],
            'shop-currency-title' => $shop_data["shop_currency_title"],
            'shop-featured-image-id' => $shop_data["shop_featured_image_id"],
            'shop-others-images-ids' => $shop_data["shop_others_images_ids"]
        )
    );
    $shop_id = wp_insert_post($post_args, true);
    return $shop_id;
}

function updateShop($shop_data) {
    $post_args = array(
        'ID' => $shop_data["ID"],
        'post_title' => wp_strip_all_tags($shop_data["shop_name"]),
        'post_name' => sanitize_title(wp_strip_all_tags($shop_data["shop_name"])),
        'post_type' => 'shops_cpt',
        'post_content' => $shop_data["shop_description"],
        'post_category' => $shop_data["post_category"],
        'tax_input' => array("shop_type" => $shop_data["shop_type"]),
        'meta_input' => array(
            'shop-google-places-city' => $shop_data["shop_gplace_city"],
            'shop-city' => $shop_data["shop_city"],
            'shop-region' => $shop_data["shop_region"],
            'shop-country' => $shop_data["shop_country"],
            'shop-longitude' => $shop_data["shop_longitude"],
            'shop-latitude' => $shop_data["shop_latitude"],
            'shop-phone-number' => $shop_data["shop_phone_number"],
            'shop-opening-program' => $shop_data["shop_opening_program"],
            'shop-website' => $shop_data["shop_website"],
            'shop-address' => $shop_data["shop_address"],
            'shop-manager-name' => $shop_data["shop_manager_name"],
            'shop-taxe-percent' => $shop_data["shop_taxe_percent"],
            'shop-email' => $shop_data["shop_email"],
            'shop-po-box' => $shop_data["shop_po_box"],
            'shop-language' => $shop_data['shop_language'],
            'shop-currency-id' => $shop_data["shop_currency_id"],
            'shop-currency-code' => $shop_data["shop_currency_code"],
            'shop-currency-title' => $shop_data["shop_currency_title"],
            'shop-featured-image-id' => $shop_data["shop_featured_image_id"],
            'shop-others-images-ids' => $shop_data["shop_others_images_ids"]
        )
        
    );
    $shop_id = wp_update_post($post_args, true);
    return $shop_id;
}