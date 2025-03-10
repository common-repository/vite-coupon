<?php
/**
 * Its Percentage Upto Calculation
 *
 * @since: 21/09/2021
 * @author: Sarwar Hasan
 * @version 1.0.0
 * @package Vite_Coupon_Lite\Libs
 */

namespace Vite_Coupon_Lite\Libs;

/**
 * Class Percentage_Upto_Calculation
 *
 * @package Vite_Coupon_Lite\Libs
 */
class Percentage_Upto_Calculation {
	/**
	 * The apply coupon remainder is generated by appsbd
	 *
	 * @param mixed $discount_array It is discount_array param.
	 * @param mixed $items_to_apply It is items_to_apply param.
	 * @param mixed $amount It is amount param.
	 *
	 * @return int|mixed
	 */
	public static function apply_coupon_remainder( &$discount_array, $items_to_apply, $amount ) {
		$total_discount = 0;
		foreach ( $items_to_apply as $item ) {
			for ( $i = 0; $i < $item['quantity']; $i++ ) {
				if ( empty( $item['discounted_price'] ) ) {
					continue;
				}
				$discount = min( $item['discounted_price'], 1 );
				$total_discount += $discount;
				$discount_array[ $item['key'] ] += $discount;

				if ( $total_discount >= $amount ) {
					break 2;
				}
			}
			if ( $total_discount >= $amount ) {
				break;
			}
		}
		return $total_discount;
	}
}
