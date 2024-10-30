<?php

/**
 * Starter Register Demos
 */

function cosme_demos_list() {

	$plugins = array();

	$plugins[] = array(
		'name'     => 'WooCommerce',
		'slug'     => 'woocommerce',
		'path'     => 'woocommerce/woocommerce.php',
		'required' => true
	);

	$plugins[] = array(
		'name'     => 'Designer',
		'slug'     => 'designer',
		'path'     => 'designer/designer.php',
		'required' => true
	);

	$demos = array(
		'handmade'      => array(
			'id'    => 'UGC10002',
			'name'       => esc_html__( 'Handmade', 'codegear-starter' ),
			'type'       => 'free',
			'status'	 => 'active',
			'categories' => array( 'ecommerce' ),
			'builders'   => array(
				'elementor',
			),
			'thumbnail'  => 'https://demo.codegearthemes.com/cosme/handmade/wp-assets/thumb.png',
			'preview'	 => 'https://demo.codegearthemes.com/?id=UGC10002',
			'plugins'    => array_merge(
				array(
					array(
						'name'     => 'Elementor Website Builder',
						'slug'     => 'elementor',
						'path'     => 'elementor/elementor.php',
						'required' => false
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
				'content'    => 'https://demo.codegearthemes.com/cosme/handmade/wp-assets/cosme-handmade.xml',
				'widgets'    => 'https://demo.codegearthemes.com/cosme/handmade/wp-assets/cosme-handmade.wie',
				'customizer' => 'https://demo.codegearthemes.com/cosme/handmade/wp-assets/cosme-handmade.dat',
			),
		),
		'cosmetic'      => array(
			'id'    => 'UGC10003',
			'name'       => esc_html__( 'Cosmetic', 'codegear-starter' ),
			'type'       => 'free',
			'status'	 => 'active',
			'categories' => array( 'ecommerce' ),
			'builders'   => array(
				'elementor',
			),
			'thumbnail'  => 'https://demo.codegearthemes.com/cosme/cosmetic/wp-assets/thumb.png',
			'preview'	 => 'https://demo.codegearthemes.com/?id=UGC10003',
			'plugins'    => array_merge(
				array(
					array(
						'name'     => 'Elementor Website Builder',
						'slug'     => 'elementor',
						'path'     => 'elementor/elementor.php',
						'required' => false
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
				'content'    => 'https://demo.codegearthemes.com/cosme/cosmetic/wp-assets/cosme-cosmetic.xml',
				'widgets'    => 'https://demo.codegearthemes.com/cosme/cosmetic/wp-assets/cosme-cosmetic.wie',
				'customizer' => 'https://demo.codegearthemes.com/cosme/cosmetic/wp-assets/cosme-cosmetic.dat',
			),
		),
		'essence'      => array(
			'id'    => 'UGC10004',
			'name'       => esc_html__( 'Essence', 'codegear-starter' ),
			'type'       => 'pro',
			'status'	 => 'inactive',
			'categories' => array( 'ecommerce' ),
			'builders'   => array(
				'elementor',
			),
			'thumbnail'  => 'https://demo.codegearthemes.com/cosme/essence/wp-assets/thumb.png',
			'preview'	 => 'https://demo.codegearthemes.com/?id=UGC10004',
			'plugins'    => array_merge(
				array(
					array(
						'name'     => 'Elementor Website Builder',
						'slug'     => 'elementor',
						'path'     => 'elementor/elementor.php',
						'required' => false
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
				'content'    => 'https://demo.codegearthemes.com/cosme/essence/wp-assets/cosme-essence.xml',
				'widgets'    => 'https://demo.codegearthemes.com/cosme/essence/wp-assets/cosme-essence.wie',
				'customizer' => 'https://demo.codegearthemes.com/cosme/essence/wp-assets/cosme-essence.dat',
			),
		),
		'organic'      => array(
			'id'    => 'UGC10003',
			'name'       => esc_html__( 'Organic', 'codegear-starter' ),
			'type'       => 'pro',
			'status'	 => 'inactive',
			'categories' => array( 'ecommerce' ),
			'builders'   => array(
				'elementor',
			),
			'thumbnail'  => 'https://demo.codegearthemes.com/cosme/organic/wp-assets/thumb.png',
			'preview'	 => 'https://demo.codegearthemes.com/?id=UGC10005',
			'plugins'    => array_merge(
				array(
					array(
						'name'     => 'Elementor Website Builder',
						'slug'     => 'elementor',
						'path'     => 'elementor/elementor.php',
						'required' => false
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
				'content'    => 'https://demo.codegearthemes.com/cosme/organic/wp-assets/cosme-organic.xml',
				'widgets'    => 'https://demo.codegearthemes.com/cosme/organic/wp-assets/cosme-organic.wie',
				'customizer' => 'https://demo.codegearthemes.com/cosme/organic/wp-assets/cosme-organic.dat',
			),
		)
	);

	return $demos;
}
add_filter( 'codegear_register_demos_list', 'cosme_demos_list' );

function cosme_update_settings( $settings ){
	$settings['filter'] = false;
	$settings['pro_link'] = 'https://www.codegearthemes.com/products/cosme-premium';
	return $settings;

}
add_filter( 'codegear_register_settings', 'cosme_update_settings' );

/**
 * Define actions that happen after import
 */
function cosme_setup_after_import() {

	// Assign the menu.
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	set_theme_mod(
		'nav_menu_locations',
		array(
			'main-menu' => $main_menu->term_id,
		)
	);

	// Asign the static front page and the blog page.
	$front_page = get_page_by_title( 'Home' );
	$blog_page  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page->ID );
	update_option( 'page_for_posts', $blog_page->ID );

	// Create/assign WooCommerce pages
	$shop_page 		= get_page_by_title( 'Shop' );
	$cart_page 		= get_page_by_title( 'Cart' );
	$checkout_page  = get_page_by_title( 'Checkout' );
	$account_page 	= get_page_by_title( 'My Account' );

	update_option( 'woocommerce_shop_page_id', $shop_page->ID );
	update_option( 'woocommerce_cart_page_id', $cart_page->ID );
	update_option( 'woocommerce_checkout_page_id', $checkout_page->ID );
	update_option( 'woocommerce_myaccount_page_id', $account_page->ID );

	// Delete the transient for demo id
	delete_transient( 'starter_importer_demo_id' );

}
add_action( 'starter_finish_import', 'cosme_setup_after_import' );

// Do not create default WooCommerce pages when plugin is activated
// The condition avoid the filter being applied in others pages
// Eg: Woo > Status > Tools > Create default pages
if( isset( $_POST['action'] ) && $_POST['action'] === 'starter_import_plugin' ) {
	add_filter( 'woocommerce_create_pages', function(){
		return array();
	} );
}
