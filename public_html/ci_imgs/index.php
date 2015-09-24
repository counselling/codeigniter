<?php
/*---------------------------------------------------+
| Counselling Website - Caring for Emotional Health
+----------------------------------------------------+
| Copyright © 2002 - 2008 Paul Hayter
| http://www.counselling.ltd.uk/
+----------------------------------------------------+
|
| Version 1.0 August 2008
|
+----------------------------------------------------*/
if ($_SERVER['SERVER_NAME'] == 'counselling.local')

  require_once("f:/counselling/2011/cgi-bin/inc/config.inc.php");

else

  require_once('/home/secretary/public_html/cgi-bin/inc/config.inc.php');
require_once(BASEDIR . '/public/public_page.php');
?>

<div class='content'>

 <?php
  $page = 1;
	$webpage = new Webpages;
	$q = $webpage->getPageCount($page);
	if (!$q) $page = 168;
	echo $webpage->getWebPage($page);
 ?>

</div>

<?php
 include_once(BASEDIR . '/public/public_footer.php');
?>