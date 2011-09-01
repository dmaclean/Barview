<!-- Begin contentWrapper -->
<div id="contentWrapper">
	<div class="colmask threecol">
		<div class="colmid">
			<div class="colleft">
				<!-- Middle column -->
				<div class="col1">
					<?php if (count($search_results) == 0) { ?>
						No results found.
					<?php } else { ?>
					
						<?php foreach ($search_results as $row) {  ?>
							<div class="search_bar_container">
								<!--
									0 - id
									1 - name
									2 - address
								-->
								<div class="search_bar_name"><?php echo $row[1]; ?></div>
								<div class="search_bar_address"><?php echo $row[2]; ?></div>
								<div><img id="<?php echo $row[0]; ?>" class="bar_image" src="broadcast_images/<?php echo $row[0]; ?>.jpg"/></div>
								<?php if($this->session->userdata('is_logged_in')) { ?>
									<div class="search_bar_favorite">
										<?php if(isset($favorites[$row[0]])) { ?>
											<a id="<?php echo $row[0];?>_favorite" onclick="alert('trying to remove <?php echo $row[1]; ?> from favorites');">Remove from favorites</a>
										<?php } else { ?>
											<a id="<?php echo $row[0];?>_favorite" onclick="$.ajax({
  																	type: 'POST',
  																	url: '<?php echo base_url();?>index.php?/rest/favorite/<?php echo $row[0]; ?>',
  																	beforeSend: function(xhr) {
																			xhr.setRequestHeader('USER_ID', '<?php echo $this->session->userdata('uid'); ?>');
 																		},
  																	success: function() {
  																				$('#<?php echo $row[0];?>_favorite').text('Remove from favorites');
  																			}
																});">Add to favorites</a>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					
					<?php } ?>
					<p>
						Don't see your favorite bar here?  Tell them to sign up for Barview!
					</p>
				</div>
				<!-- Left column -->
				<div class="col2">
					
				</div>
				<!-- Right column -->
				<div class="col3">
					
				</div>
			</div>
		</div>
	</div>
	
</div>
<!-- End contentWrapper -->
