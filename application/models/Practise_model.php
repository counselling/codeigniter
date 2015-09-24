<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Practise_model extends CI_Model 

{
    function get_practise_address($urn)
    {
        $this->db->where('member_id', $urn);
        $query = $this->db->get('practises');
    //echo $this->db->last_query();
    
        $d = '';
    
        if ($query->num_rows)
        {
            $row = $query->row();

            $d .= '<table><tr><td><b>Practice Address:</b></td>';
      
            if ($row->hostreet) $d  .= '<td>'.$row->hostreet.'</td></tr><tr><td></td>';
            if ($row->add2) $d      .= '<td>'.$row->add2.'</td></tr><tr><td></td>';
            if ($row->add3) $d      .= '<td>'.$row->add3.'</td></tr><tr><td></td>';
            if ($row->town) $d      .= '<td>'.$row->town.'</td></tr><tr><td></td>';
            if ($row->county) $d    .= '<td>'.$row->county.'</td></tr><tr><td></td>';
            if ($row->postcode) $d  .= '<td>'.$row->postcode.'</td></tr><tr><td></td>';
      
            $d .= '</tr></table><hr>';
        }
		return $d;
	}

	

	function setPractise($data)

	{
    $data = array(
      'member_id'   => $data['user_id'],
      'hostreet'    => $data['hostreet'],
      'add2'        => $data['add2'],
      'add3'        => $data['add3'],
      'town'        => $data['town'],
      'county'      => $data['county'],
      'postcode'    => $data['postcode'],
      'country'     => $data['country'],
      'priopt'      => $data['priopt'],
      'status'      => 1,
      'change_date' => $data['change_date']
    );
    
    $this->db->insert('practises', $data);
    
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

/* End of file practise_model.php */
/* Location: ./application/models/practise_model.php */