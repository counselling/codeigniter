<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 17/08/2015
 * Time: 11:57
 */
 defined('BASEPATH') OR exit('No direct script access allowed');


class User_prof_memb_model extends CI_Model

{



	function get_user_prof_memb($user)

	{
		$this->db->select('prof_memb');
		$this->db->where('user_id', $user);
		$stmt = $this->db->get('user_prof_membs');

		if ($stmt->num_rows())

		{

			$prof_memb = "<table><tr><td valign='top'><b>Member of:</b></td>";

			foreach ($stmt->result() as $row)
			{
				$prof = $row->prof_memb;

				$this->db->select('org_url, org_long');
				$this->db->where('org_ini', $prof);
				$stmt1 = $this->db->get('organisations');
				$row1 = $stmt1->row();

				if ($stmt1->num_rows())
				{
					$prof_memb .= "<td>&nbsp;".$prof."&nbsp;".anchor("http://".$row1->org_url)."</td><td>".$row1->org_long."</td></tr><tr><td>&nbsp;</td>";
				}
				else
				{
					$prof_memb .= "<td>&nbsp;".$prof."</tr><tr><td>&nbsp;</td>";
				}
			}

			$prof_memb .="<td>&nbsp;</td></tr></table>";

			return $prof_memb;
		}
		else
		{
			return FALSE;
		}
	}



	function setProfMemb($data)

	{
		$data = array(
			'user_id'   => $data['user_id'],
			'prof_memb' => $data['prof_memb']
		);

		$this->db->where('user_id', $_POST['user_id']);

		$this->db->insert('user_prof_membs', $data);

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