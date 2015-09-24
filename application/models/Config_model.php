<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 16/05/2015
 * Time: 19:58
 */
 defined('BASEPATH') OR exit('No direct script access allowed');

class Config_model extends CI_Model
{

	function get_horiz_address($id = 1)
	{
		$this->db->where('id',$id);
		$query =    $this->db->get('config');

		$row = $query->row();

		$c='';

		if ($row)
		{
			$c = 'Registered Office: Counselling, ' . $row->office_1;

			if ($row->office_2 != '') $c = $c . ', ' . $row->office_2;

			if ($row->office_3 != '') $c = $c . ', ' . $row->office_3;

			if ($row->office_4 != '') $c = $c . ', ' . $row->office_4;

			if ($row->office_pc != '') $c = $c . ', ' . $row->office_pc;
		}

		return $c;
	}


	function get_registered_address($id = 1)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('config');

		$row = $query->row();

		if ($row)
		{
			return $row;
		}
		else
		{
			return '';
		}
	}
}

/* End of file config_model.php */
/* Location: ./application/models/config_model.php */