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
				<h2>
					<cufon class="cufon cufon-canvas" alt="Home" style="width: 51px; height: 24px; ">
						<canvas width="64" height="29" style="width: 64px; height: 29px; top: -3px; left: -2px; "></canvas>
						<cufontext>Edit Information</cufontext>
					</cufon>
				</h2>
	
	
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
						<!--<p>
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
						</p>-->
						<p>
							<label for="dob">Date of Birth: </label>
							<?php echo form_input('dob', set_value('dob', $user_model->get_dob() ));?>
						</p>
						<p>
							<label for="city">City: </label>
							<?php echo form_input('city', set_value('city', $user_model->get_city() ));?>
						</p>
						<p>
							<label for="state">State: </label>
							<?php echo form_input('state', set_value('state', $user_model->get_state() ));?>
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
	<?php } else { ?>
		<!--
			BAR
		-->
		<section class="post clearfix">
				<!-- Page layout: Default -->
				<h2>
					<cufon class="cufon cufon-canvas" alt="Home" style="width: 51px; height: 24px; ">
						<canvas width="64" height="29" style="width: 64px; height: 29px; top: -3px; left: -2px; "></canvas>
						<cufontext>Edit Information</cufontext>
					</cufon>
				</h2>
	
	
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
							<?php echo form_input('state', set_value('state', $bar_model->get_state() ));?>
						</p>
						<p>
							<label for="zip">Zip Code: </label>
							<?php echo form_input('zip', set_value('zip', $bar_model->get_zip() ));?>
						</p>
						<!--<p>
							<label for="username">Username: </label>
							<?php echo form_input('username', set_value('username'));?>
						</p>
						<p>
							<label for="password">Password: </label>
							<?php echo form_password('password');?>
						</p>
						<p>
							<label for="password_conf">Confirm password: </label>
							<?php echo form_password('password_conf');?>
						</p>-->
						<p>
							<label for="email">Email: </label>
							<?php echo form_input('email', set_value('email', $bar_model->get_email() ));?>
						</p>
						<!--<p>
							<label for="reference">Business Reference: </label>
							<?php echo form_input('reference', set_value('reference')); ?>
						</p>-->
						<p>
							<?php echo form_submit('submit', 'Update');?>
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
	<?php } ?>
			
</div>
<!-- End contentWrapper -->
