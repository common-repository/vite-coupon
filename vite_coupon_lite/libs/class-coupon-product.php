<?php
/**
 * Its Coupon product model
 *
 * @since: 21/09/2021
 * @author: Sarwar Hasan
 * @version 1.0.0
 * @package Vite_Coupon_Lite\Libs
 */

namespace Vite_Coupon_Lite\Libs;

use Automattic\WooCommerce\Utilities\NumberUtil;
use VitePos\Modules\POS_Settings;


/**
 * Class POS Product
 *
 * @package VitePos\Libs
 */
class Coupon_Product {

	/**
	 * Its property id.
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Its property barcode.
	 *
	 * @var int
	 */
	public $barcode;
	/**
	 * Its property name.
	 *
	 * @var string
	 */
	public $name;
	/**
	 * Its property is new.
	 *
	 * @var boolean
	 */
	public $is_new;
	/**
	 * Its property image.
	 *
	 * @var string
	 */
	public $image;

	/**
	 * Its property image.
	 *
	 * @var array
	 */
	public $image_gallery;

	/**
	 * Its property sale_price.
	 *
	 * @var float
	 */
	public $sale_price;
	/**
	 * Its property regular_price.
	 *
	 * @var float
	 */
	public $regular_price;
	/**
	 * Its property price_html.
	 *
	 * @var string
	 */
	public $price_html;
	/**
	 * Its property price.
	 *
	 * @var float
	 */
	public $price;
	/**
	 * Its property cross_sale.
	 *
	 * @var string
	 */
	public $cross_sale;
	/**
	 * Its property up_sale.
	 *
	 * @var string
	 */
	public $up_sale;
	/**
	 * Its property attributes.
	 *
	 * @var string
	 */
	public $attributes;
	/**
	 * Its property variations.
	 *
	 * @var string
	 */
	public $variations;
	/**
	 * Its property group_product.
	 *
	 * @var string
	 */
	public $group_product;
	/**
	 * Its property parent_product.
	 *
	 * @var string
	 */
	public $parent_product;
	/**
	 * Its property status.
	 *
	 * @var string
	 */
	public $status;
	/**
	 * Its property manage_stock.
	 *
	 * @var string
	 */
	public $manage_stock;
	/**
	 * Its property stock_quantity.
	 *
	 * @var int
	 */
	public $stock_quantity;
	/**
	 * Its property stock_status.
	 *
	 * @var bool
	 */
	public $stock_status;
	/**
	 * Its property low_stock_amount.
	 *
	 * @var int
	 */
	public $low_stock_amount;
	/**
	 * Its property purchasable.
	 *
	 * @var string
	 */
	public $purchasable;
	/**
	 * Its property average_rating.
	 *
	 * @var int
	 */
	public $average_rating;
	/**
	 * Its property rating_count.
	 *
	 * @var int
	 */
	public $rating_count;
	/**
	 * Its property slug.
	 *
	 * @var string
	 */
	public $slug;
	/**
	 * Its property sku.
	 *
	 * @var string
	 */
	public $sku;
	/**
	 * Its property description.
	 *
	 * @var string
	 */
	public $description;
	/**
	 * Its property purchase_cost.
	 *
	 * @var int
	 */
	public $purchase_cost;
	/**
	 * Its property taxable.
	 *
	 * @var bool
	 */

	public $is_favorite = 'N';
	/**
	 * Its property taxable.
	 *
	 * @var bool
	 */

	public $taxable = false;
	/**
	 * Its property tax_status
	 *
	 * @var bool
	 */
	public $tax_status;
	/**
	 * Its property tax_class
	 *
	 * @var string
	 */
	public $tax_class;



	/**
	 * Its property type.
	 *
	 * @var string
	 */
	public $type;
	/**
	 * Its property weight.
	 *
	 * @var float
	 */
	public $weight;
	/**
	 * Its property height.
	 *
	 * @var float
	 */
	public $height;
	/**
	 * Its property width.
	 *
	 * @var float
	 */
	public $width;
	/**
	 * Its property length.
	 *
	 * @var float
	 */
	public $length;
	/**
	 * Its addons.
	 *
	 * @var array
	 */
	public $addons = array();
	/**
	 * Its property _is_inclusive
	 *
	 * @var null
	 */
	protected static $_is_inclusive = null;


