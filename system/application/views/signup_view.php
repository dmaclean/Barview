<h1>Bar Registration</h1>
	<div class="span16">
		<?php echo form_open('signup/submit')?>
			<?php echo validation_errors('<div class="alert-message error"><p><strong>','</strong></p></div>')?>
			<div class="clearfix">
				<label for="name">Bar Name: </label>
				<div class="input">
					<?php 
						$options = array('class' => 'xlarge', 'type'=>'text', 'id' => 'name', 'name' => 'name', 'maxlength'=>20);
						echo form_input($options, set_value('name'));
					?>
				</div>
			</div>
			<div class="clearfix">
				<label for="address">Bar Address: </label>
				<div class="input">
					<?php 
						$options = array('class' => 'xlarge', 'type'=>'text', 'id' => 'address', 'name' => 'address', 'maxlength'=>40);
						echo form_input($options, set_value('address'));
					?>
				</div>
			</div>
			<div class="clearfix">
				<label for="address">City: </label>
				<div class="input">
					<?php 
						$options = array('class' => 'xlarge', 'type'=>'text', 'id' => 'city', 'name' => 'city', 'maxlength'=>20);
						echo form_input($options, set_value('city'));
					?>
				</div>
			</div>
			<div class="clearfix">
				<label for="state">State: </label>
				<div class="input">
					<?php echo form_dropdown('state', get_state_list(), set_value('state')); ?>
				</div>
			</div>
			<div class="clearfix">
				<label for="address">Zip Code: </label>
				<div class="input">
					<?php 
						$options = array('class' => 'xlarge', 'type'=>'text', 'id' => 'zip', 'name' => 'zip', 'maxlength'=>10);
						echo form_input($options, set_value('zip'));
					?>
				</div>
			</div>
			<div class="clearfix">
				<label for="username">Username: </label>
				<div class="input">
					<?php 
						$options = array('class' => 'xlarge', 'type'=>'text', 'id' => 'username', 'name' => 'username', 'maxlength'=>30);
						echo form_input($options, set_value('username'));
					?>
				</div>
			</div>
			<div class="clearfix">
				<label for="password">Password: </label>
				<div class="input">
					<?php 
						$options = array('class' => 'xlarge', 'type'=>'password', 'id' => 'password', 'name' => 'password', 'maxlength'=>20);
						echo form_input($options, set_value('password'));
					?>
				</div>
			</div>
			<div class="clearfix">
				<label for="password_conf">Confirm password: </label>
				<div class="input">
					<?php 
						$options = array('class' => 'xlarge', 'type'=>'password', 'id' => 'password_conf', 'name' => 'password_conf', 'maxlength'=>20);
						echo form_input($options, set_value('password_conf'));
					?>
				</div>
			</div>
			<div class="clearfix">
				<label for="email">Email: </label>
				<div class="input">
					<?php 
						$options = array('class' => 'xlarge', 'type'=>'text', 'id' => 'email', 'name' => 'email', 'maxlength' => 30);
						echo form_input($options, set_value('email'));
					?>
				</div>
			</div>
			<div class="clearfix">
				<label for="security_question">Security Question: </label>
				<div class="input">
					<?php echo form_dropdown('security_question', $security_questions); ?>
				</div>
			</div>
			
			<div class="clearfix">
				<label for="security_answer">Security Answer: </label>
				<div class="input">
				<?php
					$options = array('name' => 'security_answer', 'size' => 30, 'max_length' => 30);
					echo form_input($options); 
				?>
				</div>
			</div>
			<div class="clearfix">
				<label for="reference">Business Reference URL (yelp.com, etc.): </label>
				<div class="input">
					<?php 
						$options = array('class' => 'xlarge', 'type'=>'text', 'id' => 'reference', 'name' => 'reference', 'maxlength' => 200);
						echo form_input($options, set_value('reference'));
					?>
				</div>
			</div>
			<div class="clearfix">
				<label for="terms">I have read and agree to the <a href="<?php echo base_url(); ?>tos.html">Terms of Use</a>: </label>
				<div class="input">
					<?php 
						$options = array('name' => 'terms', 'id' => 'terms', 'value' => 'accept', 'checked' => FALSE);
						echo form_checkbox($options);
					?>
				</div>
			</div>
			
			<div class="actions">
				<?php 
					$options = array('class' => 'btn primary', 'name' => 'submit', 'value' => 'Create Account');
					echo form_submit($options);
				?>
			</div>
		<?php echo form_close();?>
	</div>
</div>
<!-- End contentWrapper -->
