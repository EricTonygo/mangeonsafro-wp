<?php

/*
  Template Name: Backups Page
 */

if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "save" && isset($_POST["id"])) {
            $post_id = intval(removeslashes(esc_attr(trim($_POST['id']))));
            $save_result = save_post($post_id);
            if ($save_result) {
                $json = array("message" => __("Saved successfully", "gpdealdomain"));
                return wp_send_json_success($json);
            } else {
                $json = array("message" => __("Error during saving", "gpdealdomain"));
                return wp_send_json_error($json);
            }
        } elseif (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "unsave" && isset($_POST["id"])) {
            $post_id = intval(removeslashes(esc_attr(trim($_POST['id']))));
            $unsave_result = unsave_post($post_id);
            if ($unsave_result) {
                $json = array("message" => __("Unsaved successfully", "gpdealdomain"));
                return wp_send_json_success($json);
            } else {
                $json = array("message" => __("Error during unsaving", "gpdealdomain"));
                return wp_send_json_error($json);
            }
        }
    } else {
        // Header 
        get_header();
        //Content
        $save_posts = get_user_meta(get_current_user_id(), 'user-save-posts', true);
        $params_arg = array();
        $query_args = array('post_type' => array('publications_cpt', 'alerts_cpt'), 'post__in' => $save_posts, 'posts_per_page' => 12, "post_status" => 'publish');
        if (isset($_GET['num-page']) && $_GET['num-page'] != "") {
            $num_page = intval(removeslashes(esc_attr(trim($_GET['num-page']))));
            $query_args["paged"] = $num_page;
        } else {
            $num_page = 1;
        }
        $posts = new WP_Query($query_args);
        $total_post_pages = $posts->max_num_pages;
        $page_link = get_permalink();
        include(locate_template('backups-pages/content-backups.php'));
        //Footer 
        get_footer();
    }
} else {
    $_SESSION['redirect_to'] = wp_make_link_relative(get_the_permalink());
    $_SESSION['warning_process'] = __("You must be logged in to see a yours backups", "booksharedomain");
    wp_safe_redirect(get_permalink(get_page_by_path(__("login", "booksharedomain"))->ID));
    exit;
}    