	/**
	 * The get product from woo products with variations is generated by appsbd
	 *
	 * @param int   $page Its Page id.
	 * @param int   $limit Its limit.
	 * @param array $src_props Its other search property.
	 * @param array $orders Its orders property.
	 *
	 * @return \stdClass
	 */
	public static function get_product_from_woo_products_with_variations( $page = 1, $limit = 10, $src_props = array(), $orders = array() ) {
		$post_type   = array( 'product', 'product_variation' );
		$post_status = array( 'publish', 'private' );

		$product_query         = Coupon_Product_Query::get_products( $page, $limit, $src_props, $orders, $post_type, $post_status );
		$product_obj           = new \stdClass();
		$product_obj->products = array();
		$product_obj->records  = $product_query->found_posts;
		foreach ( $product_query->posts as $product_id ) {
			$product = wc_get_product( $product_id );
			if ( ! empty( $product ) ) {
				if ( $product->get_type() !== 'grouped' ) {
					$pos_product             = self::get_product_variation_data( $product );
					$product_obj->products[] = $pos_product;
				} else {
					--$product_obj->records;
				}
			}
		}
		return $product_obj;
	}

	/**
	 * The get product from woo products with variations is generated by appsbd
	 *
	 * @param int   $page Its Page id.
	 * @param int   $limit Its limit.
	 * @param array $src_props Its other search property.
	 * @param array $orders Its orders property.
	 *
	 * @return \stdClass
	 */
	public static function get_product_from_woo_products_without_variables( $page = 1, $limit = 10, $src_props = array(), $orders = array() ) {

		$post_type             = array( 'product', 'product_variation' );
		$post_status           = array( 'publish', 'private' );
		$product_query         = Coupon_Product_Query::get_products( $page, $limit, $src_props, $orders, $post_type, $post_status, true );
		$product_obj           = new \stdClass();
		$product_obj->products = array();
		$product_obj->records  = $product_query->found_posts;
		foreach ( $product_query->posts as $product_id ) {
			$product = wc_get_product( $product_id );
			if ( ! empty( $product ) ) {
				if ( $product->get_type() !== 'grouped' ) {
					$pos_product             = self::get_product_variation_data( $product );
					$product_obj->products[] = $pos_product;
				} else {
					--$product_obj->records;
				}
			}
		}
		return $product_obj;
	}
	/**
	 * The set barcode of product is generated by appsbd
	 *
	 * @param \WC_Product $product Its wc product.
	 * @param null        $parent_product Its parent product if exists.
	 *
	 * @return int|string
	 */
	public static function get_barcode_of_product( $product, &$parent_product = null ) {
		if ( ! ( $product instanceof \WC_Product ) ) {
			return '';
		}
		$barcode_type = POS_Settings::get_module_option( 'barcode_field' );
		if ( 'CUS' == $barcode_type ) {
			return $product->get_meta( '_vt_barcode' );
		} elseif ( 'SKU' == $barcode_type ) {
			return $product->get_sku();
		} else {
			return $product->get_id();
		}
	}
	/**
	 * The get categories name is generated by appsbd
	 *
	 * @param \WP_Term[]|int[]|string[]|string|\WP_Error $category Its category.
	 * @param string                                     $seperator Its separator.
	 */
	public static function get_categories_name( $category, $seperator = ' » ' ) {
		if ( $category instanceof \WP_Term ) {
			return $category->name;
		} elseif ( is_string( $category ) ) {
			return $category;
		} else {
			return '';
		}
	}

