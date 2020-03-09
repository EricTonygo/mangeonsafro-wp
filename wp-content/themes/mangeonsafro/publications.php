<?php

/*
  Template Name: Publications Page
 */
session_start();
if (is_user_logged_in()) {
    unset($_SESSION['redirect_to']);
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (is_page(get_page_by_path(__('account', 'booksharedomain') . "/" . __("books", "booksharedomain") . "/" . __("new", "booksharedomain"))->ID)) {
            if (isset($_POST['publication-name']) && $_POST['publication-name'] != "" && isset($_POST['publication-type']) && $_POST['publication-type'] != "" && isset($_POST['publication-city']) && $_POST['publication-city'] != "" && isset($_POST['publication-state']) && $_POST['publication-state'] != "" && isset($_POST['publication-option']) && $_POST['publication-option'] != "") {
                $pub_type = removeslashes(esc_attr(trim($_POST['publication-type'])));
                $pub_class = removeslashes(esc_attr(trim($_POST['publication-class'])));
                $pub_subject = array_map('intval', array(removeslashes(esc_attr(trim($_POST['publication-subject'])))));
                $pub_state = array_map('intval', array(removeslashes(esc_attr(trim($_POST['publication-state'])))));
                $pub_option = array_map('intval', array(removeslashes(esc_attr(trim($_POST['publication-option'])))));
                $pub_name = removeslashes(esc_attr(trim($_POST['publication-name'])));
                $pub_price = floatval(removeslashes(esc_attr(trim($_POST['publication-price']))));
                $pub_tenancy = removeslashes(esc_attr(trim($_POST['publication-tenancy'])));
                $pub_description = removeslashes(esc_attr(trim($_POST['publication-description'])));
                $pub_gplace_city = removeslashes(esc_attr(trim($_POST['publication-city'])));
                $localisation_data = getCountryRegionCityInformations($pub_gplace_city);
                $pub_city = $localisation_data["city"];
                $pub_region = $localisation_data["region"];
                $pub_country = $localisation_data["country"];
                $alert_solved_id = removeslashes(esc_attr(trim($_POST['solved-alert-id'])));
                $pub_thumbnail_image = $_FILES['publication-thumbnail-image'];
                if (is_array($pub_thumbnail_image) && $_FILES['publication-thumbnail-image']['error'] == 0) {
                    $pub_thumbnail_image_id = upload_file($pub_thumbnail_image);
                } else {
                    $pub_thumbnail_image_id = removeslashes(esc_attr(trim($_POST['publication-thumbnail-image-id'])));
                }

                $pub_type_barter = getListAllTranslationsOfTerm(get_category_by_slug(removeslashes(esc_attr(trim($_POST['publication-type-barter']))))->term_id);
                $pub_class_barter = getListAllTranslationsOfTerm(get_category_by_slug(removeslashes(esc_attr(trim($_POST['publication-class-barter']))))->term_id);
                $pub_subject_barter = array_map('intval', array(removeslashes(esc_attr(trim($_POST['publication-subject-barter'])))));
                $pub_state_barter = array_map('intval', array(removeslashes(esc_attr(trim($_POST['publication-state-barter'])))));
                $pub_name_barter = removeslashes(esc_attr(trim($_POST['publication-name-barter'])));
                $post_category = array();
                if ($pub_type == __("textbooks", "booksharedomain")) {
                    $post_category = getListAllTranslationsOfTerm(get_category_by_slug($pub_type)->term_id);
                    $post_category[] = get_category_by_slug($pub_class)->term_id;
                } else {
                    $post_category = getListAllTranslationsOfTerm(get_category_by_slug($pub_type)->term_id);
                }
                $pub_data = array(
                    "publication_name" => $pub_name,
                    "publication_type" => $pub_type,
                    "publication_class" => $pub_class,
                    "publication_subject" => $pub_subject,
                    "publication_state" => $pub_state,
                    "publication_option" => $pub_option,
                    "publication_price" => $pub_price,
                    "publication_tenancy" => $pub_tenancy,
                    "publication_description" => $pub_description,
                    "publication_thumbnail_image_id" => $pub_thumbnail_image_id,
                    "publication_gplace_city" => $pub_gplace_city,
                    "publication_city" => $pub_city,
                    "publication_region" => $pub_region,
                    "publication_country" => $pub_country,
                    "publication_name_barter" => $pub_name_barter,
                    "publication_type_barter" => $pub_type_barter,
                    "publication_class_barter" => $pub_class_barter,
                    "publication_subject_barter" => $pub_subject_barter,
                    "publication_state_barter" => $pub_state_barter,
                    "alert_solved_id" => $alert_solved_id,
                    "post_category" => $post_category,
                    "publication_language" => pll_current_language("slug")
                );

                $pub_id = savePublication($pub_data);
                if (!is_wp_error($pub_id)) {
                    $_SESSION['success_process'] = __("Your book has been published successfully", "booksharedomain");
                    wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'booksharedomain') . "/" . __("books", "booksharedomain"))->ID));
                    exit;
                } else {
                    $_SESSION['faillure_process'] = __("An error occurred while publishing your book", "booksharedomain");
                }
            } else {
                $_SESSION['faillure_process'] = __("Some data is missing. Check your form data and try again", "booksharedomain");
            }
            // Header 
            get_header();
            //Content
            include(locate_template('publications-pages/content-new-publication.php'));
            //Footer 
            get_footer();
        }
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['action']) && $_GET['action'] == 'put-online' && isset($_GET['ID'])) {
            $pub_id = intval(removeslashes(esc_attr(trim($_GET['ID']))));
            $post_author = get_post_field('post_author', $pub_id);
            if (is_user_logged_in()) {
                if (get_current_user_id() == $post_author) {
                    $post_args = array(
                        "ID" => $pub_id,
                        "post_status" => 'publish'
                    );
                    $publication_id = wp_update_post($post_args);
                    if (!is_wp_error($publication_id)) {
                        $_SESSION['success_process'] = __("Your book has been put online successfully", "booksharedomain");
                    } else {
                        $_SESSION['faillure_process'] = __("An error occurred while puting your book online", "booksharedomain");
                    }
                } else {
                    $_SESSION['warning_process'] = __("You don't have a premission to edit this book", "booksharedomain");
                }
                wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'booksharedomain') . "/" . __("books", "booksharedomain"))->ID));
                exit;
            } else {
                $_SESSION['redirect_to'] = esc_url(add_query_arg(array('action' => 'put-online', 'ID' => $pub_id), wp_make_link_relative(get_the_permalink())));
                wp_safe_redirect(get_permalink(get_page_by_path(__("login", "booksharedomain"))->ID));
                exit;
            }
        } elseif (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['ID'])) {
            $pub_id = intval(removeslashes(esc_attr(trim($_GET['ID']))));
            $post_author = get_post_field('post_author', $pub_id);
            if (is_user_logged_in()) {
                if (get_current_user_id() == $post_author) {
                    $deleled_publication = wp_delete_post($pub_id, true);
                    if ($deleled_publication) {
                        $_SESSION['success_process'] = __("Your book has been deleted successfully", "booksharedomain");
                    } else {
                        $_SESSION['faillure_process'] = __("An error occurred while deleting your book", "booksharedomain");
                    }
                } else {
                    $_SESSION['warning_process'] = __("You don't have a premission to delete this book", "booksharedomain");
                }
                wp_safe_redirect(get_permalink(get_page_by_path(__('account', 'booksharedomain') . "/" . __("books", "booksharedomain"))->ID));
                exit;
            } else {
                $_SESSION['redirect_to'] = esc_url(add_query_arg(array('action' => 'delete'), wp_make_link_relative(get_the_permalink())));
                wp_safe_redirect(get_permalink(get_page_by_path(__("login", "booksharedomain"))->ID));
                exit;
            }
        } else {
            // Header 
            get_header();
            //Content
            if (is_page(get_page_by_path(__('account', 'booksharedomain') . "/" . __("books", "booksharedomain"))->ID)) {
                $params_arg = array();
                $query_args = array('post_type' => 'publications_cpt', 'posts_per_page' => 12, "post_status" => array('publish', 'trash'), 'orderby' => 'post_date', 'order' => 'DESC', 'author' => get_current_user_id());
                if (isset($_GET['num-page']) && $_GET['num-page'] != "") {
                    $num_page = intval(removeslashes(esc_attr(trim($_GET['num-page']))));
                    $query_args["paged"] = $num_page;
                } else {
                    $num_page = 1;
                }
                $publications = new WP_Query($query_args);
                $total_post_pages = $publications->max_num_pages;
                $page_link = get_permalink();
                include(locate_template('publications-pages/content-publications.php'));
            } elseif (is_page(get_page_by_path(__('account', 'booksharedomain') . "/" . __("books", "booksharedomain") . "/" . __("publish", "booksharedomain"))->ID)) {
                if (isset($_GET['alert-solved']) && $_GET['alert-solved'] != "") {
                    $alert = get_page_by_path(removeslashes(esc_attr(trim($_GET["alert-solved"]))), $output = OBJECT, $post_type = 'alerts_cpt');
                    if ($alert) {
                        $solved_alert_id = $alert->ID;
                        $pub_type = wp_get_post_categories($alert->ID, array('fields' => 'ids'));
                        $pub_class = wp_get_post_categories($alert->ID, array('fields' => 'ids'));
                        $pub_subject = wp_get_post_terms($alert->ID, 'publication_subject', array("fields" => "ids"));
                        $pub_state = wp_get_post_terms($alert->ID, 'publication_state', array("fields" => "ids"));
                        $pub_option = wp_get_post_terms($alert->ID, 'publication_option', array("fields" => "ids"));
                        $pub_name = $alert->post_title;
                        $pub_type_barter = get_post_meta($alert->ID, "alert-type-barter", true);
                        $pub_class_barter = get_post_meta($alert->ID, "alert-class-barter", true);
                        $pub_subject_barter = get_post_meta($alert->ID, "alert-subject-barter", true);
                        $pub_state_barter = get_post_meta($alert->ID, "alert-state-barter", true);
                        $pub_name_barter = get_post_meta($alert->ID, "alert-name-barter", true);
                    }
                }
                include(locate_template('publications-pages/content-new-publication.php'));
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
    $_SESSION['warning_process'] = __("Log in to publish your book", "booksharedomain");
    wp_safe_redirect(get_permalink(get_page_by_path(__("login", "booksharedomain"))->ID));
    exit;
}    