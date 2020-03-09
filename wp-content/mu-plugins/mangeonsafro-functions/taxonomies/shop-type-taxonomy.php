<?php

// create taxonomy shop  "shop type"  for the post type "shop"
function create_shop_type_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Shop  Types', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Shop  Type', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Shop  Types', 'textdomain' ),
		'all_items'         => __( 'All Shop  Types', 'textdomain' ),
		'parent_item'       => __( 'Parent Shop  Type', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Shop  Type:', 'textdomain' ),
		'edit_item'         => __( 'Edit Shop  Type', 'textdomain' ),
		'update_item'       => __( 'Update Shop  Type', 'textdomain' ),
		'add_new_item'      => __( 'Add New Shop  Type', 'textdomain' ),
		'new_item_name'     => __( 'New Shop  Type Name', 'textdomain' ),
		'menu_name'         => __( 'Shop  Types', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
                'update_count_callback' => '_update_post_term_count',
		'rewrite'           => array( 'slug' => 'shops' ),
	);

	register_taxonomy( 'shop_type', array( 'shops_cpt' ), $args );
}