	/**
	 * The get categories is generated by appsbd
	 *
	 * @param false $is_parent Is parent category.
	 * @param bool  $hide_empty its hide emplt param.
	 *
	 * @return array
	 */
	public static function get_categories( $is_parent = true, $hide_empty = false ) {
		$orderby  = 'name';
		$order    = 'asc';
		$cat_args = array(
			'taxonomy'     => 'product_cat',
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => $hide_empty,
		);
		if ( ! $is_parent ) {
			$cat_args['parent'] = 0;
		}
		$product_categories = get_terms( $cat_args );
		$final_response     = array();
		if ( ! empty( $product_categories ) ) {
			foreach ( $product_categories as $key => $category ) {
				$el_category     = new Product_Category();
				$el_category->id = $category->term_id;
				if ( $is_parent ) {
					$el_category->name = self::get_categories_name( $category );
				} else {
					$el_category->name = $category->name;
				}
				$el_category->slug             = $category->slug;
				$el_category->image            = wp_get_attachment_url( $category->term_id );
				$el_category->parent_id        = $category->parent;
				$el_category->product_count    = $category->count;
				$el_category->taxonomy         = $category->taxonomy;
				$el_category->term_taxonomy_id = $category->term_taxonomy_id;
				if ( ! $is_parent ) {
					$el_category->child = array();
					$el_category->child = self::get_sub_categories( $category->term_id );
				}

				$final_response[] = $el_category;
				unset( $product_categories[ $key ] );
			}
		}
		return $final_response;
	}
	/**
	 * The get sub categories is generated by appsbd
	 *
	 * @param null $parent Its parent.
	 *
	 * @return array
	 */
	public static function get_sub_categories( $parent = null ) {
		$category  = array();
		$child_arg = array(
			'taxonomy'     => 'product_cat',
			'hide_empty' => false,
			'parent'     => $parent,
		);
		$child_cat = get_terms( $child_arg );
		foreach ( $child_cat as $key => $item ) {
			if ( $item->parent == $parent ) {
				if ( ! isset( $item->child ) ) {
					$item->child = array();
				}
				$item->is_selected = '';
				$item->child       = self::get_sub_categories( $item->term_id );
				$item->id          = $item->term_id;
				unset( $item->term_id );
				$category[] = $item;
			}
		}
		return $category;
	}
	/**
	 * The is inclusive is generated by appsbd
	 *
	 * @return null
	 */
	public static function is_inclusive() {
		if ( is_null( static::$_is_inclusive ) ) {
			/**
			 * Its for check is the tax option is inclusive or exclusive.
			 *
			 * @since 3.0.4
			 */
			static::$_is_inclusive = apply_filters( 'woocommerce_prices_include_tax', get_option( 'woocommerce_prices_include_tax' ) === 'yes' );
		}
		return static::$_is_inclusive;
	}

