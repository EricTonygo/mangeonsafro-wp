<?php
/**
 * Register a review post type.
 *
 */
function mangeonsafro_review_init() {
    
	$labels = array(
		'name'               => _x( 'Reviews', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Review', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Reviews', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Review', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'review', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Review', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Review', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Review', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Review', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All Reviews', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search Reviews', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent Reviews:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No reviews found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No reviews found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __('Description.', 'mangeonsafrodomain'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'reviews'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
	);

	register_post_type( 'reviews_cpt', $args );
}