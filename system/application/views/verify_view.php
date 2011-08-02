<!-- Begin contentWrapper -->
<div id="contentWrapper">
	<!-- Begin 2 column content -->
	<div id="content">
		<p id="forum_breadcrumbs">
			<span class="current">Bar Verification</span>
		</p>
	
		<section class="post clearfix">
			<!-- Page layout: Default -->
			<h2>
				<cufon class="cufon cufon-canvas" alt="Home" style="width: 51px; height: 24px; ">
					<canvas width="64" height="29" style="width: 64px; height: 29px; top: -3px; left: -2px; "></canvas>
					<cufontext>Bar Verification</cufontext>
				</cufon>
			</h2>


			<div class="page-chunk default">
				<table>
					<tr>
						<td>Bar ID</td><td>Bar Name</td><td>Address</td><td>Reference</td><td></td>
					</tr>
					<?php
						foreach($bars as $b) {?>
							<tr>
								<td><?php echo $b[0]; ?></td>
								<td><?php echo $b[1]; ?></td>
								<td><?php echo $b[2]; ?></td>
								<td><?php echo $b[3]; ?></td>
								<td>
									<?php 
										echo form_open('verify/accept');
										$hidden_atts = array('bar_id' => $b[0]);
										echo form_hidden($hidden_atts);
										$verify_atts = array('class' => 'verify', 'name' => 'verify', 'value' => 'verify');
										echo form_submit($verify_atts);
										echo form_close();
									?>
								</td>
							</tr>
					<?php }
					?>
				</table>
			</div>

		</section>
	</div>
	<!-- End 2 column content -->
	<aside>
		<div id="navigation">
			<h2>
				<cufon class="cufon cufon-canvas" alt="Navigation" style="width: 94px; height: 24px; ">
					<canvas width="106" height="29" style="width: 106px; height: 29px; top: -3px; left: -2px; "></canvas>
					<cufontext>Navigation</cufontext>
				</cufon>
			</h2>
			<ul>
				
			</ul>
		</div>
	</aside>

			
</div>
<!-- End contentWrapper -->
