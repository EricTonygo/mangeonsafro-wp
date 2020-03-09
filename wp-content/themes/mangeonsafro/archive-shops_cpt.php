<?php

session_start();
wp_reset_postdata();

// Header 
get_header();
//Content
$author = null;
$search_keyword= null;
$publication_category = null;
$publication_subject = null;
$publication_state = null;
$publication_city = null;
$params_arg = array();
$query_args = array('post_type' => 'shops_cpt', 'posts_per_page' =>12, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC');

if(isset($_GET["q"])){
    $search_keyword = removeslashes(esc_attr(trim($_GET['q'])));
    $query_args["s"] = $search_keyword;
}

if (isset($_GET['post-user']) && $_GET['post-user'] != "") {
    $post_user = removeslashes(esc_attr(trim($_GET['post-user'])));
    $user = get_user_by('login', $post_user);
    $author = $user->ID;
    $query_args["author"] = $author;
    $user_bookstore = $user->data->user_login;
    $user_display_name = $user->data->display_name;
    $params_arg["post-user"]= $user_bookstore;
}

if (isset($_GET['page']) && $_GET['page']!= "") {
    $num_page = intval(removeslashes(esc_attr(trim($_GET['page']))));
    $query_args["paged"] = $num_page;
}else{
    $num_page = 1;
}

if (isset($_GET['publication-category']) && $_GET['publication-category']!= "") {
    $publication_category = removeslashes(esc_attr(trim($_GET['publication-category'])));
    $query_args["category_name"] = $publication_category;
    $params_arg["publication-category"] = $publication_category;
}

if (isset($_GET['publication-subject']) && $_GET['publication-subject']!= "") {
    $publication_subject_slug = removeslashes(esc_attr(trim($_GET['publication-subject'])));
    $query_args["tax_query"] = array(
        array(
            "taxonomy" => 'publication_subject',
            "field" => "slug",
            "terms" => $publication_subject_slug
        )
    );
    $params_arg["publication-subject"] = $publication_subject_slug;
}

if (isset($_GET['publication-state']) && $_GET['publication-state'] != "") {
    $publication_state_slug = removeslashes(esc_attr(trim($_GET['publication-state'])));
    $query_args["tax_query"] = array(
        array(
            "taxonomy" => 'publication_state',
            "field" => "slug",
            "terms" => $publication_state_slug
        )
    );
    $params_arg["publication-state"] = $publication_state_slug;
}

if (isset($_GET['publication-city']) && $_GET['publication-city'] != "") {
    $publication_city = removeslashes(esc_attr(trim($_GET['publication-city'])));
    $query_args["meta_query"] = array(
        'relation' => 'OR',
        array(
            "key" => 'shop-city',
            "value" => $publication_city,
            "compare" => 'LIKE'
        ),
        array(
            "key" => 'shop-google-places-city',
            "value" => $publication_city,
            "compare" => 'LIKE'
        )
    );
    $params_arg["publication-city"] = $publication_city;
}
$publications = new WP_Query($query_args);
$total_post_pages = $publications->max_num_pages;
$page_link = get_post_type_archive_link( 'shops_cpt' );
include(locate_template('shops-pages/content-archive-shops_cpt.php'));
//Footer 
get_footer();


