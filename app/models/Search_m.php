<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_m extends CI_Model 
{
	public function result($query)
	{
		$this->db->select('a.activity_id,
							a.employee_id,
							a.location,
							a.shift, a.activity,
							a.date_activity,
							a.problem, a.action,
							a.result_activity,
							a.status,
							b.category_activity,
							c.employee_name');
		$this->db->join('tb_category_activity b', 'a.category_activity_id = b.category_activity_id', 'inner');
		$this->db->join('tb_employee c', 'a.employee_id = c.employee_id', 'inner');
		$this->db->like('a.activity', $query, 'BOTH');
		$this->db->or_like('a.result_activity', $query, 'BOTH');
		$this->db->or_like('c.employee_name', $query, 'BOTH');
		$this->db->order_by('a.date_activity', 'asc');

		return $this->db->get('tb_activity a')->result();
	}	

	public function countResult($query)
	{
		$this->db->select('a.activity_id');
		$this->db->join('tb_category_activity b', 'a.category_activity_id = b.category_activity_id', 'inner');
		$this->db->join('tb_employee c', 'a.employee_id = c.employee_id', 'inner');
		$this->db->like('a.activity', $query, 'BOTH');
		$this->db->or_like('a.result_activity', $query, 'BOTH');
		$this->db->or_like('c.employee_name', $query, 'BOTH');
		$this->db->order_by('a.date_activity', 'asc');

		return $this->db->get('tb_activity a')->num_rows();	
	}
}