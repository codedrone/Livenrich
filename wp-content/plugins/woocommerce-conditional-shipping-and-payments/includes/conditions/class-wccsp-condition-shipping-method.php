<?php
/**
 * WC_CSP_Condition_Shipping_Method class
 *
 * @author   SomewhereWarm <info@somewherewarm.gr>
 * @package  WooCommerce Conditional Shipping and Payments
 * @since    1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Selected Shipping Method Condition.
 *
 * @class   WC_CSP_Condition_Shipping_Method
 * @version 1.2.0
 */
class WC_CSP_Condition_Shipping_Method extends WC_CSP_Condition {

	public function __construct() {

		$this->id                             = 'shipping_method';
		$this->title                          = __( 'Shipping Method', 'woocommerce-conditional-shipping-and-payments' );
		$this->supported_global_restrictions  = array( 'payment_gateways' );
		$this->supported_product_restrictions = array( 'payment_gateways' );
	}

	/**
	 * True if a rate is excluded.
	 *
	 * @param  string                  $rate_id
	 * @param  array                   $excluded_rates
	 * @param  WC_Shipping_Rate|false  $rate
	 * @return boolean
	 */
	private function is_restricted( $rate_id, $excluded_rates, $rate = false ) {

		$is_restricted              = false;
		$legacy_flat_rate_method_id = WC_CSP_Core_Compatibility::is_wc_version_gte_2_6() ? 'legacy_flat_rate' : 'flat_rate';

		foreach ( $excluded_rates as $excluded_rate_id ) {

			if ( $rate_id === $excluded_rate_id ) {

				$is_restricted = true;
				break;

			} elseif ( $excluded_rate_id !== $legacy_flat_rate_method_id && 0 === strpos( $rate_id, $excluded_rate_id ) && in_array( substr( $rate_id, strlen( $excluded_rate_id ), 1 ), array( ':', '-' ) ) ) {

				$is_restricted = true;
				break;

			} elseif ( is_object( $rate ) && WC_CSP_Core_Compatibility::is_wc_version_gte( '3.2' ) ) {

				$method_id   = $rate->get_method_id();
				$instance_id = $rate->get_instance_id();

				// When a rate is mapped to a known method ID and instance ID (attached to specific Shipping Zones), attempt to construct & evaluate its canonical rate ID.
				if ( $method_id && $instance_id ) {

					$canonical_rate_id = $method_id . ':' . $instance_id;

					if ( self::is_restricted( $canonical_rate_id, $excluded_rates ) ) {
						$is_restricted = true;
						break;
					}
				}
			}
		}

		return $is_restricted;
	}

	/**
	 * Return condition field-specific resolution message which is combined along with others into a single restriction "resolution message".
	 *
	 * @param  array  $data   condition field data
	 * @param  array  $args   optional arguments passed by restriction
	 * @return string|false
	 */
	public function get_condition_resolution( $data, $args ) {

		// Empty conditions always return false (not evaluated).
		if ( empty( $data[ 'value' ] ) ) {
			return false;
		}

		$chosen_methods    = WC()->session->get( 'chosen_shipping_methods' );
		$shipping_packages = WC()->shipping->get_packages();
		$excluded_rates    = $data[ 'value' ];

		foreach ( $chosen_methods as $package_key => $chosen_rate_id ) {

			$chosen_rate = ! empty( $shipping_packages ) && ! empty( $shipping_packages[ $package_key ][ 'rates' ][ $chosen_rate_id ] ) ? $shipping_packages[ $package_key ][ 'rates' ][ $chosen_rate_id ] : false;

			if ( $this->is_restricted( $chosen_rate_id, $excluded_rates, $chosen_rate ) ) {
				return __( 'select a different shipping method', 'woocommerce-conditional-shipping-and-payments' );
			}
		}

		return false;
	}

