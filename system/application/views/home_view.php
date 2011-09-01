<!-- Begin contentWrapper -->
<div id="contentWrapper">
			
	<div class="colmask threecol">
		<div class="colmid">
			<div class="colleft">
				<!-- Middle column -->
				<div class="col1">
					<?php if($this->session->userdata('uid')) { ?>
						Feeds from your favorites
					<?php } else { ?>
						<div class="home_header">Current Feeds</div>
					<?php } ?>
					<ul>
						<?php if(isset($no_favorites) && $no_favorites) { ?>
							You don't have any favorite bars yet, so we'll show you some feeds from random bars.
						<?php } 
							foreach($bars as $b) { 
								$entry = $b['name'].' ('.$b['city'].', '.$b['state'].')';
							?>
							<li>
								<div><?php echo $entry; ?></div>
								<div><img id="<?php echo $b['bar_id']; ?>" class="bar_image" src="broadcast_images/<?php echo $b['bar_id']; ?>.jpg"/></div>
							</li>
						<?php } ?>
					</ul>
				</div>
				<!-- Left column (Favorites or just all the bars) -->
				<div class="col2">
					<div class="home_header">
					<?php if($this->session->userdata('uid')) { ?>
						Your Favorites
					<?php } else { ?>
						Bar-view Bars
					<?php } ?>
					</div>
					<ul>
					<?php foreach($bars as $b) {   
						$entry = $b['name'].' ('.$b['city'].', '.$b['state'].')';
						?>
						<li><?php echo $entry; ?></li>
					<?php } ?>
					</ul>
				</div>
				<!-- Right column (Current deals) -->
				<div class="col3">
					<div class="home_header">Current Deals and Events</div>
					<ul>
						<?php if(isset($no_favorites) && $no_favorites) { ?>
							You don't have any favorite bars yet, so we'll show you some events and deals for random bars.
						<?php } ?>
						<?php foreach($events as $e) {   
							$entry = $e['name'].' - '.$e['detail'];
							?>
							<li><?php echo $entry; ?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
</div>
<!-- End contentWrapper -->
