<?php

namespace Roots\Sage\Resources;

use Roots\Sage\Extras;
use Roots\Sage\ResourceOptions;

/**
 * Add an resources custom post type
 */


	// Load required files
	require_once( dirname( __FILE__) . '/resources-options.php' );



	/**
	 * Add the custom post type
	 */
	function punkacademia_resources_add_custom_post_type() {

		$options = ResourceOptions\punkacademia_resources_get_theme_options();
		$labels = array(
			'name'               => _x( 'Class Resources', 'post type general name', 'punkacademia' ),
			'singular_name'      => _x( 'class', 'post type singular name', 'punkacademia' ),
			'add_new'            => _x( 'Add New', 'classes', 'punkacademia' ),
			'add_new_item'       => __( 'Add New Resource', 'punkacademia' ),
			'edit_item'          => __( 'Edit Resource', 'punkacademia' ),
			'new_item'           => __( 'New Resource', 'punkacademia' ),
			'all_items'          => __( 'All Class Resources', 'punkacademia' ),
			'view_item'          => __( 'View Class Resource', 'punkacademia' ),
			'search_items'       => __( 'Search Class Resources', 'punkacademia' ),
			'not_found'          => __( 'No Class Resources found', 'punkacademia' ),
			'not_found_in_trash' => __( 'No Class Resources found in the Trash', 'punkacademia' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Class Resources', 'punkacademia' ),
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Holds our classes',
			'public'        => true,
			// 'menu_position' => 5,
			'menu_icon'     => 'dashicons-welcome-add-page',
			'supports'      => array(
				'title',
				'editor',
				'excerpt',
				'revisions',
				'wpcom-markdown',
				'author',
				'page-attributes',
				'thumbnail',
				'custom-fields'
			),
			'has_archive'   => true,
			'hierarchical'   => true,
			'taxonomies' => array( 'class-name' ),
			'rewrite' => array(
				'slug' => 'resources',
			)
		);

		register_post_type( 'punkacademia-classes', $args );

	}
	add_action( 'init', __NAMESPACE__ . '\\punkacademia_resources_add_custom_post_type' );

//create a custom taxonomy name it topics for your posts
function create_topics_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Classes', 'taxonomy general name' ),
    'singular_name' => _x( 'Class', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Classes' ),
    'all_items' => __( 'All Classes' ),
    'parent_item' => __( 'Parent Class' ),
    'parent_item_colon' => __( 'Parent Class:' ),
    'edit_item' => __( 'Edit Class' ),
    'update_item' => __( 'Update Class' ),
    'add_new_item' => __( 'Add New Class' ),
    'new_item_name' => __( 'New Class Name' ),
    'menu_name' => __( 'Specific Classes' ),
  );

// Now register the taxonomy

  register_taxonomy('class-name',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'class-name' ),
  ));

}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', __NAMESPACE__ . '\\create_topics_hierarchical_taxonomy', 0 );


