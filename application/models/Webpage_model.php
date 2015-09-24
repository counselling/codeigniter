<?php
/**
 * Created by PhpStorm.
 * User: Paul Hayter
 * Created for Counselling Ltd
 * Using Codeigniter framework version 3.0.0
 * Date: 16/05/2015
 * Time: 19:26
 */
 defined('BASEPATH') OR exit('No direct script access allowed');

class Webpage_model extends CI_Model
{

	function get_webpage($web=1)
	{
		$this->db->where('id',$web);
		$query =  $this->db->get('webpages');

		$row = $query->row();

		if($row)
		{
			return $row;
		}
		else
		{
			return FALSE;
		}
	}

	function get_site_map()
	{

		$d = '';

		$row = array();

		$d = '<h1>Information Site Map</h1>';

		$this->db->distinct();
		$this->db->select('category');
		$this->db->where('category !=', 'Index');
		$this->db->where('category !=', 'Server');
		$this->db->where('subdomain', 'www');
		$this->db->order_by("category", "asc");
		$stmt = $this->db->get('webpages');

		if ($stmt->num_rows() > 0)
		{
			foreach ($stmt->result() as $i)
			{
				$d .= '<br/><hr /><h2>' . $i->category . '</h2><hr />';

				$this->db->distinct();
				$this->db->select('subject');
				$this->db->where('category', $i->category);
				$this->db->order_by("subject", "asc");
				$stmt1 = $this->db->get_where('webpages');

				foreach ($stmt1->result() as $j)
				{
					$d .= '<b>' . $j->subject . '</b><br />';

					$this->db->where('category', $i->category);
					$this->db->where('subject', $j->subject);
					$this->db->order_by("pagetitle", "asc");
					$stmt2 = $this->db->get_where('webpages');

					foreach ($stmt2->result() as $k)
					{
						$d .= $k->pagetitle . ' - ';

						$d .= anchor('general/page/'.$k->id,$k->h1)."<br />";
					}
				}
			}


			$d .= '<br/>';

		}

		return $d;

	}
}