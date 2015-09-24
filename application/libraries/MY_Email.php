<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 18/05/2015
 * Time: 06:13
 */
 defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Email extends CI_Email {

	public function __construct()
	{
		parent::__construct();
	}


	public function send_user_email($from, $recipient, $subject, $message, $num)
	{
		$CI =& get_instance();

		$config['protocol']='smtp';
		$config['smtp_host']='merlin.xssl.net'; //(SMTP server)
//$config['smtp_port']='465'; //(SMTP port)
		$config['smtp_port']='25'; //(SMTP port)
		$config['smtp_timeout']='30';
		$config['smtp_user']='registration@counselling.ltd.uk'; //(user@gmail.com)
		$config['smtp_pass']='sx111862';
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";

		$CI->email->initialize($config);

		$CI->email->clear();
		$CI->email->from($from);
		$CI->email->to($recipient);
		$CI->email->subject($subject);
		$CI->email->message($message);

		//the line below needs to be uncommented in the live site to send emails to members
		//$CI->email->send(FALSE);

		$subject = $num . ' Copy - ' . $subject;
		$CI->email->subject($subject);
		$CI->email->to('paul.hayter@gmx.co.uk');
		$CI->email->send();
		//echo $CI->email->print_debugger();
	}


	public function php_error_email($message)
	{
		$CI =& get_instance();

		$config['protocol']='smtp';
		$config['smtp_host']='merlin.xssl.net'; //(SMTP server)
//$config['smtp_port']='465'; //(SMTP port)
		$config['smtp_port']='25'; //(SMTP port)
		$config['smtp_timeout']='30';
		$config['smtp_user']='registration@counselling.ltd.uk'; //(user@gmail.com)
		$config['smtp_pass']='sx111862';
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";

		$CI->email->initialize($config);

		$CI->email->clear();
		$CI->email->from('registration@counselling.ltd.uk');
		$CI->email->to('paul.hayter@gmx.co.uk');
		$CI->email->subject('Counselling PHP error');
		$CI->email->message($message);

		$CI->email->send();

		//$subject = $num . ' Copy - ' . $subject;
		//$CI->email->subject($subject);
		//$CI->email->to('paul.hayter@gmx.co.uk');
		//$CI->email->send(FALSE);
		//echo $CI->email->print_debugger();
	}


	public function mysql_email_error($query, $message)
	{
		$CI =& get_instance();

		$config['protocol']='smtp';
		$config['smtp_host']='merlin.xssl.net'; //(SMTP server)
		$config['smtp_port']='25'; //(SMTP port)
		$config['smtp_timeout']='30';
		$config['smtp_user']='registration@counselling.ltd.uk'; //(user@gmail.com)
		$config['smtp_pass']='sx111862';
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";

		$CI->email->initialize($config);

		$data['url'] = $CI->config->site_url($CI->uri->uri_string());//current url
		$data['error'] = 'MySql';
		$data['last_query'] = $query;
		$data['error_message'] = $message['message'];
		$data['error_number'] = $message['code'];

		$message = $CI->load->view('emails/error_message.tpl.php', $data, true);

		$CI->email->clear();
		$CI->email->from('paul@counselling.ltd.uk');
		$CI->email->to('paul.hayter@gmx.co.uk');
		$CI->email->subject('Counselling MySql error');
		$CI->email->message($message);

		$CI->email->send();
	}

	public function send_temp_email($recipient, $subject, $message, $num)
	{
		$CI =& get_instance();

		$config['protocol']='smtp';
		$config['smtp_host']='merlin.xssl.net'; //(SMTP server)
		$config['smtp_port']='25'; //(SMTP port)
		$config['smtp_timeout']='30';
		$config['smtp_user']='registration@counselling.ltd.uk'; //(user@gmail.com)
		$config['smtp_pass']='sx111862';
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";

		$CI->email->initialize($config);

		$CI->email->clear();
		$CI->email->from('admin@counselling.ltd.uk');
		$CI->email->to($recipient);
		$CI->email->subject($subject);
		$CI->email->message($message);

		$CI->email->send(FALSE);

		$subject = $num . ' Copy - ' . $subject;
		$CI->email->subject($subject);
		$CI->email->to('paul.hayter@gmx.co.uk, trustees@counselling.ltd.uk');
		//$CI->email->to('paul.hayter@gmx.co.uk');
		$CI->email->send();
		echo $CI->email->print_debugger();
	}
}