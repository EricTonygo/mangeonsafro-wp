<?php

/**
 * Register a currency post type.
 *
 */
function mangeonsafro_currency_init() {
	$labels = array(
		'name'               => _x( 'Currencies', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Currency', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Currencies', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Currency', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'currency', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Currency', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Currency', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Currency', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Currency', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All Currencies', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search Currencies', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent Currencies:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No currencies found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No currencies found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Custom post type of currencies', 'mangeonsafrodomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'currencies' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'excerpt', ),
	);

	register_post_type( 'currencies_cpt', $args );
}