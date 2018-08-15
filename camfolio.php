<?php
   /*
   Plugin Name: Camfolio
   description: Portfolio but Cam! Therefore Camfolio!
  a plugin to create awesomeness and spread joy
   Version: 0.1
   Author: Cam
   */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Camfolio class.
 * Handles core plugin hooks and action setup.
 *
 * @package camfolio
 * @since 1.0.0
 */
class Camfolio {
	
	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since  0.1
	 */
	private static $_instance = null;

	/**
	 * @var Camfolio_REST_API
	 */
	private $rest_api = null;

	/**
	 * Main Camfolio Instance.
	 *
	 * Ensures only one instance of Camfolio is loaded or can be loaded.
	 *
	 * @since  1.0.0
	 * @static
	 * @see Camfolio()
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/**
	 * Constructor - get the plugin hooked in and ready
	 */
	public function __construct() {
		// Define constants
		define( 'CAMFOLIO_VERSION', '0.1' );
		define( 'CAMFOLIO_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
		define( 'CAMFOLIO_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
		
		if(class_exists('CMB2_Bootstrap_226_Trunk')){
		include( 'addons/cmb2/functions.php' );

			$CMB2_Bootstrap_226_Trunk = new CMB2_Bootstrap_226_Trunk();
		}

		
		if(class_exists('PW_CMB2_Field_Select_Tagger')){
		include( 'addons/cmb-field-select_tagger/cmb-field-select_tagger.php' );

			$PW_CMB2_Field_Select_Tagger = new PW_CMB2_Field_Select_Tagger();
		}
	
	
		if(class_exists('MAG_CMB2_Field_Post_Search_Ajax')){
		include( 'addons/cmb2-field-post-search-ajax/cmb-field-post-search-ajax.php' );

			$MAG_CMB2_Field_Post_Search_Ajax = new MAG_CMB2_Field_Post_Search_Ajax();
		}

		if(class_exists('WDS_CMB2_Attached_Posts_Field_126')){
			include( 'addons/cmb2-attached-posts-field/cmb2-attached-posts-field.php' );
			$WDS_CMB2_Attached_Posts_Field_126 = new WDS_CMB2_Attached_Posts_Field_126();

		}
		include( 'addons/cmb2-field-type-tags/cmb2-field-type-tags.php' );
		
		if(class_exists('CMB2_Taxonomy')){
		include( 'addons/cmb2-taxonomy/init.php' );
			$CMB2_Taxonomy = new CMB2_Taxonomy();
		}
		
		// Includes
		include( 'includes/class-camfolio-install.php');
		include( 'includes/class-camfolio-post-types.php');
		include( 'includes/class-camfolio-shortcodes.php'); //*
		//include( 'includes/class-hiitv-api.php');
		if ( file_exists( CAMFOLIO_DIR . '/addons/cmb2/init.php' ) ) {
				require_once  CAMFOLIO_DIR . '/addons/cmb2/init.php';
		} 
		
		if( is_admin() ) {
			include( 'includes/admin/class-camfolio-admin.php');
		}
		
		// Init classes
		$this->post_types = new Camfolio_Post_Types();
		
		// Activation - works with symlinks
		register_activation_hook( basename( dirname( __FILE__ ) ) . '/'. basename( __FILE__ ), array( $this, 'activate' ) );
		
		// Switch theme
		add_action( 'after_switch_theme', array( $this->post_types, 'register_post_types'), 11);
		add_action( 'after_switch_theme', 'flush_rewrite_rules', 15);
		
		// Actions
		add_action( 'after_setup_theme', array( $this, 'load_plugin_textdomain') );
		add_action( 'after_setup_theme', array( $this, 'include_template_functions' ), 11);
		add_action( 'widget_init', array( $this, 'widget_init'));
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
		add_action( 'admin_init', array( $this, 'updater') );
// 		add_action( 'wp_footer', array( $this, 'add_fitthem') );
		
		 
			}
			
	
	/**
	 * Called on plugin activation
	 */
	public function activate() {
		$this->post_types->register_post_types();
		Camfolio_Install::install();
		flush_rewrite_rules();
	}
	
	/**
	 * Handle Updates
	 */
	public function updater() {
		if ( version_compare( CAMFOLIO_VERSION, get_option( 'camfolio_version' ), '>' ) ) {
			Camfolio_Install::install();
			flush_rewrite_rules();
		}
	}
	
	/**
	 * Localisation
	 */
	public function load_plugin_textdomain() {
		load_textdomain( 'camfolio', WP_LANG_DIR . 'camfolio/camfolio-' . apply_filters( 'plugin_locale', get_locale( ), 'camfolio' ) . '.mo' );
		load_plugin_textdomain( 'camfolio', false, dirname( plugin_basename( __FILE__ )) . '/languages/' );
	}
	
	/**
	 * Load functions
	 */
	public function include_template_functions() {
		include( 'camfolio-functions.php' );
		//include( 'hiitv-template.php' );
	}

	/**
	 * Widgets init
	 */
	public function widgets_init() {
		include_once( 'includes/class-camfolio-widgets.php' );
	}
	
	/**
	 * Register and enqueue scripts and css
	 */
	public function frontend_scripts() {
		
		wp_register_script( 'camfolio-scripts', CAMFOLIO_URL . '/assets/js/camfolio-scripts.js', array('jquery'), '1.1', true );
		wp_enqueue_script( 'camfolio-scripts');
		
		wp_enqueue_style( 'camfolio-frontend', CAMFOLIO_URL . '/assets/css/frontend.css' );
	}
		
}	

/**
 * Main instance of WP Job Manager.
 *
 * Returns the main instance of WP Job Manager to prevent the need to use globals.
 *
 * @since  1.26
 * @return WP_Job_Manager
 */
function Camfolio() {
	return Camfolio::instance();
}

$GLOBALS['camfolio'] = new Camfolio();

?>