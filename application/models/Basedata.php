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


class Basedata extends CI_Model //Used by all views
{
	public function index($page)
	{
		$data['todaysdate'] = date("jS F Y");
		$data['title'] = ucfirst($page); // Capitalize the first letter
		$data['quote'] = $this->quote_model->get_random_quote();
		$data['address'] = $this->config_model->get_horiz_address(1);
		$data['base'] = $this->base;
		$data['css'] = $this->css;
		$data['images'] = $this->images;

		return $data;
	}

}

/* End of file basedata.php */
/* Location: ./application/models/basedata.php */