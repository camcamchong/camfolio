
<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Camfolio_Shortcodes {
	

	
	private static $_instance = null;
	
	public static function instance(){
		if( is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function __construct(){
		//add_action( 'wp', array($this, 'shortcode_action_handler'));
		

	}
		
}
Camfolio_Shortcodes::instance();