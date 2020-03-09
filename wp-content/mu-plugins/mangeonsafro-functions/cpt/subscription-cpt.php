<?php
/**
 * Register a subscription post type.
 *
 */
function mangeonsafro_subscription_init() {
	$labels = array(
		'name'               => _x( 'Subscriptions', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Subscription', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Subscriptions', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Subscription', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'subscription', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Subscription', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Subscription', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Subscription', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Subscription', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All Subscriptions', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search Subscriptions', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent Subscriptions:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No subscriptions found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No subscriptions found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Custom post type of subscriptions', 'mangeonsafrodomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'subscriptions'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category')
	);

	register_post_type( 'subscriptions_cpt', $args );
}