<?php
/**
 * Coupon Category model
 *
 * @package Vite_Coupon_Lite\Models\Database
 */

namespace Vite_Coupon_Lite\Models\Database;

use Vite_Coupon_Lite\Core\Vite_Coupon_Lite_Model;



/**
 * Class Mapbd_Coupon_Category
 *
 * @package Coupon_Plugin\Models\Database
 */
class Mapbd_Coupon_Category extends Vite_Coupon_Lite_Model {

	/**
	 * Its property id
	 *
	 * @var int
	 */
	public $id;
	/**
	 * Its property title
	 *
	 * @var string
	 */
	public $title;
	/**
	 * Its property slug
	 *
	 * @var string
	 */
	public $slug;
	/**
	 * Its property description
	 *
	 * @var string
	 */
	public $description;
	/**
	 * Its property  status
	 *
	 * @var boolean
	 */
	public $status;


	/**
	 * Coupon constructor.
	 */
	public function __construct() {

		parent::__construct();
		$this->set_validation();
		$this->table_name     = 'apbd_cp_categories';
		$this->primary_key    = 'id';
		$this->unique_key     = array();
		$this->multi_key      = array();
		$this->auto_inc_field = array( 'id' );
		$this->app_base_name  = 'coupon-plugin';
	}



	/**
	 * The set validation is generated by appsbd.
	 */
	public function set_validation() {

		$this->validations = array(
			'id'          => array(
				'Text' => 'Id',
				'Rule' => 'max_length[11]|integer',
			),
			'title'       => array(
				'Text' => 'Title',
				'Rule' => 'max_length[100]',
			),
			'slug'        => array(
				'Text' => 'End Date',
				'Rule' => 'max_length[100]',
			),
			'description' => array(
				'Text' => 'Description',
				'Rule' => 'max_length[255]',
			),
			'status'      => array(
				'Text' => 'Status',
				'Rule' => 'max_length[1]',
			),

		);
	}

	/**
	 * The generate slug is generated by appsbd
	 *
	 * @param string $title It is title param.
	 *
	 * @return string
	 */
	public function generate_slug( $title = '' ) {
		$slug = strtolower( $title );
		$slug = str_replace( ' ', '-', $slug );
		$slug = preg_replace( '/[^\w\-]/', '', $slug );
		$slug = preg_replace( '/\-+/', '-', $slug );
		$slug = trim( $slug, '-' );
		return $slug;
	}

	/**
	 * The Create db table is generated by appsbd
	 */
	public static function create_db_table() {

		$this_obj = new static();
		$table    = $this_obj->db->prefix . $this_obj->table_name;
		if ( $this_obj->db->get_var( "show tables like '{$table}'" ) != $table ) {
			$sql = "CREATE TABLE `{$table}` (
					      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                          `title` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
                          `slug` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
                           `description` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
                           `status` char(1) CHARACTER SET utf8 DEFAULT 'A' COMMENT 'bool(A=Active,I=Inactive)',
                            PRIMARY KEY (`id`)) ";
					   require_once ABSPATH . 'wp-admin/includes/upgrade.php';
					  dbDelta( $sql );
		}
	}

	/**
	 * The DeleteById is generated by appsbd
	 *
	 * @param any $id Its integer.
	 *
	 * @return bool
	 */
	public static function delete_by_id( $id ) {

		return self::delete_by_key_value( 'id', $id );
	}

	/**
	 * The get categories is generated by appsbd
	 *
	 * @return array|Mapbd_Coupon_Category[]|false
	 */
	public static function get_coupon_categories() {
		$mainobj = new Mapbd_Coupon_Category();
		$mainobj->status( 'A' );
		$records = $mainobj->count_aLL();
		$result  = array();
		if ( $records > 0 ) {
			$result = $mainobj->select_all_grid_data( '', '', '', '', '', );
		}
		return $result;
	}

	/**
	 * The filter data is generated by appsbd
	 */
	public function filter_data() {
		if ( $this->is_set_prperty( 'title' ) ) {
			$this->slug( $this->generate_slug( $this->title ) );
		}
	}
	/**
	 * The save is generated by appsbd
	 *
	 * @return bool
	 */
	public function save() {
		$this->filter_data();
		return parent::save();
	}
}
