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


class General extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index($page = 'home', $web = 1)
	{
		$this->load->model('webpage_model');
		$row = $this->webpage_model->get_webpage($web);
		$d = '';
		if ($row) {
			$d .= '<h1>' . $row->h1 . '</h1><hr>';
			$d = $d .= '<b>' . $row->pagetitle . '</b><br>';
			$d = $d .= $row->wording . '<hr>';
			$d = $d .= '<img src="' . $this->images . '/link_icon_sm.gif" alt="links" ><b>Related Links</b><br>Counselling &gt;&gt; ' . $row->category . '&gt;&gt; ' . $row->subject . '<br><br>';
			$d = $d .= '<a href="http://www.relationshipexpert.co.uk" target="_blank" >Advice and tips on all aspects of relationships at relationshipexpert.co.uk</a><hr>';
			$d = $d .= "<b>This webpage is a public document, published by Counselling.</b><br>";
			if ($row->published != "0000-00-00") {
				$v = $row->published;
				$d = $d .= "Published: " . substr($v, 8, 2) . "-" . substr($v, 5, 2) . "-" . substr($v, 0, 4);
			} else {
				$d = $d .= "Published: Public ";
			}
			if ($row->edited != "0000-00-00") {
				$d = $d .= "<br>Last Updated: " . date("d-m-Y");
			} else {
				$d = $d .= "<br>Last Updated: Never Updated ";
			}
			if ($row->expires != "0000-00-00") {
				$v = $row->expires;
				$d = $d .= "<br>Expires: " . substr($v, 8, 2) . "-" . substr($v, 5, 2) . "-" . substr($v, 0, 4);
			} else {
				$d = $d .= "<br>Expires: Never Expires ";
			}
		} else {
			$d .= '<h1>Ooops</h1><hr>';
			$d = $d .= '<b>The page you requested is not available</b><br>';
		}
		$this->data['content'] = $d;
		$this->load->view('public/public_view', $this->data);
	}


	public function page($web = 1)
	{
		$this->load->model('webpage_model');
		$row = $this->webpage_model->get_webpage($web);
		$d = '';

		if ($row)
		{
			$d .= '<h1>' . $row->h1 . '</h1><hr>';
			$d = $d .= '<b>' . $row->pagetitle . '</b><br>';
			$d = $d .= $row->wording . '<hr>';
			$d = $d .= '<img src="'.$this->images.'/link_icon_sm.gif" alt="links" ><b>Related Links</b><br>Counselling &gt;&gt; ' . $row->category . '&gt;&gt; ' . $row->subject . '<br><br>';
			$d = $d .= '<a href="http://www.relationshipexpert.co.uk" target="_blank" >Advice and tips on all aspects of relationships at relationshipexpert.co.uk</a><hr>';
			$d = $d .= "<b>This webpage is a public document, published by Counselling.</b><br>";
			if ($row->published != "0000-00-00")
			{
				$v=$row->published;
				$d = $d .= "Published: " . substr($v, 8, 2)."-".substr($v, 5, 2)."-".substr($v, 0, 4);
			}
			else
			{
				$d = $d .= "Published: Public ";
			}
			if ($row->edited != "0000-00-00")
			{
				$d = $d .= "<br>Last Updated: " . date("d-m-Y");
			}
			else
			{
				$d = $d .= "<br>Last Updated: Never Updated ";
			}
			if ($row->expires != "0000-00-00")
			{
				$v=$row->expires;
				$d = $d .= "<br>Expires: " . substr($v, 8, 2)."-".substr($v, 5, 2)."-".substr($v, 0, 4);
			}
			else
			{
				$d = $d .= "<br>Expires: Never Expires ";
			}

		}
		else
		{
			$d .= '<h1>Ooops</h1><hr>';
			$d = $d .= '<b>The page you requested is not available</b><br>';
		}
		$this->data['content'] = $d;

		$this->load->view('public/public_view', $this->data);
	}

	public function forgot_password()
	{
		if ($this->form_validation->run('forgot_password') == TRUE)
		{
			$identity = $this->user_model->user_email_check($this->input->post('email'));

			if (!empty($identity))
			{
				//run the forgotten password method to email an activation code to the user
				$this->db->trans_start();

				$forgotten = $this->user_model->forgotten_password($identity);

				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE)
				{
					$query = $this->db->last_query();
					$message = $forgotten;
					$this->email->mysql_email_error($query, $message);

					$this->data['error_message'] = 'password';
					$this->data['message'] = 'Please request a further password reset code from the "Request New Password" link on the right.';
					$this->data['content'] = $this->load->view('common/database_error_message', $this->data, TRUE);

					$this->load->view('public/public_view', $this->data);
				}
				else
				{
					if (isset($forgotten))
					{
						//if there were no errors
						$message = $this->load->view('emails/forgot_password.tpl.php', $forgotten, TRUE);
						$from = 'registration@counselling.ltd.uk';
						$to = $identity;
						$subject = 'Counselling Reset Password Request';
						//$this->email->message($message);
						$this->email->send_user_email($from, $to, $subject, $message, $forgotten['id']);
						//$this->email->message($message);

						//$this->email->send();
						redirect("general/forgot_password_request", 'refresh');
					}

				}

			}
			else
			{
				$this->session->set_flashdata('message', 'We have been unable to send your password reset link. <br />Please re-enter your registered email address.');
				redirect("general/forgot_password");
			}
		}
		else
		{
			$this->data['content'] = $this->load->view('public/public_forgot_password_view', $this->data, TRUE);
			$this->load->view('public/public_view', $this->data);
		}
	}//End of forgot password

