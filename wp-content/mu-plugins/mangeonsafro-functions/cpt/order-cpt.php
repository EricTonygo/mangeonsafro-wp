<?php
/**
 * Register a order post type.
 *
 */
function mangeonsafro_order_init() {
	$labels = array(
		'name'               => _x( 'Orders', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Order', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Orders', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Order', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'order', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Order', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Order', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Order', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Order', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All Orders', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search Orders', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent Orders:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No orders found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No orders found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Custom post type of orders', 'mangeonsafrodomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'orders' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category')
	);

	register_post_type( 'orders_cpt', $args );
}