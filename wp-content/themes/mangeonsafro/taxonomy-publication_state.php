<?php

/*
  Template Name:  Contents Categories
 */

// Header 
get_header();
//Content
$params_arg = array();
$query_args = array('posts_per_page' => 12, "post_status" => 'publish', 'orderby' => 'post_date', 'tax_query' => array(array('taxonomy' => 'publication_state', 'field' => 'term_id', 'terms' => array(get_queried_object_id()))), 'order' => 'DESC');
if (isset($_GET['publication-type']) && $_GET['publication-type'] == "alerts") {
    $pub_type = "alerts";
    $query_args["post_type"] = "alerts_cpt";
    $params_arg["publication-type"] = "alerts";
} else {
    $pub_type = "books";
    $query_args["post_type"] = "publications_cpt";
    $params_arg["publication-type"] = "books";
}
if (isset($_GET['post-user']) && $_GET['post-user'] != "") {
    $post_user = removeslashes(esc_attr(trim($_GET['post-user'])));
    $user = get_user_by('login', $post_user);
    $author = $user->ID;
    $query_args["author"] = $author;
    $user_bookstore = $user->data->user_login;
    $params_arg["post-user"] = $user_bookstore;
}

if (isset($_GET['page']) && $_GET['page'] != "") {
    $num_page = intval(removeslashes(esc_attr(trim($_GET['page']))));
    $query_args["paged"] = $num_page;
} else {
    $num_page = 1;
}

if (isset($_GET['publication-category']) && $_GET['publication-category'] != "") {
    $publication_category = removeslashes(esc_attr(trim($_GET['publication-category'])));
    $query_args["category_name"] = $publication_category;
    $params_arg["publication-category"] = $publication_category;
}


if (isset($_GET['publication-city']) && $_GET['publication-city'] != "") {
    $publication_city = removeslashes(esc_attr(trim($_GET['publication-city'])));
    if (isset($_GET['publication-type']) && $_GET['publication-type'] == "alerts") {
        $query_args["meta_query"] = array(
            'relation' => 'OR',
            array(
                "key" => 'alert-city',
                "value" => $publication_city,
                "compare" => 'LIKE'
            ),
            array(
                "key" => 'alert-google-places-city',
                "value" => $publication_city,
                "compare" => 'LIKE'
            )
        );
    } else {
        $query_args["meta_query"] = array(
            'relation' => 'OR',
            array(
                "key" => 'publication-city',
                "value" => $publication_city,
                "compare" => 'LIKE'
            ),
            array(
                "key" => 'publication-google-places-city',
                "value" => $publication_city,
                "compare" => 'LIKE'
            )
        );
    }

    $params_arg["publication-city"] = $publication_city;
}
$publications = new WP_Query($query_args);
$total_post_pages = $publications->max_num_pages;
$page_link = get_term_link(get_queried_object_id());
if (isset($_GET['publication-type']) && $_GET['publication-type'] == "alerts") {
    include(locate_template('notifications-pages/content-archive-alerts_cpt.php'));
} else {
    include(locate_template('publications-pages/content-archive-publications_cpt.php'));
}
//Footer 
get_footer();
