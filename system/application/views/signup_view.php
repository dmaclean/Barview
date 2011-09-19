<!-- Begin contentWrapper -->
<div id="contentWrapper">
	<!-- Begin 2 column content -->
	<div id="content">
		<p id="forum_breadcrumbs">
			<span class="current">Search Results</span>
		</p>
	
		<section class="post clearfix">
			<!-- Page layout: Default -->
			<h2>
				<cufon class="cufon cufon-canvas" alt="Home" style="width: 51px; height: 24px; ">
					<canvas width="64" height="29" style="width: 64px; height: 29px; top: -3px; left: -2px; "></canvas>
					<cufontext>Bar Registration</cufontext>
				</cufon>
			</h2>


			<div class="page-chunk default">
				<?php echo form_open('signup/submit')?>
					<?php echo validation_errors('<p class="error">','</p>')?>
					<p>
						<label for="name">Bar Name: </label>
						<?php echo form_input('name', set_value('name'));?>
					</p>
					<p>
						<label for="address">Bar Address: </label>
						<?php echo form_input('address', set_value('address'));?>
					</p>
					<p>
						<label for="city">City: </label>
						<?php echo form_input('city', set_value('city'));?>
					</p>
					<p>
						<label for="state">State: </label>
						<?php echo form_input('state', set_value('state'));?>
					</p>
					<p>
						<label for="zip">Zip Code: </label>
						<?php echo form_input('zip', set_value('zip'));?>
					</p>
					<p>
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
					</p>
					<p>
						<label for="email">Email: </label>
						<?php echo form_input('email', set_value('email'));?>
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
						<label for="reference">Business Reference: </label>
						<?php echo form_input('reference', set_value('reference')); ?>
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
