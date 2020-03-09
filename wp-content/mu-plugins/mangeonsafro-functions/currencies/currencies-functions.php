<?php

function saveCurrency($currency_data) {
    $post_args = array(
        'post_title' => wp_strip_all_tags($currency_data["currency_name"]),
        'post_type' => 'currencies_cpt',
        'post_content' => $currency_data["currency_description"],
        'post_author' => get_current_user_id(),
        'post_status' => 'publish',
        'meta_input' => array(
            'currency-code' => $currency_data["currency_code"],
            'currency-symbol' => $currency_data["currency_symbol"],
            'currency-print-left-side' => $currency_data["currency_print_left_side"],
            'currency-print-right-side' => $currency_data["currency_print_right_side"]
        )
    );
    $currency_id = wp_insert_post($post_args, true);
    return $currency_id;
}

function updateCurrency($currency_data) {
    $post_args = array(
        'ID' => $currency_data["ID"],
        'post_title' => wp_strip_all_tags($currency_data["currency_name"]),
        'post_name' => sanitize_title(wp_strip_all_tags($currency_data["currency_name"])),
        'post_type' => 'currencies_cpt',
        'post_content' => $currency_data["currency_description"],
        'meta_input' => array(
            'currency-code' => $currency_data["currency_code"],
            'currency-symbol' => $currency_data["currency_symbol"],
            'currency-print-left-side' => $currency_data["currency_print_left_side"],
            'currency-print-right-side' => $currency_data["currency_print_right_side"]
        )
    );
    $currency_id = wp_update_post($post_args, true);
    return $currency_id;
}

function init_currency_db() {
    $currencies = array(
        array(
            "currency_name" => "Euro",
            "currency_code" => "EUR",
            "currency_symbol" => "€",
            "currency_description" => "",
            "currency_print_left_side" => false,
            "currency_print_right_side" => true
        ),
        array(
            "currency_name" => "United State Dollar",
            "currency_code" => "USD",
            "currency_symbol" => "$",
            "currency_description" => "",
            "currency_print_left_side" => true,
            "currency_print_right_side" => false
        ),
        array(
            "currency_name" => "Franc CFA - BEAC",
            "currency_code" => "XAF",
            "currency_symbol" => "XAF",
            "currency_description" => "",
            "currency_print_left_side" => false,
            "currency_print_right_side" => true
        ),
        array(
            "currency_name" => "Franc CFA - BCEAO",
            "currency_code" => "XOF",
            "currency_symbol" => "XOF",
            "currency_description" => "",
            "currency_print_left_side" => false,
            "currency_print_right_side" => true
        ),
        array(
            "currency_name" => "Pounds sterling",
            "currency_code" => "GBP",
            "currency_symbol" => "£",
            "currency_description" => "",
            "currency_print_left_side" => true,
            "currency_print_right_side" => false
        ),
        array(
            "currency_name" => "Japanese yen",
            "currency_code" => "JPY",
            "currency_symbol" => "¥",
            "currency_description" => "",
            "currency_print_left_side" => false,
            "currency_print_right_side" => true
        )
    );
//    $args = array(
//        'post_type' => 'currencies_cpt',
//        "post_status" => 'publish',
//        'posts_per_page' => 1
//    );
    $result = null;
    foreach ($currencies as $currency) {
//        $args['title'] = esc_attr(trim($currency["currency_name"]));
//        $args['meta_query'] = array(
//            'relation' => 'AND',
//            array(
//                'key' => 'currency-code',
//                'value' => esc_attr(trim($currency["currency_code"])),
//                'compare' => '=',
//            ),
//            array(
//                'key' => 'currency-symbol',
//                'value' => '',
//                'compare' => '=',
//            )
//        );
//        $currency_search = new WP_Query($args);
//        if (!$currency_search->have_posts()) {
//            $currency_search->the_post();
//            $currency[ID] = get_the_ID();
//            $result = updateCurrency($currency);
//            wp_reset_postdata();
//        }else{
            $result = saveCurrency($currency);
//        }
        
    }
    return $result;
}
