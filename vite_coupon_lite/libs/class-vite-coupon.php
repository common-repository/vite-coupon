<?php
/**
 * Coupon_Plugin Coupons model
 *
 * @package Vite_Coupon_Lite\Models\Database
 */

namespace Vite_Coupon_Lite\Libs;

use Appsbd_Lite\V2\libs\AppInput;
use Vite_Coupon_Lite\Core\Coupon_Lite;
use Vite_Coupon_Lite\libs\Coupon_Rules;
use Vite_Coupon_Lite\Modules\Vite_Coupon_Plugin;


/**
 * Class Vite_Coupon
 *
 * @package Coupon_Plugin\Models\Database
 *
 * @property  int $id This is id.
 * @property string $coupon_code This is coupon code.
 * @property string $category_id This is coupon code.
 * @property mixed $start_date This is coupon code.
 * @property mixed $end_date This is coupon code.
 * @property bool $no_expiry This is coupon code.
 * @property string $discount_type This is coupon code.
 * @property float $discount_amount This is coupon code.
 * @property float $percentage_upto This is coupon code.
 * @property float $percentage_shipping This is coupon code.
 * @property string $is_scheduler_active This is coupon code.
 * @property mixed $scheduler_data This is coupon code.
 * @property Coupon_Rules $rules This is coupon code.
 * @property int $coupon_usage_limit This is coupon code.
 * @property int $user_usage_limit This is coupon code.
 * @property string $status This is coupon code.
 * @property string $apply_to This is coupon code.
 * @property int $usage_count This is coupon code.

 * @property string $is_all_outlet This is coupon code.
 * @property array $outlets This is coupon code.
 * @property array $offer_products Discount(Bogo) offer_products;
 */
class Vite_Coupon {
	/**
	 * Its property rules_object
	 *
	 * @var Coupon_Rules
	 */
	protected $rules_object = null;
	/**
	 * Its property data
	 *
	 * @var array
	 */
	protected $data = array();
	/**
	 * Its property coupon
	 *
	 * @var \WC_Coupon
	 */
	protected $coupon = null;
	/**
	 * Its property meta_data
	 *
	 * @var array
	 */
	protected $meta_data = array();

	/**
	 * Coupon constructor.
	 *
	 * @param null $id It is id.
	 */
	public function __construct( $id = null ) {
		if ( ! empty( $id ) ) {
			$this->load_coupon_by_id( $id );
		}
	}

	/**
	 * The is found is generated by appsbd
	 *
	 * @return bool
	 */
	public function is_found() {
		if ( ( $this->coupon instanceof \WC_Coupon ) && ! empty( $this->coupon->get_id() ) ) {
			return true;
		}
		return false;
	}

	/**
	 * The get related products is generated by appsbd
	 *
	 * @return mixed|void
	 */
	public function get_related_products() {
		$added          = array();
		$products       = array();
		$offer_products = $this->offer_products;
		$rules          = $this->rules;
		if ( ! empty( $rules ) ) {
			foreach ( $rules['products'] as $item ) {
				if ( ! in_array( $item, $added ) ) {
					$product    = wc_get_product( $item );
					$added[]    = $item;
					$products[] = Coupon_Product::get_product_variation_data( $product );
				}
			}
			foreach ( $rules['exclude_products'] as $item ) {
				if ( ! in_array( $item, $added ) ) {
					$product    = wc_get_product( $item );
					$added[]    = $item;
					$products[] = Coupon_Product::get_product_variation_data( $product );
				}
			}
			foreach ( $offer_products as $item ) {
				if ( ! in_array( $item, $added ) ) {
					$product    = wc_get_product( $item );
					$added[]    = $item;
					$products[] = Coupon_Product::get_product_variation_data( $product );
				}
			}
		}
		/**
		 * Its for check is there any change before process
		 *
		 * @since 4.0
		 */
		return apply_filters( 'appsbd/vite-coupon/filter/coupon-details-products', $products, $added, $this );
	}

