<div id="logon_form">
	<p class="heading">Account Sign-up</p>
	<p><a href="">Link</a></p>
	
	<?php echo form_open('signup/submit')?>
		<?php echo validation_errors('<p class="error">','</p>')?>
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
			<label for="name">Name: </label>
			<?php echo form_input('name', set_value('name'));?>
		</p>
		<p>
			<label for="email">Email: </label>
			<?php echo form_input('email', set_value('email'));?>
		</p>
		<p>
			<label for="type">What type of account do you want? </label>
			<?php 
				$options = array('u' => 'User', 'o' => 'Bar owner/employee');
				echo form_dropdown('type', $options);
			?>
		</p>
		<p>
			<?php echo form_submit('submit', 'Create Account');?>
		</p>
	<?php echo form_close();?>
</div>