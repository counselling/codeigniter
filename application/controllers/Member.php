<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 29/05/2015
 * Time: 12:10
 */
 defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Member_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['content'] = $this->load->view('members/member_home_view', $this->data, TRUE);
		$this->load->view('members/member_view', $data);
	}
}