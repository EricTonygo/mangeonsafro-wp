<?php

/**
 * Register a shop post type.
 *
 */
function mangeonsafro_shop_init() {
	$labels = array(
		'name'               => _x( 'Shops', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Shop', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Shops', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Shop', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'shop', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Shop', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New shop', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit shop', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View shop', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All shops', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search shops', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent shops:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No shops found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No shops found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description', 'mangeonsafrodomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'shops' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category')
	);

	register_post_type( 'shops_cpt', $args );
}