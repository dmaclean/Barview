<!-- Begin contentWrapper -->
<div id="contentWrapper">
	
			<!-- Begin 2 column content -->
<div id="content">
	<section class="post clearfix">
		<!-- Page layout: Default -->
<h2><cufon class="cufon cufon-canvas" alt="Broadcast to bar-view!" style="width: 51px; height: 24px; "><canvas width="64" height="29" style="width: 64px; height: 29px; top: -3px; left: -2px; "></canvas><cufontext>Home</cufontext></cufon></h2>


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

<aside>
	<div id="navigation">
		<h2><cufon class="cufon cufon-canvas" alt="My Current Deals and Events" style="width: 94px; height: 24px; "><canvas width="106" height="29" style="width: 106px; height: 29px; top: -3px; left: -2px; "></canvas><cufontext>My Current Deals and Events</cufontext></cufon></h2>
		<div class="bar_events_list">
			<ul>
				<?php foreach($events as $e) { ?>
					<li id="event_<?php echo $e['id'] ?>">
						<div style="float:left;"><?php echo $e['detail']; ?></div>
						<div><a class="bar_events_link" id="event_<?php $e['id'];?>_a" onclick="deleteEvent('<?php echo base_url(); ?>', <?php echo $e['id']; ?>, <?php echo $bar_id; ?>, '<?php echo $bar_name; ?>', '<?php echo $session_id; ?>');">delete</a></div>
					</li>
				<?php } ?>
			</ul>
		</div>
		<div class="bar_events_edit">
			<textarea id="event_text" name="event_text" rows="5"></textarea><br/>
			<button type="button" id="submit" name="submit" value="Add new event or deal." 
							onclick="addEvent('<?php echo base_url(); ?>', $('#event_text').val(), <?php echo $bar_id; ?>, '<?php echo $bar_name; ?>', '<?php echo $session_id; ?>');">Add new event or deal.</button>
		</div>
	</div>
	
</aside>

			
</div>
<!-- End contentWrapper -->
