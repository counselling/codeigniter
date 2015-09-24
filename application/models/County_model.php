<?php defined('BASEPATH') OR exit('No direct script access allowed');

class County_model extends CI_Model {

	function __construct()
	{
		// Call the Model Constructor
		parent::__construct();
	}
    
	function get_dropdown_list()
    {
        $county = array();
        $county['Select'] = 'Please Select';
        $this->db->order_by("country", "asc");
        $this->db->order_by("county", "asc");
        $query = $this->db->get('county');

        foreach ($query->result() as $row)
        {
            $county[$row->country][$row->county] = $row->county;
        }

        return $county;
    }

}
/* End of file county_model.php */
/* Location: ./application/models/county_model.php */
