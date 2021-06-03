<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentation_m extends CI_Model {

	public function monthly($month, $uid)
	{
		$this->db->select("a.picture_id, a.picture, date_format(a.upload_date, '%Y/%m') AS upload_date, b.activity, UNIX_TIMESTAMP(STR_TO_DATE(b.date_activity, '%Y-%m-%d')) AS date_activity, b.employee_id");
		$this->db->join('tb_activity b', 'a.activity_id = b.activity_id', 'inner');
		$this->db->where("date_format(b.date_activity, '%Y-%m') =", date('Y-m', $month));
		$this->db->where('md5(b.employee_id)', verify($uid));
		return $this->db->get('tb_picture a')->result();
	}

	public function getImageByHash($image)
	{
		$this->db->select('a.picture, b.activity, date_format(a.upload_date, "%Y/%m") AS month, b.employee_id');
		$this->db->join('tb_activity b', 'a.activity_id = b.activity_id', 'inner');
		$this->db->where('md5(picture)', verify($image));
		return $this->db->get('tb_picture a')->row();
	}

	public function deleteImageByHash($image)
	{
		$this->db->where('md5(picture)', verify($image));
		return $this->db->delete('tb_picture') ? true : false;
	}

	public function periodic($from, $to, $uid)
	{
		$this->db->select("a.picture_id, a.picture, date_format(a.upload_date, '%Y/%m') AS upload_date, b.activity, UNIX_TIMESTAMP(STR_TO_DATE(b.date_activity, '%Y-%m-%d')) AS date_activity, b.employee_id");
		$this->db->join('tb_activity b', 'a.activity_id = b.activity_id', 'inner');
		$this->db->where("b.date_activity BETWEEN '". date('Y-m-d', $from) ."' AND '" .date('Y-m-d', $to)."'");
		$this->db->where('md5(b.employee_id)', verify($uid));
		return $this->db->get('tb_picture a')->result();
	}
}

/* End of file documentation_m.php */
/* Location: ./application/models/documentation_m.php */