<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 17/05/2015
 * Time: 07:05
 */
 defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
	}

	public function user_email_check($email)
	{
		// get identity for that email
		$this->db->select('id, email');
		$this->db->where('email', $email);
		$query = $this->db->get('users');

		if ($query->num_rows()) {
			$row = $query->row();
			return $row->email;
		} else {
			return NULL;
		}
	}

	function get_user_details($urn)
	{
		$this->db->where('id', $urn);
		$query = $this->db->get('users');

		if ($query->num_rows())
		{
			$row = $query->row();
		}
		else
		{
			$row = '';
		}

		return $row;
	}

	public function fetch_identity($identity)

	{
		$this->db->select('active, password, old_password, email');
		$this->db->where('email', $identity);

		if (!$query = $this->db->get('users'))
		{
			$query = $this->db->last_query();
			$message = $this->db->_error_message();
			$number = $this->db->_error_number();
			mysql_email_error($query, $message, $number);

			return false;
		}
		else
		{
			$row = $query->row();

			return $row;
		};
	}

	public function forgotten_password($email)

	{

		$this->db->select('id, first_name, last_name');
		$this->db->where('email', $email);
		$query = $this->db->get('users');

		if ($query->num_rows()) {
			$row = $query->row();
			$unique = uniqid('', true); // generate a unique string
			$random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10); // generate a more random string
			$generated_string = $unique . $random; // a random and unique string

			$data = array
			(
				'forgotten_password_code' => $generated_string,
				'forgotten_password_time' => time()
			);

			$this->db->where('email', $email);
			$this->db->update('users', $data);


			if ($this->db->affected_rows() > 0) {
				$data['id'] = $row->id;
				$data['first_name'] = $row->first_name;
				$data['last_name'] = $row->last_name;
				$data['forgotten_password_code'] = $generated_string;
				return $data;
			}
			else
			{
				return $this->db->error();
			}
		}
	}

	function get_active_name_count($uname)
	{
		$uname = $uname.'%';

		$this->db->select('id');
		$this->db->where('active >=', 1);
		$this->db->where("last_name LIKE '$uname'");
		$query = $this->db->get('users');

		return $query->num_rows();
	}

	function get_active_postcode_count($uname)
	{

		$uname = $uname.'%';

		$this->db->select('id');
		$this->db->where('active >=', 1);
		$this->db->where("postcode LIKE '$uname'");
		$query = $this->db->get('users');

		return $query->num_rows();
	}

	function list_name_search($limit, $start, $uname)
	{
		$uname = $uname . '%';

		$this->db->select('id, first_name, last_name');
		$this->db->where('active >=', 1);
		$this->db->where('active <', 4);
		$this->db->where("last_name LIKE '$uname'");
		$this->db->order_by("last_name ASC, first_name ASC");
		$this->db->limit($limit, $start);
		$query = $this->db->get('users');

		$d = '';

		$tmpl = array ( 'table_open'  => '<table border="0" cellpadding="8" cellspacing="10">' );



		$this->table->set_template($tmpl);

		$this->table->set_heading('Name', 'Location', ' ');

		foreach ($query->result() as $row)
		{
			$first_name = $this->capitalise_text($row->first_name);
			$last_name = $this->capitalise_text($row->last_name);
			$this->table->add_row($first_name . " " . $last_name, anchor('common/list_member_details/'.$row->id,'[Counsellor Details]'));
		}

		return $this->table->generate();
	}

	function list_postcode_search($limit, $start, $uname)
	{

		$uname = $uname . '%';
		$this->db->select('id, first_name, last_name');
		$this->db->where('active >=', 1);
		$this->db->where("postcode LIKE '$uname' AND priopt != 'NO'");
		$this->db->order_by("last_name ASC, first_name ASC");
		$this->db->limit($limit, $start);
		$query = $this->db->get('users');

		$d = '';

		$tmpl = array ( 'table_open'  => '<table border="0" cellpadding="8" cellspacing="10">' );

		$this->table->set_template($tmpl);

		$this->table->set_heading('Name', 'Location', ' ');

		foreach ($query->result() as $row)
		{

			$this->table->add_row($row->first_name . " " . $row->last_name, anchor('common/list_member_details/'.$row->id,'[Counsellor Details]'));

		}

		return $this->table->generate();

	}

	public function join_us($user)
	{
		$data = array
		(
			'last_name'		=> $user['last_name'],
			'first_name'	=> $user['first_name'],
			'email'			=> $user['email'],
			'hostreet'		=> $user['hostreet'],
			'add2'			=> $user['add2'],
			'add3'			=> $user['add3'],
			'town'			=> $user['town'],
			'home_county'	=> $user['home_county'],
			'postcode'		=> $user['postcode'],
			'maintel'		=> $user['maintel'],
			'dob'			=> $user['dob'],
			'created_on'	=> date('Y-m-d'),
			'active'		=> 1
		);

		if (!$this->db->insert('users', $data))
		{
			$query = $this->db->last_query();
			$message = $this->db->_error_message();
			$number = $this->db->_error_number();
			mysql_email_error($query, $message, $number);

			return false;
		}
		else
		{
			return true;
		}
	}

	function capitalise_text($txt)
	{
		$txt = strtolower($txt);

		$first = substr($txt,0,2);
		if ($first == 'mc')
		{
			$last = substr($txt,2);
			$txt = $first . ucfirst($last);
		}

		$pos = strpos($txt,'-');

		if ($pos)
		{
			$first = substr($txt,0,$pos);
			$last = substr($txt,$pos+1);
			$txt = $first . '-' . ucfirst($last);
		}

		$pos = strpos($txt,'\'');

		if ($pos)
		{
			$first = substr($txt,0,$pos);
			$last = substr($txt,$pos+1);
			$txt = $first . '\'' . ucfirst($last);
		}

		$name = ucwords($txt);

		return $name;
	}
}