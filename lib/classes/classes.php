<?php

namespace Roots\Sage\Classes;

use Roots\Sage\Extras;
use Roots\Sage\ClassOptions;
use DateTimeZone;

/**
 * Add an classes custom post type
 */


	// Load required files
	require_once( dirname( __FILE__) . '/classes-options.php' );



	/**
	 * Add the custom post type
	 */
	function punkacademia_classes_add_custom_post_type() {

		// Check that feature is activated
		//Not using this option from keel_harbor_theme
		//$dev_options = punkacademia_developer_options();
		//if ( !$dev_options['classes'] ) return;

		$options = ClassOptions\punkacademia_classes_get_theme_options();
		$labels = array(
			'name'               => _x( 'Classes', 'post type general name', 'punkacademia' ),
			'singular_name'      => _x( 'Class', 'post type singular name', 'punkacademia' ),
			'add_new'            => _x( 'Add New', 'classes', 'punkacademia' ),
			'add_new_item'       => __( 'Add New Class', 'punkacademia' ),
			'edit_item'          => __( 'Edit Class', 'punkacademia' ),
			'new_item'           => __( 'New Class', 'punkacademia' ),
			'all_items'          => __( 'All Classes', 'punkacademia' ),
			'view_item'          => __( 'View Class', 'punkacademia' ),
			'search_items'       => __( 'Search Classes', 'punkacademia' ),
			'not_found'          => __( 'No classes found', 'punkacademia' ),
			'not_found_in_trash' => __( 'No classes found in the Trash', 'punkacademia' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Classes', 'punkacademia' ),
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Holds our classes and class-specific data',
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
			'taxonomies' => array( 'category' ),
			'rewrite' => array(
				'slug' => 'classes',
			)
		);
		register_post_type( 'punkacademia-classes', $args );
	}
	add_action( 'init', __NAMESPACE__ . '\\punkacademia_classes_add_custom_post_type' );





	/**
	 * Save classes data to revisions
	 * @param  Number $post_id The post ID
	 */
	function punkacademia_classes_save_revisions( $post_id ) {

		// Check if it's a revision
		$parent_id = wp_is_post_revision( $post_id );

		// If is revision
		if ( $parent_id ) {

			// Get the data
			$parent = get_post( $parent_id );

		}

	}
	add_action( 'save_post', __NAMESPACE__ . '\\punkacademia_classes_save_revisions' );



	/**
	 * Restore classes data with post revisions
	 * @param  Number $post_id     The post ID
	 * @param  Number $revision_id The revision ID
	 */
	function punkacademia_classes_restore_revisions( $post_id, $revision_id ) {

		// Variables
		$post = get_post( $post_id );
		$revision = get_post( $revision_id );
		$class_details = array();

	}
	add_action( 'wp_restore_post_revision', __NAMESPACE__ . '\\punkacademia_classes_restore_revisions', 10, 2 );



	/**
	 * Get the data to display on the revisions page
	 * @param  Array $fields The fields
	 * @return Array The fields
	 */
	function punkacademia_classes_get_revisions_fields( $fields ) {
		foreach ( $class_defaults as $key => $value ) {
			$fields['punkacademia_classes_details_' . $key] = ucfirst( $key );
		}
		return $fields;
	}
	add_filter( '_wp_post_revision_fields', __NAMESPACE__ . '\\punkacademia_classes_get_revisions_fields' );



	/**
	 * Display the data on the revisions page
	 * @param  String|Array $value The field value
	 * @param  Array        $field The field
	 */
	function punkacademia_classes_display_revisions_fields( $value, $field ) {
		global $revision;
	}
	add_filter( '_wp_post_revision_field_my_meta', __NAMESPACE__ . '\\punkacademia_classes_display_revisions_fields', 10, 2 );