	/**
	 * The get grid data is generated by appsbd
	 *
	 * @return \stdClass
	 */
	public function get_grid_data() {
		$data                     = new \stdClass();
		$data->id                 = $this->id;
		$data->usage_count        = $this->usage_count;
		$data->coupon_code        = $this->coupon_code;
		$data->start_date         = $this->start_date;
		$data->end_date           = $this->end_date;
		$data->discount_type      = $this->get_discount_grid_type();
		$data->discount_amount    = $this->discount_amount;
		$data->percentage_upto    = $this->percentage_upto;
		$data->coupon_usage_limit = $this->coupon_usage_limit;
		$data->user_usage_limit   = $this->user_usage_limit;
		$data->no_expiry          = $this->no_expiry;
		$data->apply_to           = $this->apply_to;
		$data->status             = $this->status;

		$data->is_all_outlet = $this->is_all_outlet;
		$outlets             = Vite_Coupon_Plugin::get_outlets_id_name();
		$data->outlets       = $this->outlets;
		if ( is_array( $data->outlets ) ) {
			foreach ( $data->outlets as &$outlet ) {
				$obj       = new \stdClass();
				$obj->id   = $outlet;
				$obj->name = appsbd_get_text_by_key( $outlet, $outlets );
				$outlet    = $obj;
			}
		}
		$data->is_scheduler_active = array( 'status' => $this->is_scheduler_active ? 'Y' : 'N' );
		$data->scheduler_data      = $this->scheduler_data;
		$data->rules               = $this->rules;
		return $data;
	}

	/**
	 * The   get is generated by appsbd
	 *
	 * @param mixed $name It is name param.
	 *
	 * @return array|bool|int|mixed|string|void
	 */
	public function __get( $name ) {

		if ( 'id' == $name ) {
			return $this->coupon->get_id();
		} elseif ( 'status' == $name ) {
			return $this->coupon->get_status();
		} elseif ( 'usage_count' == $name ) {
			return $this->coupon->get_usage_count();
		} elseif ( 'coupon_code' == $name ) {
			return $this->coupon->get_code();
		} elseif ( 'start_date' == $name ) {
			$start_date = $this->coupon->get_date_created();
			if ( ! empty( $start_date ) ) {
				return $start_date->date( 'Y-m-d' );
			} else {
				return '';
			}
		} elseif ( 'end_date' == $name ) {
			$exp_date = $this->coupon->get_date_expires();
			if ( ! empty( $exp_date ) ) {
				return $exp_date->date( 'Y-m-d' );
			} else {
				return '';
			}
		} elseif ( 'discount_type' == $name ) {
			return $this->coupon->get_discount_type();
		} elseif ( 'discount_amount' == $name ) {
			return $this->coupon->get_amount();
		} elseif ( 'offer_products' == $name ) {
			$offer_products = $this->coupon->get_meta( 'offer_products' );
			if ( ! empty( $offer_products ) && is_array( $offer_products ) ) {
				return $offer_products;
			} else {
				return array();
			}
		} elseif ( 'percentage_upto' == $name ) {
			return $this->coupon->get_meta( '_vc_percentage_upto' );
		} elseif ( 'coupon_usage_limit' == $name ) {
			return $this->coupon->get_usage_limit();
		} elseif ( 'user_usage_limit' == $name ) {
			return $this->coupon->get_usage_limit_per_user();
		} elseif ( 'no_expiry' == $name ) {
			return $this->coupon->get_meta( '_vc_no_expiry' );
		} elseif ( 'category_id' == $name ) {
			return $this->coupon->get_meta( '_vc_category_id' );
		} elseif ( 'apply_to' == $name ) {
			return $this->coupon->get_meta( '_vc_apply_to' );
		} elseif ( 'outlets' == $name ) {
			$outlets = $this->coupon->get_meta( '_vc_outlets' );
			if ( ! empty( $outlets ) && is_array( $outlets ) ) {
				return $outlets;
			} else {
				return array();
			}
		} elseif ( 'is_all_outlet' == $name ) {
			return $this->coupon->get_meta( '_vc_is_all_outlet' );
		} elseif ( 'is_scheduler_active' == $name ) {
			return $this->coupon->get_meta( '_vc_is_scheduler_active' );
		} elseif ( 'scheduler_data' == $name ) {
			return $this->coupon->get_meta( '_vc_scheduler_data' );
		} elseif ( 'minimum_spend' == $name ) {
			return $this->coupon->get_minimum_amount();
		} elseif ( 'maximum_spend' == $name ) {
			return $this->coupon->get_maximum_amount();
		} elseif ( 'is_indvidual' == $name ) {
			return $this->coupon->get_individual_use();
		} elseif ( 'is_exclude_sale' == $name ) {
			return $this->coupon->get_exclude_sale_items();
		} elseif ( 'is_free_shipping' == $name ) {
			return $this->coupon->get_free_shipping();
		} elseif ( 'products' == $name ) {
			return $this->coupon->get_product_ids();
		} elseif ( 'exclude_products' == $name ) {
			return $this->coupon->get_excluded_product_ids();
		} elseif ( 'categories' == $name ) {
			return $this->coupon->get_product_categories();
		} elseif ( 'exclude_categories' == $name ) {
			return $this->coupon->get_excluded_product_categories();
		} elseif ( 'allowed_emails' == $name ) {
			return $this->coupon->get_email_restrictions();
		} elseif ( 'rules' == $name ) {
			$rules                       = array();
			$rules['minimum_spend']      = $this->coupon->get_minimum_amount();
			$rules['maximum_spend']      = $this->coupon->get_maximum_amount();
			$rules['is_indvidual']       = $this->coupon->get_individual_use() ? 'Y' : 'N';
			$rules['is_exclude_sale']    = $this->coupon->get_exclude_sale_items() ? 'Y' : 'N';
			$rules['is_free_shipping']   = $this->coupon->get_free_shipping() ? 'Y' : 'N';
			$rules['products']           = $this->coupon->get_product_ids();
			$rules['exclude_products']   = $this->coupon->get_excluded_product_ids();
			$rules['categories']         = $this->coupon->get_product_categories();
			$rules['exclude_categories'] = $this->coupon->get_excluded_product_categories();
			$rules['allowed_emails']     = $this->coupon->get_email_restrictions();
			return $rules;
		} else {
			/**
			 * Its for check is there any change before process
			 *
			 * @since 1.0
			 */
			return apply_filters( 'appsbd/vite-coupon/filter/vite-coupon-get', null, $name );
		}
	}

