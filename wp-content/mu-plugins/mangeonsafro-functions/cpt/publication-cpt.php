<?php
/**
 * Register a publication post type.
 *
 */
function bookshare_publication_init() {
	$labels = array(
		'name'               => _x( 'Publications', 'post type general name', 'booksharedomain' ),
		'singular_name'      => _x( 'Publication', 'post type singular name', 'booksharedomain' ),
		'menu_name'          => _x( 'Publications', 'admin menu', 'booksharedomain' ),
		'name_admin_bar'     => _x( 'Publication', 'add new on admin bar', 'booksharedomain' ),
		'add_new'            => _x( 'Add New', 'publication', 'booksharedomain' ),
		'add_new_item'       => __( 'Add New Publication', 'booksharedomain' ),
		'new_item'           => __( 'New Publication', 'booksharedomain' ),
		'edit_item'          => __( 'Edit Publication', 'booksharedomain' ),
		'view_item'          => __( 'View Publication', 'booksharedomain' ),
		'all_items'          => __( 'All Publications', 'booksharedomain' ),
		'search_items'       => __( 'Search Publications', 'booksharedomain' ),
		'parent_item_colon'  => __( 'Parent Publications:', 'booksharedomain' ),
		'not_found'          => __( 'No publications found.', 'booksharedomain' ),
		'not_found_in_trash' => __( 'No publications found in Trash.', 'booksharedomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'booksharedomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'books' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category')
	);

	register_post_type( 'publications_cpt', $args );
}