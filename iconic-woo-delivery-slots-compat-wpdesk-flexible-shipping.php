<?php
/**
 * Plugin Name:     WooCommerce Delivery Slots by Kadence [Table Rate for WooCommerce by Flexible Shipping]
 * Plugin URI:      https://iconicwp.com/products/woocommerce-delivery-slots/
 * Description:     Compatibility between WooCommerce Delivery Slots by Kadence and 'Table Rate for WooCommerce by Flexible Shipping' by WPDesk.
 * Author:          Kadence WP
 * Author URI:      https://www.kadencewp.com/
 * Text Domain:     iconic-woo-delivery-slots-compat-wpdesk-flexible-shipping
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Iconic_Woo_Delivery_Slots_Compat_WPDesk_Flexible_shipping
 */


/**
 * Is Flexible Shippin active?
 *
 * @return bool
 */
function iconic_compat_wpdesk_flexible_shipping_is_active() {
	return defined( 'FLEXIBLE_SHIPPING_VERSION' );
}


/**
 * Change format of the shipping method ID.
 *
 * @return array
 */
function iconic_compat_wpdesk_flexible_shipping_update_shipping_method_id( $shipping_method_options ) {
	if ( ! iconic_compat_wpdesk_flexible_shipping_is_active() ) {
		return $shipping_method_options;
	}

	$updated_shipping_method = array();

	foreach ( $shipping_method_options as $method_key => $method_name ) {
		if ( false !== strpos( $method_key, 'wpdesk\fs\tablerate\shippingmethodsingle:' ) ) {
			$method_key = str_replace( 'wpdesk\fs\tablerate\shippingmethodsingle:', 'flexible_shipping_single:', $method_key );
		}

		$updated_shipping_method[ $method_key ] = $method_name;
	}


	return $updated_shipping_method;
}

add_filter( 'iconic_wds_shipping_method_options', 'iconic_compat_wpdesk_flexible_shipping_update_shipping_method_id', 10 );
