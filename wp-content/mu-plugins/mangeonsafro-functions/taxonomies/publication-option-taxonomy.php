<?php

// create taxonomy publication  "publication option"  for the post option "publication"
function create_publication_option_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Publication  Options', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Publication  Option', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Publication  Options', 'textdomain' ),
		'all_items'         => __( 'All Publication  Options', 'textdomain' ),
		'parent_item'       => __( 'Parent Publication  Option', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Publication  Option:', 'textdomain' ),
		'edit_item'         => __( 'Edit Publication  Option', 'textdomain' ),
		'update_item'       => __( 'Update Publication  Option', 'textdomain' ),
		'add_new_item'      => __( 'Add New Publication  Option', 'textdomain' ),
		'new_item_name'     => __( 'New Publication  Option Name', 'textdomain' ),
		'menu_name'         => __( 'Publication  Options', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
                'update_count_callback' => '_update_post_term_count',
		'rewrite'           => array('slug' => 'publications-sale-options' ),
	);

	register_taxonomy( 'publication_option', array( 'publications_cpt', 'alerts_cpt' ), $args );
}