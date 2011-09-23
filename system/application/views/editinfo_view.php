<!-- Begin contentWrapper -->
<div id="contentWrapper">
	<!-- Begin 2 column content -->
	<div id="content">
		<?php if(!$is_bar) { ?>
		
			<!-- 
				USER
			-->
			<section class="post clearfix">
				<!-- Page layout: Default -->
				<h2>Edit Information</h2>
	
				<div class="page-chunk default">
					<?php echo form_open('editinfo/submit')?>
						<?php echo validation_errors('<p class="error">','</p>')?>
						<p>
							<label for="first_name">First Name: </label>
							<?php echo form_input('first_name', set_value('first_name', $user_model->get_first_name() ));?>
						</p>
						<p>
							<label for="last_name">Last Name: </label>
							<?php echo form_input('last_name', set_value('last_name', $user_model->get_last_name() ));?>
						</p>
						<p>
							<label for="dob">Date of Birth (yyyy-mm-dd): </label><br/>
							<?php 
								$options = array('type' => 'text', 'id' => 'dob', 'name' => 'dob', 'maxlength' => 10);
								echo form_input($options, set_value('dob', $user_model->get_dob() ));
							?>
						</p>
						<p>
							<label for="city">City: </label>
							<?php echo form_input('city', set_value('city', $user_model->get_city() ));?>
						</p>
						<p>
							<label for="state">State: </label>
							<?php echo form_dropdown('state', get_state_list(), set_value('state', $user_model->get_state() )); ?>
						</p>
						<p>
							<label for="security_question">Security Question: </label>
							<?php echo form_dropdown('security_question', $security_questions, $user_model->get_security_id()); ?>
						</p>
						<p>
							<label for="security_answer">Security Answer: </label>
							<?php
								$options = array('name' => 'security_answer', 'size' => 30, 'max_length' => 30);
								echo form_input($options, set_value('security_answer', $user_model->get_security_answer())); 
							?>
						</p>
						<p>
							<?php echo form_submit('submit', 'Update');?>
						</p>
					<?php echo form_close();?>
				</div>
				
				
	
			</section>
		</div>
		<!-- End 2 column content -->
		<aside>
			<h2>Change Password</h2>
			<!-- CHANGE PASSWORD FORM -->
			<div class="page-chunk default">
				<?php echo form_open('changepassword'); ?>
					<p>
						<label for="password">Current password: </label>
						<?php echo form_password('password'); ?>
					</p>
					<p>
						<label for="new_password">New password: </label><br/>
						<?php echo form_password('new_password');?>
					</p>
					<p>
						<label for="new_password_conf">Confirm new password: </label>
						<?php echo form_password('new_password_conf');?>
					</p>
					<p>
						<?php echo form_submit('submit', 'Change Password');?>
					</p>
				<?php echo form_close(); ?>
			</div>
		</aside>
	<?php } else { ?>
		<!--
			BAR
		-->
		<section class="post clearfix">
				<!-- Page layout: Default -->
				<h2>Edit Information</h2>

				<div class="page-chunk default">
					<?php echo form_open('editinfo/submit')?>
						<?php echo validation_errors('<p class="error">','</p>')?>
						<p>
							<label for="name">Bar Name: </label>
							<?php echo form_input('name', set_value('name', $bar_model->get_name() ));?>
						</p>
						<p>
							<label for="address">Bar Address: </label>
							<?php echo form_input('address', set_value('address', $bar_model->get_address() ));?>
						</p>
						<p>
							<label for="city">City: </label>
							<?php echo form_input('city', set_value('city', $bar_model->get_city() ));?>
						</p>
						<p>
							<label for="state">State: </label>
							<?php echo form_dropdown('state', get_state_list(), set_value('state', $bar_model->get_state() )); ?>
						</p>
						<p>
							<label for="zip">Zip Code: </label>
							<?php echo form_input('zip', set_value('zip', $bar_model->get_zip() ));?>
						</p>
						<p>
							<label for="email">Email: </label>
							<?php echo form_input('email', set_value('email', $bar_model->get_email() ));?>
						</p>
						<p>
							<label for="security_question">Security Question: </label>
							<?php echo form_dropdown('security_question', $security_questions, $bar_model->get_security_id()); ?>
						</p>
						<p>
							<label for="security_answer">Security Answer: </label>
							<?php
								$options = array('name' => 'security_answer', 'size' => 30, 'max_length' => 30);
								echo form_input($options, set_value('security_answer', $bar_model->get_security_answer())); 
							?>
						</p>
						<p>
							<?php echo form_submit('submit', 'Update');?>
						</p>
					<?php echo form_close();?>
				</div>
				
				
	
			</section>
		</div>
		<!-- End 2 column content -->
		<aside>
			<!-- CHANGE PASSWORD FORM -->
			<h2>Change Password</h2>
			<div class="page-chunk default">
				<?php echo form_open('changepassword'); ?>
					<p>
						<label for="password">Current password: </label>
						<?php echo form_password('password'); ?>
					</p>
					<p>
						<label for="new_password">New password: </label><br/>
						<?php echo form_password('new_password');?>
					</p>
					<p>
						<label for="new_password_conf">Confirm new password: </label>
						<?php echo form_password('new_password_conf');?>
					</p>
					<p>
						<?php echo form_submit('submit', 'Change Password');?>
					</p>
				<?php echo form_close(); ?>
			</div>
		</aside>
	<?php } ?>
			
</div>
<!-- End contentWrapper -->
