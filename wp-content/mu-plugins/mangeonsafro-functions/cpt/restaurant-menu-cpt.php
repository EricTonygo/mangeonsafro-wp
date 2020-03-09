<?php
/**
 * Register a restaurantMenu post type.
 *
 */
function mangeonsafro_restaurantMenu_init() {
	$labels = array(
		'name'               => _x( 'Restaurant menus', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Restaurant menu', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Restaurant menus', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Restaurant menu', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'restaurant menu', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Restaurant menu', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Restaurant menu', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Restaurant menu', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Restaurant menu', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All Restaurant menus', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search Restaurant menus', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent Restaurant menus:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No restaurant menus found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No restaurant menus found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Custom post type of restaurant menu', 'mangeonsafrodomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'restaurant-menus' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category')
	);

	register_post_type( 'restaurant-menus_cpt', $args );
}