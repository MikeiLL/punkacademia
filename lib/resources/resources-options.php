<?php

namespace Roots\Sage\ResourceOptions;

use Roots\Sage\Extras;

/**
 * Resources Options
 */

	// Page

	function punkacademia_resources_settings_field_page_slug() {
		$options = punkacademia_resources_get_theme_options();
		?>
		<input type="text" name="punkacademia_resources_theme_options[page_slug]" id="page_slug" value="<?php echo esc_attr( $options['page_slug'] ); ?>" />
		<label resource="description" for="page_slug">
			<?php _e( 'The URL path for your resources page (ex. if you put <code>resources</code>, your upcoming resources would be displayed at <code>yourwebsite.com/resources/upcoming</code> and your past resources would be displayed at <code>yourwebsite.com/resources/past</code>', 'punkacademia' ); ?> <strong><?php _e( 'Note:', 'punkacademia' ); ?></strong> <em><?php _e( 'It this doesn\'t work, try saving your options again. It\'s absurd, but it works.', 'punkacademia' ); ?></em>
		</label>
		<?php
	}


	/**
	 * Theme Option Defaults & Sanitization
	 * Each option field requires a default value under punkacademia_resources_get_theme_options(), and an if statement under punkacademia_resources_theme_options_validate();
	 */

	// Get the current options from the database.
	// If none are specified, use these defaults.
	function punkacademia_resources_get_theme_options() {
		$saved = (array) get_option( 'punkacademia_resources_theme_options' );
		$defaults = array(
			'page_slug' => 'resources',
		);

		$defaults = apply_filters( __NAMESPACE__ . '\\punkacademia_resources_default_theme_options', $defaults );

		$options = wp_parse_args( $saved, $defaults );
		$options = array_intersect_key( $options, $defaults );

		return $options;
	}

	// Sanitize and validate updated theme options
	function punkacademia_resources_theme_options_validate( $input ) {
		$output = array();

		// Page content

		if ( isset( $input['page_slug'] ) && ! empty( $input['page_slug'] ) )
			$output['page_slug'] = wp_filter_nohtml_kses( $input['page_slug'] );

		return apply_filters( __NAMESPACE__ . '\\punkacademia_resources_theme_options_validate', $output, $input );
	}



	/**
	 * Theme Options Menu
	 * Each option field requires its own add_settings_field function.
	 */

	// Create theme options menu
	// The content that's rendered on the menu page.
	function punkacademia_resources_theme_options_render_page() {
		?>
		<div resource="wrap">
			<h2><?php _e( 'Resources Options', 'punkacademia' ); ?></h2>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'punkacademia_resources_options' );
					do_settings_sections( 'resources_options' );
					wp_nonce_field( 'punkacademia_resources_update_options_nonce', 'punkacademia_resources_update_options_process' );
					submit_button();
				?>
			</form>
		</div>
		<?php
	}

	// Register the theme options page and its fields
	function punkacademia_resources_theme_options_init() {

		// Register a setting and its sanitization callback
		// register_setting( $option_group, $option_name, $sanitize_callback );
		// $option_group - A settings group name.
		// $option_name - The name of an option to sanitize and save.
		// $sanitize_callback - A callback function that sanitizes the option's value.
		register_setting( 'punkacademia_resources_options', 'punkacademia_resources_theme_options', __NAMESPACE__ . '\\punkacademia_resources_theme_options_validate' );


		// Register our settings field group
		// add_settings_section( $id, $title, $callback, $page );
		// $id - Unique identifier for the settings section
		// $title - Section title
		// $callback - // Section callback (we don't want anything)
		// $page - // Menu slug, used to uniquely identify the page. See punkacademia_resources_theme_options_add_page().
		add_settings_section( 'page_content', __( 'Page Content', 'punkacademia' ),  '__return_false', 'resources_options' );


		// Register our individual settings fields
		// add_settings_field( $id, $title, $callback, $page, $section );
		// $id - Unique identifier for the field.
		// $title - Setting field title.
		// $callback - Function that creates the field (from the Theme Option Fields section).
		// $page - The menu page on which to display this field.
		// $section - The section of the settings page in which to show the field.

		add_settings_field( 'page_slug', __( 'URL Path', 'punkacademia' ), __NAMESPACE__ . '\\punkacademia_resources_settings_field_page_slug', 'resources_options', 'page_content' );
	}
	add_action( 'admin_init', __NAMESPACE__ . '\\punkacademia_resources_theme_options_init' );

	// Add the theme options page to the admin menu
	// Use add_theme_page() to add under Appearance tab (default).
	// Use add_menu_page() to add as it's own tab.
	// Use add_submenu_page() to add to another tab.
	function punkacademia_resources_theme_options_add_page() {

		// add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function );
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function );
		// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		// $page_title - Name of page
		// $menu_title - Label in menu
		// $capability - Capability required
		// $menu_slug - Used to uniquely identify the page
		// $function - Function that renders the options page
		// $theme_page = add_theme_page( __( 'Theme Options', 'punkacademia' ), __( 'Theme Options', 'punkacademia' ), 'edit_theme_options', 'resources_options', 'punkacademia_resources_theme_options_render_page' );

		// $theme_page = add_menu_page( __( 'Theme Options', 'punkacademia' ), __( 'Theme Options', 'punkacademia' ), 'edit_theme_options', 'resources_options', 'punkacademia_resources_theme_options_render_page' );
		$theme_page = add_submenu_page( 'edit.php?post_type=punkacademia-class-resources', __( 'Options', 'punkacademia' ), __( 'Options', 'punkacademia' ), 'edit_theme_options', 'resources_options', __NAMESPACE__ . '\\punkacademia_resources_theme_options_render_page' );
	}
	add_action( 'admin_menu', __NAMESPACE__ . '\\punkacademia_resources_theme_options_add_page' );



	// Restrict access to the theme options page to admins
	function punkacademia_resources_option_page_capability( $capability ) {
		return 'edit_theme_options';
	}
	add_filter( 'option_page_capability_punkacademia_resources_options', __NAMESPACE__ . '\\punkacademia_resources_option_page_capability' );



	// Update resources URL
	function punkacademia_resources_refresh_slug() {
		if ( isset( $_POST['punkacademia_resources_update_options_process'] ) ) {
			if ( wp_verify_nonce( $_POST['punkacademia_resources_update_options_process'], 'punkacademia_resources_update_options_nonce' ) ) {
				flush_rewrite_rules();
			}
		}
	}
	add_action( 'init', __NAMESPACE__ . '\\punkacademia_resources_refresh_slug' );