//Forgot Password email sent page
	public function forgot_password_request()
	{
		$data['content'] = $this->load->view('public/public_forgot_password_request_view', $this->data, TRUE);

		$this->load->view('public/public_view', $data);
	}//End of forgotPassword


	public function join_us()
	{
		if($this->input->post('Submit') == 'Home Page')
		{
			redirect('/general');
		}

		if ($this->form_validation->run('join_us') == false)
		{
			$this->load->model('county_model');
			$this->data['county'] = $this->county_model->get_dropdown_list();
			$this->data['content'] = $this->load->view('public/public_join_us_view', $this->data, TRUE);

			$this->load->view('public/public_view', $this->data);
		}
		else
		{
			$new_user = array();
			$new_user = $this->input->post();

			$this->db->trans_start();
			$identity = $this->user_model->join_us($new_user);

			$new_user['user_id'] = $this->db->insert_id();
			$new_user['qual_status'] = 0; //Set to 1 for initial approved qual
			$new_user['qual_approved'] = 0; //Set to 1 for initial approved qual
			$new_user['qual_accreditation'] = '';

			$this->load->model('user_qual_model');

			$result = $this->user_qual_model->set_user_qualification($new_user);

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE)
			{
				$query = $this->db->last_query();
				$message = $result;
				$this->email->mysql_email_error($query, $message);

				$this->data['error_message'] = 'details';
				$this->data['content'] = $this->load->view('common/database_error_message', $this->data, TRUE);

				$this->load->view('public/public_view', $this->data);
			}
			else
			{
				$message = $this->load->view('emails/application_received.tpl.php', $new_user, true);
				$from = 'registration@counselling.ltd.uk';
				$to = $new_user['email'];
				$subject = 'Application for Affiliation';
				//$this->email->message($message);
				$this->email->send_user_email($from,$to,$subject,$message,$new_user['user_id']);

				$this->data['content'] = $this->load->view('public/public_join_us_success_view', $this->data, TRUE);

				$this->load->view('public/public_view', $this->data);
			}
		}
	}

	public function initial_setup()
	{
		$data['identity_label'] = 'Email address';
		$data['content'] = $this->load->view('public/public_important_view', $this->data, TRUE);

		$this->load->view('public/public_view', $data);
	}
}