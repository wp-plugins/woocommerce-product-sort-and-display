<?php
/**
 * WC_PSAD_Settings_Hook Class
 *
 * Class Function into WooCommerce plugin
 *
 * Table Of Contents
 * __construct()
 * psad_add_category_fields()
 * psad_edit_category_fields()
 * psad_category_fields_save()
 * a3_wp_admin()
 * plugin_extension()
 * plugin_extra_links()
 */

class WC_PSAD_Settings_Hook
{
	
	public function __construct() {

		// Include google fonts into header
		add_action( 'wp_head', array( $this, 'add_google_fonts'), 11 );

		//Add sort into Settings of WC
		add_filter( 'woocommerce_default_catalog_orderby_options', array( $this, 'add_options_into_default_catalog_orderby') );
		
		// AJAX hide yellow message dontshow
		add_action('wp_ajax_psad_yellow_message_dontshow', array( $this, 'psad_yellow_message_dontshow' ) );
		add_action('wp_ajax_nopriv_psad_yellow_message_dontshow', array( $this, 'psad_yellow_message_dontshow' ) );
		
		// AJAX hide yellow message dismiss
		add_action('wp_ajax_psad_yellow_message_dismiss', array( $this, 'psad_yellow_message_dismiss' ) );
		add_action('wp_ajax_nopriv_psad_yellow_message_dismiss', array( $this, 'psad_yellow_message_dismiss' ) );
		
	}
	
	public function add_google_fonts() {
		global $wc_psad_fonts_face;
		$psad_es_shop_bt_font 				= get_option( 'psad_es_shop_bt_font' );
		$psad_es_shop_link_font 			= get_option( 'psad_es_shop_link_font' );
		$psad_es_category_item_bt_font 		= get_option( 'psad_es_category_item_bt_font' );
		$psad_es_category_item_link_font 	= get_option( 'psad_es_category_item_link_font' );
		$google_fonts = array( 
							$psad_es_shop_bt_font['face'], 
							$psad_es_shop_link_font['face'], 
							$psad_es_category_item_bt_font['face'],
							$psad_es_category_item_link_font['face'],
						);
						
		$google_fonts = apply_filters( 'wc_psad_google_fonts', $google_fonts );
		
		$wc_psad_fonts_face->generate_google_webfonts( $google_fonts );
	}

	public function add_options_into_default_catalog_orderby( $default_catalog_orderby_options ) {
		$default_catalog_orderby_options['onsale'] = __('Sort by On Sale: Show first', 'wc_psad');
		$default_catalog_orderby_options['featured'] = __('Sort by Featured: Show first', 'wc_psad');

		return $default_catalog_orderby_options;
	}

	public function psad_yellow_message_dontshow() {
		check_ajax_referer( 'psad_yellow_message_dontshow', 'security' );
		$option_name   = $_REQUEST['option_name'];
		update_option( $option_name, 1 );
		die();
	}
	
	public function psad_yellow_message_dismiss() {
		check_ajax_referer( 'psad_yellow_message_dismiss', 'security' );
		$session_name   = $_REQUEST['session_name'];
		update_option( $session_name, 1 );
		if ( !isset($_SESSION) ) { @session_start(); } 
		$_SESSION[$session_name] = 1 ;
		die();
	}
	
	public function a3_wp_admin() {
		wp_enqueue_style( 'a3rev-wp-admin-style', WC_PSAD_CSS_URL . '/a3_wp_admin.css' );
	}
	
	public function plugin_extension_box( $boxes = array() ) {
		$support_box = '<a href="https://wordpress.org/support/plugin/woocommerce-product-sort-and-display" target="_blank" alt="'.__('Go to Support Forum', 'wc_psad').'"><img src="'.WC_PSAD_IMAGES_URL.'/go-to-support-forum.png" /></a>';
		$boxes[] = array(
			'content' => $support_box,
			'css' => 'border: none; padding: 0; background: none;'
		);

		$review_box = '<div style="margin-bottom: 5px; font-size: 12px;"><strong>' . __('Is this plugin is just what you needed? If so', 'wc_psad') . '</strong></div>';
        $review_box .= '<a href="https://wordpress.org/support/view/plugin-reviews/woocommerce-product-sort-and-display#postform" target="_blank" alt="'.__('Submit Review for Plugin on WordPress', 'wc_psad').'"><img src="'.WC_PSAD_IMAGES_URL.'/a-5-star-rating-would-be-appreciated.png" /></a>';

        $boxes[] = array(
            'content' => $review_box,
            'css' => 'border: none; padding: 0; background: none;'
        );

		$pro_box = '<a href="'.WC_PSAD_AUTHOR_URI.'" target="_blank" alt="'.__('WooCommerce Product Sort and Display Pro', 'wc_psad').'"><img src="'.WC_PSAD_IMAGES_URL.'/product-sort-and-display-pro.png" /></a>';
		$boxes[] = array(
			'content' => $pro_box,
			'css' => 'border: none; padding: 0; background: none;'
		);

		$free_woocommerce_box = '<a href="https://profiles.wordpress.org/a3rev/#content-plugins" target="_blank" alt="'.__('Free WooCommerce Plugins', 'wc_psad').'"><img src="'.WC_PSAD_IMAGES_URL.'/free-woocommerce-plugins.png" /></a>';

		$boxes[] = array(
			'content' => $free_woocommerce_box,
			'css' => 'border: none; padding: 0; background: none;'
		);

		$free_wordpress_box = '<a href="https://profiles.wordpress.org/a3rev/#content-plugins" target="_blank" alt="'.__('Free WordPress Plugins', 'wc_psad').'"><img src="'.WC_PSAD_IMAGES_URL.'/free-wordpress-plugins.png" /></a>';

		$boxes[] = array(
			'content' => $free_wordpress_box,
			'css' => 'border: none; padding: 0; background: none;'
		);

		return $boxes;
	}
	
	public function plugin_extra_links($links, $plugin_name) {
		if ( $plugin_name != WC_PSAD_NAME) {
			return $links;
		}
		$links[] = '<a href="http://docs.a3rev.com/user-guides/plugins-extensions/woocommerce/product-sort-and-display/" target="_blank">'.__('Documentation', 'wc_psad').'</a>';
		$links[] = '<a href="http://wordpress.org/support/plugin/woocommerce-product-sort-and-display/" target="_blank">'.__('Support', 'wc_psad').'</a>';
		return $links;
	}

	public function settings_plugin_links($actions) {
		$actions = array_merge( array( 'settings' => '<a href="admin.php?page=wc-sort-display">' . __( 'Settings', 'wc_psad' ) . '</a>' ), $actions );

		return $actions;
	}
}

$GLOBALS['wc_psad_settings_hook'] = new WC_PSAD_Settings_Hook();
?>
