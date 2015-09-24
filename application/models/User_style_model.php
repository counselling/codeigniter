<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 17/08/2015
 * Time: 12:00
 */
 defined('BASEPATH') OR exit('No direct script access allowed');


class User_style_model extends CI_Model

{

	function get_user_styles($user)

	{
		$this->db->select('style');
		$this->db->where('user_id', $user);
		$stmt = $this->db->get('user_styles');

		if ($stmt->num_rows())
		{
			$row = $stmt->row();

			$style = "<table><tr><td valign='top'><b>Style of Working:</b></td>";

			foreach ($stmt->result() as $row)
			{
				$style .= "<td>".$row->style."</td></tr><tr><td>&nbsp;</td>";
			}

			$style .="</tr></table>";
			return $style;
		}
		else
		{
			return FALSE;
		}
	}



	function setUserStyles($data)

	{
		$data = array(
			'user_id'   => $data['user_id'],
			'style'  => $data['style']
		);

		$this->db->insert('user_styles', $data);

		if (!$this->db->insert_id())
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

}