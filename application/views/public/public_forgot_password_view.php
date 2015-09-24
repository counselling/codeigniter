<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 16/05/2015
 * Time: 17:42
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>Forgot Password</h1>
<hr /><br />
<p>Please enter your Email Address so we can send you an email to reset your password.</p>
	<div id="infoMessage"><?php echo (validation_errors()) ? validation_errors() : $this->session->flashdata('message');?></div>
<br />
<?php echo form_open("general/forgot_password");?>
	<p>
		<?php echo form_label('Email Address:*', 'email');
		$data = array
		(
			'name' => 'email',
			'id' => 'email',
			'value' => '',
			'title' => 'Enter your currently registered email address'
		);

		echo form_input($data);?>
	</p>
	<br />
	<p><?php echo form_submit('submit', 'Submit');?></p>
<?php echo form_close();?>