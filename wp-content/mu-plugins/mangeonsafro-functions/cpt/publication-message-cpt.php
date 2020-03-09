<?php
/**
 * Register a publication post type.
 *
 */
function bookshare_message_init() {
    
	$labels = array(
		'name'               => _x( 'Messages', 'post type general name', 'booksharedomain' ),
		'singular_name'      => _x( 'Message', 'post type singular name', 'booksharedomain' ),
		'menu_name'          => _x( 'Messages', 'admin menu', 'booksharedomain' ),
		'name_admin_bar'     => _x( 'Message', 'add new on admin bar', 'booksharedomain' ),
		'add_new'            => _x( 'Add New', 'message', 'booksharedomain' ),
		'add_new_item'       => __( 'Add New Message', 'booksharedomain' ),
		'new_item'           => __( 'New Message', 'booksharedomain' ),
		'edit_item'          => __( 'Edit Message', 'booksharedomain' ),
		'view_item'          => __( 'View Message', 'booksharedomain' ),
		'all_items'          => __( 'All Messages', 'booksharedomain' ),
		'search_items'       => __( 'Search Messages', 'booksharedomain' ),
		'parent_item_colon'  => __( 'Parent Messages:', 'booksharedomain' ),
		'not_found'          => __( 'No messages found.', 'booksharedomain' ),
		'not_found_in_trash' => __( 'No messages found in Trash.', 'booksharedomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __('Description.', 'booksharedomain'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'messages'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
	);

	register_post_type( 'messages_cpt', $args );
}