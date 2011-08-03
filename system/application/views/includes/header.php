
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
		<h2 class="slogan">Only slightly less profitable than our competitors.</h2>
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
					<li class="email">
						<?php 
							$user_atts = array('name' => 'username', 'id' => 'username', 'maxlength' => '120', 'onblur' => 'if (this.value == \'\') { this.value = \'Username\'; }" onfocus="if (this.value == \'Username\') { this.value = \'\'; }');
							echo form_input($user_atts);
						?>
					</li>
						
					<li class="pword">
						<?php 
							$pass_atts = array('name' => 'password', 'id' => 'password','maxlength' => '20', 'onblur' => 'if (this.value == \'\') { this.value = \'Password\'; }" onfocus="if (this.value == \'Password\') { this.value = \'\'; }');
							echo form_password($pass_atts);
						?>
					</li>
				
					<li class="form-buttons">
						<input type="submit" value="Bar Login" name="btnLogin"> | &nbsp;<a href="<?php echo base_url();?>index.php?/signup">Register</a>
						<input type="checkbox" id="remember-checksidebar" name="remember" value="1"><span>Remember Me</span>
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