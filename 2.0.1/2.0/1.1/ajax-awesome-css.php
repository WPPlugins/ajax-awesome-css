<?php
/**
 * Plugin Name: Ajax Awesome CSS
 * Plugin URI: https://github.com/harry005/ajax-awesome-css
 * Description: Add custom CSS/JSS to your website without modifying the CSS/JS files of the theme or plugin with the help of ajax functionality.
 * Version: 1.0.1
 * Author: Harpreet Singh
 * Author URI: https://github.com/harry005/
 * License: GNU General Public License v3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
*/
if( ! defined( 'ABSPATH' ) ) {
	die();
}

if (!class_exists( 'HSAwsomeCustomCss' ) ) :
final class HSAwsomeCustomCss{
	protected static $_instance = null; 
	  /**
			Getting the instance of class
     */
	 public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	static function hsawesome_install() {
		global $hsawesome_db_version;
		$hsawesome_db_version='1.0';
		global $wpdb;
		$table_name = $wpdb->prefix . 'awesomecustom';
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			awesomecss longtext NOT NULL,
			awesomejs longtext NOT NULL,
			UNIQUE KEY id (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		add_option( 'hsawesome_db_version', $hsawesome_db_version ); 
	}
	
	function hsawesome_install_data() {
	global $wpdb;
	
		$table_name = $wpdb->prefix . 'awesomecustom';
		$custom_query = 'SELECT * FROM '.$table_name.' where id =1';
		$checkdata = $wpdb->get_results($custom_query);
		$checkdata;
		 if($checkdata == NULL){
			 $wpdb->insert( 
			$table_name, 
				array( 
					'awesomecss' => '',
					'awesomejs' => '',
					'id' => 1
				) 
			);
	}
}
	
	
	public function __construct(){
			 if ( is_admin() ) {
					include_once( 'includes/admin/admin-main.php' );
			}
			else{
					include_once('includes/frontend/frontend.php');
			}
			register_activation_hook( __FILE__, array( $this , 'hsawesome_install') );
			register_activation_hook( __FILE__, array( $this , 'hsawesome_install_data') );
	}
}
endif;
$HSAwsomeCustomCss = HSAwsomeCustomCss::instance();