	/**
	 * The get product inclusive price is generated by appsbd
	 *
	 * @param mixed $price Its the actual price.
	 * @param mixed $product Its the product object.
	 *
	 * @return float|string
	 */
	public static function get_product_inclusive_price( $price, &$product ) {
		if ( static::is_inclusive() ) {
			$price = wc_get_price_including_tax(
				$product,
				array(
					'qty'   => 1,
					'price' => $price,
				)
			);
		}
		return $price;
	}
	/**
	 * The get product data is generated by appsbd
	 *
	 * @param any   $product Its string.
	 * @param false $add_ctg_id Its bool.
	 * @param false $is_no_variable Its bool.
	 *
	 * @return POS_Product
	 */
	public static function get_product_data( $product, $add_ctg_id = false, $is_no_variable = false ) {
		if ( ! ( $product instanceof \WC_Product ) ) {
			return;
		}

		$pos_product       = new self();
		$pos_product->id   = $product->get_id();
		$pos_product->type = $product->get_type();
		if ( 'variation' == $pos_product->type ) {
			$pos_product->name = $product->get_name();
		} else {
			$pos_product->name = $product->get_title();
		}
		$pos_product->image         = self::get_wc_product_image( $product, 'woocommerce_thumbnail' );
		$pos_product->image_gallery = array();
		$pos_product->outlet_id     = 0;

		/**
		 * Its for product feature update
		 *
		 * @since 1.0
		 */
		$outlet_info = apply_filters( 'vitepos/filter/current-outlet', null );
		if ( ! empty( $outlet_info->id ) ) {
			$pos_product->outlet_id = absint( $outlet_info->id );
		}
		$attachment_ids = $product->get_gallery_image_ids();
		foreach ( $attachment_ids as $attachment_id ) {
			$image                        = new \stdClass();
			$image->id                    = $attachment_id;
			$image->url                   = wp_get_attachment_url( $attachment_id );
			$pos_product->image_gallery[] = $image;
		}
		$pos_product->price_html = $product->get_price_html();
		$pos_product->status     = $product->get_status();

		$pos_product->price = static::get_product_inclusive_price( $product->get_price(), $product );

		$pos_product->description   = $product->get_description();
		$pos_product->regular_price = static::get_product_inclusive_price( $product->get_regular_price(), $product );
		if ( true ) {
			$pos_product->stock_quantity = $product->get_stock_quantity() ? $product->get_stock_quantity() : 0;
		} else {
			/**
			 * This is a outlet stock hook
			 *
			 * @since 1.0.0
			 */
			$pos_product->stock_quantity = apply_filters( 'vitepos/filter/outlet-stock', 0, $product, $outlet_info->id );
		}
		$pos_product->sale_price = $product->get_sale_price() ? $product->get_sale_price() : 0;
		$pos_product->cross_sale = array_map( 'absint', $product->get_cross_sell_ids() );
		$pos_product->up_sale    = array_map( 'absint', $product->get_upsell_ids() );
		$categories              = wc_get_object_terms( $product->get_id(), 'product_cat' );
		foreach ( $categories as $category ) {
			$pos_product->category_ids[] = $category->term_id;
			if ( $add_ctg_id ) {
				$pos_product->categories[] = $category->term_id;
			} else {
				$pos_product->categories[] = $category->name;
			}
		}
		$pos_product->low_stock_amount = $product->get_low_stock_amount();
		$pos_product->manage_stock     = $product->get_manage_stock();
		$pos_product->stock_status     = $product->get_stock_status();
		$pos_product->sku              = $product->get_sku();
		$pos_product->taxable          = $product->is_taxable() ? 'Y' : 'N';
		$pos_product->tax_status       = $product->get_tax_status();
		$pos_product->tax_class        = $product->get_tax_class();
		$pos_product->height           = $product->get_height();
		$pos_product->width            = $product->get_width();
		$pos_product->length           = $product->get_length();
		$pos_product->weight           = $product->get_weight();
		$pos_product->is_new           = false;

		$duration    = 0;
		$create_date = $product->get_date_created();
		if ( ! empty( $create_date ) ) {
			$todate = strtotime( "+ {$duration} DAYS", $create_date->getTimestamp() );
			if ( $todate >= time() ) {
				$pos_product->is_new = true;
			}
		}
		if ( static::is_inclusive() ) {
			$pos_product->tax_rate = 0;
		} else {
			$pos_product->tax_rate = NumberUtil::round(
				( floatval( wc_get_price_including_tax( $product ) ) - floatval( $pos_product->price ) ),
				wc_get_price_decimals()
			);
		}
		if ( ! $is_no_variable ) {
			if ( $product->is_type( 'variable' ) && $product->has_child() ) {
				$pos_product->variations = self::get_variation_data( $product );

			} else {

				$pos_product->variations = array();
			}
		}

		$pos_product->attributes = self::get_attributes( $product );
		$pos_product->barcode    = (string) self::get_barcode_of_product( $product, $parent_product );

		if ( $parent_product instanceof \WC_Product ) {
			$pos_product->parent_product = self::get_product_data( $parent_product );
		}

		if ( $product->is_type( 'grouped' ) && $product->has_child() ) {
			$pos_product->group_product = self::get_grouped_products_data( $product );
		}
		$pos_product->rating_count   = $product->get_rating_count();
		$pos_product->average_rating = wc_format_decimal( $product->get_average_rating(), 2 );
		$pos_product->slug           = $product->get_slug();
		$pos_product->sku            = $product->get_sku();
		$pos_product->purchasable    = 'Y';
		$pos_product->purchase_cost  = $product->meta_exists( '_vt_purchase_cost' ) ? $product->get_meta( '_vt_purchase_cost' ) : 0;

		if ( $product->meta_exists( '_vt_is_favorite' ) ) {
			$pos_product->is_favorite = $product->get_meta( '_vt_is_favorite' );
		} else {
			$pos_product->is_favorite = 'N';
		}
		/**
		 * Its for check is there any change before process
		 *
		 * @since 2.0
		 */
		$pos_product->addons = apply_filters( 'vitepos/filter/product-details', array(), $pos_product, $product );
		/**
		 * Its for getting 3rd parties addons
		 *
		 * @since 3.0.0
		 */
		$get_addons = apply_filters( 'vitepos/3rd-party/filter/get-addons', array(), $product );
		if ( ! empty( $get_addons ) ) {
			$pos_product->addons = array_merge( $pos_product->addons, $get_addons );
		}
		return $pos_product;
	}

	/**
	 * The get product variation data is generated by appsbd
	 *
	 * @param mixed $product Its wc product.
	 *
	 * @return \stdClass|void
	 */
	public static function get_product_variation_data( $product ) {
		if ( ! ( $product instanceof \WC_Product ) ) {
			return;
		}
		$pos_product                = new \stdClass();
		$pos_product->id            = $product->get_id();
		$pos_product->name          = $product->get_name();
		$pos_product->price         = empty( $product->get_price() ) ? 0 : $product->get_price();
		$pos_product->regular_price = empty( $product->get_regular_price() ) ? 0 : $product->get_regular_price();
		$pos_product->sale_price    = $product->get_sale_price() ? $product->get_sale_price() : 0;
		$pos_product->slug          = $product->get_slug();
		$pos_product->sku           = $product->get_sku();
		return $pos_product;
	}

