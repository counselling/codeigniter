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
<h1>Oooops....</h1>

<hr />

<br /><br />

<b>

<p>A temporary error has occurred on our website while you were adding your <?php echo $error_message?>.</p>
<p>No changes have been made to the information we hold for you at this time.</p>
<p><?php if(isset($message)) echo $message; else echo
	'We apologise for the inconvenience this has caused you. Please try to input the information again.' ?></p>

<p>If the problem persists please wait 24 hours before trying again.</p>

<p>The cause of the error has been reported.</p>

<br /><br />