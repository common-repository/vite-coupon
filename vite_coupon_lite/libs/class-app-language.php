<?php
/**
 * Its used for Client Language
 *
 * @since: 21/09/2021
 * @author: Sarwar Hasan
 * @version 1.0.0
 * @package VitePos_Lite\Libs
 */

namespace Vite_Coupon_Lite\Libs;

if ( ! class_exists( __NAMESPACE__ . '\App_Language' ) ) {
	/**
	 * Class VitePOS_API_Base
	 *
	 * @package VitePos_Lite\Libs
	 */
	class App_Language {
		/**
		 * The get Admin Languages is generated by appsbd
		 *
		 * @param mixed $kernel_object Its the object of kernel.
		 *
		 * @return mixed
		 */
		public static function get_admin_languages( &$kernel_object ) {
			$language                  = array();
			$language['Coupons']            = $kernel_object->__( 'Coupons' );
			$language['Products']            = $kernel_object->__( 'Products' );
			$language['Search']            = $kernel_object->__( 'Search' );
			$language['Reset']            = $kernel_object->__( 'Reset' );
			$language['Add New Coupon']            = $kernel_object->__( 'Add New Coupon' );
			$language['No %{type} found']            = $kernel_object->__( 'No %{type} found' );
			$language['Coupon List Loading ...']            = $kernel_object->__( 'Coupon List Loading ...' );
			$language['Initial Data Is Loading ...']            = $kernel_object->__( 'Initial Data Is Loading ...' );
			$language['Coupon code']            = $kernel_object->__( 'Coupon code' );
			$language['Start date']            = $kernel_object->__( 'Start date' );
			$language['End date']            = $kernel_object->__( 'End date' );
			$language['Discount type']            = $kernel_object->__( 'Discount type' );
			$language['Apply To']            = $kernel_object->__( 'Apply To' );
			$language['Vitepos Outlets']            = $kernel_object->__( 'Vitepos Outlets' );
			$language['Action']            = $kernel_object->__( 'Action' );
			$language['%{ row } rows']            = $kernel_object->__( '%{ row } rows' );
			$language[' Viewing %{ startRecord } to %{ endRecord } of %{ totalRecord } records']            = $kernel_object->__( 'Viewing %{ startRecord } to %{ endRecord } of %{ totalRecord } records' );
			$language['Version']            = $kernel_object->__( 'Version' );

			$language['Settings']            = $kernel_object->__( 'Settings' );
			$language['Categories']            = $kernel_object->__( 'Categories' );

			$language['Add Coupon']            = $kernel_object->__( 'Add Coupon' );
			$language['User Usage Limit']            = $kernel_object->__( 'User Usage Limit' );
			$language['Coupon Usage Limit']            = $kernel_object->__( 'Coupon Usage Limit' );
			$language['Check this box if the coupon should not apply to items on sale. Per-item coupons will only work if the item is not on sale. Per-cart coupons will only work if there are items in the cart that are not on sale.']            = $kernel_object->__( 'Check this box if the coupon should not apply to items on sale. Per-item coupons will only work if the item is not on sale. Per-cart coupons will only work if there are items in the cart that are not on sale.' );
			$language['Check this box if the coupon cannot be used in conjunction with other coupons.']            = $kernel_object->__( 'Check this box if the coupon cannot be used in conjunction with other coupons.' );
			$language['Scheduler']            = $kernel_object->__( 'Scheduler' );

			$language['Coupon Settings']            = $kernel_object->__( 'Coupon Settings' );
			$language['Allowed emails']            = $kernel_object->__( 'Allowed emails' );
			$language['Allowed billing emails for orders. Separate with commas. Use asterisk (*) for partial matches, like (*@gmail.com) for all Gmail addresses.']            = $kernel_object->__( 'Allowed billing emails for orders. Separate with commas. Use asterisk (*) for partial matches, like (*@gmail.com) for all Gmail addresses.' );
			$language['Coupon Category']            = $kernel_object->__( 'Coupon Category' );

			$language['Start Date']            = $kernel_object->__( 'Start Date' );

			$language['Online Sale']            = $kernel_object->__( 'Online Sale' );
			$language['Vitepos']                    = $kernel_object->__( 'Vitepos' );
			$language['Both']                   = $kernel_object->__( 'Both' );
			$language['Usage']            = $kernel_object->__( 'Usage' );
			$language['Conditions']            = $kernel_object->__( 'Conditions' );
			$language['No End date']            = $kernel_object->__( 'No End date' );
			$language['Minimum spend']            = $kernel_object->__( 'Minimum spend' );
			$language['Maximum spend']            = $kernel_object->__( 'Maximum spend' );
			$language['Exclude products']            = $kernel_object->__( 'Exclude products' );
			$language['Product categories']            = $kernel_object->__( 'Product categories' );
			$language['Exclude categories']            = $kernel_object->__( 'Exclude categories' );
			$language['%{fld_name} is required']            = $kernel_object->__( '%{fld_name} is required' );
			$language['Category']            = $kernel_object->__( 'Category' );
			$language['End Date']            = $kernel_object->__( 'End Date' );
			$language['Discount Type']            = $kernel_object->__( 'Discount Type' );
			$language['Status']            = $kernel_object->__( 'Status' );
			$language['Vouchers']            = $kernel_object->__( 'Vouchers' );
			$language['All Coupons']            = $kernel_object->__( 'All Coupons' );
			$language['Coupon Code']            = $kernel_object->__( 'Coupon Code' );
			$language['New']            = $kernel_object->__( 'New' );
			$language['Choose Date']            = $kernel_object->__( 'Choose Date' );
			$language['Upto']            = $kernel_object->__( 'Upto' );
			$language['Percentage(%)']            = $kernel_object->__( 'Percentage(%)' );
			$language['Add Coupon Category']            = $kernel_object->__( 'Add Coupon Category' );
			$language['Please Install Vitepos']            = $kernel_object->__( 'Please Install Vitepos' );
			$language['Check this box if its allow free shipping.']            = $kernel_object->__( 'Check this box if its allow free shipping.' );

			$language['Always use regular price']            = $kernel_object->__( 'Always use regular price' );
			$language['If the sale price is available, use it by default.']            = $kernel_object->__( 'If the sale price is available, use it by default.' );
			$language['Always utilize the regular price, but exclusively for products subject to discounts through BOGO and Add Products coupons.']            = $kernel_object->__( 'Always utilize the regular price, but exclusively for products subject to discounts through BOGO and Add Products coupons.' );
			$language['Always utilize the regular price for all types of coupons.']            = $kernel_object->__( 'Always utilize the regular price for all types of coupons.' );
			$language['Automatically remove coupons for failed/cancelled orders']            = $kernel_object->__( 'Automatically remove coupons for failed/cancelled orders' );
			$language['If checked, the system will automatically remove coupons from orders that have failed or been cancelled.']            = $kernel_object->__( 'If checked, the system will automatically remove coupons from orders that have failed or been cancelled.' );
			$language['Scheduler Settings']           = $kernel_object->__( 'Scheduler Settings' );
			$language['Scheduler Start Time Error Message']           = $kernel_object->__( 'Scheduler Start Time Error Message' );
			$language['This Message will appear if the applied coupon has not yet become active.']           = $kernel_object->__( 'This Message will appear if the applied coupon has not yet become active.' );
			$language['Scheduler End Time Error Message']           = $kernel_object->__( 'Scheduler End Time Error Message' );
			$language['This message will show up when attempting to apply a coupon that has already passed its expiration date.']           = $kernel_object->__( 'This message will show up when attempting to apply a coupon that has already passed its expiration date.' );
			$language['Role Restriction']           = $kernel_object->__( 'Role Restriction' );
			$language['Role error message']           = $kernel_object->__( 'Role error message' );
			$language['This message will be shown when the coupon is deemed invalid for the specified role.']           = $kernel_object->__( 'This message will be shown when the coupon is deemed invalid for the specified role.' );
			$language['You are not allowed to use this coupon']           = $kernel_object->__( 'You are not allowed to use this coupon' );
			$language['User Usage Error Message']           = $kernel_object->__( 'User Usage Error Message' );
			$language['This message will be displayed when the user usage limit has been surpassed.']           = $kernel_object->__( 'This message will be displayed when the user usage limit has been surpassed.' );

			$language['Hide the coupon fields from the cart and checkout pages on the client side.']           = $kernel_object->__( 'Hide the coupon fields from the cart and checkout pages on the client side.' );
			$language['Hide coupon fields']           = $kernel_object->__( 'Hide coupon fields' );
			$language['Property']           = $kernel_object->__( 'Property' );
			$language['Value']           = $kernel_object->__( 'Value' );
			$language['Choose property']           = $kernel_object->__( 'Choose property' );
			$language['Enter value']           = $kernel_object->__( 'Enter value' );
			$language['Unlock Pro']           = $kernel_object->__( 'Unlock Pro' );
			$language['Pro Version']           = $kernel_object->__( 'Pro Version' );
			$language['You will get premium support']           = $kernel_object->__( 'You will get premium support' );
			$language['Multiple Rules Conditions']           = $kernel_object->__( 'Multiple Rules Conditions' );
			$language['Time Scheduler']           = $kernel_object->__( 'Time Scheduler' );
			$language['You will get these features in pro version']           = $kernel_object->__( 'You will get these features in pro version' );
			$language['To unlock these features, you need']           = $kernel_object->__( 'To unlock these features, you need' );

			$language['URL prefix']           = $kernel_object->__( 'URL prefix' );
			$language['The prefix to be utilized preceding the coupon code.']           = $kernel_object->__( 'The prefix to be utilized preceding the coupon code.' );
			$language['Redirect URL after applying coupon']           = $kernel_object->__( 'Redirect URL after applying coupon' );
			$language['Upon attempting to apply the coupon, users will be redirected to the provided URL.']           = $kernel_object->__( 'Upon attempting to apply the coupon, users will be redirected to the provided URL.' );
			$language['Redirect URL after applied invalid coupon']           = $kernel_object->__( 'Redirect URL after applied invalid coupon' );
			$language['This will redirect the user to the provided URL if an invalid coupon has been applied.']           = $kernel_object->__( 'This will redirect the user to the provided URL if an invalid coupon has been applied.' );
			$language['Success message']           = $kernel_object->__( 'Success message' );
			$language['Users will be redirected to the provided URL in the event of applying valid coupon.']           = $kernel_object->__( 'Users will be redirected to the provided URL in the event of applying valid coupon.' );
			$language['Disable message']           = $kernel_object->__( 'Disable message' );
			$language['This message will appear when the functionality for coupon URLs is disabled.']           = $kernel_object->__( 'This message will appear when the functionality for coupon URLs is disabled.' );

			$language['General']           = $kernel_object->__( 'General' );
			$language['Description']           = $kernel_object->__( 'Description' );
			$language['Title']           = $kernel_object->__( 'Title' );
			$language['Submit']           = $kernel_object->__( 'Submit' );
			$language['Discount Amount']           = $kernel_object->__( 'Discount Amount' );
			$language['Pro version']           = $kernel_object->__( 'Pro version' );
			$language['pro version']           = $kernel_object->__( 'pro version' );
			$language['You will get these features in pro version.']           = $kernel_object->__( 'You will get these features in pro version.' );
			$language['DayTime Scheduler.']           = $kernel_object->__( 'DayTime Scheduler.' );
			$language['Url Coupon.']           = $kernel_object->__( 'Url Coupon.' );
			$language['Smart Coupon']           = $kernel_object->__( 'Smart Coupon' );
			$language['Buy One Get One (BOGO) Product.']           = $kernel_object->__( 'Buy One Get One (BOGO) Product.' );
			$language['Premium support 24/7.']           = $kernel_object->__( 'Premium support 24/7.' );
			$language['Cancel']           = $kernel_object->__( 'Cancel' );
			$language['Details']           = $kernel_object->__( 'Details' );
			$language['Percentage discount']           = $kernel_object->__( 'Percentage discount' );
			$language['Fixed cart discount']           = $kernel_object->__( 'Fixed cart discount' );
			$language['Fixed product discount']           = $kernel_object->__( 'Fixed product discount' );
			$language['Next']           = $kernel_object->__( 'Next' );
			$language['Back']           = $kernel_object->__( 'Back' );
			$language['Sunday']           = $kernel_object->__( 'Sunday' );
			$language['Tuesday']           = $kernel_object->__( 'Tuesday' );
			$language['Thursday']           = $kernel_object->__( 'Thursday' );
			$language['Saturday']           = $kernel_object->__( 'Saturday' );
			$language['Monday']           = $kernel_object->__( 'Monday' );
			$language['Wednesday']           = $kernel_object->__( 'Wednesday' );
			$language['Friday']           = $kernel_object->__( 'Friday' );
			$language['All Day']           = $kernel_object->__( 'All Day' );
			$language['Loading Coupon details']           = $kernel_object->__( 'Loading Coupon details' );
			$language['Edit']           = $kernel_object->__( 'Edit' );
			$language['Delete']           = $kernel_object->__( 'Delete' );

			$language['Published']           = $kernel_object->__( 'Published' );
			$language['Yes']           = $kernel_object->__( 'Yes' );
			$language['No']           = $kernel_object->__( 'No' );
			$language['Category List Loading ...']           = $kernel_object->__( 'Category List Loading ...' );
			$language['Loading Category Details']           = $kernel_object->__( 'Loading Category Details' );
			$language['Updating Category']           = $kernel_object->__( 'Updating Category' );
			$language['Edit Coupon Category']           = $kernel_object->__( 'Edit Coupon Category' );

			$language['Update Coupon']           = $kernel_object->__( 'Update Coupon' );
			$language['Updating Coupon...']           = $kernel_object->__( 'Updating Coupon...' );
			$language['Close']           = $kernel_object->__( 'Close' );
			$language['Message Settings']           = $kernel_object->__( 'Message Settings' );
			$language['URL Settings']           = $kernel_object->__( 'URL Settings' );
			$language['URL Coupons']           = $kernel_object->__( 'URL Coupons' );
			$language['Coupon Usage Error Message']           = $kernel_object->__( 'Coupon Usage Error Message' );
			$language['This message will be shown when the coupon usage limit has been exceeded.']           = $kernel_object->__( 'This message will be shown when the coupon usage limit has been exceeded.' );
			$language['You need Pro version,to use product voucher.']           = $kernel_object->__( 'You need Pro version,to use product voucher.' );
			$language['Draft']           = $kernel_object->__( 'Draft' );
			$language['Ok']           = $kernel_object->__( 'Ok' );
			$language['Finish']           = $kernel_object->__( 'Finish' );
			$language['Enter Category']           = $kernel_object->__( 'Enter Category' );
			$language['Enter Description']           = $kernel_object->__( 'Enter Description' );
			$language['Are you sure to delete this Coupon Category?']           = $kernel_object->__( 'Are you sure to delete this Coupon Category?' );
			$language['Smart Coupon.']           = $kernel_object->__( 'Smart Coupon.' );
			$language['Are you sure to delete this coupon?']           = $kernel_object->__( 'Are you sure to delete this coupon?' );
			$language['Pro']           = $kernel_object->__( 'Pro' );
			$language['categories']           = $kernel_object->__( 'categories' );
			$language['Not Enable']           = $kernel_object->__( 'Not Enable' );
			$language['Save Changes']           = $kernel_object->__( 'Save Changes' );
			$language['Lifespan']           = $kernel_object->__( 'Lifespan' );
			$language['Install Vitepos']           = $kernel_object->__( 'Install Vitepos' );
			$language['Saving Coupon...']           = $kernel_object->__( 'Saving Coupon...' );
			$language['Coupon Added']           = $kernel_object->__( 'Coupon Added' );
			$language['Coupon Updated']           = $kernel_object->__( 'Coupon Updated' );
			$language['Inactive coupon url']           = $kernel_object->__( 'Inactive coupon url' );
			$language['Discount Type']           = $kernel_object->__( 'Discount Type' );
			$language['0 value will set no limit/infinite for this coupon']           = $kernel_object->__( '0 value will set no limit/infinite for this coupon' );
			$language['Buy Two Get One (BTGO).']           = $kernel_object->__( 'Buy Two Get One (BTGO).' );

			$language['Buy One Get Two (BOGT).']           = $kernel_object->__( 'Buy One Get Two (BOGT).' );
			$language['Url Coupons.']           = $kernel_object->__( 'Url Coupons.' );
			$language['Apply Conditions.']           = $kernel_object->__( 'Apply Conditions.' );
			$language['Percentage / Fixed / UP-TO.']           = $kernel_object->__( 'Percentage / Fixed / UP-TO.' );

			$language['Select']           = $kernel_object->__( 'Select' );
			$language['Pro']           = $kernel_object->__( 'Pro' );
			$language['Active']           = $kernel_object->__( 'Active' );
			$language['Inactive']           = $kernel_object->__( 'Inactive' );
			$language['Initial data is loading...']           = $kernel_object->__( 'Initial data is loading...' );
			$language['Usage/Limit']           = $kernel_object->__( 'Usage/Limit' );
			$language['Select Outlets']           = $kernel_object->__( 'Select Outlets' );
			$language['Are you sure to change the status?']           = $kernel_object->__( 'Are you sure to change the status?' );
			$language['Coupon']           = $kernel_object->__( 'Coupon' );

			$language['Adding Category']           = $kernel_object->__( 'Adding Category' );
			$language['Add']           = $kernel_object->__( 'Add' );
			$language['Sub-Directory URL']           = $kernel_object->__( 'Sub-Directory URL' );
			$language['Unknown']           = $kernel_object->__( 'Unknown' );
			$language['Easy Setup']           = $kernel_object->__( 'Easy Setup' );
			$language['Easy to setup with your woocommerce. Add your products and sell easily.']           = $kernel_object->__( 'Easy to setup with your woocommerce. Add your products and sell easily.' );
			$language['Safe and Secure System']           = $kernel_object->__( 'Safe and Secure System' );
			$language['It’s a secure, high-end, user-friendly platform with no bloatware. We promise that your data is safe and that you’re in control.']           = $kernel_object->__( 'It’s a secure, high-end, user-friendly platform with no bloatware. We promise that your data is safe and that you’re in control.' );
			$language['All in One App']           = $kernel_object->__( 'All in One App' );
			$language['A great software that lets you manage your whole store and track inventory in the shortest time.']           = $kernel_object->__( 'A great software that lets you manage your whole store and track inventory in the shortest time.' );
			$language['Premium Support']           = $kernel_object->__( 'Premium Support' );
			$language['We are always available 24/7 to offer support for your business needs. Appsbd has more than 5 years of experience.']           = $kernel_object->__( 'We are always available 24/7 to offer support for your business needs. Appsbd has more than 5 years of experience.' );
			$language['Install Now']           = $kernel_object->__( 'Install Now' );
			$language['Use your online store as local store with Vitepos. A Powerful Point of Sale (POS) for Restaurant Point of sale (POS) plugin for Wordpress & Woocommerce.']           = $kernel_object->__( 'Use your online store as local store with Vitepos. A Powerful Point of Sale (POS) for Restaurant Point of sale (POS) plugin for Wordpress & Woocommerce.' );

			self::get_both_panel( $language, $kernel_object );

			return $language;
		}

		/**
		 * The get pos languages is generated by appsbd
		 *
		 * @param mixed $kernel_object Its the object of kernel.
		 *
		 * @return array
		 */
		public static function get_client_languages( &$kernel_object ) {
			$language                  = array();

			self::get_both_panel( $language, $kernel_object );

			return $language;
		}

		/**
		 * The get client extra is generated by appsbd
		 *
		 * @param any $language Its language array.
		 * @param any $kernel_object Its kernel Object.
		 */
		public static function get_both_panel( &$language, &$kernel_object ) {
		}
	}
}
