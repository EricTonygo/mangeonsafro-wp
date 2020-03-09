<?php

/*
  Template Name:  Contents Categories
 */

// Header 
get_header();
//Content
$publications = new WP_Query(array('post_type' => 'publications_cpt', 'posts_per_page' => 12, "post_status" => 'publish', 'orderby' => 'post_date', 'category_name' => get_category(get_query_var('cat'))->name, 'order' => 'DESC'));
include(locate_template('publications-pages/content-archive-publications_cpt.php')); 
//Footer 
get_footer();
