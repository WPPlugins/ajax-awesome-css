<?php
// Prevent direct file access
if( ! defined( 'ABSPATH' ) ) {
	die();
}
class HSAWSfrontend{
	private static $instance;
	
	public static function instance(){
		 if ( ! isset( self::$instance ) ) {
             self::$instance = new self;
		}
			return self::$instance;		
	}
	public function __construct(){
		
		add_action('wp_head', array($this,'register_frontend_Css'));
		add_action('wp_head', array($this,'register_frontend_Js'));
	}
	public function register_frontend_Css(){
		global $wpdb;
		global $insertcss;
		$table_name = $wpdb->prefix . 'awesomecustom';
		$getcontent = $wpdb->get_results( "SELECT awesomecss FROM $table_name ");
		echo $insertcss .= '<style type="text/css">'.$getcontent[0]->awesomecss .'</style>';
	}
	public function register_frontend_Js(){
		global $wpdb;
		global $insertjs;
		$table_name = $wpdb->prefix . 'awesomecustom';
		$getcontent = $wpdb->get_results( "SELECT awesomejs FROM $table_name ");
		echo $insertjs .= '<script type="text/javascript">'.stripslashes_deep($getcontent[0]->awesomejs) .'</script>';
	}
}
return $HSAWSfrontend = HSAWSfrontend::instance();