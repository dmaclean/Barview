
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>bar-view.com</title> 
	
	<link rel="stylesheet" href="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap-1.2.0.min.css">
	
	<script type="text/javascript" src="<?php echo base_url();?>javascript/cufon.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/barview.js"></script> 
 
 	<style type="text/css">cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media print{cufon{padding:0!important;}cufon canvas{display:none!important;}}</style>
</head> 
 
<body>
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script>
         FB.init({ 
            appId:'177771455596726', cookie:true, 
            status:true, xfbml:true 
         });
	</script>		
	
	<div class="topbar">
		<div class="fill">
			<div class="container">
				<h3><a href="#">Bar-view.com</a></h3>
				<ul>
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
				<?php echo form_open('search/submit'); ?>
					<?php 
								$search_atts = array('id' => 'search', 'name' => 'search', 'maxlength' => '100', 'placeholder' => 'Search bars');
								echo form_input($search_atts); 
							?>
				<?php echo form_close(); ?>
				<ul class="nav secondary-nav">
					<li><a href="<?php echo base_url();?>index.php?/barhome">Bars</a></li>
					<li><a id="user_login" href="#data">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<?php if(!$search_results) {	?>
		<div class="hero-unit">
			<h1>Your night starts here</h1>
			<p>Barview lets you do cool stuff...</p>
		</div>
		<?php } ?>

		<!-- Begin header -->
<!--<header>
	<div id="logo">
		<h1><a href="<?php echo base_url();?>index.php/" title="Home"><cufon class="cufon cufon-canvas" alt="Barview.com" style="width: 148px; height: 32px; "><canvas width="157" height="39" style="width: 157px; height: 39px; top: -4px; left: -2px; "></canvas><cufontext>Barview.com</cufontext></cufon></a></h1>
		<h2 class="slogan">Your night starts here.</h2>
	</div>
	
	<div id="user-meta">
		<?php if(isset($user_name)) { ?>
			<a href="<?php echo base_url();?>index.php?/logout">Logout</a>
		<?php } else { ?>
				<ul>
					<li class="form-buttons">
						<div>
						<?php if(!$this->session->userdata('uid')) { ?>
							<div class="user_login_div" style="float:left;"><a id="user_login" href="#data">Login</a></div>&nbsp; | &nbsp;<a href="<?php echo base_url();?>index.php?/barhome">Bars</a>
						<?php } else {?>
							<div style="float:left;"><a href="<?php echo base_url();?>index.php?/logout">Log out</a></div>
						<?php } ?>
						</div>
					</li>
				</ul>
		<?php } ?>
	</div>
</header>-->
<!-- End header -->

		<!-- Begin nav -->
		<!--<nav>
			<ul id="head-nav">
				<li class="first current"><a href="<?php echo base_url(); ?>index.php">Home</a></li>
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
		</nav>-->
		<!-- End nav -->
		
		
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
				</div>
				<div style="float:left;">
					<p>Use an existing account:</p>
					<fb:login-button>Login with Facebook</fb:login-button>
				</div>
			</div>
		</div>