	/**
	 * The get offer product data is generated by appsbd
	 *
	 * @param Vite_Coupon $coupon It is coupon param.
	 * @param mixed       $offer_products It is offer_products param.
	 *
	 * @return array|void
	 */
	public static function get_offer_product_data( $coupon, $offer_products ) {
		$products = array();
		foreach ( $offer_products as $item ) {
			$product = wc_get_product( absint( $item ) );
			if ( ! ( $product instanceof \WC_Product ) ) {
				return;
			}
			$offer_amount = $coupon->offer_amount;
			$offer_type   = $coupon->offer_type;
			$pos_product          = new \stdClass();
			$pos_product->id      = $product->get_id();
			/**
			 * Its for check is there any change before process
			 *
			 * @since 1.0
			 */
			$pos_product->barcode = apply_filters( 'vitepos/3rd-party/filter/product-barcode', '', $product );
			$pos_product->name    = $product->get_name();
			$pos_product->amount  = ! empty( $offer_amount ) ? $offer_amount : 50;
			$pos_product->type    = ! empty( $offer_type ) ? $offer_type : 'P';
			/**
			 * Its for get price type settings
			 *
			 * @since 1.0
			 */
			$pos_product->price_type = apply_filters( 'appsbd/vite-coupon/filter/discount_price_type', $pos_product->price_type );
			$products[]              = $pos_product;
		}
		return $products;
	}
	/**
	 * The get offer product data is generated by appsbd
	 *
	 * @param mixed  $offer_products It is offer_products param.
	 * @param string $price_type Its price type.
	 * @param int    $offer_amount Its offer amount.
	 * @param string $offer_type Its offer type.
	 *
	 * @return array|void
	 */
	public static function get_offer_products( $offer_products, $price_type = 'S', $offer_amount = 100, $offer_type = 'P' ) {
		$products = array();
		foreach ( $offer_products as $item ) {
			$product = wc_get_product( absint( $item ) );
			if ( ! ( $product instanceof \WC_Product ) ) {
				return;
			}
			$pro_data                  = self::get_offer_product_price( $product, $price_type, $offer_type, $offer_amount );
			$pos_product               = new \stdClass();
			$pos_product->product_id   = $product->get_id();
			$pos_product->price        = $pro_data->price;
			$pos_product->price_type   = $price_type;
			$pos_product->offer_amount = $pro_data->offer_amount;
			$products[]                = $pos_product;
		}
		return $products;
	}
	/**
	 * The get offer product price is generated by appsbd
	 *
	 * @param \WC_Product $product It is product param.
	 * @param mixed       $price_type It is price_type param.
	 * @param String      $offer_type Its offer type.
	 * @param float       $offer_amount Its offer amount.
	 *
	 * @return \stdClass
	 */
	public static function get_offer_product_price( $product, $price_type, $offer_type, $offer_amount ) {
		$price = 0.0;
		$data  = new \stdClass();
		if ( empty( $product->get_sale_price() ) ) {
			$price_type = 'R';
		}
		$price = appsbd_wc_amount( 'R' == $price_type ? $product->get_regular_price() : $product->get_sale_price() );
		if ( 'S' == $offer_type ) {
			if ( $price > $offer_amount ) {
				$data->offer_amount = $price - $offer_amount;
			}
			$data->price = $offer_amount;

		} elseif ( 'F' == $offer_type ) {
			$data->price        = $price - $offer_amount;
			$data->offer_amount = $offer_amount;
		} else {
			$offer       = appsbd_wc_amount( $price * ( $offer_amount / 100.00 ) );
			$data->price = $price - $offer;
			if ( $price >= $offer ) {
				if ( ( $data->price + $offer ) > $price ) {
					$offer += ( $price - ( $data->price + $offer ) );
				} elseif ( ( $data->price + $offer ) < $price ) {
					$data->price += ( $price - ( $data->price + $offer ) );
				}
				$data->offer_amount = $offer;
			}
		}
			return $data;
	}
	/**
	 * Get grouped products data
	 *
	 * @param WC_Product $product Its string.
	 *
	 * @return array
	 * @since  2.5.0
	 */
	private static function get_grouped_products_data( $product ) {
		$products = array();

		foreach ( $product->get_children() as $child_id ) {
			$_product = wc_get_product( $child_id );

			if ( ! $_product || ! $_product->exists() ) {
				continue;
			}

			$products[] = self::get_product_data( $_product );

		}

		return $products;
	}

