<h1>Counsellor Details</h1><hr><br />

<br />
<h1><?php echo $first_name . ' ' . $last_name ?></h1> <br />
<p><b>A Member of Counselling - CCC Registered Counsellor</b></p><br />
<p><b>Registration No: </b><?php echo $id . ' - valid until '.nice_date($expire,'d/m/Y') ?></p>
<hr>
Partial view
<table>
<tr>
	<td><b>Address: </b></td>
	<td><?php echo ($town !='' ? $town : 'Not available')?></td>
	<tr><td>&nbsp;</td></tr>
</tr>
<tr>
	<td><b>Telephone: </b></td>
	<td><?php echo ($maintel !='' ? $maintel : 'Not available')?></td>
	<tr><td>&nbsp;</td></tr>
</tr>
</table>
<?php echo $prof_memb ?>
<?php echo $style ?>
<table>
<tr>
	<td><b>Website: </b></td>
	<td><?php if ($web) echo anchor("http://$web",$web); else echo 'Not entered';?></td>
</tr>
</table>
<hr>
<?php echo $qual ?>
<hr>
