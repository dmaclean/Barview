var interval = 0;

$(document).ready(function(){
 
 /*	$('.verify').click( function() {
 		var row = $(this).parent;
 		alert('fuck');
 		$.ajax({
 			type: 		'GET',
 			url:		'verify/accept',
 			data:		'bar_id=1',
 			dataType:	'html',
 			success:	function(html, textStatus) {
 				$('body').append(html);
				//row.remove();
 			},
 			error:		function(xhr, errorStatus, errorThrown) {
 				alert('An error occurred! ' + (errorThrown ? errorThrown : xhr.status));
 			}
 		});
 	});*/
 
 	///////////////////////////////////////////////////////////
	// JQUERY EVENT TO SHOW BROADCAST IMAGE WHEN FAVORITE BAR
	// IS CLICKED.
	///////////////////////////////////////////////////////////
	/*$('ul.subnav li').click(function(event) {
		getCurrentImage(event.target.id);
	
		var $newComm = "getCurrentImage(" + event.target.id + ")";
		clearInterval(this.interval);
		this.interval = setInterval($newComm, 10000);
	});*/
	
	/////////////////////////////
	// FANCYBOX BAR OWNER LOGIN
	/////////////////////////////
	//$('#bar_login').fancybox();
 
 	///////////////////////////////////////////////////////////////////
	// DROPDOWNS FOR MENUBAR
	// (http://www.noupe.com/tutorial/drop-down-menu-jquery-css.html)
	///////////////////////////////////////////////////////////////////
	/*$("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled - Adds empty span tag after ul.subnav
	
	$("ul.topnav li span").click(function() { //When trigger is clicked...
		
		//Following events are applied to the subnav itself (moving subnav up and down)
		$(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click
 
		$(this).parent().hover(function() {
		}, function(){	
			$(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
		});
 
		//Following events are applied to the trigger (Hover events for the trigger)
		}).hover(function() { 
			$(this).addClass("subhover"); //On hover over, add class "subhover"
		}, function(){	//On Hover Out
			$(this).removeClass("subhover"); //On hover out, remove class "subhover"
	});*/
 
	function getCurrentImage(bar_id) {
		//alert('calling getCurrentImage('+bar_id+')');
		var $srcVal = '<?php echo base_url();?>broadcast_images/getimage.php?bar_id=' + bar_id;
		$('#broadcast_img').remove();
		$('<img id="broadcast_img" src="' + $srcVal + '" />').appendTo('#broadcast');
	}
	
	
});