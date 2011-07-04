<div id="logon_form">
	<p class="heading">Account Sign-up</p>
	<p><a href="">Link</a></p>
	
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
			<?php echo form_submit('submit', 'Create Account');?>
		</p>
	<?php echo form_close();?>
</div>