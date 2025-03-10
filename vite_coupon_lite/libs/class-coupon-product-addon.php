<?php
/**
 * Its coupon product addon, its field value of coupon addon
 *
 * @author: Sarwar Hasan
 * @version 1.0.0
 * @package VitePos\Libs
 */

namespace Vite_Coupon_Lite\Libs;

if ( ! class_exists( __NAMESPACE__ . '\Coupon_Product_Addon' ) ) {
	/**
	 * Class Coupon_Product_Addon
	 *
	 * @package Vite_Coupon_Lite\Libs
	 */
	class Coupon_Product_Addon {
		/**
		 * Its property id
		 *
		 * @var integer
		 */
		public $id;
		/**
		 * Its property title
		 *
		 * @var string
		 */
		public $title = '';

		/**
		 * Its property option_limit
		 *
		 * @var int
		 */
		public $opt_limit = 0;
		/**
		 * Its property des
		 *
		 * @var string
		 */
		public $des = '';
		/**
		 * Its property addon_type
		 *
		 * @var string
		 */
		public $addon_type = 'T';
		/**
		 * Its property addon options
		 *
		 * @var array
		 */
		public $addon_opts = array();
		/**
		 * Its property help_text
		 *
		 * @var string
		 */
		public $help_text = '';

		/**
		 * Its property is_required
		 *
		 * @var string
		 */
		public $is_required = 'Y';
		/**
		 * Its property is_required
		 *
		 * @var string
		 */
		public $def_value = '';
		/**
		 * Its property status
		 *
		 * @var string
		 */
		public $status = 'A';

		/**
		 * The add option is generated by appsbd
		 *
		 * @param array       $addon_opts Its addon_opts param.
		 * @param \WC_Product $wc_product Its wc_product param.
		 */
		public function add_option( $addon_opts, $wc_product ) {
			foreach ( $addon_opts as $addon_opt ) {
				$option        = new \stdClass();
				$option->id    = $addon_opt->id;
				$option->label = $addon_opt->label;
				$option->price = doubleval( $addon_opt->price );
				/**
				 * Its for check is there any change before process
				 *
				 * @since 2.0
				 */
				$option->tax = apply_filters( 'vitepos/filter/addon-tax', 0.0, $option->price, $wc_product );

				$option->is_selected = $addon_opt->is_selected;
				$this->addon_opts[]  = $option;
			}
		}

		/**
		 * The set product addon by is generated by appsbd
		 *
		 * @param any   $addon Its addon param.
		 * @param array $product_addons its product addons param.
		 * @param null  $wc_product its wc product param.
		 *
		 * @return array|mixed
		 */
		public static function set_product_addon_by( $addon, &$product_addons = array(), $wc_product = null ) {

			foreach ( $addon->fields as $field ) {
				$sf              = new self();
				$sf->id          = $field->id;
				$sf->title       = $field->title;
				$sf->des         = $field->des;
				$sf->addon_type  = $field->type;
				$sf->help_text   = $field->placeholder;
				$sf->is_required = $field->is_required;
				$sf->def_value   = $field->def_value;
				$sf->opt_limit   = $field->field_limit;
				$sf->add_option( $field->options, $wc_product );
				$product_addons[] = $sf;
			}
			return $product_addons;
		}
	}
}
