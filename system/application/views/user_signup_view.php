<!-- Begin contentWrapper -->
<div id="contentWrapper">
	<!-- Begin 2 column content -->
	<div id="content">
		<section class="post clearfix">
			<!-- Page layout: Default -->
			<h2>
				<cufon class="cufon cufon-canvas" alt="Home" style="width: 51px; height: 24px; ">
					<canvas width="64" height="29" style="width: 64px; height: 29px; top: -3px; left: -2px; "></canvas>
					<cufontext>User Registration</cufontext>
				</cufon>
			</h2>


			<div class="page-chunk default">
				<?php echo form_open('usersignup/submit')?>
					<?php echo validation_errors('<p class="error">','</p>')?>
					<p>
						<label for="first_name">First Name: </label>
						<?php echo form_input('first_name', set_value('first_name'));?>
					</p>
					<p>
						<label for="last_name">Last Name: </label>
						<?php echo form_input('last_name', set_value('last_name'));?>
					</p>
					<p>
						<label for="email">Email: </label>
						<?php echo form_input('email', set_value('email'));?>
					</p>
					<p>
						<label for="password">Password: </label>
						<?php echo form_password('password');?>
					</p>
					<p>
						<label for="password_conf">Confirm password: </label>
						<?php echo form_password('password_conf');?>
					</p>
					<p>
						<label for="dob">Date of Birth (yyyy-mm-dd): </label>
						<?php 
							$options = array('type' => 'text', 'id' => 'dob', 'name' => 'dob', 'maxlength' => 10);
							echo form_input($options, set_value('dob'));
						?>
					</p>
					<p>
						<label for="city">City: </label>
						<?php echo form_input('city', set_value('city'));?>
					</p>
					<p>
						<label for="state">State: </label>
						<?php echo form_dropdown('state', get_state_list(), set_value('state'));?>
					</p>
					<p>
						<label for="security_question">Security Question: </label>
						<?php echo form_dropdown('security_question', $security_questions); ?>
					</p>
					<p>
						<label for="security_answer">Security Answer: </label>
						<?php
							$options = array('name' => 'security_answer', 'size' => 30, 'max_length' => 30);
							echo form_input($options); 
						?>
					</p>
					<p>
						<?php echo form_submit('submit', 'Create Account');?>
					</p>
				<?php echo form_close();?>
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
