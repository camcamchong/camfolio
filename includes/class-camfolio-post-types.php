<?php
/**
 * HiiTV_Post_Types class.
 * Handles displays and hooks for the HiiTV custom post types.
 *
 * @package hiitv
 * @since 1.0.0
 */
class Camfolio_Post_Types {
	
	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since  1.0.0
	 */
	private static $_instance = null;

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since  1.0.0
	 * @static
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_types'), 0 );
		add_action('cmb2_admin_init', array($this, 'register_meta_boxes'),0);

	}
	
	
	/**
	 * register_taxonomies function.
	 * 
	 * @access public
	 * @return void
	 */

	
	

	
	/**
	 * register_post_types function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register_post_types() {
		$args = array(
			'public' => true,
			'supports' => array('title','editor','author','thumbnail','excerpt'),
			'labels' => array('name' => __('Camfolio','camfolio') ),
			'menu_icon' => 'dashicons-images-alt',
			'hierarchical' => true,
			'public' => true,
			'has_archive' => true,
			'archives' => 'camfolio'
				
		);
		register_post_type( 'camfolio', $args );
			
		
	}
	
	
	
	public function register_meta_boxes(){
		$cmb2 = new_cmb2_box(array(
			'id' => 'camfolio_metabox',
			'title' => esc_html__('Camfolio Metabox', 'camfolio'),
			'object_types' => array('camfolio')
		));
		
		
		$cmb2->add_field(array(
		'name' => __('Showcase Images','camfolio'),
		'desc' => '',
		'id' => 'camfolio-image-attachment',
		'type' => 'file_list'
		));
		
		$cont_group = $cmb2->add_field(array(
		'id' => 'camfolio-contributors',
		'type' => 'group',
		'options' => array(
			'sortable' => true,
			'group_title' => 'Contributors'
		)	
		));
		
		
		$cmb2->add_group_field($cont_group,array(
		'name' => __('Name','camfolio'),
		'desc' => '',
		'id' => 'camfolio-name',
		'type' => 'text'
		));
		
		$cmb2->add_group_field($cont_group,array(
		'name' => __('Website URL','camfolio'),
		'desc' => '',
		'id' => 'camfolio-website',
		'type' => 'text_url'
		));
		
		
		$cmb2->add_field( array(
			'name' => __('Thumbnail Text','camfolio'),
			'desc' => '',
			'default' => '',
			'id' => 'camfolio-thumbnail-text',
			'type' => 'textarea_small'
		));
		
		$cmb2->add_field( array(
		'name' => __('Date','camfolio'),
		'id'   => 'camfolio_textdate_timestamp',
		'type' => 'text_date',
		));
		
		
	}
	
// 	add_action('init', 'authors_post_type');

}