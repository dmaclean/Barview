<h1>Forgot Password</h1>
<?php if($is_bar) { ?>

	<?php echo form_open('forgotpassword/submit'); ?>
		<?php echo form_hidden('action', $action); ?>
		<?php echo validation_errors('<div class="alert-message error"><p><strong>','</strong></p></div>')?>
		
		<?php if($action == "initial") { ?>
			<div class="clearfix">
				<label for="email">Please enter your username: </label>
				<div class="input">
				<?php 
					$args = array('class' => 'xlarge', 'type' => 'text', 'name' => 'username', 'id' => 'username', 'size' => 30, 'max_length' => 30);
					echo form_input($args, set_value('username'));
				?>
				</div>
			</div>
		<?php } else if($action == "show_question") { ?>
			<?php echo form_hidden('username', $username); ?>
			<p>
				<label for="answer"><?php echo $question ?>: </label>
				<?php 
					$args = array('name' => 'answer', 'id' => 'answer', 'size' => 30, 'max_length' => 30);
					echo form_input($args, set_value('answer'));
				?>
			</p>
		<?php } else if($action == "show_password") { ?>
			<?php echo form_hidden('username', $username); ?>
			<p>
				<label for="password">Your Password: </label><?php echo $password; ?>
			</p>
		<?php } ?>
		
		<?php if($action != "show_password") { ?>
			<div class="actions">
				<?php 
					$options = array('name' => 'submit', 'value' => 'Submit', 'class' => 'btn primary');
					echo form_submit($options);
				?>
			</div>
		<?php } ?>
	<?php echo form_close();?>
	
<?php } else { ?>
	<?php echo form_open('forgotpassworduser/submit'); ?>
		<?php echo form_hidden('action', $action); ?>
		<?php echo validation_errors('<p class="error">','</p>')?>
		
		<?php if($action == "initial") { ?>
			<div class="clearfix">
				<label for="email">Please enter your email address: </label>
				<div class="input">
				<?php 
					$args = array('class' => 'xlarge', 'type' => 'text', 'name' => 'email', 'id' => 'email', 'size' => 30, 'max_length' => 30);
					echo form_input($args, set_value('email'));
				?>
				</div>
			</div>
		<?php } else if($action == "show_question") { ?>
			<?php echo form_hidden('email', $email); ?>
			<div class="clearfix">
				<label for="answer"><?php echo $question ?>: </label>
				<div class="input">
				<?php 
					$args = array('class' => 'xlarge', 'name' => 'answer', 'id' => 'answer', 'size' => 30, 'max_length' => 30);
					echo form_input($args, set_value('answer'));
				?>
				</div>
			</div>
		<?php } else if($action == "show_password") { ?>
			<?php echo form_hidden('email', $email); ?>
			<div class="clearfix">
				<label for="password">Your Password: </label>
				<div class="input">
					<span class="uneditable-input"><?php echo $password; ?></span>
				</div>
			</div>
		<?php } ?>
		
		<?php if($action != "show_password") { ?>
			<div class="actions">
				<?php 
					$options = array('name' => 'submit', 'value' => 'Submit', 'class' => 'btn primary');
					echo form_submit($options);
				?>
			</div>
		<?php } ?>
	<?php echo form_close();?>
<?php } ?>