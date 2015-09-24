<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 19/05/2015
 * Time: 06:53
 */
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>

<body>

	<p style="font:34pt Casper Open SF;color:blue">Counselling</p>

	<h2>Problem with recurring PayPal payment for <?php echo $first_name.' '.$last_name;?></h2>

<p>According to the records we hold for you your membership was due to be renewed on <?php echo date("d/m/Y",strtotime($expire)) ?>.</p>

<p>The annual contribution to Counselling of &pound;10.50 which should have been made via paypal has not yet been received.</p>

<p>Please renew your paypal payment in order to remain a registered member of Counselling.</p>

<p>Failure to renew your membership within one month will result in your details being removed from our listings.</p>

<p>Thank you.</p><br />

<p>Paul</p>
<p>Membership Director</p>

</body>

</html>