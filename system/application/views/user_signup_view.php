<h1>User Registration</h1>


			<div class="span16">
				<?php echo form_open('usersignup/submit')?>
					<?php echo validation_errors('<div class="alert-message error"><p><strong>','</strong></p></div>')?>
					<div class="clearfix">
						<label for="first_name">First Name: </label>
						<div class="input">
							<?php 
								$options = array('class' => 'xlarge', 'type'=>'text', 'id' => 'first_name', 'name' => 'first_name', 'maxlength'=>20);
								echo form_input($options, set_value('first_name'));
							?>
						</div>
					</div>
					
					<div class="clearfix">
						<label for="last_name">Last Name: </label>
						<div class="input">
							<?php 
								$options = array('class' => 'xlarge', 'type'=>'text', 'id' => 'last_name', 'name' => 'last_name', 'maxlength'=>30);
								echo form_input($options, set_value('last_name'));
							?>
						</div>
					</div>
					
					<div class="clearfix">
						<label for="email">Email: </label>
						<div class="input">
							<?php 
								$options = array('class' => 'xlarge', 'type'=>'text', 'id' => 'email', 'name' => 'email');
								echo form_input($options, set_value('email'));
							?>
						</div>
					</div>
					
					<div class="clearfix">
						<label for="password">Password: </label>
						<div class="input">
							<?php 
								$options = array('class' => 'xlarge', 'type'=>'password', 'id' => 'password', 'name' => 'password');
								echo form_password($options);
							?>
						</div>
					</div>
					
					<div class="clearfix">
						<label for="password_conf">Confirm password: </label>
						<div class="input">
							<?php
								$options = array('class' => 'xlarge', 'type'=>'password', 'id' => 'password_conf', 'name' => 'password_conf');
								echo form_password($options);
							?>
						</div>
					</div>
					
					<div class="clearfix">
						<label for="dob">Date of Birth (yyyy-mm-dd): </label>
						<div class="input">
						<?php 
							$options = array('class' => 'xlarge', 'type' => 'text', 'id' => 'dob', 'name' => 'dob', 'maxlength' => 10);
							echo form_input($options, set_value('dob'));
						?>
						</div>
					</div>
					
					<div class="clearfix">
						<label for="city">City: </label>
						<div class="input">
							<?php 
								$options = array('class' => 'xlarge', 'type' => 'text', 'id' => 'city', 'name' => 'city', 'maxlength' => 20);
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
							echo form_input($options, set_value('security_answer')); 
						?>
						</div>
					</div>
					
					<fieldset>
						<legend>Just a couple questions...</legend>
						
						<?php foreach($user_questions as $k => $q) { ?>
							<div class="clearfix">
								<label for="q<?php echo $k; ?>"><?php echo $q['question'] ?></label>
								<div class="input">
									<?php 
										$qfield = 'q'.$k;
										echo form_dropdown($qfield, $q['options'], set_value($qfield)); 
									?>
								</div>
							</div>
						<?php } ?>
					</fieldset>
					<div class="actions">
						<?php 
							$options = array('class' => 'btn primary', 'name' => 'submit', 'value' => 'Create Account');
							echo form_submit($options);
						?>
					</div>
				<?php echo form_close();?>
			</div>

		</section>
	</div>
