<html>

<body>

	<p style="font:34pt Casper Open SF;color:blue">Counselling</p>

	<h2><?php echo $error?> Error Message reported on <?php echo mdate('%d/%m/%Y - %h:%i %a', time())?></h2>
    
  <p><?php echo $url?></p>
  
  <p>MySql error no: <?php echo $error_number?></p>
  
  <p>MySql error message: <?php echo $error_message?></p>
  
  <p><?php echo $last_query?></p>


</body>

</html>