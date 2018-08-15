<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Camfolio_Admin class.
 */
class Camfolio_Admin {
	
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
// 		include_once( 'class-hiitv-cpt.php' );
		include_once( 'class-camfolio-settings.php' );
// 		include_once( 'class-hiitv-writepanels.php' );
		//include_once( 'class-hiitv-setup.php' );

		//$this->settings_page = new HiiTV_Settings();

		add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}
	
	/**
	 * admin_enqueue_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_enqueue_scripts() {
		global $wp_scripts;

		$screen = get_current_screen();		
		wp_enqueue_style( 'camfolio_admin_css', CAMFOLIO_URL . '/assets/css/admin.css', array(), CAMFOLIO_VERSION );
	}
	
	/**
	 * admin_menu function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_menu() {
		global $menu;
		
		$main_page = add_menu_page( __( 'Camfolio', 'camfolio' ), __( 'Camfolio', 'camfolio' ),  array( $this, 'settings_page' ), 'dashicons-image-alt', '30' );
	}
	
	/**
	 * Init the settings page
	 */
	public function settings_page() {
		
	}

}

new Camfolio_Admin();