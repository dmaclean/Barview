
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>bar-view.com</title> 
	
	<link rel="stylesheet" href="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
	
	<script type="text/javascript" src="<?php echo base_url();?>javascript/jquery.js"></script>
	<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" />-->
	<script type="text/javascript" src="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/barview.js"></script>
</head> 
 
<body <?php if(isset($no_hero)) { echo "style='padding-top: 50px;'"; } ?>>
	
	<div class="topbar">
		<div class="fill">
			<div class="container">
				<h3><a href="<?php echo base_url(); ?>">Bar-view.com</a></h3>
				<ul>
					<li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
					<?php if($this->session->userdata('uid') && $this->session->userdata('usertype') == BARVIEW_TYPE) { ?>
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
					<?php if(!$this->session->userdata('uid')) { ?>
						<li><a href="<?php echo base_url();?>index.php?/barhome">Bars</a></li>
						<li><a class="user_login" href="#data">Login</a></li>
					<!-- FACEBOOK Logout -->
					<?php } else if($this->session->userdata('usertype') == FACEBOOK_TYPE) { ?>
						<li>
							<?php 
								$callback_url = base_url() . 'index.php?/logout';
								$fb_array = array('next' => $callback_url);
							?>
							<a href="<?php echo $facebook->getLogoutUrl($fb_array); ?>">
								<img 	src="http://static.ak.fbcdn.net/images/fbconnect/logout-buttons/logout_small.gif" 
										alt="http://static.ak.fbcdn.net/images/fbconnect/logout-buttons/logout_small.gif"/>
							</a>
						</li>
					<!-- BARVIEW logout -->
					<?php } else if($this->session->userdata('usertype') == BARVIEW_TYPE) { ?>
						<li><a href="<?php echo base_url(); ?>index.php?/logout">Log out</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<?php if(!( isset($search_results) || 
					isset($no_hero) )) {	?>
		<div class="hero-unit">
			<h1>Your night starts here</h1>
			<!--<p>Barview lets you do cool stuff...</p>-->
		</div>
		<?php } ?>

		
		
		
		<!-- ERROR/INFO MESSAGES -->
		<?php if(isset($error_msg)) { ?>
			<div class="alert-message error"><?php echo $error_msg; ?></div>
		<?php } else if(isset($info_msg)) { ?>
			<div class="alert-message info"><p><?php echo $info_msg; ?></p></div>
		<?php } ?>
		
		<div style="display:none">
			<div id="data">
				<div class="row">
					<div class="span7">
						<?php echo form_open('userlogon/submit')?>
							<?php echo validation_errors('<div class="alert-message error"><p><strong>','</strong></p></div>')?>
							<fieldset>
								<legend>Log in to Barview</legend>
								<div class="clearfix">
									<label for="username">Email: </label>
									<div class="input">
										<?php echo form_input('email', set_value('email'));?>
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
							Don't have an account?  Register <a href="<?php echo base_url(); ?>index.php?/usersignup">here</a>.
						</p>
						<p>
							<a href="<?php echo base_url(); ?>index.php?/forgotpassworduser">Forgot your password?</a>
						</p>
					</div>
					<div class="span6">
						<h3>Use an existing account:</h3>
						<?php 
							$callback_url = base_url(); 
							$fb_array  = array('next' => $callback_url);
						?>
						<a href="<?php echo $facebook->getLoginUrl($fb_array); ?>"><img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif"></a>
					</div>
				</div>
			</div>
		</div>