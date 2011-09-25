
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>bar-view.com</title> 
	
	<link rel="stylesheet" href="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
	
	<script type="text/javascript" src="<?php echo base_url();?>javascript/cufon.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/barview.js"></script> 
 
 	<!--<style type="text/css">cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media print{cufon{padding:0!important;}cufon canvas{display:none!important;}}</style>-->
</head> 
 
<body style="padding-top: 50px;">
	<div class="topbar">
		<div class="fill">
			<div class="container">
				<h3><a href="<?php echo base_url(); ?>">Bar-view.com</a></h3>
				<ul>
					<li class="active"><a href="<?php echo base_url(); ?>index.php?/barhome">Home</a></li>
					<?php if($this->session->userdata('bar_id')) { ?>
						<li><a href="<?php echo base_url(); ?>index.php?/editinfo">Edit Info</a></li>
					<?php } ?>
					<li><a href="<?php echo base_url(); ?>">Contact</a></li>
				</ul>
				<?php echo form_open('search/submit'); ?>
					<?php 
						$search_atts = array('id' => 'search', 'name' => 'search', 'maxlength' => '100', 'placeholder' => 'Search bars');
						echo form_input($search_atts); 
					?>
				<?php echo form_close(); ?>
				<ul class="nav secondary-nav">
					<?php if($this->session->userdata('bar_id')) { ?>
						<li><a href="<?php echo base_url();?>index.php?/logout">Log out</a></li>
					<?php } else { ?>
						<li><a href="<?php echo base_url();?>index.php?/home">Users</a></li>
						<li><a id="bar_login" href="#data">Login</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>	

	<div class="container">
		
		
		<!-- ERROR/INFO MESSAGES -->
		<?php if(isset($error_msg)) { ?>
			<div class="alert-message error"><p><?php echo $error_msg; ?></p></div>
		<?php } else if(isset($info_msg)) { ?>
			<div class="alert-message info"><p><?php echo $info_msg; ?></p></div>
		<?php } ?>
		
		<div style="display:none">
			<div id="data">
				<?php echo form_open('logon/submit')?>
					<?php echo validation_errors('<div class="alert-message error"><p><strong>','</strong></p></div>')?>
					<fieldset>
						<div class="clearfix">
							<label for="username">Username: </label>
							<div class="input">
								<?php echo form_input('username', set_value('username'));?>
							</div>
						</div>
						<div class="clearfix">
							<label for="password">Password: </label>
							<div class="input">
								<?php echo form_password('password');?>
							</div>
						</div>
						<div class="actions">
							<?php 
								$options = array('name'=>'submit', 'value'=>'Login', 'class'=>'btn primary');
								echo form_submit($options);
							?>
						</div>
					</fieldset>
				<?php echo form_close();?>
				<p>
					Don't have an account?  Register <a href="<?php echo base_url(); ?>index.php?/signup">here</a>.
				</p>
				<p>
					<a href="<?php echo base_url(); ?>index.php?/forgotpassword">Forgot your password?</a>
				</p>
			</div>
		</div>