	/**
	 * The set meta is generated by appsbd
	 *
	 * @param mixed $key It is key param.
	 * @param mixed $val It is val param.
	 */
	public function set_meta( $key, $val ) {
		$this->meta_data[ $key ] = $val;
	}

	/**
	 * The   set is generated by appsbd
	 *
	 * @param mixed $name It is name param.
	 * @param mixed $value It is value param.
	 */
	public function __set( $name, $value ) {
		if ( 'usage_count' == $name ) {
			$this->coupon->set_usage_count( $value );
		} elseif ( 'coupon_code' == $name ) {
			$this->coupon->set_code( $value );
		} elseif ( 'status' == $name ) {
			return $this->coupon->set_status( 'A' == $value ? 'publish' : 'draft' );
		} elseif ( 'start_date' == $name ) {
			if ( ! empty( $value ) ) {
				$value = vite_date( 'Y-m-d', strtotime( $value ) );
			}
			$this->coupon->set_date_created( $value );
		} elseif ( 'end_date' == $name ) {
			if ( ! empty( $value ) ) {
				$value = vite_date( 'Y-m-d', strtotime( $value ) );
			}
			$this->coupon->set_date_expires( $value );
		} elseif ( 'discount_type' == $name ) {
			$this->coupon->set_discount_type( $this->get_discount_type( $value ) );
		} elseif ( 'discount_amount' == $name ) {
			$this->coupon->set_amount( $value );
		} elseif ( 'offer_products' == $name ) {
			return $this->set_meta( 'offer_products', $value );
		} elseif ( 'outlets' == $name ) {
			$this->set_meta( '_vc_outlets', $value );
		} elseif ( 'is_all_outlet' == $name ) {
			$this->set_meta( '_vc_is_all_outlet', $value );
		} elseif ( 'percentage_upto' == $name ) {
			$this->set_meta( '_vc_percentage_upto', $value );
		} elseif ( 'coupon_usage_limit' == $name ) {
			$this->coupon->set_usage_limit( $value );
		} elseif ( 'user_usage_limit' == $name ) {
			$this->coupon->set_usage_limit_per_user( $value );
		} elseif ( 'no_expiry' == $name ) {
			$this->set_meta( '_vc_no_expiry', $value );
		} elseif ( 'category_id' == $name ) {
			$this->set_meta( '_vc_category_id', $value );
		} elseif ( 'apply_to' == $name ) {
			$this->set_meta( '_vc_apply_to', $value );
		} elseif ( 'is_scheduler_active' == $name ) {
			$this->set_meta( '_vc_is_scheduler_active', $value );
		} elseif ( 'scheduler_data' == $name ) {
			$this->set_meta( '_vc_scheduler_data', $value );
		} elseif ( 'minimum_spend' == $name ) {

			$this->coupon->set_minimum_amount( $value );
		} elseif ( 'maximum_spend' == $name ) {
			$this->coupon->set_maximum_amount( $value );
		} elseif ( 'is_indvidual' == $name ) {
			$this->coupon->set_individual_use( 'Y' == $value );
		} elseif ( 'is_exclude_sale' == $name ) {
			$this->coupon->set_exclude_sale_items( 'Y' == $value );
		} elseif ( 'is_free_shipping' == $name ) {
			$this->coupon->set_free_shipping( 'Y' == $value );
		} elseif ( 'products' == $name && ! empty( $value ) ) {
			$this->coupon->set_product_ids( $value );
		} elseif ( 'exclude_products' == $name && ! empty( $value ) ) {
			$this->coupon->set_excluded_product_ids( $value );
		} elseif ( 'categories' == $name && ! empty( $value ) ) {
			$this->coupon->set_product_categories( $value );
		} elseif ( 'exclude_categories' == $name && ! empty( $value ) ) {
			$this->coupon->set_excluded_product_categories( $value );
		} elseif ( 'allowed_emails' == $name && ! empty( $value ) ) {
			$this->coupon->set_email_restrictions( $value );
		} elseif ( 'rules' == $name ) {
			if ( is_array( $value ) ) {
				foreach ( $value as $key => $rule ) {
					if ( 'minimum_spend' == $key ) {
						$this->coupon->set_minimum_amount( $rule );
					} elseif ( 'maximum_spend' == $key ) {
						$this->coupon->set_maximum_amount( $rule );
					} elseif ( 'is_indvidual' == $key ) {
						$this->coupon->set_individual_use( 'Y' == $rule );
					} elseif ( 'is_exclude_sale' == $key ) {
						$this->coupon->set_exclude_sale_items( 'Y' == $rule );
					} elseif ( 'is_free_shipping' == $key ) {
						$this->coupon->set_free_shipping( 'Y' == $rule );
					} elseif ( 'products' == $key ) {
						if ( empty( $rule ) ) {
							$rule = array();
						}
						$this->coupon->set_product_ids( $rule );
					} elseif ( 'exclude_products' == $key ) {
						if ( empty( $rule ) ) {
							$rule = array();
						}
						$this->coupon->set_excluded_product_ids( $rule );
					} elseif ( 'categories' == $key ) {
						if ( empty( $rule ) ) {
							$rule = array();
						}
						$this->coupon->set_product_categories( $rule );
					} elseif ( 'exclude_categories' == $key ) {
						if ( empty( $rule ) ) {
							$rule = array();
						}
						$this->coupon->set_excluded_product_categories( $rule );
					} elseif ( 'allowed_emails' == $key ) {
						if ( empty( $rule ) ) {
							$rule = array();
						}
						$this->coupon->set_email_restrictions( $rule );
					}
				}
			}
		} else {
			do_action_ref_array( 'appsbd/vite-coupon/filter/vite-coupon-set', array( $name, $value, &$this ) );
		}
	}

