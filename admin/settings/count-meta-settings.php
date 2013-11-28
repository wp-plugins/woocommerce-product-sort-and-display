<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC PSAD Count Meta Settings

TABLE OF CONTENTS

- var parent_tab
- var subtab_data
- var option_name
- var form_key
- var position
- var form_fields
- var form_messages

- __construct()
- subtab_init()
- set_default_settings()
- get_settings()
- subtab_data()
- add_subtab()
- settings_form()
- init_form_fields()

-----------------------------------------------------------------------------------*/

class WC_PSAD_Count_Meta_Settings extends WC_PSAD_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'view-all-count-meta';
	
	/**
	 * @var array
	 */
	private $subtab_data;
	
	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = '';
	
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'woo_psad_count_meta_settings';
	
	/**
	 * @var string
	 * You can change the order show of this sub tab in list sub tabs
	 */
	private $position = 2;
	
	/**
	 * @var array
	 */
	public $form_fields = array();
	
	/**
	 * @var array
	 */
	public $form_messages = array();
	
	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		$this->init_form_fields();
		$this->subtab_init();
		
		$this->form_messages = array(
				'success_message'	=> __( 'Count Meta Settings successfully saved.', 'wc_psad' ),
				'error_message'		=> __( 'Error: Count Meta Settings can not save.', 'wc_psad' ),
				'reset_message'		=> __( 'Count Meta Settings successfully reseted.', 'wc_psad' ),
			);
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );
			
		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_init' , array( $this, 'reset_default_settings' ) );
		
		//add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
		
		add_action( $this->plugin_name . '-'. $this->form_key.'_settings_start', array( $this, 'pro_fields_before' ) );
		add_action( $this->plugin_name . '-'. $this->form_key.'_settings_end', array( $this, 'pro_fields_after' ) );
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* subtab_init() */
	/* Sub Tab Init */
	/*-----------------------------------------------------------------------------------*/
	public function subtab_init() {
		
		add_filter( $this->plugin_name . '-' . $this->parent_tab . '_settings_subtabs_array', array( $this, 'add_subtab' ), $this->position );
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* set_default_settings()
	/* Set default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function set_default_settings() {
		global $wc_psad_admin_interface;
		
		$wc_psad_admin_interface->reset_settings( $this->form_fields, $this->option_name, false );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* reset_default_settings()
	/* Reset default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function reset_default_settings() {
		global $wc_psad_admin_interface;
		
		$wc_psad_admin_interface->reset_settings( $this->form_fields, $this->option_name, true, true );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* get_settings()
	/* Get settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function get_settings() {
		global $wc_psad_admin_interface;
		
		$wc_psad_admin_interface->get_settings( $this->form_fields, $this->option_name );
	}
	
	/**
	 * subtab_data()
	 * Get SubTab Data
	 * =============================================
	 * array ( 
	 *		'name'				=> 'my_subtab_name'				: (required) Enter your subtab name that you want to set for this subtab
	 *		'label'				=> 'My SubTab Name'				: (required) Enter the subtab label
	 * 		'callback_function'	=> 'my_callback_function'		: (required) The callback function is called to show content of this subtab
	 * )
	 *
	 */
	public function subtab_data() {
		
		$subtab_data = array( 
			'name'				=> 'count-meta',
			'label'				=> __( 'Count Meta', 'wc_psad' ),
			'callback_function'	=> 'wc_psad_count_meta_settings_form',
		);
		
		if ( $this->subtab_data ) return $this->subtab_data;
		return $this->subtab_data = $subtab_data;
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* add_subtab() */
	/* Add Subtab to Admin Init
	/*-----------------------------------------------------------------------------------*/
	public function add_subtab( $subtabs_array ) {
	
		if ( ! is_array( $subtabs_array ) ) $subtabs_array = array();
		$subtabs_array[] = $this->subtab_data();
		
		return $subtabs_array;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* settings_form() */
	/* Call the form from Admin Interface
	/*-----------------------------------------------------------------------------------*/
	public function settings_form() {
		global $wc_psad_admin_interface;
		
		$output = '';
		$output .= $wc_psad_admin_interface->admin_forms( $this->form_fields, $this->form_key, $this->option_name, $this->form_messages );
		
		return $output;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {
		
  		// Define settings			
     	$this->form_fields = apply_filters( $this->option_name . '_settings_fields', array(
		
			array(
            	'name' 		=> __( 'Categories Count Meta Setup', 'wc_psad' ),
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Count Meta Text', 'wc_psad' ),
				'id' 		=> 'psad_count_meta_text',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'psad_count_meta_text1',
	 										'name' 		=> __( '%d - %d', 'wc_psad' ),
	 										'css'		=> 'width:120px;',
	 										'default'	=> __( 'Showing', 'wc_psad' ) 
									),
									array(  'id' 		=> 'psad_count_meta_text2',
	 										'name' 		=> __( '%d', 'wc_psad' ),
	 										'css'		=> 'width:60px;',
	 										'default'	=> __( 'of', 'wc_psad' ) 
									),
									array(  'id' 		=> 'psad_count_meta_text3',
	 										'name' 		=> '',
	 										'css'		=> 'width:200px;',
	 										'default'	=> __( 'products in this Category', 'wc_psad' ) 
									),
	 							)
			),
			array(
            	'name' 		=> __( 'Tags Count Meta Setup', 'wc_psad' ),
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Count Meta Text', 'wc_psad' ),
				'id' 		=> 'psad_tag_count_meta_text',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'psad_tag_count_meta_text1',
	 										'name' 		=> __( '%d - %d', 'wc_psad' ),
	 										'css'		=> 'width:120px;',
	 										'default'	=> __( 'Showing', 'wc_psad' ) 
									),
									array(  'id' 		=> 'psad_tag_count_meta_text2',
	 										'name' 		=> __( '%d', 'wc_psad' ),
	 										'css'		=> 'width:60px;',
	 										'default'	=> __( 'of', 'wc_psad' ) 
									),
									array(  'id' 		=> 'psad_tag_count_meta_text3',
	 										'name' 		=> '',
	 										'css'		=> 'width:200px;',
	 										'default'	=> __( 'products in this Tag', 'wc_psad' ) 
									),
	 							)
			),
			
			array(
            	'name' 		=> __( 'Count Meta Styling', 'wc_psad' ),
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Padding', 'wc_psad' ),
				'id' 		=> 'psad_count_meta_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'psad_count_meta_padding_top',
	 										'name' 		=> __( 'Top', 'wc_psad' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 10
									),
									array(  'id' 		=> 'psad_count_meta_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'wc_psad' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 10
									),
	 							)
			),
			array(  
				'name' 		=> __( 'Count Meta Font', 'wc_psad' ),
				'id' 		=> 'psad_count_meta_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '11px', 'face' => 'Arial, sans-serif', 'style' => 'italic', 'color' => '#000000' )
			),
			
        ));
	}
	
	public function include_script() {}
}

global $wc_psad_count_meta_settings;
$wc_psad_count_meta_settings = new WC_PSAD_Count_Meta_Settings();

/** 
 * wc_psad_count_meta_settings_form()
 * Define the callback function to show subtab content
 */
function wc_psad_count_meta_settings_form() {
	global $wc_psad_count_meta_settings;
	$wc_psad_count_meta_settings->settings_form();
}

?>