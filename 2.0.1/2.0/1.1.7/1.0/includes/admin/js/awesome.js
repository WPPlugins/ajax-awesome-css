jQuery(document).ready( function() {
jQuery('#hssavefile').click(function(){
	var getCss = editor2.getValue();
	//alert(getCss);
	jQuery.ajax({
		url : ajaxurl,
		type : 'POST',
		data : {
			action : 'myawesomecallback',
			getCss : getCss
		},
		success : function( data ) {
			//alert(data);
			jQuery('#awesome-css-area').val(data);
			jQuery().addClass('');
			jQuery( "#hssavefile" ).after( "<div class='hssuccess-message'>Css Saved</div>" ).fadeIn();
			jQuery('.hssuccess-message').delay(2000).fadeOut('slow');
			
		},
      error: function(errorThrown){
          //alert(errorThrown);
      } 
	});
});

jQuery('#hssavejs').click(function(){
	var getJs = editorjs.getValue();
	//alert(getJs);
	jQuery.ajax({
		url : ajaxurl,
		type : 'POST',
		data : {
			action : 'myawesomecallbackjs',
			getJs : getJs
		},
		success : function( data ) {
			//alert(data);
			jQuery('#awesome-js-area').val(data);
			jQuery().addClass('');
			jQuery( "#hssavejs" ).after( "<div class='hssuccess-messagejs'>JS Saved</div>" ).fadeIn();
			jQuery('.hssuccess-messagejs').delay(2000).fadeOut('slow');
			
		},
      error: function(errorThrown){
          alert(errorThrown);
      } 
	});
});

 
});		  