<?php

/**
 * Starter Register Demos
 */

function acoustics_demos_list() {

	$plugins = array();

	$plugins[] = array(
		'name'     => 'WooCommerce',
		'slug'     => 'woocommerce',
		'path'     => 'woocommerce/woocommerce.php',
		'required' => true
	);

	$demos = array(
		'cosmetic'      => array(
			'id'    => 'AWP10001',
			'name'       => esc_html__( 'Clothing', 'codegear-starter' ),
			'type'       => 'free',
			'status'	 => 'active',
			'categories' => array( 'ecommerce' ),
			'builders'   => array(
				'elementor',
			),
			'thumbnail'  => 'https://wpcodegear.com/wc/clothing/wp-assets/thumb.png',
			'preview'	 => 'https://wpcodegear.com/wc/clothing',
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
				'content'    => 'https://wpcodegear.com/wc/clothing/wp-assets/acoustics-clothing.xml',
				'widgets'    => 'https://wpcodegear.com/wc/clothing/wp-assets/acoustics-clothing.wie',
				'customizer' => 'https://wpcodegear.com/wc/clothing/wp-assets/acoustics-clothing.dat',
			),
		)
	);

	return $demos;
}
add_filter( 'codegear_register_demos_list', 'acoustics_demos_list' );

function acoustics_update_settings( $settings ){

	$settings['filter'] = false;

	return $settings;

}
add_filter( 'codegear_register_settings', 'acoustics_update_settings' );

/**
 * Define actions that happen after import
 */
function acoustics_setup_after_import() {

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
add_action( 'starter_finish_import', 'acoustics_setup_after_import' );

// Do not create default WooCommerce pages when plugin is activated
// The condition avoid the filter being applied in others pages
// Eg: Woo > Status > Tools > Create default pages
if( isset( $_POST['action'] ) && $_POST['action'] === 'starter_import_plugin' ) {
	add_filter( 'woocommerce_create_pages', function(){
		return array();
	} );
}
