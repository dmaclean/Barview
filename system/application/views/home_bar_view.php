<!--<div class="page-header">
	<h1>Broadcast to Bar-view</h1>
</div>-->

<div class="row">
	<div class="span12">
		<h2>Broadcast to Bar-view</h2>
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

	<div class="span4">
		<h2>My Current Deals</h2>
		<dl id="bar_events_list">
			<?php foreach($events as $e) { ?>
				<dt id="event_<?php echo $e['id'] ?>"><?php echo $e['detail']; ?></dt>
				<dd id="event_<?php echo $e['id'];?>_a"><a class="btn small danger"  onclick="deleteEvent('<?php echo base_url(); ?>', <?php echo $e['id']; ?>, <?php echo $bar_id; ?>, '<?php echo $bar_name; ?>', '<?php echo $session_id; ?>');">delete</a></dd>
			<?php } ?>
		</dl>
		<div class="bar_events_edit">
			<textarea id="event_text" name="event_text" rows="5"></textarea><br/>
			<button class="btn primary" type="button" id="submit" name="submit" value="Add new event or deal." 
							onclick="addEvent('<?php echo base_url(); ?>', $('#event_text').val(), <?php echo $bar_id; ?>, '<?php echo $bar_name; ?>', '<?php echo $session_id; ?>');">Add new event or deal.</button>
		</div>
	</div>
		
</div>
