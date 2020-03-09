<?php
/**
 * Register a booking post type.
 *
 */
function mangeonsafro_booking_init() {
	$labels = array(
		'name'               => _x( 'Bookings', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Booking', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Bookings', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Booking', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'booking', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Booking', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Booking', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Booking', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Booking', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All Bookings', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search Bookings', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent Bookings:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No bookings found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No bookings found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Custom post type of bookings', 'mangeonsafrodomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'bookings' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category')
	);

	register_post_type( 'bookings_cpt', $args );
}