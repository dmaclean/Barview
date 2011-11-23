<div class="container">
	<div class="row">
		<div class="home_header">
			<h1><?php echo $bar_name; ?></h1>
		</div>
		<div class="span4 columns">
			<h2>Address</h2>
			<p>
				<?php echo $bar_address; ?><br/>
				<?php echo $bar_city; ?>, <?php echo $bar_state; ?> <?php echo $bar_zip; ?>
			</p>
		</div>
		
		<div class="span6 columns">
			<h2>Current Feed</h2>
			<div><img id="<?php echo $bar_id; ?>" class="bar_image" src="<?php echo base_url(); ?>index.php?/getimage/index/<?php echo $bar_id; ?>"/></div>
			<?php if($this->session->userdata('is_logged_in')) { ?>					
				<?php if(isset($favorites[$bar_id])) { ?>
					<a class="btn danger" id="<?php echo $bar_id;?>_favorite" onclick="removeFromFavorites('<?php echo base_url(); ?>', <?php echo $bar_id; ?>, '<?php echo $this->session->userdata('uid'); ?>');">Remove from favorites</a>
				<?php } else { ?>
					<a class="btn success" id="<?php echo $bar_id;?>_favorite" onclick="addToFavorites('<?php echo base_url(); ?>', <?php echo $bar_id; ?>, '<?php echo $this->session->userdata('uid'); ?>');">Add to favorites</a>
				<?php } ?>
			<?php } ?>
		</div>
		
		<div class="span6 columns">
			<h2>Current Deals</h2>
			<?php if(count($events) > 0) { 
						foreach($events as $e) {  ?>
							<p><?php echo $e['detail']; ?></p>
						<?php }
				 } else { ?>
					<p>No deals or events at the moment.</p>
			<?php } ?>
		</div>
	</div>
</div>