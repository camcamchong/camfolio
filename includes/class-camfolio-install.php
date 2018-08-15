<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Camfolio_Install
 */
class Camfolio_Install {
	
	
	/**
	 * install function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function install() {
		
	
		// Redirect to setup screen for new installs
		if ( ! get_option(  'camfolio_version' ) ) {
			set_transient( '_camfolio_activation_redirect', 1, HOUR_IN_SECONDS);
		}
		
		delete_transient( 'camfolio_addons_html' );
		update_option( 'camfolio_version', CAMFOLIO_VERSION );
	}
	

}