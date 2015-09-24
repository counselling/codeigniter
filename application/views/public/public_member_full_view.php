<h1>Counsellor Details</h1><hr><br />

<br />
<h1><?php echo $first_name . ' ' . $last_name ?></h1> <br />
<p><b>A Member of Counselling - CCC Registered Counsellor</b></p><br />
<p><b>Registration No: </b><?php echo $id . ' - valid until '.nice_date($expire,'d/m/Y') ?></p>
<hr>
Full disclosure view
<table><tr>
	<td><b>Address: </b></td>
	<td><?php echo ($hostreet !='' ? $hostreet : 'Not available').'</td></tr><tr><td></td>';
			if ($add2 != '') echo '<td>'.$add2.'</td></tr><tr><td></td>';
			if ($add3 != '') echo '<td>'.$add3.'</td></tr><tr><td></td>';
			if ($town != '') echo '<td>'.$town.'</td></tr><tr><td></td>';
			if ($home_county != '') echo '<td>'.$home_county.'</td></tr><tr><td></td>';
			if ($postcode != '') echo '<td>'.$postcode.'</td></tr><tr><td></td>';
	?>
<tr><td>&nbsp;</td></tr>
<tr>
	<td><b>Website: </b></td><td><?php echo $web?></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
	<td><b>Telephone: </b></td><td><?php echo $maintel?></td>
</tr>
</table>
<br />
<hr>
<?php echo $qual ?>
<hr>
