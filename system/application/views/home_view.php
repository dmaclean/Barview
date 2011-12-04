<div class="container">
			
	<div class="row">
		<!--  (Favorites or just all the bars) -->
		<div class="span4 columns">
			<div class="home_header">
				<h1>
			<?php if($this->session->userdata('uid') && !isset($no_favorites)) { ?>
				Your Favorites
			<?php } else { ?>
				Bar-view Bars
			<?php } ?>
				</h1>
			</div>
			<ul class="unstyled">
			<?php foreach($bars as $b) {   
				$bar = $b['name'];
				$location = '('.$b['city'].', '.$b['state'].')';
				?>
				<li>
					<h4>
						<?php if($this->session->userdata('uid')) { ?>
							<a href="<?php echo base_url(); ?>index.php?/bardetail/index/<?php echo $b['bar_id']; ?>"><?php echo $bar; ?></a>
						<?php } else { ?>
							<a class="user_login" href="#data"><?php echo $bar; ?></a>
						<?php } ?>
					</h4>
					<?php echo $location; ?>
				</li>
			<?php } ?>
			</ul>
		</div>

		<div class="span6 columns">
			<h1>
			<?php if($this->session->userdata('uid') and !isset($no_favorites)) { ?>
				Feeds from your favorites
			<?php } else { ?>
				Current Feeds
			<?php } ?>
			</h1>
			<ul class="unstyled">
				<?php if(isset($no_favorites) && $no_favorites) { ?>
					Here are a few bars you might like.
				<?php } 
					foreach($bars as $b) { 
						$bar = $b['name'];
						$location = '('.$b['city'].', '.$b['state'].')';
					?>
					<li>
						<div><h4><?php echo $bar; ?></h4><?php echo $location; ?></div>
						<div><img id="<?php echo $b['bar_id']; ?>" class="bar_image" src="<?php echo base_url(); ?>index.php?/getimage/index/<?php echo $b['bar_id']; ?>"/></div>
						
						<!-- User is logged in and has favorites - show the "Remove from Favorites" link -->
						<?php if($this->session->userdata('uid') && !isset($no_favorites)) { ?>
						<div><a class="btn danger" id="<?php echo $b['bar_id'];?>_favorite" onclick="removeFromFavorites('<?php echo base_url(); ?>', <?php echo $b['bar_id']; ?>, '<?php echo $this->session->userdata('uid'); ?>');">Remove from favorites</a></div>
						
						<!-- User is logged in but has no favorites - show the "Add to Favorites" link -->
						<?php } else if($this->session->userdata('uid') && isset($no_favorites)) { ?>
						<div><a class="btn success" id="<?php echo $b['bar_id'];?>_favorite" onclick="addToFavorites('<?php echo base_url(); ?>', <?php echo $b['bar_id']; ?>, '<?php echo $this->session->userdata('uid'); ?>');">Add to favorites</a></div>
						<?php } ?>
					</li>
					<br/><br/><br/>
				<?php } ?>
			
			<?php if($this->session->userdata('uid') && isset($nonfaves) && count($nonfaves) > 0) { ?>
			<ul><br/><br/><br/><h2>Other bars you might like</h2></ul>
			
				<!--
					NON-FAVORITES (for logged-in users)
				-->
				<?php if(isset($nonfaves)) { 
							foreach($nonfaves as $n) {
								$bar = $n['name'];
								$location = '('.$n['city'].', '.$n['state'].')';
				?>
								<li>
									<div><h4><?php echo $bar; ?></h4><?php echo $location; ?></div>
									<div><img id="<?php echo $n['bar_id']; ?>" class="bar_image" src="<?php echo base_url(); ?>index.php?/getimage/index/<?php echo $n['bar_id']; ?>"/></div>
									<div><a class="btn success" id="<?php echo $n['bar_id'];?>_favorite" onclick="addToFavorites('<?php echo base_url(); ?>', <?php echo $n['bar_id']; ?>, '<?php echo $this->session->userdata('uid'); ?>');">Add to favorites</a></div>
								</li>
								<br/><br/><br/>
					
				<?php 		}
					} ?>
			</ul>
			<?php } ?>
		</div>
		
		<!-- (Current deals) -->
		<div class="span6 columns">
			<h1>Current Deals</h1>
			<dl>
				<?php if(isset($no_favorites)) { ?>
					You don't have any favorite bars yet, so we'll show you some events and deals for random bars.
				<?php } ?>
				<?php foreach($events as $bar => $deals) {   ?>
					<dt><?php echo $bar;?></dt>
						<?php foreach($deals as $d) { ?>
							<dd><?php echo $d;?></dd>
						<?php } ?>
				<?php } ?>
			</dl>
			
			<?php if($this->session->userdata('uid') && isset($nonfave_events) && count($nonfave_events) > 0) { ?>
				<dl>
					<!-- NON-FAVORITE EVENTS - for logged-in users -->
					<?php if(!isset($no_favorites)) {
						foreach($nonfave_events as $bar => $deals) { ?>
						<dt><?php echo $bar;?></dt>
							<?php foreach($deals as $d) { ?>
								<dd><?php echo $d;?></dd>
							<?php } ?>
					<?php }
					} ?>
				</dl>
			<?php } ?>
		</div>
	</div>
	
</div>
<!-- End contentWrapper -->
