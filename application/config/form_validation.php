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


$config = array(

	'login' => array
	(
		array
		(
			'field' => 'email',
			'label' => 'Email Address',
			'rules' => 'email_confirm'
		),

		array
		(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required'
		)

	),

	'forgot_password' => array
	(
		array
		(
			'field' => 'email',
			'label' => 'Email Address',
			'rules' => 'required'
		)
	),

	'reset_password' => array
	(
		array
		(
			'field' => 'new_password',
			'label' => 'New Password',
			'rules' => 'required|password_validate',
			'set_message' => 'The password field is empty'
		),

		array
		(
			'field' => 'new_password_confirm',
			'label' => 'Confirm New Password',
			'rules' => 'required|matches[new_password]'
		)
	),

    'member' => array
	(
		array
		(
			'field' => 'hostreet',
			'label' => 'Address Line 1',
			'rules' => 'alpha_numeric|required'
		),

        array
		(
			'field' => 'add2',
			'label' => 'Address line 2',
			'rules' => 'alpha_numeric'
		),

        array
		(
			'field' => 'add3',
			'label' => 'Address Line 3',
			'rules' => 'alpha_numeric'
		),

        array
		(
			'field' => 'town',
			'label' => 'Town',
			'rules' => 'alpha_numeric|required'
		),

        array
		(
			'field' => 'county',
			'label' => 'County',
			'rules' => 'is_county_set'
		),

        array
		(
			'field' => 'postcode',
			'label' => 'Postcode',
			'rules' => 'alpha_numeric|required'
		),

        array
		(
			'field' => 'pritel',
			'label' => 'Private Telephone Number',
			'rules' => 'required|check_telephone'
		)
	),

    'temp_address' => array
	(
		array
		(
			'field' => 'temp_hostreet',
			'label' => 'First Line of the Address ',
			'rules' => 'required|alpha_numeric_space'
		),

        array
		(
			'field' => 'temp_add2',
			'label' => 'Address line 2',
			'rules' => 'alpha_numeric_space'
		),

        array
		(
			'field' => 'temp_add3',
			'label' => 'Address Line 3',
			'rules' => 'alpha_numeric_space'
		),

        array
		(
			'field' => 'temp_town',
			'label' => 'Town',
			'rules' => 'required|alpha_numeric_space'
		),

        array
		(
			'field' => 'temp_county',
			'label' => 'County',
			'rules' => 'is_county_set' //found in /libraries/MY_form_validation
		),

        array
		(
			'field' => 'temp_postcode',
			'label' => 'Postcode',
			'rules' => 'required|valid_postcode' //found in /libraries/MY_form_validation
		)
	),

    'pritel' => array
	(
		array
		(
			'field' => 'pritel',
			'label' => 'Private Telephone Number',
			'rules' => 'check_telephone' //found in /libraries/MY_form_validation
		)
	),

	'maintel' => array
	(
		array
		(
			'field' => 'maintel',
			'label' => 'Practice Telephone Number',
			'rules' => 'check_telephone' //found in /libraries/MY_form_validation
		)
	),

    'temp_web' => array
	(
		array
		(
			'field' => 'temp_web',
			'label' => 'Website Address',
			'rules' => 'required|valid_website' //found in /libraries/MY_form_validation
		)
	),

    'email' => array
	(
		array
		(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|check_password'
		),
        array
		(
			'field' => 'email',
			'label' => 'Email Address',
			'rules' => 'required|valid_email|matches[email_conf]|email_unique'
		),
		array
		(
			'field' => 'email_conf',
			'label' => 'Email Confirmation',
			'rules' => 'required'
		)
	),

    'options' => array
	(
		array
		(
			'field' => 'priopt',
			'label' => 'Privacy Options',
			'rules' => 'required'
		)
	),

    'search_name' => array
	(
		array
		(
			'field' => 'search_name',
			'label' => 'At least one character',
			'rules' => 'required'
		)
	),

    'name_list' => array
	(
		array
		(
			'field' => 'search_name',
			'label' => 'At least one character',
			'rules' => 'required'
		)
	),

    'join_us' => array
	(
		array
		(
			'field' => 'last_name',
			'label' => 'Last Name',
			'rules' => 'required'
		),
		array
		(
			'field' => 'first_name',
			'label' => 'First Name',
			'rules' => 'required'
		),
		array
		(
			'field' => 'email',
			'label' => 'Email Address',
			'rules' => 'required|valid_email|email_unique' //found in /libraries/MY_form_validation
		),
		array
		(
			'field' => 'hostreet',
			'label' => 'first line of your Home Address',
			'rules' => 'required'
		),
		array
		(
			'field' => 'add2',
			'label' => 'second line of your Home Address',
			'rules' => 'alphanumeric'
		),
		array
		(
			'field' => 'town',
			'label' => 'Home Address Town',
			'rules' => 'required'
		),
		array
		(
			'field' => 'home_county',
			'label' => 'County for your Home Address',
			'rules' => 'is_county_set' //found in /libraries/MY_form_validation
        ),
		array
		(
			'field' => 'postcode',
			'label' => 'Postcode for your Home Address',
			'rules' => 'required'
		),
		array
		(
			'field' => 'dob',
			'label' => 'Date of Birth',
			'rules' => 'date_validation'
		),
		array
		(
			'field' => 'maintel',
			'label' => 'Home Telephone',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_subject',
			'label' => 'Qualification Title',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_level',
			'label' => 'Qualification Level',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_start',
			'label' => 'Qualification Start Date',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_end',
			'label' => 'Qualification End Date',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_method',
			'label' => 'Study/Training Method',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_college',
			'label' => 'College/University Name',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_town',
			'label' => 'College Town',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_telephone',
			'label' => 'College/University Telephone',
			'rules' => 'numeric' //found in /libraries/MY_form_validation
		),
		array
		(
			'field' => 'qual_email',
			'label' => 'College/University Email',
			'rules' => '' //found in /libraries/MY_form_validation
		),
		array
		(
			'field' => 'qual_website',
			'label' => 'College/University Website',
			'rules' => '' //found in /libraries/MY_form_validation
		),
		array
		(
			'field' => 'qual_county',
			'label' => 'County for your College/University',
			'rules' => 'is_county_set' //found in /libraries/MY_form_validation
		)
	),

	'user_qual' => array
	(
		array
		(
			'field' => 'qual_subject',
			'label' => 'Qualification Title',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_level',
			'label' => 'Qualification Level',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_start',
			'label' => 'Qualification Start Date',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_end',
			'label' => 'Qualification End Date',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_method',
			'label' => 'Study/Training Method',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_college',
			'label' => 'College/University Name',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_town',
			'label' => 'College Town',
			'rules' => 'required'
		),
		array
		(
			'field' => 'qual_telephone',
			'label' => 'College/University Telephone',
			'rules' => 'numeric' //found in /libraries/MY_form_validation
		),
		array
		(
			'field' => 'qual_email',
			'label' => 'College/University Email',
			'rules' => '' //found in /libraries/MY_form_validation
		),
		array
		(
			'field' => 'qual_website',
			'label' => 'College/University Website',
			'rules' => '' //found in /libraries/MY_form_validation
		),
		array
		(
			'field' => 'qual_county',
			'label' => 'County for your College/University',
			'rules' => 'is_county_set' //found in /libraries/MY_form_validation
		)
	),

    'prof_memb' => array
	(
		array
		(
			'field' => 'prof_memb',
			'label' => 'Professional Bodies',
			'rules' => 'required'
		)
	),

    'user_style' => array
	(
		array
		(
			'field' => 'style',
			'label' => 'Style of Working',
			'rules' => 'required'
		)
	),

    'priopt' => array
	(
		array
		(
			'field' => 'priopt',
			'label' => 'Style of Working',
			'rules' => 'required'
		)
	)
);

/* End of form_vaidation.php */
/* Location: ./application/config */