	/**
	 * The   call is generated by appsbd
	 *
	 * @param string $name It is name param.
	 * @param array  $arguments It is arguments param.
	 *
	 * @return array|bool|int|mixed|string|void
	 */
	public function __call( string $name, array $arguments ) {
		$data = $this->{$name};
		return $data;
	}

	/**
	 * The get text by is generated by appsbd
	 *
	 * @param mixed $prop It is prop param.
	 * @param mixed $data It is data param.
	 *
	 * @return array|bool|float|int|mixed|string|void
	 */
	public function get_text_by( $prop, $data ) {
		if ( isset( $data[ $prop ] ) ) {
			return $data[ $prop ];
		} else {
			return $this->$prop;
		}
	}

	/**
	 * The set from array is generated by appsbd
	 *
	 * @param mixed $data It is data param.
	 */
	public function set_from_array( $data ) {
		$general_settings          = appsbd_get_value_from_array( 'general_settings', $data, array() );
		$usage_settings            = appsbd_get_value_from_array( 'usage_settings', $data, array() );
		$sch                       = appsbd_get_value_from_array( 'is_scheduler_active', $data, array() );
		$is_scheduler_active       = appsbd_get_value_from_array( 'status', $sch, 'N' );
		$scheduler_data            = appsbd_get_value_from_array( 'scheduler', $data, array() );
		$rules                     = appsbd_get_value_from_array( 'rules', $data, array() );
		$this->coupon_code         = $this->get_text_by( 'coupon_code', $general_settings );
		$this->start_date          = $this->get_text_by( 'start_date', $general_settings );
		$no_expiry = $this->get_text_by( 'no_expiry', $general_settings );
		$this->no_expiry           = $no_expiry;
		if ( $no_expiry == 'Y' ) {
			$this->end_date            = '';
		} else {
			$this->end_date            = $this->get_text_by( 'end_date', $general_settings );
		}
		$this->discount_type       = $this->get_text_by( 'discount_type', $general_settings );
		$this->category_id         = $this->get_text_by( 'category_id', $general_settings );
		$this->apply_to            = $this->get_text_by( 'apply_to', $general_settings );
		$this->discount_amount     = $this->get_text_by( 'discount_amount', $general_settings );
		$this->percentage_upto     = $this->get_text_by( 'percentage_upto', $general_settings );
		$this->is_all_outlet       = $this->get_text_by( 'is_all_outlet', $general_settings );
		$this->outlets             = 'Y' == $this->is_all_outlet ? array() : $this->get_text_by( 'outlets', $general_settings );
		$this->percentage_shipping = $this->get_text_by( 'percentage_shipping', $general_settings );
		$this->offer_products      = $this->get_text_by( 'offer_products', $general_settings );
		$this->coupon_usage_limit  = $this->get_text_by( 'coupon_usage_limit', $usage_settings );
		$this->user_usage_limit    = $this->get_text_by( 'user_usage_limit', $usage_settings );
		$this->is_scheduler_active = $is_scheduler_active;
		$this->scheduler_data      = $scheduler_data;
		$this->rules               = $rules;
	}
	/**
	 * The get property raw options is generated by appsbd
	 *
	 * @param \Appsbd\V1\Core\any $property Its string.
	 * @param false               $is_with_select Its bool.
	 *
	 * @return array|string[]
	 */
	public function get_property_raw_options( $property, $is_with_select = false ) {
		$return_obj = array();
		switch ( $property ) {
			case 'status':
				$return_obj = array(
					'A' => 'Active',
					'I' => 'Inactive',
				);
				break;
			case 'discount_type':
				$return_obj = array(
					'FA' => 'fixed_cart',
					'PA' => 'percent',
					'PU' => 'percent_upto',
					'FP' => 'fixed_product',
				);
				break;
			default:
		}
		if ( $is_with_select ) {
			return array_merge( array( '' => 'Select' ), $return_obj );
		}

		return $return_obj;
	}


