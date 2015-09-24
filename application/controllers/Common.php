<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 29/05/2015
 * Time: 12:56
 */
 defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function postcode_search()
	{
		if($this->input->post('Submit') == 'Home Page')
		{//Display home page according to logged on member
			if (isset($_SESSION['user_id']))
			{
				redirect('member', 'refresh');
			}
			else
			{
				redirect('general', 'refresh');
			}
		}
		elseif ($this->input->post('Submit') == 'Submit')
		{
			$this->form_validation->set_rules('postcode_name', 'Postcode', 'required');
			if ( ! $this->form_validation->run() == FALSE)
			{
				$search_name = $this->input->post("postcode_name");
				redirect('/common/postcode_list/'.$search_name);
			}
			else
			{
				$this->data['message'] = 'You must enter at least one letter in the postcode field';
			}
		}

		$this->data['content'] = $this->load->view('public/public_postcode_search_view', $this->data, TRUE);

		$this->display_page($this->data);
	}

	public function postcode_list($search_name)
	{
		$this->load->library('pagination');

		$this->session->set_userdata('search_name', $search_name);

		$config['base_url'] = base_url() . "common/postcode_list/$search_name";
		$config['total_rows'] = $this->user_model->get_active_postcode_count($_SESSION['search_name']);
		if ($config['total_rows'] == 0)
		{
			$this->data['d'] = 'No matching entries found';
		}
		else
		{
			$config['per_page'] = 10;
			$config['uri_segment'] = 4;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = round($choice);

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

			$this->data['d'] = $this->user_model->list_postcode_search($config['per_page'], $page ,$_SESSION['search_name']);
			$this->data['links'] = $this->pagination->create_links();
		}

		$this->data['match'] = strtoupper($this->session->userdata('search_name'));
		$this->data['content'] = $this->load->view('public/public_name_list_view', $this->data, TRUE);

		$this->display_page($this->data);
	}

	public function name_search()
	{
		if($this->input->post('Submit') == 'Home Page')
		{//Display home page according to logged on member

			if (isset($_SESSION['user_id']))
			{
				redirect('member', 'refresh');
			}
			else
			{
				redirect('general', 'refresh');

			}
			$this->display_page($this->data);

			exit;
		}
		elseif ($this->input->post('Submit') == 'Submit')
		{
			$this->form_validation->set_rules('search_name', 'Name', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->data['content'] = $this->load->view('public/public_name_search_view', '', TRUE);
				$this->display_page($this->data);
			}
			else
			{
				$search_name = $this->input->post("search_name");
				redirect('/common/name_list/'.$search_name);
			}
		}

		$this->session->set_userdata('search_name', '');

		$this->data['content'] = $this->load->view('public/public_name_search_view', $this->data, TRUE);

		$this->display_page($this->data);
	}

	public function name_list($search_name)
	{
		$this->load->library('pagination');

		$this->session->set_userdata('search_name', $search_name);

		$config['base_url'] = base_url() . "common/name_list/$search_name";

		$config['total_rows'] = $this->user_model->get_active_name_count($_SESSION['search_name']);
		if ($config['total_rows'] == 0)
		{
			$this->data['d'] = 'No matching entries found';
		}
		else
		{
			$config['per_page'] = 10;
			$config['uri_segment'] = 4;
			$choice = $config['total_rows'] / $config["per_page"];
			$config['num_links'] = round($choice);
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';


			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

			$this->data['d'] = $this->user_model->list_name_search($config['per_page'], $page ,$this->session->userdata('search_name'));
			$this->data['links'] = $this->pagination->create_links();
		}

		$this->data['match'] = ucwords($this->session->userdata('search_name'));
		$this->data['content'] = $this->load->view('public/public_name_list_view', $this->data, TRUE);

		$this->display_page($this->data);
	}

	public function list_member_details($urn)
	{
		$list_user = $this->user_model->get_user_details($urn);

		//$this->member->expire = date('d/m/Y', strtotime($this->member->expire));
		$this->load->model('user_prof_memb_model');
		$list_user->prof_memb = $this->user_prof_memb_model->get_user_prof_memb($urn);

		$this->load->model('user_style_model');
		$list_user->style = $this->user_style_model->get_user_styles($urn);

		$this->load->model('user_qual_model');
		$list_user->qual = $this->user_qual_model->get_user_qualifications($urn);

		if ($list_user->priopt == 'practise')
		{
			$this->load->model('practise_model');
			$list_user->practise = $this->practise_model->get_practise_address($urn);
		}

		if ($list_user->active == 3)
		{
			if ($list_user->priopt == 'full')
				$this->data['content'] = $this->load->view('public/public_member_full_view', $list_user, TRUE);
			elseif ($list_user->priopt == 'part') $this->data['content'] = $this->load->view('public/public_member_part_view', $list_user, TRUE);
			elseif ($list_user->priopt == 'practise') $this->data['content'] = $this->load->view('public/public_member_practise_view', $list_user, TRUE);
			else $this->data['content'] = $this->load->view('public/public_member_default_view', $list_user, TRUE);
		}
		elseif ($list_user->active == 2)
			$this->data['content'] = $this->load->view('public/public_member_pending_view', $list_user, TRUE);
		elseif ($list_user->active == 1)
			$this->data['content'] = $this->load->view('public/public_member_approval_view', $list_user, TRUE);
		else
			$this->data['content'] = $this->load->view('public/public_member_lapsed_view', $list_user, TRUE);

		$this->display_page($this->data);
	}

	public function show_information()
	{
		$this->load->model('webpage_model');
		$this->data['content'] = $this->webpage_model->get_site_map();

		$this->display_page($this->data);
	}

	public function show_organisations()
	{
		$this->load->model('organisation_model');
		$this->data['content'] = $this->organisation_model->get_all_organisations();

		$this->display_page($this->data);
	}

	private function display_page($data)
	{
		if ($this->session->userdata('user_id'))
		{
			$this->load->view('members/member_view', $data);
		}
		else
		{
			$this->load->view('public/public_view', $data);
		}
	}

}