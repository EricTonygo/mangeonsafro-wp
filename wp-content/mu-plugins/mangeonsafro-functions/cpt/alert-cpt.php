<?php

/**
 * Register a alert post type.
 *
 */
function bookshare_alert_init() {
	$labels = array(
		'name'               => _x( 'Alerts', 'post type general name', 'booksharedomain' ),
		'singular_name'      => _x( 'Alert', 'post type singular name', 'booksharedomain' ),
		'menu_name'          => _x( 'Alerts', 'admin menu', 'booksharedomain' ),
		'name_admin_bar'     => _x( 'Alert', 'add new on admin bar', 'booksharedomain' ),
		'add_new'            => _x( 'Add New', 'alert', 'booksharedomain' ),
		'add_new_item'       => __( 'Add New Alert', 'booksharedomain' ),
		'new_item'           => __( 'New Alert', 'booksharedomain' ),
		'edit_item'          => __( 'Edit Alert', 'booksharedomain' ),
		'view_item'          => __( 'View Alert', 'booksharedomain' ),
		'all_items'          => __( 'All Alerts', 'booksharedomain' ),
		'search_items'       => __( 'Search Alerts', 'booksharedomain' ),
		'parent_item_colon'  => __( 'Parent Alerts:', 'booksharedomain' ),
		'not_found'          => __( 'No alerts found.', 'booksharedomain' ),
		'not_found_in_trash' => __( 'No alerts found in Trash.', 'booksharedomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description', 'booksharedomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'alerts' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category')
	);

	register_post_type( 'alerts_cpt', $args );
}