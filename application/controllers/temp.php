<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 19/05/2015
 * Time: 06:49
 */
 defined('BASEPATH') OR exit('No direct script access allowed');

class Temp extends MY_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
		$user = $this->user_model->get_user_details($this->session->userdata('user_id'));
		$this->load->vars($user);

		//$this->load->model('temp_url_model');
		//$this->data['temp_url_count'] = $this->temp_url_model->getTempUrlCount();
		//$this->load->model('temp_residence_model');
		//$this->data['temp_res_count'] = $this->temp_residence_model->Count_all();
	}

	public function index()
	{
		//$this->load->model('user_model');
		//$user = $this->user_model->getUserdetails($this->session->userdata('user_id'));
		//$this->load->vars($user);

		$this->load->model('temp_url_model');
		$this->data['temp_url_count'] = $this->temp_url_model->getTempUrlCount();
		$this->load->model('temp_residence_model');
		$this->data['temp_res_count'] = $this->temp_residence_model->Count_all();

		//$this->data['expire'] = date('d/m/Y', strtotime($expire));
		$data['content'] = $this->load->view('admin/admin_index_view', $this->data, TRUE);

		$this->load->view('admin/admin_view', $data);
	}

	public function website_approve()
	{
		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the temporary urls
			$this->load->model('Webaddress');
			$this->data['d'] = $this->Webaddress->getAllWebAddress();

			$this->data['temp_url_count'] = $this->db->count_all('temp_urls');
			$data['content'] = $this->load->view('admin/admin_website_view', $this->data, TRUE);
			$this->load->view('admin/admin_view', $data);
			//$this->_render_page('admin/admin_view', $this->data);
		}
		else
		{


			$this->load->view('admin/admin_view', $data);
		}
	}

	public function declineWebAddress($num)
	{
		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->load->model('Webaddress');
			$this->data['temp_web'] = $this->Webaddress->getPendingWebAddress($num);
			$this->load->model('Users');
			//echo $this->post->user_id;
			$this->data['user_name_number'] = $this->Users->getUserNameNumber($num);
			$data['content'] = $this->load->view('admin/admin_decline_website_view', $this->data, TRUE);

			$this->load->view('admin/admin_view', $data);
		}
	}


	public function send_one_month_email()
	{
		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		//if( !confirm('Really submit this form?') ){
		//  return FALSE;
		//}

		$member = 8098;

		$this->load->model('user_model');
		$member_details = $this->user_model->getUserdetails($member);

		$message = $this->load->view('temp/one_month_email.tpl.php', $member_details, true);
		$this->email->clear();
		$this->email->from('admin@counselling.ltd.uk');
		$this->email->to($member_details->email);
		$this->email->subject('Counselling Registration - Reminder');
		$this->email->message($message);

		$this->email->send();

		//$data = array(
		//'payment' => 3,
		//'payment_date' => $payment_date //YYYYMMDD
		//);

		$this->email->subject($member_details->id.' COPY - Reminder expiry in one month');
		$this->email->to('paul.hayter@gmx.co.uk,trustees@counselling.ltd.uk');
		$this->email->send();

		$data['content'] = $this->load->view('admin/admin_index_view', $this->data, TRUE);

		$this->load->view('admin/admin_view', $data);
	}


	public function send_practise_decline_email()
	{

		$member = 8624;

		$this->load->model('user_model');
		$member_details = $this->user_model->get_user_details($member);

		if ($member_details->email == '')
		{
			echo 'Email address not found';
			exit;
		}
		else
		{
			$message = $this->load->view('temp/practice_address_declined.tpl.php', $member_details, true);

			$from = 'admin@counselling.ltd.uk';
			$to = '$member_details->email';
			$subject = 'Change of Practise Address';

			$this->email->send_temp_email($from, $to, $subject, $message, $member);

			echo 'Email sent';
			exit;
		}
	}

	public function send_paypal_nonpayment_email()
	{

		$member = 8098;

		$this->load->model('user_model');
		$member_details = $this->user_model->get_user_details($member);

		$message = $this->load->view('temp/chase_paypal_email.tpl.php', $member_details, true);
		$subject = 'Problem with Paypal Payment';
		//$this->email->clear();
		//$from = 'admin@counselling.ltd.uk';
		$to = $member_details->email;
		//$this->email->subject($subject);
		//$this->email->message($message);

		//$this->email->to($to);
		$this->email->send_temp_email($to, $subject, $message, $member);

		//$data['content'] = $this->load->view('admin/admin_index_view', $this->data, TRUE);
		//$this->email->subject($member_details->id.' COPY - Reminder Paypal Collection Problem');
		//$this->email->to('paul.hayter@gmx.co.uk,trustees@counselling.ltd.uk');
		//$this->email->to('paul.hayter@gmx.co.uk');
		//$this->email->send();
		//$this->load->view('admin/admin_view', $data);
	}

	public function test()
	{
		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		$data['content'] = $this->load->view('admin/admin_test_view', $this->data, TRUE);

		$this->load->view('admin/admin_view', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */