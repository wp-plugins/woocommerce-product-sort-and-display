<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC PSAD View All Products Settings

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

class WC_PSAD_View_All_Products_Settings extends WC_PSAD_Admin_UI
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
	public $form_key = 'woo_psad_view_all_products_settings';
	
	/**
	 * @var string
	 * You can change the order show of this sub tab in list sub tabs
	 */
	private $position = 1;
	
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
				'success_message'	=> __( 'View All Products Settings successfully saved.', 'wc_psad' ),
				'error_message'		=> __( 'Error: View All Products Settings can not save.', 'wc_psad' ),
				'reset_message'		=> __( 'View All Products Settings successfully reseted.', 'wc_psad' ),
			);
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );
			
		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );
		
		//add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
		
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
			'name'				=> 'view-all-products',
			'label'				=> __( 'View All Products', 'wc_psad' ),
			'callback_function'	=> 'wc_psad_view_all_products_settings_form',
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
            	'name' 		=> __( 'Style for View all Products link in each Category', 'wc_psad' ),
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Button or Hyperlink Text', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_type',
				'class'		=> 'psad_es_category_item_bt_type',
				'default'	=> 'link',
				'type' 		=> 'switcher_checkbox',
				'checked_value'		=> 'link',
				'unchecked_value'	=> 'button',
				'checked_label'		=> __( 'Linked', 'wc_psad' ),
				'unchecked_label' 	=> __( 'Button', 'wc_psad' ),
			),
			
			array(
            	'name' 		=> __( 'View All Position', 'wc_psad' ),
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Show at', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_position',
				'type' 		=> 'onoff_radio',
				'default'	=> 'bottom',
				'onoff_options'	=> array(
					array(
						'val'				=> 'top',
						'text'				=> __( 'At top After Category product count meta', 'wc_psad' ),
						'checked_label'		=> __( 'ON' , 'wc_psad' ),
						'unchecked_value'	=> __( 'OFF' , 'wc_psad' ),
					),
					array(
						'val'				=> 'bottom',
						'text'				=> __( 'At Bottom under category products', 'wc_psad' ),
						'checked_label'		=> __( 'ON' , 'wc_psad' ),
						'unchecked_value'	=> __( 'OFF' , 'wc_psad' ),
					),
				),
			),
			
			array(
            	'name' 		=> __( 'Button Styling', 'wc_psad' ),
                'type' 		=> 'heading',
				'class'		=> 'psad_es_view_all_click_more_bt_container',
           	),
			array(  
				'name' 		=> __( 'Button Text', 'wc_psad' ),
				'desc' 		=> __('Text for link in each category', 'wc_psad'),
				'id' 		=> 'psad_es_category_item_bt_text',
				'type' 		=> 'text',
				'default'	=> __( 'See more...', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Button Align', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_align',
				'css' 		=> 'width:120px;',
				'type' 		=> 'select',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wc_psad' ) ,	
						'left'			=> __( 'Left', 'wc_psad' ) ,	
						'right'			=> __( 'Right', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' 		=> __( 'Button Padding', 'wc_psad' ),
				'desc' 		=> __( 'Padding from Button text to Button border', 'wc_psad' ),
				'id' 		=> 'psad_es_view_all_bt_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'psad_es_view_all_bt_padding_tb',
	 										'name' 		=> __( 'Top/Bottom', 'wc_psad' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 5 ),
	 
	 								array(  'id' 		=> 'psad_es_view_all_bt_padding_lr',
	 										'name' 		=> __( 'Left/Right', 'wc_psad' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 5 ),
	 							)
			),
			array(  
				'name' 		=> __( 'Background Colour', 'wc_psad' ),
				'desc' 		=> __('Default [default_value]', 'wc_psad'),
				'id' 		=> 'psad_es_category_item_bt_bg',
				'type' 		=> 'color',
				'default'	=> '#7497B9'
			),
			array(  
				'name' 		=> __( 'Background Colour Gradient From', 'wc_psad' ),
				'desc' 		=> __('Default [default_value]', 'wc_psad'),
				'id' 		=> 'psad_es_category_item_bt_bg_from',
				'type' 		=> 'color',
				'default'	=> '#7497B9'
			),
			array(  
				'name' 		=> __( 'Background Colour Gradient To', 'wc_psad' ),
				'desc' 		=> __('Default [default_value]', 'wc_psad'),
				'id' 		=> 'psad_es_category_item_bt_bg_to',
				'type' 		=> 'color',
				'default'	=> '#4b6E90'
			),
			
			array(  
				'name' 		=> __( 'Button Border', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#7497B9', 'corner' => 'rounded' , 'top_left_corner' => 3 , 'top_right_corner' => 3 , 'bottom_left_corner' => 3 , 'bottom_right_corner' => 3 ),
			),
			array(  
				'name' 		=> __( 'Button Font', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'face' => 'Arial, sans-serif', 'style' => 'bold', 'color' => '#FFFFFF' )
			),
			array(  
				'name' 		=> __( 'Button Shadow', 'wc_psad' ),
				'id' 		=> 'psad_es_view_all_bt_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '5px' , 'v_shadow' => '5px', 'blur' => '2px' , 'spread' => '2px', 'color' => '#999999', 'inset' => '' )
			),
			array(  
				'name' 		=> __( 'CSS Class', 'wc_psad' ),
				'desc' 		=> __('Enter your own button CSS class', 'wc_psad'),
				'id' 		=> 'psad_es_category_item_bt_class',
				'type' 		=> 'text',
				'default'	=> ''
			),
			
			array(
            	'name' 		=> __( 'Linked Text Styling', 'wc_psad' ),
                'type' 		=> 'heading',
				'class'		=> 'psad_es_view_all_click_more_linked_container',
           	),
			array(  
				'name' 		=> __( 'Linked Text', 'wc_psad' ),
				'desc' 		=> __('Text for link in each category', 'wc_psad'),
				'id' 		=> 'psad_es_category_item_link_text',
				'type' 		=> 'text',
				'default'	=> __( 'See more...', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Linked Text Align', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_link_align',
				'css' 		=> 'width:120px;',
				'type' 		=> 'select',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wc_psad' ) ,	
						'left'			=> __( 'Left', 'wc_psad' ) ,	
						'right'			=> __( 'Right', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' 		=> __( 'Hyperlink Font', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_link_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'face' => 'Arial, sans-serif', 'style' => 'bold', 'color' => '#7497B9' )
			),
			array(  
				'name' 		=> __( 'Hyperlink Hover Colour', 'wc_psad' ),
				'desc' 		=> __('Default [default_value]', 'wc_psad'),
				'id' 		=> 'psad_es_category_item_link_font_hover_color',
				'type' 		=> 'color',
				'default'	=> '#4b6E90',
			),
			
        ));
	}
	
	public function include_script() {
	?>
<script>
(function($) {
	
	$(document).ready(function() {
		
		if ( $("input.psad_es_category_item_bt_type:checked").val() == 'link') {
			$(".psad_es_view_all_click_more_linked_container").css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} );
			$(".psad_es_view_all_click_more_bt_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden'} );
		} else {
			$(".psad_es_view_all_click_more_linked_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden'} );
			$(".psad_es_view_all_click_more_bt_container").css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} );
		}
			
		$(document).on( "a3rev-ui-onoff_checkbox-switch", '.psad_es_category_item_bt_type', function( event, value, status ) {
			if ( status == 'true' ) {
				$(".psad_es_view_all_click_more_linked_container").hide().css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} ).slideDown();
				$(".psad_es_view_all_click_more_bt_container").slideUp();
			} else {
				$(".psad_es_view_all_click_more_linked_container").slideUp();
				$(".psad_es_view_all_click_more_bt_container").hide().css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} ).slideDown();
			}
		});
		
	});
	
})(jQuery);
</script>
    <?php	
	}
}

global $wc_psad_view_all_products_settings;
$wc_psad_view_all_products_settings = new WC_PSAD_View_All_Products_Settings();

/** 
 * wc_psad_view_all_products_settings_form()
 * Define the callback function to show subtab content
 */
function wc_psad_view_all_products_settings_form() {
	global $wc_psad_view_all_products_settings;
	$wc_psad_view_all_products_settings->settings_form();
}

?>