		<!-- Begin contentWrapper -->
		<div id="contentWrapper">
			
			<!-- Begin 2 column content -->
<div id="content">
				<p id="forum_breadcrumbs">
									<span class="current">Home</span>
					
		</p>
	
	
	<section class="post clearfix">
		<!-- Page layout: Default -->
<h2><cufon class="cufon cufon-canvas" alt="Home" style="width: 51px; height: 24px; "><canvas width="64" height="29" style="width: 64px; height: 29px; top: -3px; left: -2px; "></canvas><cufontext>Home</cufontext></cufon></h2>


<div class="page-chunk default"><p>
	<div id="broadcast" class="broadcast">			
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="barview_cam">
			<param name="movie" value="<?php echo base_url();?>camera/barview_cam.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="true" />
			<param name="FlashVars" value="bar_name=<?php echo urlencode($bar_name); ?>&session_id=<?php echo $session_id; ?>&bar_id=<?php echo $bar_id; ?>&server_url=<?php echo base_url(); ?>index.php?/rest/barimage/<?php echo $bar_id; ?>"/>
			<embed 	src="<?php echo base_url();?>camera/barview_cam.swf" 
					width="700" 
					height="400" 
					FlashVars="bar_name=<?php echo urlencode($bar_name); ?>&session_id=<?php echo $session_id; ?>&bar_id=<?php echo $bar_id; ?>&server_url=<?php echo base_url(); ?>index.php?/rest/barimage/<?php echo $bar_id; ?>"></embed>
			<!--<![endif]-->
		</object>	
	</div>
</div>


	</section>
</div>
<!-- End 2 column content -->
<aside>
	<div id="navigation">
		<h2><cufon class="cufon cufon-canvas" alt="Navigation" style="width: 94px; height: 24px; "><canvas width="106" height="29" style="width: 106px; height: 29px; top: -3px; left: -2px; "></canvas><cufontext>Navigation</cufontext></cufon></h2>
		<ul>
			
		</ul>
	</div>
	
</aside>

			
		</div>
	<!-- End contentWrapper -->
