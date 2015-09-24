<?php defined('BASEPATH') OR exit('No direct script access allowed');



class User_qual_model extends CI_Model

{

    function get_user_qualifications($user)

	{
        $this->db->select('qual_level, qual_subject, qual_college');
        $this->db->where("user_id = $user AND (qual_status = 1 OR qual_approved = 1)");
        $stmt = $this->db->get('user_quals');

		$qual = "<table><tr><td valign='top'><b>Qualifications:</b></td>";

        foreach ($stmt->result() as $row)
		{
            $qual .= "<td valign='top'>".'<b>'.$row->qual_level.'</b>'."&nbsp;&nbsp;</td><td valign='top'>".$row->qual_subject."&nbsp;&nbsp;</td><td valign='top'>".$row->qual_college."</td></tr><tr><td>&nbsp;</td>";
        }

		$qual .="<td>&nbsp;</td></tr></table>";

		return $qual;
    }

	function getRegisteredQuals($user)

	{

		$stmt = $this->db->prepare("SELECT qual_level, qual_subject, qual_college FROM user_quals WHERE user_id = $user AND (qual_status = 1 OR qual_approved = 1)");

		$stmt->execute();

		$qual = "<table><tr><td valign='top'><b>&nbsp;&nbsp;</b></td>";

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

		{

		//$qual .= "<td>".$row['qual_level']."</td></tr><tr><td>&nbsp;</td>";

		$qual .= "<td valign='top'>".'<b>'.$row['qual_level'].'</b>'."&nbsp;&nbsp;</td><td valign='top'>".$row['qual_subject']."&nbsp;&nbsp;</td><td valign='top'>".$row['qual_college']."</td></tr><tr><td>&nbsp;</td>";

		}

		$qual .="<td>&nbsp;</td></tr></table>";

		return $qual;

		//}

	}

	function getPendingUserQuals($user)

	{
    $this->db->where("user_id = $user AND qual_approved = 0");

    if ($stmt = $this->db->get('user_quals'))
    {

		  $qual = "<table><tr><td valign='top'><b>&nbsp;&nbsp;</b></td>";

      foreach ($stmt->result() as $row)
		  {
		    $qual .= "<td valign='top'><b>&nbsp;&nbsp;</b></td><td valign='top'>".'<b>'.$row->qual_level.'</b>'."&nbsp;&nbsp;</td><td valign='top'>".$row->qual_subject."&nbsp;&nbsp;</td><td valign='top'>".$row->qual_college."</td><td align='right'>";
		    $qual .= anchor('member/delete_qualification/'.$row->id,'Remove',array('onClick' => "return confirm('Are you sure you want to delete this qualification?')"));
		    $qual .= "</td></tr><tr><td>&nbsp;</td>";
      }

		  $qual .="<td>&nbsp;</td></tr></table>";

		  return $qual;
    }
    else
    {echo $this->db->last_query();
      return false;
    }
	}



	function set_user_qualification($user)

	{
		$data = array
		(
			'user_id'             => $user['user_id'],
			'qual_level'          => $user['qual_level'],
			'qual_subject'        => $user['qual_subject'],
			'qual_college'        => $user['qual_college'],
			'qual_town'           => $user['qual_town'],
			'qual_county'         => $user['qual_county'],
			'qual_start'          => $user['qual_start'],
			'qual_end'            => $user['qual_end'],
			'qual_status'         => $user['qual_status'],
			'qual_approved'       => $user['qual_approved'],
			'qual_email'          => $user['qual_email'],
			'qual_website'        => $user['qual_website'],
			'qual_telephone'      => $user['qual_telephone'],
			'qual_accreditation'  => $user['qual_accreditation'],
			'qual_method'         => $user['qual_method']
		);

		$this->db->insert('user_quals', $data);

		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return $this->db->error();
		}
	}



	function delete_qualification($id)

	{
    $data = array
    (
      'qual_approved' => 4
    );

        $this->db->where('id', $id);

    if (!$this->db->update('user_quals', $data))
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