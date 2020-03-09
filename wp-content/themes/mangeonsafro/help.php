<?php

/*
  Template Name: Help Page
 */
if ( wp_redirect( "http://m.me/BledShare.co" ) ) {
    exit;
}
// Header 
get_header();
//Content
include(locate_template('statics-pages/content-help.php'));
//Footer 
get_footer();
