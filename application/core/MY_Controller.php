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


class MY_Controller extends CI_Controller
{
	public $base;
	public $css;
	public $images;

	protected $the_user;

	function __construct()
	{
		parent::__construct();

		$this->base = $this->config->item('base_url');
		$this->css = $this->config->item('css');
		$this->images = $this->config->item('images');
		//echo $this->images;
		$this->data = $this->basedata->index(1);
	}
}//End of MY-Controller

class Admin_Controller extends MY_Controller
{
	protected $the_user;

	function __construct()
	{
		parent::__construct();

    //Check if user is in admin group
		if (!$this->ion_auth->logged_in())
		{
			redirect('general/not_logged_in', 'refresh');
		}
		else
		{
			$group = $this->session->group;

			if ($group > 10)
			{
				redirect('member', 'refresh');
			}
		}
	}
}//End of Admin Controller

class Member_Controller extends MY_Controller
{
	protected $data;

	function __construct()
	{
    parent::__construct();

    //Check if user is in admin group
		if (!$this->ion_auth->logged_in())
		{
			redirect('general/not_logged_in', 'refresh');
		}
		else
		{
			$this->load->model('User_model');
            $this->data['group'] = $this->ion_auth->get_users_groups();
            $user = $this->User_model->get_user_details($this->session->user_id);
            $data = $this->load->vars($user);
		}
	}
}

class Common_Controller extends MY_Controller
{
	protected $the_user;

	function __construct()
	{
		parent::__construct();

		if ($this->ion_auth->logged_in())
		{
			$this->load->model('user_model');
			$this->data['group'] = $this->ion_auth->get_users_groups();
			$user = $this->user_model->getUserdetails($this->session->user_id);
			$data = $this->load->vars($user);
		}
	}
}//End of MY_Controller
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */