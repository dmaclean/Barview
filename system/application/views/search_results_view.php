
	<h1>Search results</h1>
	
	<?php if (count($search_results) == 0) { ?>
	<div class="row">
		No results found.
	</div>
	<?php } else { ?>

		<?php foreach ($search_results as $row) {  ?>
			<div class="row">
				<!--
					0 - id
					1 - name
					2 - address
				-->
				<div class="span8 offset4">
					<div>
						<h3>
							<?php if($this->session->userdata('uid')) { ?>
								<a href="<?php echo base_url(); ?>index.php?/bardetail/index/<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a>
							<?php } else { ?>
								<a class="user_login" href="#data"><?php echo $row[1]; ?></a>
							<?php } ?>
						</h3>
					</div>
					<div class="search_bar_address"><?php echo $row[2]; ?></div>
					<div><img id="<?php echo $row[0]; ?>" class="bar_image" src="broadcast_images/<?php echo $row[0]; ?>.jpg?<?php echo rand(0, getrandmax()); ?>"/></div>
					<?php if($this->session->userdata('is_logged_in')) { ?>
					
						<?php if(isset($favorites[$row[0]])) { ?>
							<a class="btn danger" id="<?php echo $row[0];?>_favorite" onclick="removeFromFavorites('<?php echo base_url(); ?>', <?php echo $row[0]; ?>, '<?php echo $this->session->userdata('uid'); ?>');">Remove from favorites</a>
						<?php } else { ?>
							<a class="btn success" id="<?php echo $row[0];?>_favorite" onclick="addToFavorites('<?php echo base_url(); ?>', <?php echo $row[0]; ?>, '<?php echo $this->session->userdata('uid'); ?>');">Add to favorites</a>
						<?php } ?>
					
				<?php } ?>
				</div>
				
			</div>
		<?php } ?>
	<?php } ?>
	
	<div class="row">
		<br/><br/>
		<h2>Don't see your favorite bar here?  Tell them to sign up for Barview!</h2>
	</div>
	

<!-- End contentWrapper -->
