
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html class="cufon-active cufon-ready"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>bar-view.com</title> 
	
	<link rel="stylesheet" href="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<link href="<?php echo base_url();?>css/style.css" type="text/css" rel="stylesheet"/>
	<!--<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap-1.2.0.min.css">-->
	
	<script type="text/javascript" src="<?php echo base_url();?>javascript/cufon.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/jquery.js"></script>
	<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" />-->
	<script type="text/javascript" src="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/barview.js"></script> 
 
 	<style type="text/css">cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media print{cufon{padding:0!important;}cufon canvas{display:none!important;}}</style>
</head> 
 
<body id="top">
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script>
         FB.init({ 
            appId:'177771455596726', cookie:true, 
            status:true, xfbml:true 
         });
	</script>


	<!-- Begin pageWrapper -->
	<div id="pageWrapper">
		

		<!-- Begin header -->
<header>
	<!-- Begin logo -->
	<div id="logo">
		<h1><a href="<?php echo base_url();?>index.php/" title="Home"><cufon class="cufon cufon-canvas" alt="Barview.com" style="width: 148px; height: 32px; "><canvas width="157" height="39" style="width: 157px; height: 39px; top: -4px; left: -2px; "></canvas><cufontext>Barview.com</cufontext></cufon></a></h1>
		<h2 class="slogan">Your night starts here.</h2>
	</div>
	<!-- End logo -->

	<!-- Begin user meta -->
	<div id="user-meta">
		<ul>
			<li class="form-buttons">
				<div>
				<!--
					No one logged in.
				-->
				<?php if(!$this->session->userdata('uid')) { ?>
					<div class="user_login_div" style="float:left;"><a id="user_login" href="#data">Login</a></div>&nbsp; | &nbsp;<a href="<?php echo base_url();?>index.php?/barhome">Bars</a>
				<!--
					Facebook user logged in.
				-->
				<?php } else if($this->session->userdata('uid') && $this->session->userdata('usertype') == FACEBOOK_TYPE) { 
					$callback_url = base_url() . 'index.php?/logout';
				?>
					<div style="float:left;"><a href="<?php echo $this->facebook->getLogoutUrl(array('next' => $callback_url));?>">Log out</a></div>
				<!--
					Non-facebook user logged in.
				-->
				<?php } else {?>
					<div style="float:left;"><a href="<?php echo base_url();?>index.php?/logout">Log out</a></div>
				<?php } ?>
				</div>
			</li>
		</ul>
	</div>
<!-- End user meta -->
</header>
<!-- End header -->

		<!-- Begin nav -->
		<nav>
			<ul id="head-nav">
				<li class="first current"><a href="<?php echo base_url(); ?>index.php">Home</a></li>
				<?php if($this->session->userdata('usertype') && $this->session->userdata('usertype') == BARVIEW_TYPE) { ?>
				<li class="last"><a href="<?php echo base_url(); ?>index.php?/editinfo">Edit Info</a></li>
				<?php } ?>
				<li class="last"><a href="<?php echo base_url(); ?>index.php">Contact</a></li>
				<li class="last">
					<span class="current">
						<?php echo form_open('search/submit'); ?>
							Search bars: 
							<?php 
								$search_atts = array('id' => 'search', 'name' => 'search', 'maxlength' => '100');
								echo form_input($search_atts); 
							?>
						<?php echo form_close(); ?>
					</span>
				</li>
			</ul>
		</nav>
		<!-- End nav -->
		
		
		
		<!-- ERROR/INFO MESSAGES -->
		<?php if(isset($error_msg)) { ?>
			<div class="error"><?php echo $error_msg; ?></div>
		<?php } else if(isset($info_msg)) { ?>
			<div class="info"><?php echo $info_msg; ?></div>
		<?php } ?>
		
		<div style="display:none">
			<div id="data">
				<div style="float:left;">
				<?php echo form_open('userlogon/submit')?>
					<?php echo validation_errors('<p class="error">','</p>')?>
					<p>Log in to Barview</p>
					<p>
						<label for="username">Email: </label>
						<?php echo form_input('email', set_value('email'));?>
					</p>
					<p>
						<label for="password">Password: </label>
						<?php echo form_password('password');?>
					</p>
					<p>
						<?php echo form_submit('submit', 'Login');?>
					</p>
				<?php echo form_close();?>
				<p>
					Don't have an account?  Register <a href="<?php echo base_url(); ?>index.php?/usersignup">here</a>.
				</p>
				<p>
					<a href="<?php echo base_url(); ?>index.php?/forgotpassworduser">Forgot your password?</a>
				</p>
				</div>
				<div style="float:left;">
					<p>Use an existing account:</p>
					<fb:login-button>Login with Facebook</fb:login-button>
				</div>
			</div>
		</div>