	/**
	 * Evaluate if a condition field is in effect or not.
	 *
	 * @param  array  $data   condition field data
	 * @param  array  $args   optional arguments passed by restrictions
	 * @return boolean
	 */
	public function check_condition( $data, $args ) {

		// Empty conditions always apply (not evaluated).
		if ( empty( $data[ 'value' ] ) ) {
			return true;
		}

		if ( is_checkout_pay_page() ) {

			global $wp;

			$chosen_methods    = array();
			$shipping_packages = array();

			if ( isset( $wp->query_vars[ 'order-pay' ] ) ) {

				$order_id = $wp->query_vars[ 'order-pay' ];
				$order    = wc_get_order( $order_id );

				if ( $order ) {
					$order_shipping_methods = $order->get_shipping_methods();

					if ( ! empty( $order_shipping_methods ) ) {
						foreach ( $order_shipping_methods as $order_shipping_method ) {
							$chosen_methods[] = $order_shipping_method[ 'method_id' ];
						}
					}
				}
			}

		} else {
			$chosen_methods    = WC()->session->get( 'chosen_shipping_methods' );
			$shipping_packages = WC()->shipping->get_packages();
		}

		$excluded_rates = $data[ 'value' ];

		if ( ! empty( $chosen_methods ) ) {
			foreach ( $chosen_methods as $package_key => $chosen_rate_id ) {

				$chosen_rate = ! empty( $shipping_packages ) && ! empty( $shipping_packages[ $package_key ][ 'rates' ][ $chosen_rate_id ] ) ? $shipping_packages[ $package_key ][ 'rates' ][ $chosen_rate_id ] : false;

				if ( $this->is_restricted( $chosen_rate_id, $excluded_rates, $chosen_rate ) ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Validate, process and return condition field data.
	 *
	 * @param  array  $posted_condition_data
	 * @return array
	 */
	public function process_admin_fields( $posted_condition_data ) {

		$processed_condition_data = array();

		if ( ! empty( $posted_condition_data[ 'value' ] ) ) {
			$processed_condition_data[ 'condition_id' ] = $this->id;
			$processed_condition_data[ 'value' ]        = array_map( 'stripslashes', $posted_condition_data[ 'value' ] );
			$processed_condition_data[ 'modifier' ]     = stripslashes( $posted_condition_data[ 'modifier' ] );

			return $processed_condition_data;
		}

		return false;
	}

	/**
	 * Get shipping methods condition content for admin product restriction metaboxes.
	 *
	 * @param  int    $index
	 * @param  int    $condition_index
	 * @param  array  $condition_data
	 * @return str
	 */
	public function get_admin_fields_html( $index, $condition_index, $condition_data ) {

		$modifier = '';
		$methods  = array();

		if ( ! empty( $condition_data[ 'modifier' ] ) ) {
			$modifier = $condition_data[ 'modifier' ];
		}

		if ( ! empty( $condition_data[ 'value' ] ) ) {
			$methods = $condition_data[ 'value' ];
		}

		$shipping_methods = WC()->shipping->load_shipping_methods();

		?>
		<input type="hidden" name="restriction[<?php echo $index; ?>][conditions][<?php echo $condition_index; ?>][condition_id]" value="<?php echo $this->id; ?>" />
		<div class="condition_modifier">
			<select name="restriction[<?php echo $index; ?>][conditions][<?php echo $condition_index; ?>][modifier]">
				<option value="in" <?php selected( $modifier, 'in', true ) ?>><?php echo __( 'is', 'woocommerce-conditional-shipping-and-payments' ); ?></option>
			</select>
		</div>
		<div class="condition_value">
			<select name="restriction[<?php echo $index; ?>][conditions][<?php echo $condition_index; ?>][value][]" style="width:80%" class="multiselect <?php echo WC_CSP_Core_Compatibility::is_wc_version_gte_2_3() ? 'wc-enhanced-select' : 'chosen_select'; ?>" multiple="multiple" data-placeholder="<?php _e( 'Select shipping methods&hellip;', 'woocommerce-conditional-shipping-and-payments' ); ?>">
				<?php
					foreach ( $shipping_methods as $key => $val ) {
						do_action( 'woocommerce_csp_admin_shipping_method_option', $key, $val, $methods );
					}
				?>
			</select>
		</div><?php

	}

}
