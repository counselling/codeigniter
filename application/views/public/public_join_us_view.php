<h1>Apply for Affiliation</h1>
<hr />
<div id="infoMessage"><?php echo validation_errors(); ?></div>
<p class="indent">If you hold a recognised Counselling Qualification you may apply for membership of Counselling Ltd.<br />In accordance with the aims of the Charity members are expected to offer a limited amount of free or subsidised counselling sessions to approved clients.<br />Members are asked to make a contribution of &pound;10.00 (&pound;10.50 if you pay by Paypal) towards the cost of running Counselling Ltd.<br />Members are able to download a certificate of membership.<br />Your application  will be reviewed by an Administrator and you will be informed if you have been successful.<br />Please enter the information requested below. <span style='font-size: smaller' >(Fields marked * are required.)</span></p>
<br />
<!--<div id="infoMessage"><?php if (isset($message)) echo $message; ?></div>-->

<?php $hidden = array('dob' => '');?>
<?php echo form_open("general/join_us", '', $hidden); ?>

<p>
    <label for 'last_name'>Last Name:* </label><input type="text" name="last_name" id="last_name" value="<?php echo set_value('last_name'); ?>" />
</p>
<p>
    <label for 'first_name'>First Name:* </label><input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>" />
</p>
<p>
    <label for 'email'>Email:*</label><input type="text" title="You must enter a valid email address and keep it up to date. We will use this address to communicate with you" name="email" id="email" value="<?php echo set_value('email'); ?>" />
</p>
<p>
    <label for 'hostreet'>Home Address:* </label><input type="text" title="NOT your practice address. You will be able to enter a practice address later if you need to." name="hostreet" id="hostreet" value="<?php echo set_value('hostreet'); ?>" />
</p>
<p>
    <label for 'add2'>&nbsp; </label><input type="text" name="add2" id="add2" value="<?php echo set_value('add2'); ?>" />
</p>
<p>
    <label for 'add3'>&nbsp; </label><input type="text" name="add3" id="add3" value="<?php echo set_value('add3'); ?>" />
</p>
<p>
    <label for 'town'>Town:* </label><input type="text" name="town" id="town" value="<?php echo set_value('town'); ?>" />
</p>
<p>

    <label>County:*</label>
    <?php echo form_dropdown('home_county', $county, $this->input->post('home_county'), 'Select County')
    ?>
</p>
<p>
    <label for 'postcode'>Postcode:* </label><input type="text" name="postcode" id="town" value="<?php echo set_value('postcode'); ?>" />
</p>
<p>
    <label for 'maintel'>Home Telephone:*</label><input type="text" name="maintel" id="maintel" value="<?php echo set_value('maintel'); ?>" />
</p>
<?php require_once("calendar/classes/tc_calendar.php");

//instantiate class and set properties
$myCalendar = new tc_calendar("dob", true);
$myCalendar->setPath('calendar/');
//$myCalendar->setIcon('calendar/images/iconCalendar.gif');
$myCalendar->setYearInterval(date('Y')-70, date('Y')-17);
$myCalendar->setText("");
//$myCalendar->setDate(date('d'), date('m'), date('Y'));
//$myCalendar->setDateFormat('d m Y');

//output the calendar
?>

<p><label for 'dob'>Date of Birth:*</label>
<?php $myCalendar->writeScript();	?>
<!-- <input type='text' title="Please enter your date of birth. You may either enter it directly into the box using the format dd/mm/yyyy or use the dropdown calendar."name='dob' id='dateofbirth' value="<?php //echo set_value('dob'); ?>" /> -->

</p>




<br /><br />
<h2 style="text-decoration:underline">Qualifications</h2>
<p class="indent2">
    <label for 'qual_subject'>Full Qualification Title:*
</label><input type="text" title="This MUST be a Counselling or Counselling-related qualification or contain substantial counselling modules/content" name="qual_subject" id="qual_subject" value="<?php echo set_value('qual_subject'); ?>" />
</p>
<p class="indent2">
    <label for 'qual_level'>Qualification Level:*
</label><input type="text" title="The MINIMUM acceptable qualification should be at certificate level or an equivalent level" name="qual_level" id="qual_level" value="<?php echo set_value('qual_level'); ?>" />
</p>
<p class="indent2">
    <label for 'qual_start'>Start Date:*</label><input type="text" title="Enter the year that you started this course in this format yyyy" size="4" maxlength="4" name="qual_start" id="qual_start" value="<?php echo set_value('qual_start'); ?>" />
