<?php
/**
 * WC_PSAD Functions
 *
 * Table Of Contents
 *
 * auto_create_order_keys_all_products()
 * update_orders_value()
 */
class WC_PSAD_Functions 
{	
	public static function auto_create_order_keys_all_products() {
		global $wpdb;
		
		// Get all Products
		$all_products = $wpdb->get_results( " SELECT ID FROM ".$wpdb->posts." WHERE post_status='publish' AND post_type='product' " );	
		
		// Create sort keys
		if ( $all_products && count( $all_products ) > 0 ) {
			foreach ( $all_products as $a_product ) {
				$product = get_product( $a_product->ID );
				if ( $product ) {
					if ( $product->is_on_sale() ) {
						update_post_meta( $a_product->ID, '_psad_onsale_order', 2 );
					} else {
						update_post_meta( $a_product->ID, '_psad_onsale_order', 1 );
					}
					if ( $product->is_featured() ) {
						update_post_meta( $a_product->ID, '_psad_featured_order', 2 );
					} else {
						update_post_meta( $a_product->ID, '_psad_featured_order', 1 );	
					}
				}
			}
		}
	}
	
	public static function update_orders_value( $post_id, $post ) {
		if ( is_int( wp_is_post_revision( $post_id ) ) ) return;
		if ( is_int( wp_is_post_autosave( $post_id ) ) ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
		if ( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;
		if ( $post->post_type != 'product' ) return $post_id;
		
		$product = get_product( $post );
		if ( $product->is_on_sale() ) {
			update_post_meta( $post_id, '_psad_onsale_order', 2 );
		} else {
			update_post_meta( $post_id, '_psad_onsale_order', 1 );
		}
		if ( $product->is_featured() ) {
			update_post_meta( $post_id, '_psad_featured_order', 2 );
		} else {
			update_post_meta( $post_id, '_psad_featured_order', 1 );	
		}
	}
	
	public static function upgrade_version_1_0_2() {	
		
		// Shop Page Scroll Styling Updating
		$psad_es_shop_bt_border = get_option( 'psad_es_shop_bt_border' );
		if ( $psad_es_shop_bt_border == false || !is_array( $psad_es_shop_bt_border ) ) { 	
			$psad_es_shop_bt_border = array(
				'width'					=> get_option( 'psad_es_shop_bt_border_width', 1 ).'px',
				'style'					=> get_option( 'psad_es_shop_bt_border_style', 'solid' ),
				'color'					=> get_option( 'psad_es_shop_bt_border_color', '#7497B9' ),
				'corner'				=> 'rounded',
				'top_left_corner'		=> get_option( 'psad_es_shop_bt_rounded', 3 ),
				'top_right_corner'		=> get_option( 'psad_es_shop_bt_rounded', 3 ),
				'bottom_left_corner'	=> get_option( 'psad_es_shop_bt_rounded', 3 ),
				'bottom_right_corner'	=> get_option( 'psad_es_shop_bt_rounded', 3 ),
				
			);
			update_option( 'psad_es_shop_bt_border', $psad_es_shop_bt_border );
		}
		
		$psad_es_shop_bt_font = get_option( 'psad_es_shop_bt_font' );
		if ( $psad_es_shop_bt_font == false || !is_array( $psad_es_shop_bt_font ) ) { 
			$psad_es_shop_bt_font = array(
				'size'					=> get_option( 'psad_es_shop_bt_font_size', 12 ).'px',
				'face'					=> get_option( 'psad_es_shop_bt_font_family', 'Arial, sans-serif' ),
				'style'					=> get_option( 'psad_es_shop_bt_font_style', 'bold' ),
				'color'					=> get_option( 'psad_es_shop_bt_font_color', '#FFFFFF' ),
			);
			update_option( 'psad_es_shop_bt_font', $psad_es_shop_bt_font );
		}
		
		$psad_es_shop_link_font = get_option( 'psad_es_shop_link_font' );
		if ( $psad_es_shop_link_font == false || !is_array( $psad_es_shop_link_font ) ) { 
			$psad_es_shop_link_font = array(
				'size'					=> get_option( 'psad_es_shop_link_font_size', 12 ).'px',
				'face'					=> get_option( 'psad_es_shop_link_font_family', 'Arial, sans-serif' ),
				'style'					=> get_option( 'psad_es_shop_link_font_style', 'bold' ),
				'color'					=> get_option( 'psad_es_shop_link_font_color', '#7497B9' ),
			);
			update_option( 'psad_es_shop_link_font', $psad_es_shop_link_font );
		}
		
		// Category Page Scroll Styling Updating
		$psad_es_category_bt_border = get_option( 'psad_es_category_bt_border' );
		if ( $psad_es_category_bt_border == false || !is_array( $psad_es_category_bt_border ) ) { 	
			$psad_es_category_bt_border = array(
				'width'					=> get_option( 'psad_es_category_bt_border_width', 1 ).'px',
				'style'					=> get_option( 'psad_es_category_bt_border_style', 'solid' ),
				'color'					=> get_option( 'psad_es_category_bt_border_color', '#7497B9' ),
				'corner'				=> 'rounded',
				'top_left_corner'		=> get_option( 'psad_es_category_bt_rounded', 3 ),
				'top_right_corner'		=> get_option( 'psad_es_category_bt_rounded', 3 ),
				'bottom_left_corner'	=> get_option( 'psad_es_category_bt_rounded', 3 ),
				'bottom_right_corner'	=> get_option( 'psad_es_category_bt_rounded', 3 ),
				
			);
			update_option( 'psad_es_category_bt_border', $psad_es_category_bt_border );
		}
		
		$psad_es_category_bt_font = get_option( 'psad_es_category_bt_font' );
		if ( $psad_es_category_bt_font == false || !is_array( $psad_es_category_bt_font ) ) { 
			$psad_es_category_bt_font = array(
				'size'					=> get_option( 'psad_es_category_bt_font_size', 12 ).'px',
				'face'					=> get_option( 'psad_es_category_bt_font_family', 'Arial, sans-serif' ),
				'style'					=> get_option( 'psad_es_category_bt_font_style', 'bold' ),
				'color'					=> get_option( 'psad_es_category_bt_font_color', '#FFFFFF' ),
			);
			update_option( 'psad_es_category_bt_font', $psad_es_category_bt_font );
		}
		
		$psad_es_category_link_font = get_option( 'psad_es_category_link_font' );
		if ( $psad_es_category_link_font == false || !is_array( $psad_es_category_link_font ) ) { 
			$psad_es_category_link_font = array(
				'size'					=> get_option( 'psad_es_category_link_font_size', 12 ).'px',
				'face'					=> get_option( 'psad_es_category_link_font_family', 'Arial, sans-serif' ),
				'style'					=> get_option( 'psad_es_category_link_font_style', 'bold' ),
				'color'					=> get_option( 'psad_es_category_link_font_color', '#7497B9' ),
			);
			update_option( 'psad_es_category_link_font', $psad_es_category_link_font );
		}
		
		// Parent Cat & Tag Page Scroll Styling Updating
		$psad_es_products_bt_border = get_option( 'psad_es_products_bt_border' );
		if ( $psad_es_products_bt_border == false || !is_array( $psad_es_products_bt_border ) ) { 	
			$psad_es_products_bt_border = array(
				'width'					=> get_option( 'psad_es_products_bt_border_width', 1 ).'px',
				'style'					=> get_option( 'psad_es_products_bt_border_style', 'solid' ),
				'color'					=> get_option( 'psad_es_products_bt_border_color', '#7497B9' ),
				'corner'				=> 'rounded',
				'top_left_corner'		=> get_option( 'psad_es_products_bt_rounded', 3 ),
				'top_right_corner'		=> get_option( 'psad_es_products_bt_rounded', 3 ),
				'bottom_left_corner'	=> get_option( 'psad_es_products_bt_rounded', 3 ),
				'bottom_right_corner'	=> get_option( 'psad_es_products_bt_rounded', 3 ),
				
			);
			update_option( 'psad_es_products_bt_border', $psad_es_products_bt_border );
		}
		
		$psad_es_products_bt_font = get_option( 'psad_es_products_bt_font' );
		if ( $psad_es_products_bt_font == false || !is_array( $psad_es_products_bt_font ) ) { 
			$psad_es_products_bt_font = array(
				'size'					=> get_option( 'psad_es_products_bt_font_size', 12 ).'px',
				'face'					=> get_option( 'psad_es_products_bt_font_family', 'Arial, sans-serif' ),
				'style'					=> get_option( 'psad_es_products_bt_font_style', 'bold' ),
				'color'					=> get_option( 'psad_es_products_bt_font_color', '#FFFFFF' ),
			);
			update_option( 'psad_es_products_bt_font', $psad_es_products_bt_font );
		}
		
		$psad_es_products_link_font = get_option( 'psad_es_products_link_font' );
		if ( $psad_es_products_link_font == false || !is_array( $psad_es_products_link_font ) ) { 
			$psad_es_products_link_font = array(
				'size'					=> get_option( 'psad_es_products_link_font_size', 12 ).'px',
				'face'					=> get_option( 'psad_es_products_link_font_family', 'Arial, sans-serif' ),
				'style'					=> get_option( 'psad_es_products_link_font_style', 'bold' ),
				'color'					=> get_option( 'psad_es_products_link_font_color', '#7497B9' ),
			);
			update_option( 'psad_es_products_link_font', $psad_es_products_link_font );
		}
		
		// View All Products Styling Updating
		$psad_es_category_item_bt_border = get_option( 'psad_es_category_item_bt_border' );
		if ( $psad_es_category_item_bt_border == false || !is_array( $psad_es_category_item_bt_border ) ) { 	
			$psad_es_category_item_bt_border = array(
				'width'					=> get_option( 'psad_es_category_item_bt_border_width', 1 ).'px',
				'style'					=> get_option( 'psad_es_category_item_bt_border_style', 'solid' ),
				'color'					=> get_option( 'psad_es_category_item_bt_border_color', '#7497B9' ),
				'corner'				=> 'rounded',
				'top_left_corner'		=> get_option( 'psad_es_category_item_bt_rounded', 3 ),
				'top_right_corner'		=> get_option( 'psad_es_category_item_bt_rounded', 3 ),
				'bottom_left_corner'	=> get_option( 'psad_es_category_item_bt_rounded', 3 ),
				'bottom_right_corner'	=> get_option( 'psad_es_category_item_bt_rounded', 3 ),
				
			);
			update_option( 'psad_es_category_item_bt_border', $psad_es_category_item_bt_border );
		}
		
		$psad_es_category_item_bt_font = get_option( 'psad_es_category_item_bt_font' );
		if ( $psad_es_category_item_bt_font == false || !is_array( $psad_es_category_item_bt_font ) ) { 
			$psad_es_category_item_bt_font = array(
				'size'					=> get_option( 'psad_es_category_item_bt_font_size', 12 ).'px',
				'face'					=> get_option( 'psad_es_category_item_bt_font_family', 'Arial, sans-serif' ),
				'style'					=> get_option( 'psad_es_category_item_bt_font_style', 'bold' ),
				'color'					=> get_option( 'psad_es_category_item_bt_font_color', '#FFFFFF' ),
			);
			update_option( 'psad_es_category_item_bt_font', $psad_es_category_item_bt_font );
		}
		
		$psad_es_category_item_link_font = get_option( 'psad_es_category_item_link_font' );
		if ( $psad_es_category_item_link_font == false || !is_array( $psad_es_category_item_link_font ) ) { 
			$psad_es_category_item_link_font = array(
				'size'					=> get_option( 'psad_es_category_item_link_font_size', 12 ).'px',
				'face'					=> get_option( 'psad_es_category_item_link_font_family', 'Arial, sans-serif' ),
				'style'					=> get_option( 'psad_es_category_item_link_font_style', 'bold' ),
				'color'					=> get_option( 'psad_es_category_item_link_font_color', '#7497B9' ),
			);
			update_option( 'psad_es_category_item_link_font', $psad_es_category_item_link_font );
		}
		
		// Visual Content Separator Styling Updating
		$psad_seperator_border = get_option( 'psad_seperator_border' );
		if ( $psad_seperator_border == false || !is_array( $psad_seperator_border ) ) { 	
			$psad_seperator_border = array(
				'width'					=> get_option( 'psad_seperator_border_width', 1 ).'px',
				'style'					=> get_option( 'psad_seperator_border_style', 'solid' ),
				'color'					=> get_option( 'psad_seperator_border_color', '#000000' ),
			);
			update_option( 'psad_seperator_border', $psad_seperator_border );
		}
		update_option( 'psad_seperator_padding_top', get_option('psad_seperator_padding_tb') );
		update_option( 'psad_seperator_padding_bottom', get_option('psad_seperator_padding_tb') );
		
		// Count Meta Styling Updating
		$psad_count_meta_font = get_option( 'psad_count_meta_font' );
		if ( $psad_count_meta_font == false || !is_array( $psad_count_meta_font ) ) { 
			$psad_count_meta_font = array(
				'size'					=> get_option( 'psad_count_meta_font_size', 11 ).'px',
				'face'					=> get_option( 'psad_count_meta_font_family', 'Arial, sans-serif' ),
				'style'					=> get_option( 'psad_count_meta_font_style', 'italic' ),
				'color'					=> get_option( 'psad_count_meta_font_color', '#000000' ),
			);
			update_option( 'psad_count_meta_font', $psad_count_meta_font );
		}
		
	}
}
?>