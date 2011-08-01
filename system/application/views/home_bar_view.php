
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>bar-view.com</title> 

<link rel="stylesheet" href="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/style.css" type="text/css" rel="stylesheet">

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/barview.js"></script> 

</head> 
 
<body> 

<div class="container"> 
    <div id="header"> 
		<div class="disclaimer"></div> 
        <ul class="topnav"> 
            <li><a href="<?php echo base_url(); ?>">Home</a></li> 
            <li><a href="#">About Us</a></li>
            <li><a href="#">Advertise</a></li> 
            <li><a href="#">Contact Us</a></li> 
            
            <li>
            	<?php if ($bar_id): ?>
            		<div class="fb_logout_div"><a href="<?php echo base_url(); ?>index.php/logout">logout</a></div>
            	<?php endif ?>
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
				<?php echo form_close();?>
			</div>
		</div>
	</div></span>
    </div> 


	<div id="broadcast" class="broadcast">			
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="barview_cam">
			<param name="movie" value="<?php echo base_url();?>camera/barview_cam.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="true" />
			<param name="FlashVars" value="bar_name=<?php echo urlencode($bar_name); ?>&session_id=<?php echo $session_id; ?>&bar_id=<?php echo $bar_id; ?>&server_url=http://localhost:8888/barview/index.php/rest/barimage/<?php echo $bar_id; ?>"/>
			<embed 	src="<?php echo base_url();?>camera/barview_cam.swf" 
					width="700" 
					height="400" 
					FlashVars="bar_name=<?php echo urlencode($bar_name); ?>&session_id=<?php echo $session_id; ?>&bar_id=<?php echo $bar_id; ?>&server_url=http://localhost:8888/barview/index.php/rest/barimage/<?php echo $bar_id; ?>"></embed>
			<!--<![endif]-->
		</object>	
	</div>

</body> 
</html> 
