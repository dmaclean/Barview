
<div class="container">
	<div id="row">
		<div class="span16 columns">
			<div class="home_header">
				<h1>Bar Verification</h1>
			</div>
		
				<table class="zebra-striped">
					<thead>
					<tr>
						<th>Bar ID</th><th>Bar Name</th><th>Address</th><th colspan="2">Reference</th>
					</tr>
					</thead>
					<tbody>
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
										$verify_atts = array('class' => 'btn primary', 'name' => 'verify', 'value' => 'verify');
										echo form_submit($verify_atts);
										echo form_close();
									?>
								</td>
							</tr>
					<?php }
					?>
					</tbody>
				</table>
	</div>		
</div>