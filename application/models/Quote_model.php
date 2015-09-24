<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 16/05/2015
 * Time: 19:53
 */
 defined('BASEPATH') OR exit('No direct script access allowed');

class Quote_model extends CI_Model
{
	function get_random_quote()
	{
		$query = $this->db->get('quotes');
		$count = $this->db->count_all('quotes');
		$count = mt_rand(1,$count);

		$row = $query->row($count);

		//prepare output

		$d = '';

		$d .= $row->txt.'<br><i>by ';

		if ($row->author == '') $d .= "Unknown";

		$d .= $row->author.'</i><br><b>'.$row->date.'</b>';

		return $d;
	}

}

/* End of file quote_model.php */
/* Location: ./application/models/quote_model.php */