	/**
	 * The get wc product image is generated by appsbd
	 *
	 * @param any    $product Its string.
	 * @param string $size Its string.
	 *
	 * @return false|string
	 */
	public static function get_wc_product_image( $product, $size = 'woocommerce_thumbnail' ) {
		$image = '';
		if ( $product->get_image_id() ) {
			$image = wp_get_attachment_image_url( $product->get_image_id(), $size );
		} elseif ( $product->get_parent_id() ) {
			$parent_product = wc_get_product( $product->get_parent_id() );
			if ( $parent_product ) {
				$image = wp_get_attachment_image_url( $parent_product->get_image_id(), $size );
			}
		} else {
			$image = wc_placeholder_img_src( $size );

		}
		return $image;
	}


	/**
	 * The get variation data is generated by appsbd
	 *
	 * @param any $product Its string.
	 *
	 * @return array
	 */
	private static function get_variation_data( $product ) {
		$variations = array();

		foreach ( $product->get_children() as $child_id ) {
			$variation = wc_get_product( $child_id );

			if ( ! $variation || ! $variation->exists() ) {
				continue;
			}
			$variation_obj                = new Product_Variant();
			$variation_obj->id            = $variation->get_id();
			$variation_obj->name          = $variation->get_name();
			$variation_obj->slug          = $variation->get_slug();
			$variation_obj->sku           = $variation->get_sku();
			$variation_obj->product_id    = $product->get_id();
			$variation_obj->sale_price    = $variation->get_sale_price() ? $variation->get_sale_price() : 0;
			$variation_obj->regular_price = $variation->get_regular_price() ? $variation->get_regular_price() : 0;
			$variation_obj->price         = $variation->get_price() ? $variation->get_price() : 0;
			$variation_obj->outlet_id     = 0;
			/**
			 * Its for product feature update
			 *
			 * @since 1.0
			 */
			$outletinfo = apply_filters( 'vitepos/filter/current-outlet', null );
			if ( ! empty( $outletinfo->id ) ) {
				$variation_obj->outlet_id = absint( $outletinfo->id );
			}
			$variation_obj->price_html   = wc_price( $variation_obj->price );
			$variation_obj->manage_stock = $variation->managing_stock();

			if ( true ) {
				$variation_obj->stock_quantity = $variation->get_stock_quantity() ? $variation->get_stock_quantity() : 0;
			} else {
				/**
				 * This is a outlet stock hook
				 *
				 * @since 1.0.0
				 */
				$variation_obj->stock_quantity = apply_filters( 'vitepos/filter/outlet-stock', 0, $variation, $outletinfo->id );
			}

			$variation_obj->in_stock            = $variation->is_in_stock();
			$variation_obj->low_stock_amount    = $variation->get_low_stock_amount();
			$variation_obj->taxable             = $variation->is_taxable() ? 'Y' : 'N';
			$variation_obj->tax_status          = $variation->get_tax_status();
			$variation_obj->tax_class           = $variation->get_tax_class();
			$variation_obj->height              = $variation->get_height();
			$variation_obj->weight              = $variation->get_weight();
			$variation_obj->length              = $variation->get_length();
			$variation_obj->width               = $variation->get_width();
			$variation_obj->tax_rate            = NumberUtil::round( ( doubleval( wc_get_price_including_tax( $variation ) ) - doubleval( $variation_obj->price ) ), wc_get_price_decimals() );
			$variation_obj->on_sale             = $variation->is_on_sale() ? 'Y' : 'N';
			$variation_obj->image               = self::get_wc_product_image( $variation, 'woocommerce_thumbnail' );
			$variation_obj->attributes          = self::get_attributes( $variation );
			$variation_obj->barcode             = (string) self::get_barcode_of_product( $variation );
			$variation_obj->purchase_cost       = $variation->meta_exists( '_vt_purchase_cost' ) ? $variation->get_meta( '_vt_purchase_cost' ) : '0.0';
			$variation_obj->is_parent_dimension = $variation->get_meta( 'is_parent_dimension' );
			if ( $variation_obj->is_parent_dimension ) {
				$variation_obj->is_parent_dimension = true;
			} else {
				$variation_obj->is_parent_dimension = false;
				$variation_obj->width               = $variation->get_width();
				$variation_obj->height              = $variation->get_height();
				$variation_obj->weight              = $variation->get_weight();
				$variation_obj->length              = $variation->get_length();
			}
			$variations[] = $variation_obj;
		}

		return $variations;
	}

