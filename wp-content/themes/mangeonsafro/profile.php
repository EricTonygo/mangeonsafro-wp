<?php

/*
  Template Name: Profile Page
 */
session_start();
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $roles = $current_user->roles;
    unset($_SESSION['redirect_to']);
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['lastname']) && $_POST['lastname'] != "" && isset($_POST['phone-number']) && $_POST['phone-number'] != "") {
            global $current_user;
            $user_email = removeslashes(esc_attr(trim($_POST['email'])));
            $first_name = removeslashes(esc_attr(trim($_POST['firstname'])));
            $last_name = removeslashes(esc_attr(trim($_POST['lastname'])));
            $display_name = removeslashes(esc_attr(trim($_POST['displayname'])));
            $my_user_role = isset($_POST['role']) && $_POST['role'] != "" ? removeslashes(esc_attr(trim($_POST['role']))): "particular";
            $user_localisation = removeslashes(esc_attr(trim($_POST['localisation'])));
            $localisation_data = getCountryRegionCityInformations($user_localisation);
            $user_localisation_city = $localisation_data["city"];
            $user_localisation_region = $localisation_data["region"];
            $user_localisation_country = $localisation_data["country"];
            $user_country_code = removeslashes(esc_attr(trim($_POST['country-code'])));
            $user_phone_number = removeslashes(esc_attr(trim($_POST['phone-number'])));
            $user_pro_name = removeslashes(esc_attr(trim($_POST['pro-name'])));
            $user_pro_email = removeslashes(esc_attr(trim($_POST['pro-email'])));
            $user_pro_phone_number = removeslashes(esc_attr(trim($_POST['pro-phone-number'])));
            $user_hobbies = array_map('intval', $_POST['hobbies']);
            $user_city = removeslashes(esc_attr(trim($_POST['city'])));
            $user_zip = removeslashes(esc_attr(trim($_POST['zip'])));
            $user_data = array(
                'user_email' => $user_email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'display_name' => $display_name,
                'role' => $my_user_role,
                'country_code' => $user_country_code,
                'phone_number' => $user_phone_number,
                'user_city' => $user_city,
                'user_zip' => $user_zip,
                'localisation' => $user_localisation,
                'localisation_city' => $user_localisation_city,
                'localisation_region' => $user_localisation_region,
                'localisation_country' => $user_localisation_country,
                'hobbies'=> $user_hobbies
            );
            if (filter_var($user_email, FILTER_VALIDATE_EMAIL) && get_user_by('email', $user_email) && get_user_by('email', $user_email)->ID != get_current_user_id()) {
                $_SESSION['faillure_process'] = __("A user with this email already exists", "mangeonsafrodomain");
            } else {
                $user_id = update_user($user_data);
                if (!is_wp_error($user_id)) {
                    $_SESSION['success_process'] = __("Your profile has been updated successfully", "mangeonsafrodomain");
                    wp_safe_redirect(get_permalink());
                    exit;
                } else {
                    $_SESSION['faillure_process'] = __("An error occurred while updating your profile", "mangeonsafrodomain");
                }
            }
        } else {
            $_SESSION['faillure_process'] = __("Some form data is missing. Check it and try again", "mangeonsafrodomain");
        }
        // Header 
        get_header();
        //Content
        include(locate_template('users-pages/content-profile.php'));
        //Footer 
        get_footer();
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        $user_id = $current_user->ID;
        $user_email = $current_user->user_email;
        $display_name = $current_user->display_name;
        $first_name = $current_user->first_name;
        $last_name = $current_user->last_name;
        $user_country_code = get_user_meta($user_id, "user-country-code", true);
        $user_phone_number = get_user_meta($user_id, "user-phone-number", true);
        $user_localisation = get_user_meta($user_id, "user-localisation", true);
        $user_pro_name = get_user_meta($user_id, "user-pro-name", true);
        $user_pro_email = get_user_meta($user_id, "user-pro-email", true);
        $user_pro_phone_number = get_user_meta($user_id, "user-pro-phone-number", true);
        $user_city = get_user_meta($user_id, "user-city", true);
        $user_zip = get_user_meta($user_id, "user-zip", true);
        $user_hobbies = get_user_meta($user_id, "user-hobbies", true);
        // Header 
        get_header();
        //Content
        include(locate_template('users-pages/content-profile.php'));
        //Footer 
        get_footer();
    }
} else {
    $_SESSION['redirect_to'] = wp_make_link_relative(get_the_permalink());
    $_SESSION['warning_process'] = __("You must be logged in to see a your profile", "mangeonsafrodomain");
    wp_safe_redirect(get_permalink(get_page_by_path(__("login", "mangeonsafrodomain"))->ID));
    exit;
}    