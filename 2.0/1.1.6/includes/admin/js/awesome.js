jQuery(document).ready( function() {
jQuery('#hssavefile').click(function(){
	var getCss = editor2.getValue();
	jQuery.ajax({
		url : ajaxurl,
		type : 'POST',
		data : {
			action : 'myawesomecallback',
			getCss : getCss
		},
		beforeSend: function(){ 
        jQuery('#hsajax_load').css('display','block');
		},
		
		success : function( data ) {
			jQuery('#awesome-css-area').val(data);
			jQuery().addClass('');
			jQuery( "#hssavefile" ).after( "<div class='hssuccess-message'>Css Saved</div>" ).fadeIn();
			jQuery('.hssuccess-message').delay(500).fadeOut('slow');
			
		},
      error: function(errorThrown){
          //alert(errorThrown);
      },
	  complete: function(data){
        jQuery('#hsajax_load').css('display','none');
		}
	});
});

jQuery('#hssavejs').click(function(){
	var getJs = editorjs.getValue();
	jQuery.ajax({
		url : ajaxurl,
		type : 'POST',
		data : {
			action : 'myawesomecallbackjs',
			getJs : getJs
		},
		beforeSend: function(){ 
        jQuery('#hsajax_load').css('display','block');
		},
		success : function( data ) {
			//alert(data);
			jQuery('#awesome-js-area').val(data);
			jQuery().addClass('');
			jQuery( "#hssavejs" ).after( "<div class='hssuccess-messagejs'>JS Saved</div>" ).fadeIn();
			jQuery('.hssuccess-messagejs').delay(500).fadeOut('slow');
			
		},
      error: function(errorThrown){
          alert(errorThrown);
      }, 
	   complete: function(data){
        jQuery('#hsajax_load').css('display','none');
		}
	});
});

});		
// starts for breakpoint code generating css
 function makeMarker() {
	  var marker = document.createElement("div");
	  marker.style.color = "#000";
	  marker.innerHTML = "●";
	  marker.style.fontSize="23px";
	  return marker;
	}
// ends here