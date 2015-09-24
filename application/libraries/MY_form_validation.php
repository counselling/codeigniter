<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 17/05/2015
 * Time: 07:00
 */
 defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Form_validation extends CI_Form_validation {



	function __construct($rules = array()) {

		parent::__construct();

		$this->ci =& get_instance();

		$this->_config_rules = $rules;

	}

	function alpha_numeric_space($str)
	{
		return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
	}

	function email_confirm($str) {echo $str;

		if ($str == '')

		{

			$this->set_message('email_confirm', 'The %s must be entered now');

			return false;

		}

	}



	function valid_postcode($pc) {

		$regex = '!^([A-PR-UWYZa-pr-uwyz]([0-9]{1,2}|([A-HK-Ya-hk-y][0-9]|[A-HK-Ya-hk-y][0-9]([0-9]|[ABEHMNPRV-Yabehmnprv-y]))|[0-9][A-HJKS-UWa-hjks-uw])\ {0,1}[0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}|([Gg][Ii][Rr]\ 0[Aa][Aa])|([Ss][Aa][Nn]\ {0,1}[Tt][Aa]1)|([Bb][Ff][Pp][Oo]\ {0,1}([Cc]\/[Oo]\ )?[0-9]{1,4})|(([Aa][Ss][Cc][Nn]|[Bb][Bb][Nn][Dd]|[BFSbfs][Ii][Qq][Qq]|[Pp][Cc][Rr][Nn]|[Ss][Tt][Hh][Ll]|[Tt][Dd][Cc][Uu]|[Tt][Kk][Cc][Aa])\ {0,1}1[Zz][Zz]))$!';



		$result = preg_match($regex, $pc);



		if ($result > 0) {

			return TRUE;

		} else {

			$this->set_message('valid_postcode', 'Please enter a valid postcode');

			return FALSE;

		}

	}



	function valid_website($url) {

		$url = preg_replace('#^https?://#', '', $url);

		$data = @fsockopen("$url", 80, $errno, $errstr, 30);



		if ($data) {

			return TRUE;

		} else {

			$this->set_message('valid_website', 'The webpage does not appear to be available - please check that you using the right spelling');

			return FALSE;

		}

	}



	function password_validate($password) {

		if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $password))

		{

			return TRUE;

		}

		else

		{

			$this->set_message('password_validate', 'The password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit');

			return FALSE;

		}

	}



	function check_password($old_password)

	{

		$CI =& get_instance();

		$CI->db->select('password');
		$CI->db->where('id', $CI->session->userdata('user_id'));
		$query = $CI->db->get('users');
		//echo $CI->db->last_query();
		$row = $query->row();

		$hash_password_db = $row->password;

		$CI->load->library( 'PasswordHash' );

		if($CI->passwordhash->CheckPassword($old_password, $hash_password_db))
		{
			return TRUE;
		}
		else
		{
			$this->set_message('check_password', 'The current password does not validate');
			return FALSE;
		}
	}



	function is_county_set($string) {

		if ($string == '0') {

			$this->set_message('is_county_set', 'You must choose a %s');

			return FALSE;

		}

		else

			return TRUE;

	}



	function email_unique($email) {

		//$this->ci->load->model('user_model');

		$count = $this->ci->user_model->user_email_check($email);

		if (isset($count)) {

			$this->set_message('email_unique', 'There is already a registered user with this email address. If you have registered with us before and have forgotten your log on details please use the \'Request New Password\' facility on the right. You may not register with this email address.');

			return FALSE;

		}

		else {

			return TRUE;

		}



	}



	function date_validation($dob) {

		if ($_POST['dob_day'] =='00' OR $_POST['dob_month'] == '00' OR $_POST['dob_year'] == '0000')

		{

			$this->set_message('date_validation', 'Invalid %s');

			return FALSE;

		}

		else

		{

			return $_POST['dob_year'].'-'.$_POST['dob_month'].'-'.$_POST['dob_day'];

		}

	}



	function residence_confirm() {

		echo 'here';

		exit;

		if (isset($_POST[residence_confirm])) return TRUE;

		$this->form_validation->set_message('residence_confirm', 'Please read and accept our terms and conditions.');

		return false;

	}



	/* ==============================================================================



		Application:   Utiity Function

		Author:        John Gardner

		Date:          25th December 2004

		Description:   Used to check the validity of a UK telephone number

		Version:       V1.0



		Version:       V1.1  4th August 2006

		Updated to include 03 numbers being added by Ofcom in early 2007.



		Version:       V1.2  9th January 2007

		Isle of Man mobile numbers catered for



		Version:       V1.3  6th November 2007

		Support for mobile numbers improved - thanks to Natham Lisgo



		Version:       V1.4  14th April 2008

		Numbers allocated for drama excluded - thanks to David Legg



		Version:       V1.5  8th February 2012

		Updated to use PCRE rather than POSIX regular expressions



		Parameters:    $strTelephoneNumber - telephone number to be checked. This is

		returned reformatted if valid.

		$intError           - Error number

		0 - valid telephone number

		1 - no number provided

		2 - Country code invalidly provided

		3 - 10 or 11 digits not provided

		4 - 0 not provided as first digit

		5 - invalid or inappropriate number

		$strError           - Error string - empty if valid



		This routine checks the value of the string variable specified by the parameter for a valid UK

		telphone number. It returns true for a valid number and false for an invalid number.



		The definition of a valid telephone number has been taken from:



		http://stakeholders.ofcom.org.uk/binaries/telecoms/numbering/numplan201210.pdf



		All inappropriate telephone numbers are disallowed (e.g. premium lines, sex lines, radio-paging

		services etc.)



		Example call:



		if (!checkUKTelephone ($telNo, $errorNo, $errorText) ) {

		echo $errorText & '<br>';

		}



		------------------------------------------------------------------------------ */



	function check_telephone(&$strTelephoneNumber, &$intError = 0, &$strError = '') {



		// Copy the parameter and strip out the spaces

		$strTelephoneNumberCopy = str_replace(' ', '', $strTelephoneNumber);



		// Convert into a string and check that we were provided with something

		//if (empty($strTelephoneNumberCopy)) {

		//  $intError = 1;

		//  $strError = 'Telephone number not provided';

		//  $this->set_message('check_telephone', $strError);

		//  return false;

		//}



		// Don't allow country codes to be included (assumes a leading "+")

		if (preg_match('/^(\+)[\s]*(.*)$/', $strTelephoneNumberCopy)) {

			$intError = 2;

			$strError = 'UK telephone number without the country code, please';

			$this->set_message('check_telephone', $strError);

			return false;

		}



		// Remove hyphens - they are not part of a telephone number

		$strTelephoneNumberCopy = str_replace('-', '', $strTelephoneNumberCopy);



		// Now check that all the characters are digits

		if (!preg_match('/^[0-9]{10,11}$/', $strTelephoneNumberCopy)) {

			$intError = 3;

			$strError = 'UK telephone numbers should contain 10 or 11 digits';

			$this->set_message('check_telephone', $strError);

			return false;

		}



		// Now check that the first digit is 0

		if (!preg_match('/^0[0-9]{9,10}$/', $strTelephoneNumberCopy)) {

			$intError = 4;

			$strError = 'The telephone number should start with a 0';

			$this->set_message('check_telephone', $strError);

			return false;

		}



		// Check the string against the numbers allocated for dramas

		// Expression for numbers allocated to dramas



		$tnexp[0] = '/^(0113|0114|0115|0116|0117|0118|0121|0131|0141|0151|0161)(4960)[0-9]{3}$/';

		$tnexp[1] = '/^02079460[0-9]{2,3}$/';

		$tnexp[2] = '/^01914980[0-9]{3}$/';

		$tnexp[3] = '/^02890180[0-9]{3}$/';

		$tnexp[4] = '/^02920180[0-9]{3}$/';

		$tnexp[5] = '/^01632960[0-9]{3}$/';

		$tnexp[6] = '/^07700900[0-9]{2,3}$/';

		$tnexp[7] = '/^08081570[0-9]{3}$/';

		$tnexp[8] = '/^09098790[0-9]{3}$/';

		$tnexp[9] = '/^03069990[0-9]{3}$/';



		foreach ($tnexp as $regexp) {

			if (preg_match($regexp, $strTelephoneNumberCopy, $matches)) {

				$intError = 5;

				$strError = 'The telephone number is either invalid or inappropriate';

				$this->set_message('check_telephone', $strError);

				return false;

			}

		}



		// Finally, check that the telephone number is appropriate.

		if (!preg_match('/^(01|02|03|05|070|071|072|073|074|075|07624|077|078|079)[0-9]+$/', $strTelephoneNumberCopy)) {

			$intError = 5;

			$strError = 'The telephone number is either invalid or inappropriate';

			$this->set_message('check_telephone', $strError);

			return false;

		}



		// Seems to be valid - return the stripped telephone number

		$strTelephoneNumber = $strTelephoneNumberCopy;

		$intError = 0;

		$strError = '';

		return true;

	}



	function set_error($i, $error = '')

	{

		if (empty($error))

		{

			return FALSE;

		}

		else

		{

			$CI =& get_instance();



			$CI->form_validation->_error_array['custom_error_'.$i] = $error;



			return TRUE;

		}

	}

}