	/**
	 * The get discount type is generated by appsbd
	 *
	 * @param null $val It is val param.
	 *
	 * @return mixed|null
	 */
	public function get_discount_type( $val = null ) {

		return $val;
	}
	/**
	 * The get discount type is generated by appsbd
	 *
	 * @return mixed|string
	 */
	public function get_discount_grid_type() {

		return $this->discount_type;
	}
	/**
	 * The get product ids is generated by appsbd
	 *
	 * @return array
	 */
	public function get_product_ids() {
		if ( ! empty( $this->get_coupon_rules() ) ) {
			return $this->get_coupon_rules()->products;
		}
		return array();
	}
	/**
	 * The get product ids is generated by appsbd
	 *
	 * @return array
	 */
	public function get_exclude_product_ids() {
		if ( ! empty( $this->get_coupon_rules() ) ) {
			return $this->get_coupon_rules()->exclude_products;
		}
		return array();
	}
	/**
	 * The get product ids is generated by appsbd
	 *
	 * @return array
	 */
	public function get_category_ids() {
		if ( ! empty( $this->get_coupon_rules() ) ) {
			return $this->get_coupon_rules()->categories;
		}
		return array();
	}
	/**
	 * The get product ids is generated by appsbd
	 *
	 * @return array
	 */
	public function get_exclude_category_ids() {
		if ( ! empty( $this->get_coupon_rules() ) ) {
			return $this->get_coupon_rules()->exclude_categories;
		}
		return array();
	}

