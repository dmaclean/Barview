<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<title>Barview.com</title>
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" charset="utf-8">
	<!--<link rel="stylesheet" href="<?php echo base_url();?>css/menubar.css" type="text/css" media="screen" charset="utf-8">-->
	<link rel="stylesheet" href="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4" type="text/css" media="screen" />
	
	<script type="text/javascript" src="<?php echo base_url();?>javascript/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.js"></script>

	<script type="text/javascript">
		var interval = 0;
	
		$(document).ready(function() {
			
			///////////////////////////////////////////////////////////
			// JQUERY EVENT TO SHOW BROADCAST IMAGE WHEN FAVORITE BAR
			// IS CLICKED.
			///////////////////////////////////////////////////////////
			$('ul.subnav li').click(function(event) {
				getCurrentImage(event.target.id);
			
				var $newComm = "getCurrentImage(" + event.target.id + ")";
				clearInterval(this.interval);
				this.interval = setInterval($newComm, 10000);
			});
			
			/////////////////////////////
			// FANCYBOX BAR OWNER LOGIN
			/////////////////////////////
			$('#bar_login').fancybox();
			
			///////////////////////////////////////////////////////////////////
			// DROPDOWNS FOR MENUBAR
			// (http://www.noupe.com/tutorial/drop-down-menu-jquery-css.html)
			///////////////////////////////////////////////////////////////////
			$("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)
			
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
				});
		});
		
		function getCurrentImage(bar_id) {
			//alert('calling getCurrentImage('+bar_id+')');
			var $srcVal = '<?php echo base_url();?>broadcast_images/getimage.php?bar_id=' + bar_id;
			$('#broadcast_img').remove();
			$('<img id="broadcast_img" src="' + $srcVal + '" />').appendTo('#broadcast');
		}
	</script>
</head>
<body>
	<div class="container">
		<div id="header">
		<div class="disclaimer">Sexy Drop Down Menu Tutorial by <a href="http://www.SohTanaka.com">Soh Tanaka</a>.</div> 
		    <ul class="topnav">
				<li><a href="#">Home</a></li>
			</ul>
		</div>	<!-- disclaimer -->
		</div>	<!-- header 	-->
	<div style="display:none">
		<div id="data">
	  		<?php echo form_open('logon/submit')?>
				<?php echo validation_errors('<p class="error">','</p>')?>
				<p>
					<label for="username">Username: </label>
					<?php echo form_input('username', set_value('username'));?>
				</p>
				<p>
					<label for="password">Password: </label>
					<?php echo form_password('password');?>
				</p>
				<p>
					<?php echo form_submit('submit', 'Login');?>
				</p>
			<?php echo form_close();?>
		</div>
	</div>

