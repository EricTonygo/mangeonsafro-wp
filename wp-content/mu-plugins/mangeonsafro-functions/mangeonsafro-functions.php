<?php

require 'commons/commons-functions.php';
require 'cpt/booking-cpt.php';
require 'cpt/historical-cpt.php';
require 'cpt/line-booking-cpt.php';
require 'cpt/line-order-cpt.php';
require 'cpt/order-cpt.php';
require 'cpt/partner-cpt.php';
require 'cpt/product-cpt.php';
require 'cpt/restaurant-menu-cpt.php';
require 'cpt/shop-cpt.php';
require 'cpt/subscription-cpt.php';
require 'cpt/currency-cpt.php';
require 'cpt/review-cpt.php';
require 'taxonomies/shop-type-taxonomy.php';
//require 'taxonomies/publication-class-taxonomy.php';
//require 'taxonomies/publication-state-taxonomy.php';
//require 'taxonomies/publication-option-taxonomy.php';
//require 'taxonomies/publication-subject-taxonomy.php';
require 'users/users-functions.php';
require 'products/products-functions.php';
require 'currencies/currencies-functions.php';
require 'reviews/reviews-functions.php';
//require 'messages/messages-functions.php';
require 'shops/shops-functions.php';

add_action('after_setup_theme', 'my_theme_supports');
if (!function_exists('set_my_locale')) {
    add_filter('locale', 'set_my_locale');
}

add_action('init', 'mangeonsafro_init');
//add_action('admin_init', 'mangeonsafro_no_admin_access', 100);

//Disable password reset from wp-login.php page
//add_filter('allow_password_reset', 'disable_password_reset');
//Remove Reset lost password link form wp-login page
//add_filter('gettext', 'remove_lostpassword_text');


function mangeonsafro_init() {
    add_role('particular', __('Particular', 'mangeonsafrodomain'), array('read' => true, 'publish_posts' => true, 'edit_posts' => true));
    add_role('professional', __('Professional', 'mangeonsafrodomain'), array('read' => true, 'publish_posts' => true, 'edit_posts' => true));
//    add_role('association', __('Association', 'mangeonsafrodomain'), array('read' => true, 'publish_posts' => true, 'edit_posts' => true));
    mangeonsafro_booking_init();
    mangeonsafro_historical_init();
    mangeonsafro_lineBooking_init();
    mangeonsafro_lineOrder_init();
    mangeonsafro_order_init();
    mangeonsafro_partner_init();
    mangeonsafro_product_init();
    mangeonsafro_restaurantMenu_init();
    mangeonsafro_shop_init();
    mangeonsafro_subscription_init();
    mangeonsafro_currency_init();
    mangeonsafro_review_init();
    create_shop_type_taxonomy();
    //create_publication_class_taxonomy();
//    create_publication_state_taxonomy();
//    create_publication_option_taxonomy();
//    create_publication_subject_taxonomy();
    //custom_login_page();
}

//Action for notifing user for new post available
add_action("publish_post", "mangeonsafro_publication_notification");

add_action("post_updated", "mangeonsafro_publication_notification");

function mangeonsafro_publication_notification($post_ID) {
    if ('publish' != get_post_status($post_ID)) {
        return false;
    }
    $post = get_post($post_ID);
    $post_type = get_post_type($post);
    if ('product_cpt' == $post_type) {
        mangeonsafro_notification_new_product($post_ID);
    }
}