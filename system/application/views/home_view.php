
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>bar-view.com</title> 

<link rel="stylesheet" href="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />


<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript"> 
var interval = 0;

$(document).ready(function(){
 
 
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
	$("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled - Adds empty span tag after ul.subnav
	
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
 
	function getCurrentImage(bar_id) {
		//alert('calling getCurrentImage('+bar_id+')');
		var $srcVal = '<?php echo base_url();?>broadcast_images/getimage.php?bar_id=' + bar_id;
		$('#broadcast_img').remove();
		$('<img id="broadcast_img" src="' + $srcVal + '" />').appendTo('#broadcast');
	}
	
	
});
</script> 
<style type="text/css"> 
body {
	margin: 0; padding: 0;
	font: 10px normal Arial, Helvetica, sans-serif;
	background: #ddd --url(body_bg.gif) repeat-x;
}
.container {
	width: 960px;
	margin: 0 auto;
	position: relative;
}
#header {
	background: #1b5790;
	padding-top: 120px;
	border-top-left-radius: 30px;
	border-top-right-radius: 30px;
}
#header .disclaimer {
	color: #999;
	padding: 100px 0 7px 0;
	text-align: right;
	display: block;
	position: absolute;
	top: 0; right: 0;
}
#header .disclaimer a {	color: #ccc;}
ul.topnav {
	list-style: none;
	padding: 0 20px;	
	margin: 0;
	float: left;
	width: 920px;
	--background: #222;
	font-size: 1.2em;
	background: #e5ecf3;--url(topnav_bg.gif) repeat-x;
}
ul.topnav li {
	float: left;
	margin: 0;	
	padding: 0 15px 0 0;
	position: relative; /*--Declare X and Y axis base--*/
}
ul.topnav li a{
	padding: 10px 5px;
	color: #000;
	display: block;
	text-decoration: none;
	float: left;
}
ul.topnav li a:hover{
	background: url(topnav_hover.gif) no-repeat center top;
}
ul.topnav li span { /*--Drop down trigger styles--*/
	width: 17px;
	height: 35px;
	float: left;
	background: url(subnav_btn.gif) no-repeat center top;
}
ul.topnav li span.subhover {background-position: center bottom; cursor: pointer;} /*--Hover effect for trigger--*/
ul.topnav li ul.subnav {
	list-style: none;
	position: absolute; /*--Important - Keeps subnav from affecting main navigation flow--*/
	left: 0; top: 35px;
	background: #333;
	margin: 0; padding: 0;
	display: none;
	float: left;
	width: 170px;
	-moz-border-radius-bottomleft: 5px;
	-moz-border-radius-bottomright: 5px;
	-webkit-border-bottom-left-radius: 5px;
	-webkit-border-bottom-right-radius: 5px;
	border: 1px solid #111;
}
ul.topnav li ul.subnav li{
	margin: 0; padding: 0;
	border-top: 1px solid #252525; /*--Create bevel effect--*/
	border-bottom: 1px solid #444; /*--Create bevel effect--*/
	clear: both;
	width: 170px;
}

/* Boxes in dropdown */
html ul.topnav li ul.subnav li a {
	float: left;
	width: 145px;
	background: #e5ecf3 url(dropdown_linkbg.gif) no-repeat 10px center;
	padding-left: 20px;
}
html ul.topnav li ul.subnav li a:hover { /*--Hover effect for subnav links--*/
	background: #fff url(dropdown_linkbg.gif) no-repeat 10px center; 
}
#header img {
	margin: 20px 0 10px;
}

div.fb_login_div {
	padding-left: 470px;
}

div.fb_logout_div {
	padding-left: 400px;
}

div.bar_login_div {
	padding-left: 548px;
}

div.content {
	height: 500px;
	background: #333;
}

div.dyn_content {
	float: left;
	width: 760px;
	background: #bbb;
}

div.ads {
	float: right;
	width: 200px;
	background: #999;
}
</style> 
 
</head> 
 
<body> 


<div class="container"> 
    <div id="header"> 
    	<div>barview.com</div>
		<div class="disclaimer"></div> 
        <ul class="topnav"> 
            <li><a href="<?php echo base_url(); ?>">Home</a></li> 
            <li><a href="#">About Us</a></li>
            <li><a href="#">Advertise</a></li> 
            <li><a href="#">Contact Us</a></li> 
            
            <li>
            	<div class="bar_login_div"><a id="bar_login" href="#data">Bar Login</a></div>
            </li>
        </ul> 
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
					<p>
						Don't have an account?  Register <a href="<?php echo base_url();?>index.php/signup">here</a>.
					</p>
				<?php echo form_close();?>
			</div>
		</div>
	</div></span>
    
	<div class="content">
    	<div id="broadcast" class="broadcast"></div>
    	<div class="dyn_content">
    		Dynamic content here...        		Dynamic content here...        		Dynamic content here...        		Dynamic content here...        		Dynamic content here...        		Dynamic content here...        		Dynamic content here...        		Dynamic content here...        		Dynamic content here...        		Dynamic content here...        		Dynamic content here...    <br/>
    		
    	</div>
    	<div class="ads">
    		Ads go here...
    	</div>
    	<div style="clear:both;"></div> <!-- no clue why this clear works, but it does. -->
    </div>    
    
    </div><!-- Container div --> 
</body> 
</html> 
