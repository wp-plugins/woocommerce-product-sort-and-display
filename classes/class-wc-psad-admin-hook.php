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
   		add_action( 'product_cat_add_form_fields', array( $this, 'psad_add_category_fields'), 11 );
		add_action( 'product_cat_edit_form', array( $this, 'psad_edit_category_fields' ), 10, 1 );
		
		// Include google fonts into header
		add_action( 'wp_head', array( $this, 'add_google_fonts'), 11 );
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
	
	public function psad_add_category_fields(){
		?>
        <style>
			#a3_upgrade_area_box { border:2px solid #E6DB55;-webkit-border-radius:10px;-moz-border-radius:10px;-o-border-radius:10px; border-radius: 10px; padding:10px; position:relative; margin-bottom:10px; }
			#a3_upgrade_area_box legend {margin-left:4px; font-weight:bold;}
		</style>
    	<fieldset id="a3_upgrade_area_box"><legend><?php _e('Upgrade to','wc_psad'); ?> <a href="<?php echo WC_PSAD_AUTHOR_URI; ?>" target="_blank"><?php _e('Pro Version', 'wc_psad'); ?></a> <?php _e('to activate', 'wc_psad'); ?></legend>
        <h3><?php _e('a3rev Shop Page Categories', 'wc_psad'); ?></h3>
        <div><?php _e("The WooCommerce 'Display type' settings above do not apply to Shop page Categories. They do apply to the a3rev Category Page settings below.", 'wc_psad'); ?></div>
        <div class="form-field">
            <label for="psad_shop_product_per_page"><?php _e( 'Products per Category', 'wc_psad' ); ?></label>
            <input disabled="disabled" id="psad_shop_product_per_page" name="psad_shop_product_per_page" type="text" style="width:120px;" value="" />
            <p class="description"><?php _e("Set the number of products to show per Category on Shop pages.", 'wc_psad'); ?> <?php _e('Empty to use global settings.', 'wc_psad'); ?></p>
        </div>
		<div class="form-field">
            <label for="psad_shop_product_show_type"><?php _e( 'Product Sort', 'wc_psad' ); ?></label>
            <select id="psad_shop_product_show_type" name="psad_shop_product_show_type" class="postform" style="width:120px;">
            	<option value=""><?php _e( 'Global Settings', 'wc_psad' ); ?></option>
                <option value="none"><?php _e( 'Default (Recent)', 'wc_psad' ); ?></option>
                <option value="onsale"><?php _e( 'On Sale', 'wc_psad' ); ?></option>
                <option value="featured"><?php _e( 'Featured', 'wc_psad' ); ?></option>
            </select>
        </div>
        <h3><?php _e('a3rev Category Page', 'wc_psad'); ?></h3>
        <div><?php _e("'Display type' settings: Select 'Both' to show Parent Cat products and Child Cats with Products on the one page. Select 'Products' if this category has just products. Select 'Subcategories' to show just this Categories Sub cats and Products. Then use the settings below to configure the product display.", 'wc_psad'); ?></div>
        <div class="form-field">
            <label for="psad_category_product_nosub_per_page"><?php _e( 'Category Products (No Sub Cats)', 'wc_psad' ); ?></label>
            <input disabled="disabled" id="psad_category_product_nosub_per_page" name="psad_category_product_nosub_per_page" type="text" style="width:120px;" value="" />
            <p class="description"><?php _e("The number of products to show per Endless Scroll or pagination.", 'wc_psad'); ?> <?php _e('Empty to use global settings.', 'wc_psad'); ?></p>
        </div>
        <div class="form-field">
            <label for="psad_top_product_per_page"><?php _e( 'Parent Category Products', 'wc_psad' ); ?></label>
            <input disabled="disabled" id="psad_top_product_per_page" name="psad_top_product_per_page" type="text" style="width:120px;" value="" />
            <p class="description"><?php _e("Sets the number of Parent Category Products to show before Child Cat Product Groups.", 'wc_psad'); ?> <?php _e('Empty to use global settings.', 'wc_psad'); ?></p>
        </div>
        <div class="form-field">
            <label for="psad_category_per_page"><?php _e( 'Sub Categories Per Page', 'wc_psad' ); ?></label>
            <input disabled="disabled" id="psad_category_per_page" name="psad_category_per_page" type="text" style="width:120px;" value="" />
            <p class="description"><?php _e('Set the number of Sub Category product groups to show per pagination or endless scroll event.', 'wc_psad'); ?> <?php _e('Empty to use global settings.', 'wc_psad'); ?></p>
        </div>
        <div class="form-field">
            <label for="psad_product_per_page"><?php _e( 'Products per Sub Category', 'wc_psad' ); ?></label>
            <input disabled="disabled" id="psad_product_per_page" name="psad_product_per_page" type="text" style="width:120px;" value="" />
            <p class="description"><?php _e("Set the number of products to show per sub Category.", 'wc_psad'); ?> <?php _e('Empty to use global settings.', 'wc_psad'); ?></p>
        </div>
        <div class="form-field">
            <label for="psad_product_show_type"><?php _e( 'Product Sort', 'wc_psad' ); ?></label>
            <select id="psad_product_show_type" name="psad_product_show_type" class="postform" style="width:120px;">
            	<option value=""><?php _e( 'Global Settings', 'wc_psad' ); ?></option>
                <option value="none"><?php _e( 'Default (Recent)', 'wc_psad' ); ?></option>
                <option value="onsale"><?php _e( 'On Sale', 'wc_psad' ); ?></option>
                <option value="featured"><?php _e( 'Featured', 'wc_psad' ); ?></option>
            </select>
        </div>
        </fieldset>
		<?php
	}
	
	public function psad_edit_category_fields($term){
		?>
        <style>
			#a3_upgrade_area_box { border:2px solid #E6DB55;-webkit-border-radius:10px;-moz-border-radius:10px;-o-border-radius:10px; border-radius: 10px; padding:10px; position:relative}
			#a3_upgrade_area_box legend {margin-left:4px; font-weight:bold;}
		</style>
        <fieldset id="a3_upgrade_area_box"><legend><?php _e('Upgrade to','wc_psad'); ?> <a href="<?php echo WC_PSAD_AUTHOR_URI; ?>" target="_blank"><?php _e('Pro Version', 'wc_psad'); ?></a> <?php _e('to activate', 'wc_psad'); ?></legend>
        <h3><?php _e('a3rev Shop Page Categories', 'wc_psad'); ?></h3>
		<div><?php _e("The WooCommerce 'Display type' settings above do not apply to Shop page Categories. They do apply to the a3rev Category Page settings below.", 'wc_psad'); ?></div>
        <table class="form-table">
            <tr class="form-field">
            <th scope="row" valign="top"><label for="psad_shop_product_per_page"><?php _e( 'Products per Category', 'wc_psad' ); ?></label></th>
            <td>
                <input disabled="disabled" id="psad_shop_product_per_page" name="psad_shop_product_per_page" type="text" style="width:120px;" value="" />
                <p class="description"><?php _e("Set the number of products to show per Category on Shop pages.", 'wc_psad'); ?> <?php _e('Empty to use global settings.', 'wc_psad'); ?></p>
            </td>
            </tr>
            <tr class="form-field">
            <th scope="row" valign="top"><label for="psad_shop_product_show_type"><?php _e( 'Product Sort', 'wc_psad' ); ?></label></th>
            <td>
                <select id="psad_shop_product_show_type" name="psad_shop_product_show_type" class="postform" style="width:120px;">
                    <option value="" selected="selected"><?php _e( 'Global Settings', 'wc_psad' ); ?></option>
                    <option value="none"><?php _e( 'Default (Recent)', 'wc_psad' ); ?></option>
                    <option value="onsale"><?php _e( 'On Sale', 'wc_psad' ); ?></option>
                    <option value="featured"><?php _e( 'Featured', 'wc_psad' ); ?></option>
                </select>
            </td>
            </tr>
		</table>
        <h3><?php _e('a3rev Category Page', 'wc_psad'); ?></h3>
		<div><?php _e("'Display type' settings: Select 'Both' to show Parent Cat products and Child Cats with Products on the one page. Select 'Products' if this category has just products. Select 'Subcategories' to show just this Categories Sub cats and Products. Then use the settings below to configure the product display.", 'wc_psad'); ?></div>
        <table class="form-table">
        	<tr class="form-field">
            <th scope="row" valign="top"><label for="psad_category_product_nosub_per_page"><?php _e( 'Category Products (No Sub Cats)', 'wc_psad' ); ?></label></th>
            <td>
                <input disabled="disabled" id="psad_category_product_nosub_per_page" name="psad_category_product_nosub_per_page" type="text" style="width:120px;" value="" />
                <p class="description"><?php _e("The number of products to show per Endless Scroll or pagination.", 'wc_psad'); ?> <?php _e('Empty to use global settings.', 'wc_psad'); ?></p>
            </td>
            </tr>
            <tr class="form-field">
            <th scope="row" valign="top"><label for="psad_top_product_per_page"><?php _e( 'Parent Category Products', 'wc_psad' ); ?></label></th>
            <td>
                <input disabled="disabled" id="psad_top_product_per_page" name="psad_top_product_per_page" type="text" style="width:120px;" value="" />
                <p class="description"><?php _e("Sets the number of Parent Category Products to show before Child Cat Product Groups.", 'wc_psad'); ?> <?php _e('Empty to use global settings.', 'wc_psad'); ?></p>
            </td>
            </tr>
            <tr class="form-field">
            <th scope="row" valign="top"><label for="psad_category_per_page"><?php _e( 'Sub Categories Per Page', 'wc_psad' ); ?></label></th>
            <td>
                <input disabled="disabled" id="psad_category_per_page" name="psad_category_per_page" type="text" style="width:120px;" value="" />
                <p class="description"><?php _e('Set the number of Sub Category product groups to show per pagination or endless scroll event.', 'wc_psad'); ?> <?php _e('Empty to use global settings.', 'wc_psad'); ?></p>
            </td>
            </tr>
            <tr class="form-field">
            <th scope="row" valign="top"><label for="psad_product_per_page"><?php _e( 'Products per Sub Category', 'wc_psad' ); ?></label></th>
            <td>
                <input disabled="disabled" id="psad_product_per_page" name="psad_product_per_page" type="text" style="width:120px;" value="" />
                <p class="description"><?php _e("Set the number of products to show per sub Category.", 'wc_psad'); ?> <?php _e('Empty to use global settings.', 'wc_psad'); ?></p>
            </td>
            </tr>
            <tr class="form-field">
            <th scope="row" valign="top"><label for="psad_product_show_type"><?php _e( 'Product Sort', 'wc_psad' ); ?></label></th>
            <td>
                <select id="psad_product_show_type" name="psad_product_show_type" class="postform" style="width:120px;">
                    <option value="" selected="selected"><?php _e( 'Global Settings', 'wc_psad' ); ?></option>
                    <option value="none"><?php _e( 'Default (Recent)', 'wc_psad' ); ?></option>
                    <option value="onsale"><?php _e( 'On Sale', 'wc_psad' ); ?></option>
                    <option value="featured"><?php _e( 'Featured', 'wc_psad' ); ?></option>
                </select>
            </td>
            </tr>
        </table>
        </fieldset>
        <?php
	}
	
	public static function a3_wp_admin() {
		wp_enqueue_style( 'a3rev-wp-admin-style', WC_PSAD_CSS_URL . '/a3_wp_admin.css' );
	}
	
	public static function plugin_extension() {
		$html = '';
		$html .= '<a href="http://a3rev.com/shop/" target="_blank" style="float:right;margin-top:5px; margin-left:10px;" ><div class="a3-plugin-ui-icon a3-plugin-ui-a3-rev-logo"></div></a>';
		$html .= '<h3>'.__('Upgrade to Product Sort and Display Pro', 'wc_psad').'</h3>';
		$html .= '<p>'.__("<strong>NOTE:</strong> All the functions inside the Yellow border on the plugins admin panel are extra functionality that is activated by upgrading to the Pro version", 'wc_psad').':</p>';
		$html .= '<p>';
		$html .= '<h3 style="margin-bottom:5px;">'.__('WooCommerce Product Sort and Display Pro', 'wc_psad').'</h3>';
		$html .= '<p>';
		$html .= '* '. sprintf( __('Trial the <a href="%s" target="_blank">Full Pro Version for Free</a>', 'wc_psad'), WC_PSAD_AUTHOR_URI );
		$html .= '</p>';
		$html .= '<div><strong>'.__('Activates these advanced Features', 'wc_psad').':</strong></div>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>1. '.__("Sort by 'On Sale' on all Product Category pages.", 'wc_psad').'</li>';
		$html .= '<li>2. '.__("Sort by 'Featured' on all Product Category pages.", 'wc_psad').'</li>';
		$html .= '<li>3. '.__('Category by Category Sort and Display settings for Shop page.', 'wc_psad').'</li>';
		$html .= '<li>4. '.__('Category by Category Sort and display settings for Product Cat pages.', 'wc_psad').'</li>';
		$html .= '<li>5. '.__('Endless Scroll feature for the entire store (Category pages).', 'wc_psad').'</li>';
		$html .= '<li>6. '.__('Category pages Endless Scroll on Click WYSIWYG style editor.', 'wc_psad').'</li>';
		$html .= '<li>7. '.__('Parent Category page show parent cat products and Child Cats with products.', 'wc_psad').'</li>';
		$html .= '<li>8. '.__("Set number of products to show on parent cat before sub cats.", 'wc_psad').'</li>';
		$html .= '<li>9. '.__("WYSIWYG count meta styling and position.", 'wc_psad').'</li>';
		$html .= '<li>10. '. sprintf( __('Immediate access to the plugins <a href="%s" target="_blank">a3rev support forum</a>', 'wc_psad'), 'https://a3rev.com/forums/forum/woocommerce-plugins/product-sort-and-display/' ).'</li>';
		$html .= '</ul>';
		$html .= '</p>';
		$html .= '<h3>'.__('View this plugins', 'wc_psad').' <a href="http://docs.a3rev.com/user-guides/plugins-extensions/woocommerce/product-sort-and-display/" target="_blank">'.__('documentation', 'wc_psad').'</a></h3>';
		$html .= '<h3>'.__('Visit this plugins', 'wc_psad').' <a href="http://wordpress.org/support/plugin/woocommerce-product-sort-and-display/" target="_blank">'.__('support forum', 'wc_psad').'</a></h3>';
		$html .= '<h3>'.__('More FREE a3rev WooCommerce Plugins', 'wc_psad').'</h3>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woocommerce-products-quick-view/" target="_blank">'.__('WooCommerce Products Quick View', 'wc_psad').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woocommerce-dynamic-gallery/" target="_blank">'.__('WooCommerce Dynamic Products Gallery', 'wc_psad').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woocommerce-predictive-search/" target="_blank">'.__('WooCommerce Predictive Search', 'wc_psad').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woocommerce-compare-products/" target="_blank">'.__('WooCommerce Compare Products', 'wc_psad').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woo-widget-product-slideshow/" target="_blank">'.__('WooCommerce Widget Product Slideshow', 'wc_psad').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woocommerce-email-inquiry-cart-options/" target="_blank">'.__('WooCommerce Email Inquiry & Cart Options', 'wc_psad').'</a></li>';
		$html .= '<li>* <a href="http://a3rev.com/shop/woocommerce-email-inquiry-ultimate/" target="_blank">'.__('WooCommerce Email Inquiry Ultimate', 'wc_psad').'</a> &nbsp;&nbsp;&nbsp;'.__( '(Free Trial)' , 'wc_psad' ).'</li>';
		$html .= '<li>* <a href="http://a3rev.com/shop/woocommerce-quotes-and-orders/" target="_blank">'.__('WooCommerce Quotes and Orders', 'wc_psad').'</a> &nbsp;&nbsp;&nbsp;'.__( '(Free Trial)' , 'wc_psad' ).'</li>';
		$html .= '</ul>';
		$html .= '</p>';
		$html .= '<h3>'.__('FREE a3rev WordPress Plugins', 'wc_psad').'</h3>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>* <a href="http://wordpress.org/plugins/a3-responsive-slider/" target="_blank">'.__('a3 Responsive Slider', 'wc_psad').'</a> &nbsp;&nbsp;&nbsp;'.__( 'New Release!' , 'wc_psad' ).'</li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/contact-us-page-contact-people/" target="_blank">'.__('Contact Us Page - Contact People', 'wc_psad').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/wp-email-template/" target="_blank">'.__('WordPress Email Template', 'wc_psad').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/page-views-count/" target="_blank">'.__('Page View Count', 'wc_psad').'</a></li>';
		$html .= '</ul>';
		$html .= '</p>';
		return $html;
	}
	
	public static function plugin_extra_links($links, $plugin_name) {
		if ( $plugin_name != WC_PSAD_NAME) {
			return $links;
		}
		$links[] = '<a href="http://docs.a3rev.com/user-guides/plugins-extensions/woocommerce/product-sort-and-display/" target="_blank">'.__('Documentation', 'wc_psad').'</a>';
		$links[] = '<a href="http://wordpress.org/support/plugin/woocommerce-product-sort-and-display/" target="_blank">'.__('Support', 'wc_psad').'</a>';
		return $links;
	}
}
?>
