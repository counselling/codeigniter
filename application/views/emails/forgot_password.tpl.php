<html>
<body>
	<p style="font:34pt Casper Open SF;color:blue">Counselling</p>
	<h2>Reset Password for <?php echo $first_name.' '.$last_name;?></h2>
	<p>You are receiving this email because we have received a request to reset your password.</p>
	<p>If you did not make this request you may simply ignore this email, your password will not be changed.</p>
	<p>If you do wish to change your password please click the link below which will take you to our website where you will be able to change your password.</p>
	<p>Please click this link to <?php echo anchor('general/reset_password/'. $forgotten_password_code, 'Reset Your Password');?>.</p>
	<br/>
	<p>Counselling Ltd</p>
</body>
</html>