	/**
	 * Get the attributes for a product or product variation
	 *
	 * @param \WC_Product|\WC_Product_Variation $product Its string.
	 * @return array
	 * @since 2.1
	 */
	private static function get_attributes( $product ) {
		$attributes = array();

		if ( $product->is_type( 'variation' ) ) {

			foreach ( $product->get_variation_attributes() as $attribute_name => $attribute ) {

				$attributes[] = array(
					'name'   => wc_attribute_label( str_replace( 'attribute_', '', $attribute_name ), $product ),
					'slug'   => str_replace( 'attribute_', '', wc_attribute_taxonomy_slug( $attribute_name ) ),
					'option' => $attribute,
				);
			}
		} else {

			foreach ( $product->get_attributes() as $attribute ) {
				$attributes[] = array(
					'id'        => $attribute['id'],
					'name'      => wc_attribute_label( $attribute['name'], $product ),

					'slug'      => wc_sanitize_taxonomy_name( $attribute['name'] ),

					'visible'   => (bool) $attribute['is_visible'],
					'variation' => (bool) $attribute['is_variation'],
					'options'   => self::get_attribute_options( $product->get_id(), $attribute ),
				);
			}
		}

		return $attributes;
	}

	/**
	 * Get attribute options.
	 *
	 * @param int   $product_id Its integer.
	 * @param array $attribute Its array.
	 * @return array
	 */
	protected static function get_attribute_options( $product_id, $attribute ) {
		$options = array();
		if ( isset( $attribute['is_taxonomy'] ) && $attribute['is_taxonomy'] ) {
			$found_options = wc_get_product_terms( $product_id, $attribute['name'] );
			foreach ( $found_options as $option ) {
				$attr       = new \stdClass();
				$attr->slug = $option->slug;
				$attr->name = $option->name;
				$options[]  = $attr;
			}
			return $options;
		} elseif ( isset( $attribute['value'] ) ) {
			$found_options = array_map( 'trim', explode( '|', $attribute['value'] ) );
			foreach ( $found_options as $option ) {
				$attr       = new \stdClass();
				$attr->slug = $option;
				$attr->name = $option;
				$options[]  = $attr;
			}
			return $options;
		}

		return array();
	}

	/**
	 * Parse an RFC3339 datetime into a MySQl datetime
	 *
	 * Invalid dates default to unix epoch
	 *
	 * @param string $datetime RFC3339 datetime.
	 * @return string MySQl datetime (YYYY-MM-DD HH:MM:SS).
	 * @since 2.1
	 */
	public static function parse_datetime( $datetime ) {

		if ( strpos( $datetime, '.' ) !== false ) {
			$datetime = preg_replace( '/\.\d+/', '', $datetime );
		}

		$datetime = preg_replace( '/[+-]\d+:+\d+$/', '+00:00', $datetime );

		try {

			$datetime = new DateTime( $datetime, new DateTimeZone( 'UTC' ) );

		} catch ( Exception $e ) {

			$datetime = new DateTime( '@0' );

		}

		return $datetime->format( 'Y-m-d H:i:s' );
	}

	/**
	 * Get attribute options.
	 *
	 * @param int $product_id Its integer.
	 *
	 * @return bool
	 */
	public static function delete_product( $product_id ) {
		$product              = wc_get_product( $product_id );
		$is_deleted_variation = true;
		if ( ! empty( $product ) ) {
			if ( $product->is_type( 'variable' ) ) {
				foreach ( $product->get_children() as $child_id ) {
					if ( ! self::delete_variation_product( $child_id ) ) {
						$is_deleted_variation = false;
					}
				}
			}
			if ( $is_deleted_variation ) {
				return $product->delete();
			}
		}
		return false;
	}
	/**
	 * The delete variation Product is generated by appsbd
	 *
	 * @param int $child_id Its integer.
	 */
	public static function delete_variation_product( $child_id ) {
		$child = wc_get_product( $child_id );
		if ( $child ) {
			return $child->delete();
		}
	}
}
