<!-- Begin contentWrapper -->
<div id="contentWrapper">
	<!-- Begin 2 column content -->
	<div id="content">
		<section class="post clearfix">
			<!-- Page layout: Default -->
			<h2>Forgot Password</h2>

			<div class="page-chunk default">
				<?php if($is_bar) { ?>
				
					<?php echo form_open('forgotpassword/submit'); ?>
						<?php echo form_hidden('action', $action); ?>
						<?php echo validation_errors('<p class="error">','</p>')?>
						
						<?php if($action == "initial") { ?>
							<p>
								<label for="email">Please enter your username: </label>
								<?php 
									$args = array('name' => 'username', 'id' => 'username', 'size' => 30, 'max_length' => 30);
									echo form_input($args, set_value('username'));
								?>
							</p>
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
							<p>
								<?php echo form_submit('submit', 'Submit');?>
							</p>
						<?php } ?>
					<?php echo form_close();?>
					
				<?php } else { ?>
					<?php echo form_open('forgotpassworduser/submit'); ?>
						<?php echo form_hidden('action', $action); ?>
						<?php echo validation_errors('<p class="error">','</p>')?>
						
						<?php if($action == "initial") { ?>
							<p>
								<label for="email">Please enter your email address: </label>
								<?php 
									$args = array('name' => 'email', 'id' => 'email', 'size' => 30, 'max_length' => 30);
									echo form_input($args, set_value('email'));
								?>
							</p>
						<?php } else if($action == "show_question") { ?>
							<?php echo form_hidden('email', $email); ?>
							<p>
								<label for="answer"><?php echo $question ?>: </label>
								<?php 
									$args = array('name' => 'answer', 'id' => 'answer', 'size' => 30, 'max_length' => 30);
									echo form_input($args, set_value('answer'));
								?>
							</p>
						<?php } else if($action == "show_password") { ?>
							<?php echo form_hidden('email', $email); ?>
							<p>
								<label for="password">Your Password: </label><?php echo $password; ?>
							</p>
						<?php } ?>
						
						<?php if($action != "show_password") { ?>
							<p>
								<?php echo form_submit('submit', 'Submit');?>
							</p>
						<?php } ?>
					<?php echo form_close();?>
				<?php } ?>
			</div>
			
		</section>
	</div>
</div>
<!-- End contentWrapper -->
