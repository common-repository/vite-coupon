<?php
/**
 * Plugin Name: Vite Coupon
 * Plugin URI: https://appsbd.com
 * Description: it's a coupon plugin for WooCommerce and Vitepos.
 * Version: 1.0.2
 * Author: appsbd
 * Author URI: http://www.appsbd.com
 * Text Domain: vite-coupon
 * Tested up to: 6.6
 * wc require:3.2.0
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package Coupon_Lite
 */

require_once ABSPATH . 'wp-admin/includes/plugin.php';
require_once 'vendor/autoload.php';

use Vite_Coupon_Lite\Core\Vite_Coupon_Lite;

if ( true === \Vite_Coupon_Lite\Libs\Vite_Coupon_Loader::is_ready_to_load( __FILE__ ) ) {



	$o_coupon = new Vite_Coupon_Lite( __FILE__ );
	$o_coupon->start_plugin();
}
