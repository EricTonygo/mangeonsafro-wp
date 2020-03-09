<?php
/**
 * Register a product post type.
 *
 */
function mangeonsafro_product_init() {
	$labels = array(
		'name'               => _x( 'Products', 'post type general name', 'mangeonsafrodomain' ),
		'singular_name'      => _x( 'Product', 'post type singular name', 'mangeonsafrodomain' ),
		'menu_name'          => _x( 'Products', 'admin menu', 'mangeonsafrodomain' ),
		'name_admin_bar'     => _x( 'Product', 'add new on admin bar', 'mangeonsafrodomain' ),
		'add_new'            => _x( 'Add New', 'product', 'mangeonsafrodomain' ),
		'add_new_item'       => __( 'Add New Product', 'mangeonsafrodomain' ),
		'new_item'           => __( 'New Product', 'mangeonsafrodomain' ),
		'edit_item'          => __( 'Edit Product', 'mangeonsafrodomain' ),
		'view_item'          => __( 'View Product', 'mangeonsafrodomain' ),
		'all_items'          => __( 'All Products', 'mangeonsafrodomain' ),
		'search_items'       => __( 'Search Products', 'mangeonsafrodomain' ),
		'parent_item_colon'  => __( 'Parent Products:', 'mangeonsafrodomain' ),
		'not_found'          => __( 'No products found.', 'mangeonsafrodomain' ),
		'not_found_in_trash' => __( 'No products found in Trash.', 'mangeonsafrodomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description', 'mangeonsafrodomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'products' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
                'taxonomies'         => array('category')
	);

	register_post_type( 'products_cpt', $args );
}