	/**
	 * The get amount is generated by appsbd
	 *
	 * @param string $type Its a param.
	 */
	public function get_amount( $type = '' ) {
	}

	/**
	 * The DeleteById is generated by appsbd
	 *
	 * @param any $id Its integer.
	 *
	 * @return bool
	 */
	public static function delete_coupon_by_id( $id ) {
		$res = wp_delete_post( $id, true );
		if ( ! empty( $res->ID ) ) {
			return true;
		}
		return false;
	}

	/**
	 * The filter data is generated by appsbd
	 */
	public function filter_data() {
		if ( $this->is_set_prperty( 'rules' ) && ! is_string( $this->rules ) ) {
			$this->rules( serialize( $this->rules ) );
		}
		if ( $this->is_set_prperty( 'scheduler_data' ) && ! is_string( $this->scheduler_data ) ) {
			$this->scheduler_data( serialize( $this->scheduler_data ) );
		}
	}

	/**
	 * The load coupon data is generated by appsbd
	 *
	 * @param mixed $coupon_code It is coupon_code param.
	 */
	public static function get_wc_coupon_data_by_code( $coupon_code ) {
		return new \WC_Coupon( $coupon_code );
	}

	/**
	 * The load coupon by code is generated by appsbd
	 *
	 * @param mixed $code It is code param.
	 */
	public function load_coupon_by_code( $code ) {
		$this->coupon = new \WC_Coupon( $code );
	}
	/**
	 * The load coupon by id is generated by appsbd
	 *
	 * @param mixed $id It is id param.
	 */
	public function load_coupon_by_id( $id ) {
		$this->coupon = new \WC_Coupon( absint( $id ) );
	}

	/**
	 * The load coupon object is generated by appsbd
	 *
	 * @param \WC_Coupon $coupon It is coupon param.
	 */
	public function load_coupon_object( &$coupon ) {
		$this->coupon = $coupon;
	}

	/**
	 * The get wc couopon is generated by appsbd
	 *
	 * @return \WC_Coupon|null
	 */
	public function &get_wc_couopon() {
		return $this->coupon;
	}

