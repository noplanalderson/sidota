<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class On_going_m extends CI_Model 
{

	public function onGoing()
	{
		$this->db->select('a.activity_id, a.activity, a.date_activity, a.result_activity, a.status, b.employee_name');
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'inner');
		$this->db->where('a.status !=', "finished");
		$this->db->order_by('a.date_activity', 'desc');
		return $this->db->get('tb_activity a')->result();
	}

	public function updateStatus($id, $status)
	{
		$this->db->where('md5(activity_id)', verify($id));
		return $this->db->update('tb_activity', array('status' => $status)) ? true : false;
	}
}

/* End of file on_going_m.php */
/* Location: ./application/models/on_going_m.php */