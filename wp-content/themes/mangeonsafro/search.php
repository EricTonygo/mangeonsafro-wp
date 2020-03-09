<?php

session_start();
wp_reset_postdata();

get_header();
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['s'])) {
        $search_query = removeslashes(esc_attr(trim($_GET['s'])));
        $query_args = array('post_type' => 'post', 's' => $search_query, 'posts_per_page' => 6, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC');

        if (isset($_GET['num-page']) && $_GET['num-page'] != "") {
            $num_page = intval(removeslashes(esc_attr(trim($_GET['num-page']))));
            $query_args["paged"] = $num_page;
        } else {
            $num_page = 1;
        }
        $params_arg = array();
        $search_results = new WP_Query($query_args);
        $total_post_pages = $blog_news->max_num_pages;
        $page_link = get_permalink();
        include(locate_template('blog/content-search-page.php'));
    }
}


get_footer();


