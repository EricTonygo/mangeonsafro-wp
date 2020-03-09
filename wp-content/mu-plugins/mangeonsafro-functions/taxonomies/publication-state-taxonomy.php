<?php

// create taxonomy publication  "publication state"  for the post state "publication"
function create_publication_state_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Publication  States', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Publication  State', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Publication  States', 'textdomain' ),
		'all_items'         => __( 'All Publication  States', 'textdomain' ),
		'parent_item'       => __( 'Parent Publication  State', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Publication  State:', 'textdomain' ),
		'edit_item'         => __( 'Edit Publication  State', 'textdomain' ),
		'update_item'       => __( 'Update Publication  State', 'textdomain' ),
		'add_new_item'      => __( 'Add New Publication  State', 'textdomain' ),
		'new_item_name'     => __( 'New Publication  State Name', 'textdomain' ),
		'menu_name'         => __( 'Publication  States', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
                'update_count_callback' => '_update_post_term_count',
		'rewrite'           => array( 'slug' => 'publications-states' ),
	);

	register_taxonomy( 'publication_state', array( 'publications_cpt', 'alerts_cpt' ), $args );
}