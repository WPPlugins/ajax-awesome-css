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
				add_menu_page('Ajax Custom CSS','Ajax Custom CSS','manage_options','hsacc', array($this,'addMenus'), plugin_dir_url( __FILE__ ). 'images/icon.png',67);
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
		wp_enqueue_script( 'closebrackets',plugin_dir_url(__FILE__).'codemirror/addon/edit/closebrackets.js');
		wp_enqueue_script( 'awesome_javascript', plugin_dir_url(__FILE__).'codemirror/mode/javascript/javascript.js');
		wp_enqueue_script( 'hsaacjshints', plugin_dir_url(__FILE__).'codemirror/addon/hint/javascript-hint.js');
		wp_enqueue_script( 'hsaaclintjs', plugin_dir_url(__FILE__).'codemirror/addon/lint/lint.js');
		wp_enqueue_script( 'hsaacmatchbrackets',plugin_dir_url(__FILE__).'codemirror/addon/edit/matchbrackets.js');
		wp_enqueue_script( 'hsaacjavascriptlint', plugin_dir_url(__FILE__).'codemirror/addon/lint/javascript-lint.js');
		wp_enqueue_script( 'hsaacplaceholder', plugin_dir_url(__FILE__).'codemirror/addon/display/placeholder.js');
		wp_enqueue_script( 'hsaacactiveline', plugin_dir_url(__FILE__).'codemirror/addon/selection/active-line.js');
		wp_enqueue_script( 'hsaacjshint', plugin_dir_url(__FILE__).'codemirror/addon/jshint/jshint.js');
		wp_enqueue_script( 'hsaacjsonlintjs', plugin_dir_url(__FILE__).'codemirror/addon/jshint/jsonlint.js');
		wp_register_style( 'admincss',plugin_dir_url(__FILE__).'css/styles.css');
		wp_enqueue_style( 'admincss' );
		wp_register_style( 'awesome_codemirrorcss',plugin_dir_url(__FILE__).'codemirror/lib/codemirror.css' );
		wp_enqueue_style( 'awesome_codemirrorcss' );
		wp_register_style( 'codemirroshowhintcss',plugin_dir_url(__FILE__).'codemirror/addon/hint/show-hint.css' );
		wp_enqueue_style( 'codemirroshowhintcss' );
		wp_register_style( 'lintcss', plugin_dir_url(__FILE__).'codemirror/addon/lint/lint.css');
		wp_enqueue_style( 'lintcss' );	
	
	}
	public function addMenus(){?>
		<div class="wrap" id='hsajaxwrap'>
			<h1>Welcome to Ajax Custom CSS/JS</h1>
				<div class='hscontent'>Ajax Custom CSS/JS plugin is very easy and simple to use with powerful features. User can add their own custom css/js without even changing the core files of themes or plugins. So they will not have 
				to worry about messing with the core files of theme or plugin. <br><br>
				
				In this plugin, we have used the ajax functionality for saving the css/js to admin panel. So this plugin will work faster than the any other plugin without even reloading the page. So we have
				build to plugin to overcome the reloading issue.<br><br>
				
				This plugin also provides the powerful features of CODEMIRROR. We have integrated the full feldge library of codemirror into our plugin. So while editing css, if user types the wrong property of css , then it will 
				show the wrong css property in red color. We have also provided the Autocomplete features for css. While adding new css , it will show the autocomplete options when you will start typing".<br><br>
				
				We will keep updating the features of this plugin. So please stay in touch.<br><br>
				
				<b>If you see any issue or bug , before giving us negative reviews. Please dont hesitate to ask us for the support.<br><br>
				
				THANK YOU FOR CHOSING US !!!!!!!!</b>
				</div>
				<div class='hsrightcontent'>
				<div class='hspaypalcontent'>
				<span class='hsinnertitle'>Please support us if you have liked our plugin.</span><br/>
				<b style='margin-bottom:10px;'>PAY WITH PAYPAL</b>
				<p style='margin-bottom:-5px;'></p>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target='_blank'>
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="er.harpreet.harry@gmail.com">
					<input type="hidden" name="item_number" value="1">
					<input type="hidden" name="item_name" value="Wordpress Plugin Support">
					<span class='hsdollar'>$ <input type="text" name="amount" value="1"></span>
					<input type="hidden" name="no_shipping" value="0">
					<input type="hidden" name="no_note" value="1">
					<input type="hidden" name="currency_code" value="USD"><br>
					<input type="hidden" name="return" value="http://www.paypal.com">
					<input type="image" src="<?php echo  plugin_dir_url( __FILE__ ). 'images/support-us.png' ;?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
				</form>
				<br/>
				</div>
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
			<h1>Add Custom Css</h1>
					<textarea cols="100" rows="30" id="awesome-css-area" placeholder='Enter Your Custom CSS . . . .' style='visibility:hidden' ><?php if($storecss) echo $storecss;?></textarea>
					<div id='hssavefile'>Add CSS</div>
					<div id='hsajax_load' style='display:none'><img src="<?php echo  plugin_dir_url( __FILE__ ). 'images/ajax_loading.gif' ;?>"></div>
		</div> <!-- wrap ends here-->
		<script>
			var editor2 = CodeMirror.fromTextArea(document.getElementById("awesome-css-area"), {
					   lineNumbers: true,
						lineWrapping: true,
						mode: "css",
						autoCloseBrackets: true,
						styleActiveLine: true,
						matchBrackets : true,
						gutters: ["CodeMirror-linenumbers"]
					//	extraKeys: {"Ctrl-Space": "autocomplete"}
					  });
			 editor2.on("keyup", function(cm, event) { 
					 var keyCode = event.keyCode;
					 //alert(keyCode);
					if(keyCode >= 65 && keyCode <=95){
						//if(timeout) clearTimeout(timeout);        
						timeout = setTimeout(function() {
							CodeMirror.showHint(cm, CodeMirror.hint.css, {completeSingle: false});
						}, 10);       
					} 
				});	
				var getheight = jQuery(window).height() - 150;
                var getwidth = jQuery(window).width() - 250;
                editor2.setSize(getwidth, getheight);

				editor2.on("gutterClick", function(cm, n) {
					  var info = cm.lineInfo(n);
					  cm.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : makeMarker());
					});
				eval(document.getElementById("awesome-css-area").value);
		</script>
		<style type="text/css">
      .breakpoints {width: .8em;}
      .breakpoint { color: #822; }
      .CodeMirror {border: 1px solid #aaa;}
    </style>
		<?php
		}
		
		public function addoptionspagejs(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'awesomecustom';
		$getcontent = $wpdb->get_results( "SELECT awesomejs FROM $table_name ");
		$storejs = $getcontent[0]->awesomejs
		?><div class="wrap" id='wrapjs'>
			<h1>Add Custom JS</h1>
					<textarea cols="100" rows="30" id="awesome-js-area" placeholder='Enter Your Custom JS . . . .' style='visibility:hidden'><?php if($storejs) echo $storejs ;?></textarea>
					<div id='hssavejs'>Add JS</div>
					<div id='hsajax_load' style='display:none'><img src="<?php echo  plugin_dir_url( __FILE__ ). 'images/ajax_loading.gif' ;?>"></div>
		</div> <!-- wrap ends here-->
		<script>
			var editorjs = CodeMirror.fromTextArea(document.getElementById("awesome-js-area"), {
			   lineNumbers: true,
			   lineWrapping: true,
			   autoCloseBrackets: true,
			   matchBrackets : true,
			   styleActiveLine: true,
			   mode: "javascript",
			   gutters: ["CodeMirror-lint-markers","breakpoints"],
			   //gutters: ["CodeMirror-linenumbers", "breakpoints"],
			   lint: true
			  });
			
			editorjs.on("keyup", function(cm, event) { 
					 var keyCode = event.keyCode;
					 //alert(keyCode);
					if(keyCode >= 65 && keyCode <=95){
						//if(timeout) clearTimeout(timeout);        
						timeout = setTimeout(function() {
							CodeMirror.showHint(cm, CodeMirror.hint.javascript, {completeSingle: false});
						}, 10);       
					} 
				});
				var getheight = jQuery(window).height() - 150;
                var getwidth = jQuery(window).width() - 250;
                editorjs.setSize(getwidth, getheight);

			editorjs.on("gutterClick", function(cm, n) {
					  var info = cm.lineInfo(n);
					  cm.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : makeMarker());
					});
			eval(document.getElementById("awesome-css-area").value);
		</script>
		<?php
		}
}
$HSAWSadminMain = HSAWSadminMain::instance();
