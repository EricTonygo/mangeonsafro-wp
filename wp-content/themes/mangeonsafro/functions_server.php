<?php

//add_action( 'after_setup_theme', 'woocommerce_support' );
//function woocommerce_support() {
//    add_theme_support( 'woocommerce' );
//}



add_action('wp_print_scripts', 'theme_slug_dequeue_footer_jquery');

function theme_slug_dequeue_footer_jquery() {

    if (!is_admin()) {

        wp_dequeue_script('jquery');

        wp_deregister_script('jquery');
    }
}

add_filter('auto_update_plugin', '__return_true');

function wpdocs_dequeue_dashicon() {

    if (current_user_can('update_core')) {

        return;
    }

    if (!is_admin()) {

        wp_deregister_style('dashicons');

        wp_deregister_style('admin-bar');
    }
}

add_action('wp_enqueue_scripts', 'wpdocs_dequeue_dashicon');

function hide_admin_bar_from_front_end() {

    if (is_blog_admin()) {

        return true;
    }

    return false;
}

add_filter('show_admin_bar', 'hide_admin_bar_from_front_end');

function mangeonsafro_scripts() {

    //-- theme stylesheet-->
    wp_register_style('default_theme_css', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/stylesheets/style.default.css')));

    wp_enqueue_style('default_theme_css');
    
    //-- Price Slider Stylesheets -->
    wp_register_style('vendor_nouislider_css', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/nouislider/nouislider.css')), array(), '2.2.10');

    wp_enqueue_style('vendor_nouislider_css');
    
    //-- Google fonts - Playfair Display-->
    wp_register_style('fonts.googleapis', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700');

    wp_enqueue_style('fonts.googleapis');
    
    wp_register_style('fonts.hkgrotesk', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/fonts/hkgrotesk/stylesheet.css')));

    wp_enqueue_style('fonts.hkgrotesk');
    
    //-- owl carousel-->
    wp_register_style('vendor_owl.carousel_css', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/owl.carousel/assets/owl.carousel.css')));

    wp_enqueue_style('vendor_owl.carousel_css');
    
    //-- Ekko Lightbox-->
    wp_register_style('vendor_ekko-lightbox_css', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/ekko-lightbox/ekko-lightbox.css')));

    wp_enqueue_style('vendor_ekko-lightbox_css');
    
    //-- Custom stylesheet - for your changes-->
    wp_register_style('custom_css', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/stylesheets/custom.css')));

    wp_enqueue_style('custom_css');

    //-- Font Awesome CSS-->
    wp_register_style('font-awesone-solid', 'https://use.fontawesome.com/releases/v5.1.0/css/solid.css');

    wp_enqueue_style('font-awesone-solid');
    
    wp_register_style('font-awesone-regular', 'https://use.fontawesome.com/releases/v5.1.0/css/regular.css');

    wp_enqueue_style('font-awesone-regular');
    
    wp_register_style('font-awesone-brands', 'https://use.fontawesome.com/releases/v5.1.0/css/brands.css');

    wp_enqueue_style('font-awesone-brands');
    
    wp_register_style('font-awesone-fontawesome', 'https://use.fontawesome.com/releases/v5.1.0/css/fontawesome.css');

    wp_enqueue_style('font-awesone-fontawesome');

    wp_register_script('main_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/js/main.js')), array(), false, true);

    //-- jQuery-->
    wp_register_script('jquery_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/jquery/jquery.min.js')), array(), false, true);
    
    wp_enqueue_script('jquery_js');
    
    //-- Bootstrap JavaScript Bundle (Popper.js included)-->
    wp_register_script('bootstrap.bundle_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')), array(), false, true);
    
    wp_enqueue_script('bootstrap.bundle_js');
    
    //-- Owl Carousel-->
    wp_register_script('owl.carousel_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/owl.carousel/owl.carousel.js')), array(), false, true);
    
    wp_enqueue_script('owl.carousel_js');
    
    //-- Owl Carousel-->
    wp_register_script('owl.carousel2.thumbs_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js')), array(), false, true);
    
    wp_enqueue_script('owl.carousel2.thumbs_js');
    
    //-- NoUI Slider (price slider)-->
    wp_register_script('nouislider_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/nouislider/nouislider.min.js')), array(), false, true);
    
    wp_enqueue_script('nouislider_js');
    
    //-- Smooth scrolling-->
    wp_register_script('smooth-scroll.polyfills_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/smooth-scroll/smooth-scroll.polyfills.min.js')), array(), false, true);
    
    wp_enqueue_script('smooth-scroll.polyfills_js');
    
    //-- Lightbox-->
    wp_register_script('ekko-lightbox_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/ekko-lightbox/ekko-lightbox.min.js')), array(), false, true);
    
    wp_enqueue_script('ekko-lightbox_js');
    
    //-- Object Fit Images - Fallback for browsers that don't support object-fit-->
    wp_register_script('ofi_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/vendor/object-fit-images/ofi.min.js')), array(), false, true);
    
    wp_enqueue_script('ofi_js');
    
    //-- theme-->
    wp_register_script('theme_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/js/theme.js')), array(), false, true);
    
    wp_enqueue_script('theme_js');

    wp_register_script('register_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/js/register.js')), array(), false, true);

    wp_register_script('categories_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/js/categories.js')), array(), false, true);

