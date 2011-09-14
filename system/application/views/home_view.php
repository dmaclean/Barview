<div class="container">
			
	<div class="row">
		<!--  (Favorites or just all the bars) -->
		<div class="span4 columns">
			<div class="home_header">
				<h1>
			<?php if($this->session->userdata('uid')) { ?>
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
				<li><h4><?php echo $bar; ?></h4><?php echo $location; ?></li>
			<?php } ?>
			</ul>
		</div>

		<div class="span6 columns">
			<h1>
			<?php if($this->session->userdata('uid')) { ?>
				Feeds from your favorites
			<?php } else { ?>
				Current Feeds
			<?php } ?>
			</h1>
			<ul class="unstyled">
				<?php if(isset($no_favorites) && $no_favorites) { ?>
					You don't have any favorite bars yet, so we'll show you some feeds from random bars.
				<?php } 
					foreach($bars as $b) { 
						$bar = $b['name'];
						$location = '('.$b['city'].', '.$b['state'].')';
					?>
					<li>
						<div><h4><?php echo $bar; ?></h4><?php echo $location; ?></div>
						<div><img id="<?php echo $b['bar_id']; ?>" class="bar_image" src="<?php echo base_url(); ?>broadcast_images/<?php echo $b['bar_id']; ?>.jpg"/></div>
					</li>
				<?php } ?>
			</ul>
		</div>
		
		<!-- (Current deals) -->
		<div class="span6 columns">
			<h1>Current Deals</h1>
			<dl>
				<?php if(isset($no_favorites) && $no_favorites) { ?>
					You don't have any favorite bars yet, so we'll show you some events and deals for random bars.
				<?php } ?>
				<?php foreach($events as $e) {   ?>
					<dt><?php echo $e['name'];?></dt>
					<dd><?php echo $e['detail'];?></dd>
				<?php } ?>
			</dl>
		</div>
	</div>
	
</div>
<!-- End contentWrapper -->
