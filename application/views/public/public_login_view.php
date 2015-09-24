<h1>Member Login</h1>
<hr><br />
<p>Please login with your email address and password below.</p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/login");?>

  <p>
		<?php
			echo form_label('Email Address:', 'identity');
			$data = array(
				'name' 	=> 'identity',
				'id' 		=> 'identity'
			);
			echo form_input($data);
		?>
  </p>
	<br />
  <p>
    <label for="password">Password:</label>
    <?php
			$data = array(
				'name' 	=> 'password',
				'id' 		=> 'password'
			);
			echo form_password($data);
		?>
  </p>
	<br />
	<p><?php 
						$submit_data = array(
						'name' => 'Submit',
						'type' => 'submit',
						'value' => 'Login',
						'style' =>'width:100px; margin 0px auto'
						);
					echo form_submit($submit_data);?></p>

<?php echo form_close();?>
<br />
<p>Forgotten password? - <a href="general/forgot_password">Click here to reset</a></p>