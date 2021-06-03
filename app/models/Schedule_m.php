<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_m extends CI_Model 
{
	public function getYears()
	{
		$this->db->select("DISTINCT date_format(date_activity, '%Y') AS year");
		return $this->db->get('tb_activity')->result();
	}

	public function getEmployees()
	{
		$this->db->select('a.employee_id, b.employee_name, c.jobdesc_id');
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'left');
		$this->db->join('tb_user c', 'b.employee_id = c.employee_id', 'left');
		$this->db->where('c.is_active', 1);
		$this->db->group_by('b.employee_name');
		$this->db->order_by('a.shift', 'asc');
		return $this->db->get('tb_activity a')->result();
	}

	public function getSchedule($emp_id, $month, $day)
	{
		$this->db->select("date_format(date_activity, '%d') AS day, shift");
		$this->db->where('employee_id', $emp_id);
		$this->db->where("date_format(date_activity, '%Y-%m') = ", $month);
		$this->db->where("date_format(date_activity, '%d') =", $day);
		$this->db->group_by("date_format(date_activity, '%d')");
		return $this->db->get('tb_activity')->row();
	}
	
	public function getShift($emp_id, $month, $day)
	{
		$this->db->select('shift');
		$this->db->where('employee_id', $emp_id);
		$this->db->where("date_format(date_activity, '%Y-%m') = ", $month);
		$this->db->where("date_format(date_activity, '%d') = ", $day);
		$this->db->group_by('shift');
		return $this->db->get('tb_activity')->result();
	}
}

/* End of file schedule_m.php */
/* Location: ./application/models/schedule_m.php */