<?php
/**
 * Register a LineBooking post type.
 *
 */
function mangeonsafro_lineBooking_init() {
    
	$labels = array(
		'name'               => _x( 'Line bookings', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Line booking', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Line bookings', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Line booking', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'lineBooking', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Line booking', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Line booking', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Line booking', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Line booking', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All Line bookings', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search Line bookings', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent Line bookings:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No line bookings found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No line bookings found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __('Description.', 'mangeonsafrodomain'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'line-bookings'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
	);

	register_post_type( 'line-bookings_cpt', $args );
}