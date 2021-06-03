<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_m extends CI_Model 
{
	public function countCategories()
	{
		$uid 	= $this->session->userdata('uid');
		$array 	= array_map('intval', explode(',', $this->app->show_category));
		$array 	= implode(",",$array);

		$sql = "SELECT b.category_activity, 
				COUNT(a.category_activity_id) AS hitung,
					(SELECT COUNT(*) AS total FROM tb_activity
						WHERE employee_id = ? AND category_activity_id IN (".$array.")) 
					AS total
				FROM tb_activity a
				INNER JOIN tb_category_activity b
				ON a.category_activity_id=b.category_activity_id
				WHERE a.employee_id = ?
				AND a.category_activity_id IN (".$array.")
				GROUP BY a.category_activity_id
				ORDER BY hitung DESC";
		return $this->db->query($sql, array($uid, $uid))->result();
	}

	public function getActivities()
	{
		$now = new DateTime();
		$now->setTimezone(new DateTimeZone('Asia/Jakarta'));

		$date = strtotime("-7 day", time());
		$yesterday = date('Y-m-d', $date);

		$this->db->select('a.activity_id, a.activity, a.result_activity, a.date_activity, a.status, b.employee_name');
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'inner');
		$this->db->where('a.date_activity >=', $yesterday);
		$this->db->where('a.date_activity <=', $now->format('Y-m-d'));
		$this->db->where('a.status !=', 'finished');
		$this->db->order_by('a.activity_id', 'desc');
		return $this->db->get('tb_activity a')->result();
	}
	
	public function getTickets()
	{
		$this->db->select('ticket_code, date_report, problem_report, approved_by, solved_by, status');
		$this->db->order_by('ticket_id', 'desc');
		return $this->db->get('tb_ticket', 10)->result();
	}

	public function getFormData($id)
	{
		$this->db->select('a.activity_id, a.employee_id,
							a.location, a.location_address,
							a.activity, a.date_activity,
							a.tools, a.result_activity,
							b.category_activity,
							c.employee_name,
							c.employee_phone');
		$this->db->join('tb_category_activity b', 'a.category_activity_id = b.category_activity_id', 'inner');
		$this->db->join('tb_employee c', 'a.employee_id=c.employee_id', 'inner');
		$this->db->where('md5(a.activity_id)', decrypt($id));
		return $this->db->get('tb_activity a')->row();
	}

	public function getPicture($id)
	{
		$this->db->select('picture');
		$this->db->where('activity_id', $id);
		return $this->db->get('tb_picture')->result();
	}
}

/* End of file dashboard_m.php */
/* Location: ./application/models/dashboard_m.php */