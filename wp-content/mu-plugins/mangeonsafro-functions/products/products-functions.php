<?php
function saveProduct($product_data) {
    $post_args = array(
        'post_title' => wp_strip_all_tags($product_data["product_name"]),
        'post_type' => 'products_cpt',
        'post_content' => $product_data["product_description"],
        'post_excerpt' => $product_data["product_brief_description"],
        'post_author' => get_current_user_id(),
        'post_status' => 'publish',
        'post_category' => $product_data['post_category'],
        //'tax_input' => array("product_state" => $product_data["product_state"], "product_option" => $product_data["product_option"], "product_subject" => $product_data["product_subject"]),
        'meta_input' => array(
            'product-category' => $product_data["product_category"],
            'product-sub-category' => $product_data["product_sub_category"],
            'product-price' => $product_data["product_price"],
            'product-delete-price' => $product_data["product_delete_price"],
            'product-currency-id' => $product_data["product_currency_id"],
            'product-google-places-city' => $product_data["product_gplace_city"],
            'product-city' => $product_data["product_city"],
            'product-region' => $product_data["product_region"],
            'product-country' => $product_data["product_country"],
            'product-thubmnail-image-id' => $product_data["product_thumbnail_image_id"],
            'product-additional-informations' => $product_data["product_additional_informations"],
            'product-views' => 0,
            'shop-id' => $product_data["shop_id"],
            'product-language' => $product_data['product_language']
        )
    );
    $product_id = wp_insert_post($post_args, true);
    return $product_id;
}

function updateProduct($product_data) {
    $post_args = array(
        'ID' => $product_data["ID"],
        'post_title' => wp_strip_all_tags($product_data["product_name"]),
        'post_name' => sanitize_title(wp_strip_all_tags($product_data["pubication_name"])),
        'post_type' => 'products_cpt',
        'post_content' => $product_data["product_description"],
        'post_excerpt' => $product_data["product_brief_description"],
        'post_category' => $product_data['post_category'],
        //'tax_input' => array("product_state" => $product_data["product_state"], "product_option" => $product_data["product_option"], "product_subject" => $product_data["product_subject"]),
        'meta_input' => array(
            'product-category' => $product_data["product_category"],
            'product-sub-category' => $product_data["product_sub_category"],
            'product-price' => $product_data["product_price"],
            'product-delete-price' => $product_data["product_delete_price"],
            'product-google-places-city' => $product_data["product_gplace_city"],
            'product-city' => $product_data["product_city"],
            'product-region' => $product_data["product_region"],
            'product-country' => $product_data["product_country"],
            'product-thubmnail-image-id' => $product_data["product_thumbnail_image_id"],
            'product-additional-informations' => $product_data["product_additional_informations"],
            'shop-id' => $product_data["shop_id"],
            'product-currency-id' => $product_data["product_currency_id"],
            'product-language' => $product_data['product_language']
        )
    );
    $product_id = wp_update_post($post_args, true);
    return $product_id;
}

function updateProductView($product_id) {
    $product_views = intval(get_post_meta($product_id, "product-views", true));
    if ($product_views && $product_views >= 1) {
        $product_views = $product_views + 1;
    } else {
        $product_views = 1;
    }
    update_post_meta($product_id, 'product-views', $product_views);
}

function mangeonsafro_notification_new_product($product_id) {
    $solved_alert_id = get_post_meta($product_id, "solved-alert-id", true);
    $product_city = get_post_meta($product_id, "product-city", true);
    $alert_city = get_post_meta($product_id, "alert-city", true);
    if ($solved_alert_id) {
        send_email_new_product($product_id, $solved_alert_id);
    } else {
        $post_categories = wp_get_post_categories($product_id, array('fields' => 'ids'));
        $pub_subject = wp_get_post_terms(get_the_ID(), 'product_subject', array("fields" => "ids"));
        $alerts = new WP_Query(array('post_type' => 'alerts_cpt', 'posts_per_page' => -1, "post_status" => 'publish', 'category__in' => $post_categories, 'tax_query' => array('taxonomy' => 'product_subject', 'field' => 'term_id', 'terms' => $pub_subject, 'operator' => 'IN')));
        if ($alerts->have_posts()) {
            $alerts = $alerts->posts;
            foreach ($alerts as $alert) {
                $solved_alert_id = $alert->ID;
                send_email_new_product($product_id, $solved_alert_id);
            }
        }
    }
}

function send_email_new_product($product_id, $solved_alert_id) {
    $user = get_user_by('id', get_post_field('post_author', $solved_alert_id));
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: BledShare <infos@bledshare.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $subject = __("Alert product(s)", "mangeonsafrodomain");

    ob_start();
    ?>
    <div style="font-size: 12.8px;"><?php echo __("Hello", "mangeonsafrodomain"); ?> <?php echo $user->data->display_name; ?> ! </div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("We have a book that may be of interest to you for your alert:", "mangeonsafrodomain"); ?> <a href="<?php echo get_permalink($solved_alert_id); ?>" ><?php echo get_post_field('post_title', $solved_alert_id) ?></a>.</div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("Click on the link here to see this book: ", "mangeonsafrodomain"); ?> <a href="<?php echo get_permalink($product_id); ?>" ><?php echo get_post_field('post_title', $product_id) ?></a>.</div>
    <div><br></div>
    <div>
        <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Thank you for using Bledshare", "mangeonsafrodomain"); ?>,</p>
        <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your BledShare team", "mangeonsafrodomain"); ?>.</p>
    </div>

    <?php
    $body = ob_get_contents();
    ob_end_clean();
    wp_mail($user->data->user_email, $subject, $body, $headers);
}