	/**
	 * The is validated coupon usage limit is generated by appsbd
	 *
	 * @return bool
	 */
	public function has_coupon_usage_limit() {
		$used        = $this->coupon->get_usage_count();
		$usage_limit = $this->coupon->get_usage_limit();
		if ( ! empty( $usage_limit ) ) {
			if ( $usage_limit > $used ) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}


	/**
	 * The set from post is generated by appsbd
	 */
	public function set_from_post() {
		$data = AppInput::get_posted_data();
		if ( ! ( $this->coupon instanceof \WC_Coupon ) ) {
			$this->coupon = new \WC_Coupon();
		}
		$this->set_from_array( $data );
	}
	/**
	 * The save is generated by appsbd
	 *
	 * @return bool
	 */
	public function save() {
		try {
			$this->set_meta( '_is_vc', 'Y' );
			$this->coupon->set_status( 'draft' );
			$id = $this->coupon->save();
			foreach ( $this->meta_data as $pro => $data ) {
				update_post_meta( $this->id, $pro, $data );
			}
			if ( ! empty( $id ) ) {
				return true;
			} else {
				Coupon_Lite::add_error( 'Error:' . $this->coupon->get_error_message() );
			}
		} catch ( \Exception $ex ) {
			Coupon_Lite::add_error( $ex->getMessage() );
		}
		return false;
	}

	/**
	 * The change status is generated by appsbd
	 *
	 * @param mixed $id It is id param.
	 * @param mixed $status It is status param.
	 *
	 * @return bool
	 */
	public static function change_status( $id, $status ) {
		$cdata = array(
			'ID'          => $id,
			'post_status' => 'A' == $status ? 'publish' : 'draft',
		);

		$id = wp_update_post( $cdata );
		if ( is_wp_error( $id ) ) {
			Coupon_Lite::add_error( $id->get_error_message() );
			return false;
		} else {
			return true;
		}
	}

	/**
	 * The update coupon meta is generated by appsbd
	 *
	 * @return bool
	 */
	public function update_coupon_meta() {
		foreach ( $this->meta_data as $prop => $data ) {
			update_post_meta( $this->id, $prop, $data );
		}
		return true;
	}
	/**
	 * The update is generated by appsbd
	 *
	 * @return bool
	 */
	public function update() {
		try {
			if ( ! $this->coupon->get_id() ) {
				Coupon_Lite::add_error( 'No coupon found with this id' );
				return false;
			}
			if ( ! empty( $this->coupon->get_changes() ) ) {
				$changes = $this->coupon->get_changes();
				if ( isset( $changes['status'] ) ) {
					$cdata = array(
						'ID'          => $this->id,
						'post_status' => $changes['status'],
					);
					$id    = wp_update_post( $cdata );
					if ( is_wp_error( $id ) ) {
						Coupon_Lite::add_error( $id->get_error_message() );
					}
				}
				$this->coupon->save();
				foreach ( $this->meta_data as $pro => $data ) {
					update_post_meta( $this->id, $pro, $data );
				}
				return true;
			} else {
				Coupon_Lite::add_warning( 'No data to update' );
				return false;
			}
		} catch ( \Exception $ex ) {
			Coupon_Lite::add_error( 'Update Error Exc:' . $ex->getMessage() );
		}

		return false;
	}

	/**
	 * Check if vitepos is installed
	 *
	 * @return boolean
	 */
	public static function is_vitepos_installed() {
		return appsbd_is_activated_plugin( 'vitepos/vitepos.php' );
	}

	/**
	 * The get rules is generated by appsbd
	 *
	 * @return Coupon_Rules|null
	 */
	public function get_coupon_rules() {

		if ( is_null( $this->rules_object ) ) {
			if ( ! is_array( $this->rules ) || empty( $this->rules ) ) {
				$this->rules = array();
			}
			$this->rules_object = new Coupon_Rules();
			$this->rules_object->set_from_array( $this->rules );
		}
		return $this->rules_object;
	}

	/**
	 * The get coupon meta is generated by appsbd
	 *
	 * @return array
	 */
	public function get_coupon_meta() {
		$meta = array();
		if ( 'PA' == $this->discount_type && $this->percentage_upto > 0 ) {
			$meta['_vc_upto'] = $this->percentage_upto;
		}
		return $meta;
	}

	/**
	 * The is active is generated by appsbd
	 *
	 * @return bool
	 */
	public function is_active() {
		return 'A' == $this->status;
	}
	/**
	 * The get coupons is generated by appsbd
	 *
	 * @param mixed $src_props It is src_props param.
	 * @param mixed $sort_by It is sort_by param.
	 * @param mixed $page It is page param.
	 * @param mixed $limit It is limit param.
	 *
	 * @return \WP_Query
	 */
	public function get_coupons( $src_props = array(), $sort_by = array(), $page = 1, $limit = 20 ) {
		$filter_param = array(
			'post_type'      => 'shop_coupon',
			'fields'         => 'ids',
			'count_total'    => true,
			'posts_per_page' => $limit,
			'paged'          => $page,
		);
		foreach ( $src_props as $src_prop ) {
			if ( ! empty( $src_prop['prop'] ) && isset( $src_prop['val'] ) ) {
				if ( ! empty( $src_prop['val'] ) && is_string( $src_prop['val'] ) ) {
					$src_prop['val'] = trim( $src_prop['val'] );
				}
				if ( ! empty( $src_prop['prop'] ) && is_string( $src_prop['prop'] ) ) {
					$src_prop['prop'] = trim( $src_prop['prop'] );
				}
				if ( 'coupon_code' == $src_prop['prop'] ) {
					$filter_param['s'] = $src_prop['val'];
				} elseif ( 'status' == $src_prop['prop'] ) {
					$filter_param['post_status'] = $src_prop['val'];
				} elseif ( 'start_date' == $src_prop['prop'] ) {
					if ( 'eq' == $src_prop['opr'] ) {
						$start_date = $src_prop['val'] . ' 00:00:00';
						$end_date   = $src_prop['val'] . ' 23:59:59';
					} elseif ( 'dr' == $src_prop['opr'] || 'bt' == $src_prop['opr'] ) {
						$prop = (object) $src_prop['val'];
						if ( ! empty( $prop->start ) ) {
							if ( empty( $prop->end ) ) {
								$prop->end = $prop->start;
							}
							$start_date = $prop->start . ' 00:00:00';
							$end_date   = $prop->end . ' 23:59:59';
						} else {
							continue;
						}
					} else {
						continue;
					}
					if ( ! empty( $start_date ) && ! empty( $end_date ) ) {
						$filter_param['date_query'] = array(
							'after'     => $start_date,
							'before'    => $end_date,
							'inclusive' => true,
						);
					}
				} elseif ( 'end_date' == $src_prop['prop'] ) {
					if ( 'eq' == $src_prop['opr'] ) {
						$start_date = appsbd_get_wptime_to_gmtime( $src_prop['val'] . ' 00:00:00' );
						$end_date   = appsbd_get_wptime_to_gmtime( $src_prop['val'] . ' 23:59:59' );
					} elseif ( 'dr' == $src_prop['opr'] || 'bt' == $src_prop['opr'] ) {
						$prop = (object) $src_prop['val'];
						if ( ! empty( $prop->start ) ) {
							if ( empty( $prop->end ) ) {
								$prop->end = $prop->start;
							}
							$start_date = appsbd_get_wptime_to_gmtime( $prop->start . ' 00:00:00' );
							$end_date   = appsbd_get_wptime_to_gmtime( $prop->end . ' 23:59:59' );
						} else {
							continue;
						}
					} else {
						continue;
					}
					if ( ! empty( $start_date ) && ! empty( $end_date ) ) {
						$filter_param['meta_key']     = '_vc_category_id';
						$filter_param['meta_query'][] = array(
							'key'     => 'date_expires',
							'value'   => array( $start_date, $end_date ),
							'compare' => 'BETWEEN',
						);
					}
				} elseif ( 'category_id' == $src_prop['prop'] ) {
					$filter_param['meta_key']     = '_vc_category_id';
					$filter_param['meta_query'][] = array(
						'key'     => '_vc_category_id',
						'value'   => $src_prop['val'],
						'compare' => '=',
					);
				} elseif ( 'discount_type' == $src_prop['prop'] ) {
					$filter_param['meta_key']     = 'discount_type';
					$filter_param['meta_query'][] = array(
						'key'     => 'discount_type',
						'value'   => $src_prop['val'],
						'compare' => '=',
					);
				}
			}
		}
		$query = new \WP_Query( $filter_param );
		return $query;
	}

	/**
	 * The get discount types is generated by appsbd
	 *
	 * @return array
	 */
	public static function get_discount_types() {
		$discount_types     = wc_get_coupon_types();
		$res_discount_types = array();
		foreach ( $discount_types as $d_type => $d_title ) {
			$obj        = new \stdClass();
			$obj->title = $d_title;
			$obj->val   = $d_type;
			/**
			 * Its for check is there any change before process
			 *
			 * @since 1.0
			 */
			$obj->is_pro_required = apply_filters( 'appsbd/vite-coupon/filter/is-pro-discount-type', false, $d_type );
			$obj->amount_title    = Vite_Coupon_Plugin::get_module_instance()->__( 'Discount Amount' );
			$obj->fields          = array( 'amount' );
			$obj->cf_fields       = array();
			$obj->rules           = array();
			$obj->rules_msg       = '';
			$obj->rules_cf        = array();
			/**
			 * Its for check is there any change before process
			 *
			 * @since 1.0
			 */
			$obj                  = apply_filters( 'appsbd/vite-coupon/filter/discount-type', $obj, $d_type );
			$res_discount_types[] = $obj;
		}
		return $res_discount_types;
	}
}
