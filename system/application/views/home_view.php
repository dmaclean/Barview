
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>bar-view.com</title> 
	
	<link rel="stylesheet" href="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<link href="<?php echo base_url();?>css/style.css" type="text/css" rel="stylesheet">
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script> 
	<script type="text/javascript" src="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/barview.js"></script> 
 
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
            	<div class="">
					<?php echo form_open('search/submit');?>
						<?php echo form_input('search', 'search bars'); ?>
					<?php echo form_close();?>
            	</div>
            </li>
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
