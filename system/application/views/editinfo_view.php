<?php if(!$is_bar) { ?>
		
		<!-- 
			USER
		-->				
		<?php echo form_open('editinfo/submit')?>
			<?php echo validation_errors('<div class="alert-message error"><p><strong>','</strong></p></div>')?>
			<fieldset>
				<legend>Edit Information</legend>
				<div class="clearfix">
					<label for="first_name">First Name: </label>
					<div class="input">
						<?php 
							$options = array('class'=>'xlarge', 'type'=>'text','id'=>'first_name','name'=>'first_name','maxlength'=>20);
							echo form_input($options, set_value('first_name', $user_model->get_first_name() ));
						?>
					</div>
				</div>
				<div class="clearfix">
					<label for="last_name">Last Name: </label>
					<div class="input">
						<?php 
							$options = array('class'=>'xlarge', 'type'=>'text','id'=>'last_name','name'=>'last_name','maxlength'=>30);
							echo form_input($options, set_value('last_name', $user_model->get_last_name() ));
						?>
					</div>
				</div>
				<div class="clearfix">
					<label for="dob">Date of Birth (yyyy-mm-dd): </label>
					<div class="input">
					<?php 
						$options = array('class'=>'span2','type' => 'text', 'id' => 'dob', 'name' => 'dob', 'maxlength' => 10);
						echo form_input($options, set_value('dob', $user_model->get_dob() ));
					?>
					</div>
				</div>
				<div class="clearfix">
					<label for="city">City: </label>
					<div class="input">
						<?php 
							$options = array('class'=>'xlarge', 'type'=>'text','id'=>'city','name'=>'city','maxlength'=>20);
							echo form_input($options, set_value('city', $user_model->get_city() ));
						?>
					</div>
				</div>
				<div class="clearfix">
					<label for="state">State: </label>
					<div class="input">
					<?php echo form_dropdown('state', get_state_list(), set_value('state', $user_model->get_state() )); ?>
					</div>
				</div>
				<div class="clearfix">
					<label for="security_question">Security Question: </label>
					<div class="input">
					<?php echo form_dropdown('security_question', $security_questions, $user_model->get_security_id()); ?>
					</div>
				</div>
				<div class="clearfix">
					<label for="security_answer">Security Answer: </label>
					<div class="input">
					<?php
						$options = array('class'=>'xlarge', 'type'=>'text','name' => 'security_answer', 'maxlength' => 30);
						echo form_input($options, set_value('security_answer', $user_model->get_security_answer())); 
					?>
					</div>
				</div>
				<div class="actions">
					<?php
						$options = array('name'=>'submit','value'=>'Update','class'=>'btn primary');
						echo form_submit($options);
					?>
				</div>
			</fieldset>
		<?php echo form_close();?>
	<?php } else { ?>
		<!--
			BAR
		-->
		<?php echo form_open('editinfo/submit')?>
			<?php echo validation_errors('<div class="alert-message error"><p><strong>','</strong></p></div>')?>
			<fieldset>
				<legend>Edit Information</legend>
				<div class= "clearfix">
					<label for="name">Bar Name: </label>
					<div class="input">
						<?php echo form_input('name', set_value('name', $bar_model->get_name() ));?>
					</div>
				</div>
				<div class="clearfix">
					<label for="address">Bar Address: </label>
					<div class="input">
						<?php echo form_input('address', set_value('address', $bar_model->get_address() ));?>
					</div>
				</div>
				<div class="clearfix">
					<label for="city">City: </label>
					<div class="input">
						<?php echo form_input('city', set_value('city', $bar_model->get_city() ));?>
					</div>
				</div>
				<div class="clearfix">
					<label for="state">State: </label>
					<div class="input">
						<?php echo form_dropdown('state', get_state_list(), set_value('state', $bar_model->get_state() )); ?>
					</div>
				</div>
				<div class="clearfix">
					<label for="zip">Zip Code: </label>
					<div class="input">
						<?php echo form_input('zip', set_value('zip', $bar_model->get_zip() ));?>
					</div>
				</div>
				<div class="clearfix">
					<label for="email">Email: </label>
					<div class="input">
						<?php echo form_input('email', set_value('email', $bar_model->get_email() ));?>
					</div>
				</div>
				<div class="clearfix">
					<label for="security_question">Security Question: </label>
					<div class="input">
						<?php echo form_dropdown('security_question', $security_questions, $bar_model->get_security_id()); ?>
					</div>
				</div>
				<div class="clearfix">
					<label for="security_answer">Security Answer: </label>
					<div class="input">
					<?php
						$options = array('name' => 'security_answer', 'size' => 30, 'max_length' => 30);
						echo form_input($options, set_value('security_answer', $bar_model->get_security_answer())); 
					?>
					</div>
				</div>
				<div class="actions">
					<?php 
						$options = array('name'=>'submit', 'value'=>'Update', 'class'=>'btn primary');
						echo form_submit($options);
					?>
				</div>
			</fieldset>
		<?php echo form_close();?>
	<?php } ?>
	
	<?php echo form_open('changepassword'); ?>
		<fieldset>
			<legend>Change Password</legend>
			<div class="clearfix">
				<label for="password">Current password: </label>
				<div class="input">
					<?php echo form_password('password'); ?>
				</div>
			</div>
			<div class="clearfix">
				<label for="new_password">New password: </label>
				<div class="input">
					<?php echo form_password('new_password');?>
				</div>
			</div>
			<div class="clearfix">
				<label for="new_password_conf">Confirm new password: </label>
				<div class="input">
					<?php echo form_password('new_password_conf');?>
				</div>
			</div>
			<div class="actions">
				<?php 
					$options = array('name'=>'submit','value'=>'Change Password', 'class'=>'btn primary');
					echo form_submit($options);
				?>
			</div>
		</fieldset>
	<?php echo form_close(); ?>
</div>