</p>
<p class="indent2">
    <label for 'qual_end'>End Date:*</label><input type="text" title="Enter the year that you finished this course in this format yyyy" size="4" maxlength="4" name="qual_end" id="qual_end" value="<?php echo set_value('qual_end'); ?>" />
</p>
<p class="indent2">
    <label for 'qual_method'>Study/training method:*
</label><input type="text" title="Full-time, Part-time, Distance Learning, etc" name="qual_method" id="qual_method" value="<?php echo set_value('qual_method'); ?>" />
</p>
<br />
<h2 style="text-decoration:underline">Course/Training Provider Details</h2>
<p class="indent2">
    <label for 'qual_college'>Name:*</label><input type="text" title="Enter the name of the University/College where you obtained the qualification" name="qual_college" id="qual_college" value="<?php echo set_value('qual_college'); ?>" />
</p>
<p class="indent2">
    <label for 'qual_town'>Town:*</label><input type="text" title="Enter the town where the college is based. If your course was that of a 'home study' type, for example Open University, Open College, Stonebridge, BSY please enter the Town of their Official Registered Office." name="qual_town" id="qual_town" value="<?php echo set_value('qual_town'); ?>" />
</p>
<p class="indent2">

    <label>County:*</label>
    <?php echo form_dropdown('qual_county', $county, $this->input->post('qual_county'), 'class = "dropdown"')
    ?>
</p>
<p class="indent2">
    <label for 'qual_telephone'>Telephone:</label><input type="text" title="If you know the telephone number of the college it would help us if you enter it here." name="qual_telephone" id="qual_telephone" value="<?php echo set_value('qual_telephone'); ?>" />
</p>
<p class="indent2">
    <label for 'qual_email'>Email:</label><input type="text" title="If you know the email address of the college it would help us if you enter it here." name="qual_email" id="qual_email" value="<?php echo set_value('qual_email'); ?>" />
</p>
<p class="indent2">
    <label for 'qual_website'>Website:</label><input type="text" title="If you know the website address of the college it would help us if you enter it here." name="qual_website" id="qual_website" value="<?php echo set_value('qual_website'); ?>" />
</p>
<br>
<p class="indent2">
    <label for 'residence_confirm'></label><input type="checkbox" title="You must check this box to indicate that the statement is correct." name="residence_confirm" id="residence_confirm" <?php if (isset($_POST['residence_confirm'])) echo 'CHECKED'; ?> /><span style="margin-left:-135px">I agree that my membership status, full name and future submitted details</span><br /><span style="margin-left:165px">of my qualifications will be made public and I confirm that I reside within the British Isles.</span>
</p>
<br>
<p class="indent2">
    <label for 'ccc_confirm'></label><input type="checkbox" title="You must check this box to indicate that the statement is correct." name="ccc_confirm" id="ccc_confirm" <?php if (isset($_POST['ccc_confirm'])) echo 'CHECKED'; ?> /><span style="margin-left:-135px">I confirm that I have read and will abide by the <a href="/index.php/general/page/163" target="_blank">Counselling Code of Conduct (&quot;CCC&quot;)</a> </span><br /><span style="margin-left:165px">and agree to be subject to the <a href="/index.php/general/page/164" target="_blank">Independent Complaints Procedure.</a></span>
</p>
<!--
<p><a href="#" title="That's what this widget is">Tooltips</a> can be attached to any element. When you hover
the element with your mouse, the title attribute is displayed in a little box next to the element, just like a native tooltip.</p>
<p>But as it's not a native tooltip, it can be styled. Any themes built with
<a href="http://themeroller.com" title="ThemeRoller: jQuery UI's theme builder application">ThemeRoller</a>
will also style tooltips accordingly.</p>
<p>Tooltips are also useful for form elements, to show some additional information in the context of each field.</p>
<p><label for="age">Your age:</label><input id="age" title="We ask for your age only for statistical purposes." /></p>
<p>Hover the field to see the tooltip.</p>
-->
<br />
<?php
$submit_data = array(
    'name' => 'Submit',
    'type' => 'submit',
    'value' => 'Submit',
);
echo form_submit($submit_data);
$submit_data = array(
    'name' => 'Submit',
    'type' => 'submit',
    'value' => 'Home Page',
);
echo form_submit($submit_data);

echo form_close();
?>