<?php
/**
 * Register a partner post type.
 *
 */
function mangeonsafro_partner_init() {
	$labels = array(
		'name'               => _x( 'Partners', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Partner', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Partners', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Partner', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'partner', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Partner', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Partner', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Partner', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Partner', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All Partners', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search Partners', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent Partners:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No partners found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No partners found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Custom post type of partners', 'mangeonsafrodomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'partners' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category')
	);

	register_post_type( 'partners_cpt', $args );
}