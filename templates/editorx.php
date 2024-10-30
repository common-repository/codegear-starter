<?php

/**
 * Starter Register Demos
 */

function editorx_demos_list() {

	$plugins = array(
		array(
			'name'     => 'Elementor Website Builder',
			'slug'     => 'elementor',
			'path'     => 'elementor/elementor.php',
			'required' => true
		),
		array(
			'name'     => esc_html__( 'Designer - Elementor Addon', 'codegear-starter' ),
			'slug'     => 'designer',
			'path'     => 'designer/designer.php',
			'required' => true
		)
	);

	$demos = array(
		'default'      => array(
			'id'    => 'UGE10001',
			'name'       => esc_html__( 'Default', 'codegear-starter' ),
			'type'       => 'free',
			'status'	 => 'active',
			'categories' => array( 'Blog', 'Editor' ),
			'builders'   => array(
				'elementor',
			),
			'thumbnail'  => 'https://demo.codegearthemes.com/editorx/default/wp-assets/thumb.webp',
			'preview'	 => 'https://demo.codegearthemes.com/?id=UGE10001',
			'plugins'    => array_merge(
				array(
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
				'content'    => 'https://demo.codegearthemes.com/editorx/default/wp-assets/editorx-default.xml',
				'widgets'    => 'https://demo.codegearthemes.com/editorx/default/wp-assets/editorx-default.wie',
				'customizer' => 'https://demo.codegearthemes.com/editorx/default/wp-assets/editorx-default.dat',
			),
		)
	);

	return $demos;
}
add_filter( 'codegear_register_demos_list', 'editorx_demos_list' );

function editorx_update_settings( $settings ){

	$settings['filter'] = false;

	return $settings;

}
add_filter( 'codegear_register_settings', 'editorx_update_settings' );

/**
 * Define actions that happen after import
 */
function editorx_setup_after_import() {

	$demo_id = get_transient( 'starter_importer_demo_id' );
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
add_action( 'starter_finish_import', 'editorx_setup_after_import' );
