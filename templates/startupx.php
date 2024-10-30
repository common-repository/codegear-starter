<?php

/**
 * Starter Register Demos
 */

function startupx_demos_list() {

	$plugins = array();

	$demos = array(
		'startupx'      => array(
			'id'    => 'UGC10008',
			'name'       => esc_html__( 'Startup', 'codegear-starter' ),
			'type'       => 'free',
			'status'	 => 'active',
			'categories' => array( 'startupx', 'business' ),
			'builders'   => array(
				'elementor',
			),
			'thumbnail'  => 'https://demo.codegearthemes.com/startupx/startup/wp-assets/thumb.png',
			'preview'	 => 'https://demo.codegearthemes.com/?id=UGC10008',
			'plugins'    => array_merge(
				array(
					array(
						'name'     => 'Elementor Website Builder',
						'slug'     => 'elementor',
						'path'     => 'elementor/elementor.php',
						'required' => false
					),
					array(
						'name'     => esc_html__( 'Startupx Toolkit', 'codegear-starter' ),
						'slug'     => 'startupx-toolkit',
						'path'     => 'startupx-toolkit/startupx-toolkit.php',
						'required' => true
					),
					array(
						'name'     => 'Contact Form 7',
						'slug'     => 'contact-form-7',
						'path'     => 'contact-form-7/wp-contact-form-7.php',
						'required' => false
					)
				),
				$plugins
			),
			'import'     => array(
				'content'    => 'https://demo.codegearthemes.com/startupx/startup/wp-assets/startupx-startup.xml',
				'widgets'    => 'https://demo.codegearthemes.com/startupx/startup/wp-assets/startupx-startup.wie',
				'customizer' => 'https://demo.codegearthemes.com/startupx/startup/wp-assets/startupx-startup.dat',
			),
		)
	);

	return $demos;
}
add_filter( 'codegear_register_demos_list', 'startupx_demos_list' );

function startupx_update_settings( $settings ){

	$settings['filter'] = false;

	return $settings;

}
add_filter( 'codegear_register_settings', 'startupx_update_settings' );

/**
 * Define actions that happen after import
 */
function startupx_setup_after_import() {

	// Assign the menu.
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	set_theme_mod(
		'nav_menu_locations',
		array(
			'main-menu' => $main_menu->term_id,
		)
	);

	// Asign the static front page and the blog page.
	update_option( 'show_on_front', 'page' );
	$frontpage = get_posts(
        array(
            'post_type'              => 'page',
            'title'                  => 'Home',
            'post_status'            => 'publish',
            'numberposts'            => 1,
            'orderby'                => 'date',
            'order'                  => 'DESC',
        )
    );
    if( !empty( $frontpage) ){
        $frontpage = $frontpage[0];
        if( !empty( $frontpage ) ){
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $frontpage->ID );
        }
    }

    $blogpage = get_posts(
        array(
            'post_type'              => 'page',
            'title'                  => 'Blog',
            'post_status'            => 'publish',
            'numberposts'            => 1,
            'orderby'                => 'date',
            'order'                  => 'DESC',
        )
    );
    if( !empty( $blogpage) ){
        $blogpage = $blogpage[0];
        if( !empty( $blogpage ) ){
            update_option( 'page_for_posts', $blogpage->ID );
        }
    }

	// Delete the transient for demo id
	delete_transient( 'starter_importer_demo_id' );

}
add_action( 'starter_finish_import', 'startupx_setup_after_import' );
