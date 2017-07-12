<?php
// Prevent direct file access
if( ! defined( 'ABSPATH' ) ) {
	die();
}
class HSAWSadminMain{
	private static $instance;
	private $file = ''; 
	public static function instance(){
		 if ( ! isset( self::$instance ) ) {
             self::$instance = new self;
		}
			return self::$instance;		
	}
	
	public function __construct(){
		add_action('admin_menu', array( $this , 'create_admin_menu'));
		add_action('admin_enqueue_scripts',array($this,'myCustomScripts'));
		add_action( 'wp_ajax_myawesomecallback', array($this,'myawesomecallback') );
		add_action( 'wp_ajax_nopriv_myawesomecallback',  array($this,'myawesomecallback') );
		add_action( 'wp_ajax_myawesomecallbackjs', array($this,'myawesomecallbackjs') );
		add_action( 'wp_ajax_nopriv_myawesomecallbackjs',  array($this,'myawesomecallbackjs') );
		
	}
	
	public function create_admin_menu(){
				add_menu_page('Ajax Awesome CSS','Ajax Awesome CSS','manage_options','hsacc', array($this,'addMenus'), plugin_dir_url( __FILE__ ). 'images/icon.png',67);
				add_submenu_page('hsacc','Add Ajax CSS','Add Ajax CSS','manage_options','hsaddacc', array($this,'addoptionspage'));
				add_submenu_page('hsacc','Add Ajax JS','Add Ajax JS','manage_options','hsaddaccjs', array($this,'addoptionspagejs'));
	}

	public function myCustomScripts(){
			wp_localize_script( 'awesome', 'awesome_ajax', array('ajax_url' => admin_url( 'admin-ajax.php' ) ));
		    wp_enqueue_script( 'my_awesome_script',plugin_dir_url(__FILE__).'js/awesome.js');
		    wp_enqueue_script( 'awesome_codemirror',plugin_dir_url(__FILE__).'codemirror/lib/codemirror.js');
		    wp_enqueue_script( 'awesome_codemirrorcssjs',plugin_dir_url(__FILE__).'codemirror/mode/css/css.js');
		    wp_enqueue_script( 'codemirrocsshintjs',plugin_dir_url(__FILE__).'codemirror/addon/hint/css-hint.js');
		    wp_enqueue_script( 'codemirroshowhintjs',plugin_dir_url(__FILE__).'codemirror/addon/hint/show-hint.js');
			wp_register_style( 'admincss',plugin_dir_url(__FILE__).'css/styles.css');
			wp_enqueue_style( 'admincss' );
			wp_register_style( 'awesome_codemirrorcss',plugin_dir_url(__FILE__).'codemirror/lib/codemirror.css' );
			wp_enqueue_style( 'awesome_codemirrorcss' );
			wp_register_style( 'codemirroshowhintcss',plugin_dir_url(__FILE__).'codemirror/addon/hint/show-hint.css' );
			wp_enqueue_style( 'codemirroshowhintcss' );	
	
	}
	public function addMenus(){?>
		<div class="wrap" id='hsajaxwrap'>
			<h1>Welcome to Ajax Awesome CSS/JS</h1>
				<div class='hscontent'>Ajax Awesome CSS/JS plugin is very easy and simple to use with powerful features. User can add their own custom css/js without even changing the core files of themes or plugins. So they will not have 
				to worry about messing with the core files of theme or plugin. <br><br>
				
				In this plugin, we have used the ajax functionality for saving the css/js to admin panel. So this plugin will work faster than the any other plugin without even reloading the page. So we have
				build to plugin to overcome the reloading issue.<br><br>
				
				This plugin also provides the powerful features of CODEMIRROR. We have integrated the full feldge library of codemirror into our plugin. So while editing css, if user types the wrong property of css , then it will 
				show the wrong css property in red color. We have also provided the Autocomplete features for css. While adding new css , it will show the autocomplete options for the css if you pres "ctrl + space".<br><br>
				
				We will keep updating the features of this plugin. So please stay in touch.<br><br>
				
				<b>If you see any issue or bug , before giving us negative reviews. Please dont hesitate to ask us for the support.<br><br>
				
				THANK YOU FOR CHOSING US !!!!!!!!</b>
				</div>
				<div class='hsrightcontent'>
				
				<div>
		</div> <!-- wrap ends here-->
	<?php
		
	}
	public function myawesomecallback(){
		global $wpdb;
		$csscontent = stripslashes_deep($_REQUEST['getCss']);
		 $table_name = $wpdb->prefix . 'awesomecustom';
		$custom_query = 'SELECT awesomecss FROM '.$table_name.' where id =1';
		$checkdata = $wpdb->get_results($custom_query);
		$checkdata;
		 if($checkdata != NULL){
			$result = $wpdb->update( 
			$table_name, 
				array( 
					'awesomecss' => $csscontent,
				) ,
				array('id' => 1)
			);
			
		}
		else{
			$result = $wpdb->insert( 
			$table_name, 
				array( 
					'awesomecss' => $csscontent,
					'id' => 1
				) 
			);
			
		} 
		 echo $getcontent = $csscontent;
		die();
	}

	public function myawesomecallbackjs(){
		global $wpdb;
		 $jscontent = stripslashes_deep($_REQUEST['getJs']);
		;$table_name = $wpdb->prefix . 'awesomecustom';
		$custom_query = 'SELECT awesomejs FROM '.$table_name.' where id = 1';
		$checkdata = $wpdb->get_results($custom_query);
		$checkdata;
		 if($checkdata != NULL){
			$result = $wpdb->update( 
			$table_name, 
				array( 
					'awesomejs' => $jscontent,
				) ,
				array('id' => 1)
			);
			
		}
		else{
			$result = $wpdb->insert( 
			$table_name, 
				array( 
					'awesomejs' => $jscontent,
					'id' => 1
				) 
			);
			
		} 
		echo $getcontent = $jscontent;
		die();
	}
	public function addoptionspage(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'awesomecustom';
		$getcontent = $wpdb->get_results( "SELECT awesomecss FROM $table_name ");
		$storecss =  $getcontent[0]->awesomecss;
		?><div class="wrap">
			<h1>Add Awesome Ajax Css</h1>
					<textarea cols="100" rows="30" id="awesome-css-area" style='visibility:hidden' ><?php if($storecss) echo $storecss; else echo 'Enter Custom CSS Here !!!!!';?></textarea>
					<div id='hssavefile'>Add CSS</div>
		</div> <!-- wrap ends here-->
		<script>
			var editor2 = CodeMirror.fromTextArea(document.getElementById("awesome-css-area"), {
					   lineNumbers: true,
						lineWrapping: true,
						mode: "css",
						extraKeys: {"Ctrl-Space": "autocomplete"}
					  });
		</script>
		<?php
		}
		
		public function addoptionspagejs(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'awesomecustom';
		$getcontent = $wpdb->get_results( "SELECT awesomejs FROM $table_name ");
		$storejs = $getcontent[0]->awesomejs;
		?><div class="wrap" id='wrapjs'>
			<h1>Add Awesome Custom JS</h1>
					<textarea cols="100" rows="30" id="awesome-js-area" style='visibility:hidden'><?php if($storejs) echo $storejs ;else echo 'Enter Custom JS Here !!!!!';?></textarea>
					<div id='hssavejs'>Add JS</div>
		</div> <!-- wrap ends here-->
		<script>
			var editorjs = CodeMirror.fromTextArea(document.getElementById("awesome-js-area"), {
			   lineNumbers: true,
			   lineWrapping: true,
			  });
		</script>
		<?php
		}
}
$HSAWSadminMain = HSAWSadminMain::instance();