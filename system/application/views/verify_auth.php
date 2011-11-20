<div class="container">
	<div class="row">
		<div class="span16 columns">
			<div class="home_header">
				<h1>Bar Verification</h1>
			</div>
			<?php echo form_open('verify/submit'); ?>
				<div class="clearfix">
					<label for="password">Password: </label>
					<div class="input">
						<?php 
							$options = array('class' => 'xlarge', 'type'=>'password', 'id' => 'password', 'name' => 'password');
							echo form_password($options);
						?>
					</div>
					<div class="actions">
						<?php 
							$options = array('class' => 'btn primary', 'name' => 'submit', 'value' => 'Login');
							echo form_submit($options);
						?>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>