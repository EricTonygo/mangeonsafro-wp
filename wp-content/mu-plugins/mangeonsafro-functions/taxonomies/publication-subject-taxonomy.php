<?php

// create taxonomy publication  "publication subject"  for the post subject "publication"
function create_publication_subject_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Publication  Subjects', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Publication  Subject', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Publication  Subjects', 'textdomain' ),
		'all_items'         => __( 'All Publication  Subjects', 'textdomain' ),
		'parent_item'       => __( 'Parent Publication  Subject', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Publication  Subject:', 'textdomain' ),
		'edit_item'         => __( 'Edit Publication  Subject', 'textdomain' ),
		'update_item'       => __( 'Update Publication  Subject', 'textdomain' ),
		'add_new_item'      => __( 'Add New Publication  Subject', 'textdomain' ),
		'new_item_name'     => __( 'New Publication  Subject Name', 'textdomain' ),
		'menu_name'         => __( 'Publication  Subjects', 'textdomain' ),
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

	register_taxonomy( 'publication_subject', array( 'publications_cpt', 'alerts_cpt' ), $args );
}