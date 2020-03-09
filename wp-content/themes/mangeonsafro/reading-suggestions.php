<?php

/*
  Template Name: Reading Suggestions Page
 */
session_start();
if (is_user_logged_in()) {
    unset($_SESSION['redirect_to']);
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
        $user_hobbies = get_user_meta(get_current_user_id(), 'user-hobbies', true);
        if($user_hobbies){
        $params_arg = array();
        $query_args = array('post_type' => 'publications_cpt', 'category__in' => $user_hobbies, 'posts_per_page' => 12, "post_status" => 'publish', 'author__not_in' => array(get_current_user_id()), 'orderby' => 'post_date', 'order' => 'DESC');
        if (isset($_GET['num-page']) && $_GET['num-page'] != "") {
            $num_page = intval(removeslashes(esc_attr(trim($_GET['num-page']))));
            $query_args["paged"] = $num_page;
        } else {
            $num_page = 1;
        }
        $publications = new WP_Query($query_args);
        $total_post_pages = $publications->max_num_pages;
        $page_link = get_permalink();
        }else{
            $publications = null;
        }
        // Header 
        get_header();
        //Content
        include(locate_template('users-pages/content-reading-suggestions.php'));
        //Footer 
        get_footer();
    }
} else {
    $_SESSION['redirect_to'] = wp_make_link_relative(get_the_permalink());
    $_SESSION['warning_process'] = __("You must be logged in to see your reading proposition", "booksharedomain");
    wp_safe_redirect(get_permalink(get_page_by_path(__("login", "booksharedomain"))->ID));
    exit;
}    