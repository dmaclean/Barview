
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html class="cufon-active cufon-ready"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>bar-view.com</title> 
	
	<link rel="stylesheet" href="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<link href="<?php echo base_url();?>css/style.css" type="text/css" rel="stylesheet"/>
	
	<script type="text/javascript" src="<?php echo base_url();?>javascript/cufon.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/fancybox/jquery.fancybox-1.3.4.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>javascript/barview.js"></script> 
 
 	<style type="text/css">cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media print{cufon{padding:0!important;}cufon canvas{display:none!important;}}</style>
</head> 
 
<body id="top">
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
		<?php if(isset($bar_name)) { ?>
			<a href="<?php echo base_url();?>index.php?/logout">Logout</a>
		<?php } else { ?>
			<?php 
				$attributes = array('id' => 'login-small', 'accept-charset' => 'utf-8');
				echo form_open('logon/submit', $attributes);
			?>
				<ul>
					<li class="form-buttons">
						<div>
						<?php if($this->session->userdata('bar_id')) { ?>
							<div style="float:left;"><a href="<?php echo base_url();?>index.php?/logout">Log out</a></div>
						<?php } else { ?>
							<div style="float:left;"><a id="bar_login" href="#data">Login</a></div>&nbsp; | &nbsp;<a href="<?php echo base_url();?>index.php?/home">Users</a>
						<?php } ?>
						</div>
					</li>
				</ul>
			<?php echo form_close(); ?>
		<?php } ?>
	</div>
<!-- End user meta -->
</header>
<!-- End header -->

		<!-- Begin nav -->
		<nav>
			<ul id="head-nav">
				<li class="first current"><a href="<?php echo base_url(); ?>index.php">Home</a></li>
				<li class="last"><a href="<?php echo base_url(); ?>index.php">Contact</a></li>
			</ul>
		</nav>
		<!-- End nav -->
		
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
				<p>
					Don't have an account?  Register <a href="<?php echo base_url(); ?>index.php?/signup">here</a>.
				</p>
			</div>
		</div>