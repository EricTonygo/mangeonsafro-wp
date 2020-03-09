<?php
/**
 * Register a LineOrder post type.
 *
 */
function mangeonsafro_lineOrder_init() {
    
	$labels = array(
		'name'               => _x( 'Line orders', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Line order', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Line orders', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Line order', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'line order', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Line order', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Line order', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Line order', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Line order', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All Line orders', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search Line orders', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent Line orders:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No line orders found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No line orders found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __('Description.', 'mangeonsafrodomain'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'line-orders'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
	);

	register_post_type( 'line-orders_cpt', $args );
}