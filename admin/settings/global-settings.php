<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC PSAD Global Settings

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

class WC_PSAD_Global_Settings extends WC_PSAD_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'global-settings';
	
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
	public $form_key = 'wc_sort_display_global_settings';
	
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
				'success_message'	=> __( 'Global Settings successfully saved.', 'wc_psad' ),
				'error_message'		=> __( 'Error: Global Settings can not save.', 'wc_psad' ),
				'reset_message'		=> __( 'Global Settings successfully reseted.', 'wc_psad' ),
			);
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );
			
		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_init' , array( $this, 'reset_default_settings' ) );
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_init' , array( $this, 'after_save_settings' ) );
		
		//add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* subtab_init()
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
	/* after_save_settings()
	/* Process when clean on deletion option is un selected */
	/*-----------------------------------------------------------------------------------*/
	public function after_save_settings() {
		if ( ( isset( $_POST['bt_save_settings'] ) || isset( $_POST['bt_reset_settings'] ) ) && get_option( 'psad_lite_clean_on_deletion' ) == 0  )  {
			$uninstallable_plugins = (array) get_option('uninstall_plugins');
			unset($uninstallable_plugins[WC_PSAD_NAME]);
			update_option('uninstall_plugins', $uninstallable_plugins);
		}
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
			'name'				=> 'global-settings',
			'label'				=> __( 'Settings', 'wc_psad' ),
			'callback_function'	=> 'wc_psad_global_settings_form',
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
            	'name' 		=> __( 'Plugin Framework Global Settings', 'wc_psad' ),
            	'id'		=> 'psad_plugin_framework_box',
                'type' 		=> 'heading',
                'first_open'=> true,
                'is_box'	=> true,
           	),
           	array(
           		'name'		=> __( 'Customize Admin Setting Box Display', 'wc_psad' ),
           		'desc'		=> __( 'By default each admin panel will open with all Setting Boxes in the CLOSED position.', 'wc_psad' ),
                'type' 		=> 'heading',
           	),
           	array(
				'type' 		=> 'onoff_toggle_box',
			),
           	array(
           		'name'		=> __( 'Google Fonts', 'wc_psad' ),
           		'desc'		=> __( 'By Default Google Fonts are pulled from a static JSON file in this plugin. This file is updated but does not have the latest font releases from Google.', 'wc_psad' ),
                'type' 		=> 'heading',
           	),
           	array(
                'type' 		=> 'google_api_key',
           	),
           	array(
            	'name' 		=> __( 'House Keeping', 'wc_psad' ),
                'type' 		=> 'heading',
            ),
			array(
				'name' 		=> __( 'Clean up on Deletion', 'wc_psad' ),
				'desc' 		=> __( 'On deletion (not deactivate) the plugin will completely remove all tables and data it created, leaving no trace it was ever here.', 'wc_psad'),
				'id' 		=> 'psad_lite_clean_on_deletion',
				'type' 		=> 'onoff_checkbox',
				'default'	=> '0',
				'separate_option'	=> true,
				'free_version'		=> true,
				'checked_value'		=> '1',
				'unchecked_value'	=> '0',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),
			array(
            	'name' 		=> __( 'Advanced Features Setting Boxes', 'wc_psad' ),
                'type' 		=> 'heading',
            ),
            array(
				'name' 		=> __( 'Explanation', 'wc_psad' ),
				'desc' 		=> '</span><div style="height:15px;">&nbsp;</div><div class="psad_explanation_message" style="clear:both;">
<ul>
	<li>* ' . __( 'This plugin has Pro Version upgrade with advanced features.', 'wc_psad' ) . '</li>
	<li>* ' . __( 'All Pro Version advanced features settings show here on the Lite Version admin panel.', 'wc_psad' ) . '</li>
	<li>* ' . __( 'The Pro Version settings work on this admin panel but changes are NOT saved and NOT applied to the front end.', 'wc_psad' ) . '</li>
	<li>* ' . __( 'Upgrading to a Lifetime License Pro Version of this plugin activates all settings.', 'wc_psad' ) . '</li>
	<li>* ' . __( 'The Pro Version Lifetime License Fee is a once only payment.', 'wc_psad' ) . '</li>
	<li>* ' . __( 'No data lost in upgrade. Deactivate the Lite version, install and activate the Pro Version. All data is preserved.', 'wc_psad' ) . '</li>
</ul>
				</div><span>',
				'class'		=> 'psad_explanation',
				'id' 		=> 'psad_explanation',
				'type' 		=> 'onoff_checkbox',
				'default'	=> 'no',
				'free_version'		=> true,
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'SHOW', 'wc_psad' ),
				'unchecked_label' 	=> __( 'HIDE', 'wc_psad' ),
			),

			array(
            	'name' 		=> __( 'Shop Page Show Products by Category', 'wc_psad' ),
            	'id'		=> 'psad_shop_page_box',
                'type' 		=> 'heading',
                'desc' 		=> sprintf( __("These settings when activated over ride the WooCommerce <a target='_blank' href='%s'>Product Options</a> shop page settings.", 'wc_psad'), admin_url( 'admin.php?page=wc-settings&tab=products&section=display', 'relative' ) ),
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Shop Page', 'wc_psad' ),
				'desc' 		=> sprintf( __("Sort and display products by category on Shop pages. Sort categories by drop and drag at <a target='_blank' href='%s'>Product Categories</a>.", 'wc_psad'), admin_url( 'edit-tags.php?taxonomy=product_cat&post_type=product', 'relative' ) ),
				'class'		=> 'psad_shop_page_enable',
				'id' 		=> 'psad_shop_page_enable',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'free_version'		=> true,
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),
			
			array(
                'type' 		=> 'heading',
                'id'		=> 'psad_shop_page_enable_container',
				'class'		=> 'psad_shop_page_enable_container',
           	),
			array(  
				'name' 		=> __( 'Empty Parent Categories', 'wc_psad' ),
				'desc' 		=> __("ON and when Parent Cat has no products assigned to it, products from Child Cats of that Parent will be displayed. If none found the Category is not displayed.", 'wc_psad'),
				'id' 		=> 'psad_shop_drill_down',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'free_version'		=> true,
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Categories Per Page', 'wc_psad' ),
				'desc' 		=> __('Set the number of Category product groups to show per pagination or endless scroll event.', 'wc_psad'). ' '. __('Default is [default_value].', 'wc_psad'),
				'id' 		=> 'psad_shop_category_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '3',
				'free_version'		=> true,
			),
			array(  
				'name' 		=> __( 'Products per Category', 'wc_psad' ),
				'desc' 		=> __('Set the number of products to show per Category on Shop pages. Can over ride on a category by category basis from each category edit page.', 'wc_psad'). ' '. __('Default is [default_value].', 'wc_psad'),
				'id' 		=> 'psad_shop_product_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '3',
				'free_version'		=> true,
			),
			array(  
				'name' 		=> __( "Product Sort", 'wc_psad' ),
				'desc' 		=> __('Product type can be set on a Category by category basis with the Pro version', 'wc_psad'),
				'id' 		=> 'psad_shop_product_show_type',
				'type' 		=> 'select',
				'default'	=> 'none',
				'free_version'		=> true,
				'options'	=> array(
						'none'			=> __( 'Default (Recent)', 'wc_psad' ) ,							
						'onsale'		=> __( 'On Sale', 'wc_psad' ) ,
						'featured'		=> __( 'Featured', 'wc_psad' ) ,
					),
			),
			array(  
				'name' 		=> __( 'Product Count', 'wc_psad' ),
				'desc' 		=> __("ON to show product count under category title.", 'wc_psad'),
				'id' 		=> 'psad_shop_enable_product_showing_count',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'free_version'		=> true,
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),

			array(
            	'name' 		=> __( 'Visual Content Separator', 'wc_psad' ),
                'type' 		=> 'heading',
                'id'		=> 'psad_seperator_box',
           		'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Visual Separator', 'wc_psad' ),
				'desc' 		=> __("On to show a separator between each category group of products on Shop Page.", 'wc_psad'),
				'class'		=> 'psad_seperator_enable',
				'id' 		=> 'psad_seperator_enable',
				'default'	=> 'no',
				'type' 		=> 'onoff_checkbox',
				'free_version'		=> true,
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),
			
			array(
                'type' 		=> 'heading',
                'id'		=> 'psad_seperator_enable_container',
				'class'		=> 'psad_seperator_enable_container',
           	),
			array(  
				'name' 		=> __( 'Separator Border', 'wc_psad' ),
				'id' 		=> 'psad_seperator_border',
				'type' 		=> 'border_styles',
				'free_version'		=> true,
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#000000' ),
			),
			array(  
				'name' 		=> __( 'Separator Padding', 'wc_psad' ),
				'id' 		=> 'psad_seperator_padding',
				'type' 		=> 'array_textfields',
				'free_version'		=> true,
				'ids'		=> array( 
	 								array(  'id' 		=> 'psad_seperator_padding_top',
	 										'name' 		=> __( 'Top', 'wc_psad' ),
	 										'css'		=> 'width:40px;',
											'free_version'		=> true,
	 										'default'	=> 5 ),
	 
	 								array(  'id' 		=> 'psad_seperator_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'wc_psad' ),
	 										'css'		=> 'width:40px;',
											'free_version'		=> true,
	 										'default'	=> 5 ),
	 							)
			),
			
			array(
            	'name' 		=> __( 'Parent / Child Category Page Settings', 'wc_psad' ),
                'type' 		=> 'heading',
                'id'		=> 'psad_category_page_box',
                'class'		=> 'pro_feature_fields',
                'desc' 		=> sprintf( __("Please Go to the <a target='_blank' href='%s'>Products Tab</a> and set the 'Default Category Display'. Select 'Show Both' to show Parent Cat products and Child Cats with Products. Can over ride on a category by category basis from each category edit page. Use the settings below to configure the product display.", 'wc_psad'), admin_url( 'admin.php?page=wc-settings&tab=products&section=display', 'relative' ) ),
           		'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Product Categories', 'wc_psad' ),
				'desc' 		=> __("Sort and display products by sub categories on Product category pages. Feature can be turned ON and OFF from each Category page independent of this Global setting.", 'wc_psad'),
				'class'		=> 'psad_category_page_enable',
				'id' 		=> 'psad_category_page_enable',
				'default'	=> 'no',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),
			
			array(
                'type' 		=> 'heading',
                'id'		=> 'psad_category_page_enable_container',
				'class'		=> 'psad_category_page_enable_container',
           	),
			array(  
				'name' 		=> __( 'Empty Parent Categories', 'wc_psad' ),
				'desc' 		=> __("ON and when Parent Cat has no products assigned to it, products from Child Cats of that Parent will be displayed. If none found the Category is not displayed.", 'wc_psad'),
				'id' 		=> 'psad_category_drill_down',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Parent / Child Title', 'wc_psad' ),
				'desc' 		=> __("ON to show Child Category title as Parent / Child title breadcrumb. OFF to only show Child Cat name.", 'wc_psad'),
				'id' 		=> 'psad_show_parent_title',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Category Products (No Sub Cats)', 'wc_psad' ),
				'desc' 		=> __("The number of products to show per Endless Scroll or pagination.", 'wc_psad'). ' '. __('Default is [default_value].', 'wc_psad'),
				'id' 		=> 'psad_category_product_nosub_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '12'
			),
			array(  
				'name' 		=> __( 'Parent Category Products', 'wc_psad' ),
				'desc' 		=> __("Sets the number of Parent Category Products to show before Child Cat Product Groups.", 'wc_psad'). ' '. __('Default is [default_value].', 'wc_psad'),
				'id' 		=> 'psad_top_product_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '3'
			),
			array(  
				'name' => __( 'Sub Categories Per Page', 'wc_psad' ),
				'desc' 		=> __('Set the number of Sub Category product groups to show per pagination or endless scroll event.', 'wc_psad'). ' '. __('Default is [default_value].', 'wc_psad'),
				'id' 		=> 'psad_category_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '3'
			),
			array(  
				'name' 		=> __( 'Product Count', 'wc_psad' ),
				'desc' 		=> __("ON to show product count under category title.", 'wc_psad'),
				'id' 		=> 'psad_cat_enable_product_showing_count',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),
			
			array(
            	'name' 		=> __( 'One Level Up Display', 'wc_psad' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields',
                'id'		=> 'psad_one_level_box',
                'desc' 		=> __("Settings apply to this categories display on its Parent Category Page <strong>IF</strong> this Category is a Sub Category.", 'wc_psad'),
           		'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Number of Product Displayed', 'wc_psad' ),
				'desc' 		=> __('Number of products displayed for this category on its Parent Category page <strong>WHEN</strong> Parent has Sort and Display Feature activated.', 'wc_psad'),
				'id' 		=> 'psad_product_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '3'
			),

			array(  
				'name' 		=> __( "Product Sort", 'wc_psad' ),
				'desc' 		=> __('Applies to this Category products on Parent Cat Page <strong>WHEN</strong> Parent has Sort and Display Feature activated.', 'wc_psad'),
				'id' 		=> 'psad_product_show_type',
				'type' 		=> 'select',
				'default'	=> 'none',
				'options'	=> array(
						'none'			=> __( 'Default (Recent)', 'wc_psad' ) ,							
						'onsale'		=> __( 'On Sale', 'wc_psad' ) ,
						'featured'		=> __( 'Featured', 'wc_psad' ) ,
					),
			),

			array(
            	'name' 		=> __( 'Global Category Reset', 'wc_psad' ),
                'type' 		=> 'heading',
                'id'		=> 'psad_global_category_reset_box',
                'class'		=> 'pro_feature_fields',
           		'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Product Category Reset', 'wc_psad' ),
				'desc' 		=> __( "On to reset all custom settings made in the 'a3rev Category Page' settings on Product Categories.", 'wc_psad'),
				'id' 		=> 'psad_global_category_reset',
				'default'	=> 'no',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),
			
			array(
            	'name' 		=> __( 'Tag Page Settings', 'wc_psad' ),
                'type' 		=> 'heading',
                'id'		=> 'psad_tag_page_box',
                'class'		=> 'pro_feature_fields',
           		'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Tag Page', 'wc_psad' ),
				'desc' 		=> __("Sort and Display Product tag pages.", 'wc_psad'),
				'class'		=> 'psad_tag_page_enable',
				'id' 		=> 'psad_tag_page_enable',
				'default'	=> 'no',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wc_psad' ),
				'unchecked_label' 	=> __( 'OFF', 'wc_psad' ),
			),
			
			array(
                'type' 		=> 'heading',
                'id'		=> 'psad_tag_page_enable_container',
				'class'		=> 'psad_tag_page_enable_container',
           	),
			array(  
				'name' 		=> __( 'Tag Products', 'wc_psad' ),
				'desc' 		=> __("The number of products to show per Endless Scroll or pagination.", 'wc_psad'). ' '. __('Default is [default_value].', 'wc_psad'),
				'id' 		=> 'psad_tag_product_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '12'
			),
			array(  
				'name' 		=> __( "Product Sort", 'wc_psad' ),
				'id' 		=> 'psad_tag_product_show_type',
				'type' 		=> 'select',
				'default'	=> 'none',
				'options'	=> array(
						'none'			=> __( 'Default (Recent)', 'wc_psad' ) ,							
						'onsale'		=> __( 'On Sale', 'wc_psad' ) ,
						'featured'		=> __( 'Featured', 'wc_psad' ) ,
					),
			),
		
        ));
	}
	
	public function include_script() {
	?>
<script>
(function($) {
	
	$(document).ready(function() {
		if ( $("input.psad_explanation:checked").val() == 'yes') {
			$(".psad_explanation_message").show();
		} else {
			$(".psad_explanation_message").hide();
		}
		if ( $("input.psad_shop_page_enable:checked").val() != 'yes') {
			$(".psad_shop_page_enable_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		}
		if ( $("input.psad_category_page_enable:checked").val() != 'yes') {
			$(".psad_category_page_enable_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		}
		if ( $("input.psad_tag_page_enable:checked").val() != 'yes') {
			$(".psad_tag_page_enable_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		}
		if ( $("input.psad_seperator_enable:checked").val() != 'yes') {
			$(".psad_seperator_enable_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		}

		$(document).on( "a3rev-ui-onoff_checkbox-switch", '.psad_explanation', function( event, value, status ) {
			if ( status == 'true' ) {
				$(".psad_explanation_message").slideDown();
			} else {
				$(".psad_explanation_message").slideUp();
			}
		});
		$(document).on( "a3rev-ui-onoff_checkbox-switch", '.psad_shop_page_enable', function( event, value, status ) {
			$(".psad_shop_page_enable_container").attr('style','display:none;');
			if ( status == 'true' ) {
				$(".psad_shop_page_enable_container").slideDown();
			} else {
				$(".psad_shop_page_enable_container").slideUp();
			}
		});
		$(document).on( "a3rev-ui-onoff_checkbox-switch", '.psad_category_page_enable', function( event, value, status ) {
			$(".psad_category_page_enable_container").attr('style','display:none;');
			if ( status == 'true' ) {
				$(".psad_category_page_enable_container").slideDown();
			} else {
				$(".psad_category_page_enable_container").slideUp();
			}
		});
		$(document).on( "a3rev-ui-onoff_checkbox-switch", '.psad_tag_page_enable', function( event, value, status ) {
			$(".psad_tag_page_enable_container").attr('style','display:none;');
			if ( status == 'true' ) {
				$(".psad_tag_page_enable_container").slideDown();
			} else {
				$(".psad_tag_page_enable_container").slideUp();
			}
		});
		$(document).on( "a3rev-ui-onoff_checkbox-switch", '.psad_seperator_enable', function( event, value, status ) {
			$(".psad_seperator_enable_container").attr('style','display:none;');
			if ( status == 'true' ) {
				$(".psad_seperator_enable_container").slideDown();
			} else {
				$(".psad_seperator_enable_container").slideUp();
			}
		});
		
	});
	
})(jQuery);
</script>
    <?php	
	}
}

global $wc_psad_global_settings;
$wc_psad_global_settings = new WC_PSAD_Global_Settings();

/** 
 * wc_psad_global_settings_form()
 * Define the callback function to show subtab content
 */
function wc_psad_global_settings_form() {
	global $wc_psad_global_settings;
	$wc_psad_global_settings->settings_form();
}

?>
