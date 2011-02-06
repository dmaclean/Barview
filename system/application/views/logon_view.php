<div id="logon_form">
	<?php echo anchor('/', 'Barview.com') ?>
	
	<p class="heading">User Login</p>
	
	<?php echo form_open('logon/submit')?>
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
			<?php echo form_submit('submit', 'Login');?>
		</p>
		<p>
			<?php echo anchor('signup', 'Create Account');?>
		</p>
	<?php echo form_close();?>
</div>