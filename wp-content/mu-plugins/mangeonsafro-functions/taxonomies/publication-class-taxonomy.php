<?php

// create taxonomy publication  "publication class"  for the post class "publication"
function create_publication_class_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Publication  Class', 'taxonomy general name', 'booksharedomain' ),
		'singular_name'     => _x( 'Publication  Class', 'taxonomy singular name', 'booksharedomain' ),
		'search_items'      => __( 'Search Publication  Class', 'booksharedomain' ),
		'all_items'         => __( 'All Publication  Class', 'booksharedomain' ),
		'parent_item'       => __( 'Parent Publication  Class', 'booksharedomain' ),
		'parent_item_colon' => __( 'Parent Publication  Class:', 'booksharedomain' ),
		'edit_item'         => __( 'Edit Publication  Class', 'booksharedomain' ),
		'update_item'       => __( 'Update Publication  Class', 'booksharedomain' ),
		'add_new_item'      => __( 'Add New Publication  Class', 'booksharedomain' ),
		'new_item_name'     => __( 'New Publication  Class Name', 'booksharedomain' ),
		'menu_name'         => __( 'Publication  Class', 'booksharedomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
                'update_count_callback' => '_update_post_term_count',
		'rewrite'           => array( 'slug' => 'publications' ),
	);

	//register_taxonomy( 'publication_class', array( 'publications_cpt', 'alerts_cpt' ), $args );
}