<?php
/**
 * Register a historical post type.
 *
 */
function mangeonsafro_historical_init() {
	$labels = array(
		'name'               => _x( 'History', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Historical', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'History', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Historical', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'historical', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Historical', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Historical', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Historical', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Historical', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All History', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search History', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent History:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No history found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No history found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Custom post type of history', 'mangeonsafrodomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'history'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category')
	);

	register_post_type( 'history_cpt', $args );
}