//    wp_register_script('text-slider_js', get_template_directory_uri() . '/assets/js/text-slider.js', array(), false, true);

    wp_register_script('publications_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/js/publications.js')), array(), false, true);

    wp_register_script('notifications_js', auto_version(wp_make_link_relative(get_template_directory_uri() . '/assets/js/notifications.js')), array(), false, true);


    wp_enqueue_script('main_js');

    if (is_page(get_page_by_path(__("register", "mangeonsafrodomain"))->ID) || is_page(get_page_by_path(__("login", "mangeonsafrodomain"))->ID) || is_page(get_page_by_path(__("account", "mangeonsafrodomain") . "/" . __("profile", "mangeonsafrodomain"))->ID) || is_page(get_page_by_path(__("account", "mangeonsafrodomain") . "/" . __("profile", "mangeonsafrodomain") . "/" . __("school-informations", "mangeonsafrodomain"))->ID)) {
        wp_enqueue_script('register_js');
    }

    wp_enqueue_script('categories_js');
    if (is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("books", "mangeonsafrodomain"))->ID) || is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("books", "mangeonsafrodomain") . "/" . __("publish", "mangeonsafrodomain"))->ID) || is_singular("publications_cpt")) {
        
        
        
    }
//    if (is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("alerts", "mangeonsafrodomain"))->ID) || is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("alerts", "mangeonsafrodomain") . "/" . __("publish", "mangeonsafrodomain"))->ID) || is_singular("alerts_cpt")) {
//       
//    }
}

add_action('wp_enqueue_scripts', 'mangeonsafro_scripts');

//Function return a list of others languages without current language with polylang
function getListOfOthersLanguages() {
    $translations = pll_the_languages(array('raw' => 1));
    $current_language = pll_current_language("slug");
    $list_languages = array();
    foreach ($translations as $translation) {
        if ($translation['slug'] != $current_language) {
            $list_languages[] = $translation['slug'];
        }
    }
    return $list_languages;
}

//Function return a list of others languages without current language with polylang
function getOppositeLanguage() {
    $translations = pll_the_languages(array('raw' => 1));
    $current_language = pll_current_language("slug");
    $opposite_language = "";
    foreach ($translations as $translation) {
        if ($translation['slug'] != $current_language) {
            $opposite_language = $translation['slug'];
            break;
        }
    }
    return $opposite_language;
}

//Funciton return a list of all translations of a term given by term_id
function getListAllTranslationsOfTerm($term_id) {
    $list_languages = getListOfOthersLanguages();
    $list_terms_translation = array($term_id);
    foreach ($list_languages as $language) {
        $list_terms_translation[] = pll_get_term($term_id, $language);
    }
    return $list_terms_translation;
}

//Function return a opposite language
function getTranslateTermInOppositeLanguage($term_id) {
    return pll_get_term($term_id, getOppositeLanguage());
}
