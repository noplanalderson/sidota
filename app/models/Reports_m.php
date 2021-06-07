<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_m extends CI_Model {
	
	public function getCategories()
	{
		$this->db->order_by('category_activity', 'asc');
		return $this->db->get('tb_category_activity')->result();
	}

	public function getMonth($uid)
	{
		$this->db->select("date_format(date_activity, '%M %Y') AS month");
		$this->db->where('md5(employee_id)', verify($uid));
		$this->db->where("date_format(date_activity, '%Y') = ", date('Y'));
		$this->db->order_by("date_format(date_activity, '%m%Y') ASC");
		$this->db->group_by("month");
		return $this->db->get('tb_activity')->result();
	}

	public function monthly($month, $uid)
	{
		$this->db->select('a.activity_id,
							a.employee_id,
							a.location,
							a.shift, a.activity,
							a.date_activity,
							a.problem,
							a.action,
							a.result_activity,
							a.status,
							b.category_activity');
		$this->db->join('tb_category_activity b', 'a.category_activity_id = b.category_activity_id', 'inner');
		$this->db->where("date_format(date_activity, '%Y-%m') = ", date('Y-m', $month));
		$this->db->where('md5(a.employee_id)', verify($uid));
		$this->db->order_by('a.date_activity', 'asc');
		return $this->db->get('tb_activity a')->result();
	}

	public function getEmployeeName($uid)
	{
		$this->db->select('a.jobdesc_series, b.employee_id, b.employee_name, c.jobdesc_name, b.employee_phone');
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'inner');
		$this->db->join('tb_jobdesc c', 'a.jobdesc_id = c.jobdesc_id', 'inner');
		$this->db->where('md5(a.user_id)', verify($uid));
		return $this->db->get('tb_user a')->row();
	}

	public function periodic($from, $to, $uid)
	{
		$this->db->select('a.activity_id,
							a.employee_id,
							a.location,
							a.shift, a.activity,
							a.problem, a.action,
							a.date_activity,
							a.result_activity,
							a.status,
							b.category_activity');
		$this->db->join('tb_category_activity b', 'a.category_activity_id = b.category_activity_id', 'inner');
		$this->db->where("a.date_activity BETWEEN '". date('Y-m-d', $from) ."' AND '" .date('Y-m-d', $to)."'");
		$this->db->where('md5(a.employee_id)', verify($uid));
		$this->db->order_by('a.date_activity', 'asc');
		return $this->db->get('tb_activity a')->result();
	}

	public function getReportByID($id)
	{
		$this->db->where('md5(activity_id)', verify($id));
		return $this->db->get('tb_activity')->row();
	}

	public function getToolsByActivity($id, $hash = FALSE)
	{
		if(!$hash) {

			$this->db->where('activity_id', $id);
		}
		else
		{
			$this->db->where('md5(activity_id)', verify($id));
		}
		return $this->db->get('tb_tool')->result();
	}

	private function _deleteImagesByActivity($id)
	{
		$this->db->select('picture');
		$this->db->where('md5(activity_id)', verify($id));
		$images = $this->db->get('tb_picture')->result();


		$this->db->select("date_format(date_activity, '%Y/%m') AS month");
		$this->db->where('md5(activity_id)', verify($id));
		$report = $this->db->get('tb_activity')->row();

		$directory  = './_/images/uploads/'.encrypt($this->session->userdata('uid')).'/'.$report->month;
		
		if(!empty($images))
		{
			foreach ($images as $image) {
				@unlink($directory.'/'.$image->picture);
				@unlink($directory.'/thumbnail/'.$image->picture);
			}
		}
	}

	public function deleteReportByID($id)
	{
		$this->_deleteImagesByActivity($id);
		$this->db->where('md5(activity_id)', verify($id));
		$this->db->where('employee_id', $this->session->userdata('uid'));
		return $this->db->delete('tb_activity') ? true : false;
	}

	public function getReportDetailByID($id)
	{
		$this->db->select('a.*, b.category_activity');
		$this->db->join('tb_category_activity b', 'a.category_activity_id = b.category_activity_id', 'inner');
		$this->db->where('md5(a.activity_id)', verify($id));
		return $this->db->get('tb_activity a')->row();
	}

	public function getEmployees()
	{
		$this->db->select('a.employee_id, b.employee_name, b.employee_picture, c.jobdesc_series, d.jobdesc_name');
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'left');
		$this->db->join('tb_user c', 'b.employee_id = c.employee_id', 'inner');
		$this->db->join('tb_jobdesc d', 'c.jobdesc_id = d.jobdesc_id', 'inner');
		$this->db->where('c.is_active', 1);
		$this->db->group_by('a.employee_id');
		$this->db->order_by('b.employee_name', 'asc');

		return $this->db->get('tb_activity a')->result();
	}

	public function getPic($date = NULL, $shift = NULL, $jobdesc_id = NULL)
	{
		$this->db->select('b.employee_name');
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'left');
		$this->db->join('tb_user c', 'b.employee_id = c.employee_id', 'left');
		$this->db->join('tb_jobdesc d', 'c.jobdesc_id = d.jobdesc_id', 'left');
		$this->db->where('a.shift', $shift);
		$this->db->where('a.date_activity', date('Y-m-d', $date));
		if(!is_null($jobdesc_id)) {
			$this->db->where('md5(d.jobdesc_id)', verify($jobdesc_id));
		}
		$this->db->group_by('a.employee_id');
		$pic_list = $this->db->get('tb_activity a')->result();

		$pic = array();

		foreach ($pic_list as $p) {
			$pic[] = $p->employee_name;
		}

		return implode(', ', $pic);
	}

	public function getDailyReport($date = NULL, $shift = NULL, $jobdesc_id = NULL)
	{
		$this->db->select('a.activity, a.problem, a.action, a.result_activity, a.location, a.shift, a.date_activity');
		$this->db->join('tb_user b', 'a.employee_id = b.employee_id', 'left');
		$this->db->join('tb_jobdesc c', 'b.jobdesc_id = c.jobdesc_id', 'left');
		$this->db->where('a.shift', $shift);
		$this->db->where('a.date_activity', date('Y-m-d', $date));
		if(!is_null($jobdesc_id)) {
			$this->db->where('md5(c.jobdesc_id)', verify($jobdesc_id));
		}
		$this->db->group_by('a.activity');
		return $this->db->get('tb_activity a')->result();
	}

	public function getJobdesc()
	{
		return $this->db->get('tb_jobdesc')->result();
	}

	public function getPictures($id) 
	{
		$this->db->select("a.picture_id, a.picture, b.activity, b.employee_id, date_format(a.upload_date, '%Y/%m') as month");
		$this->db->join('tb_activity b', 'a.activity_id = b.activity_id', 'inner');
		$this->db->where('md5(a.activity_id)', verify($id));
		$pictures = $this->db->get('tb_picture a')->result_array();
		return $pictures;
	}

	public function getJSON($pictures)
	{
		$datas = [];

		foreach ($pictures as $picture) {
			
			$datas[] =  array(
				'caption' => $picture['activity'],
				'width' => '200px',
				'url' => base_url('ajax-delete-image'),
				'key' => encrypt($picture['picture']),
				'downloadUrl' =>  base_url('download-documentation/single/'.encrypt($picture['picture']))
			);
		}

		return $datas;
	}

	public function singleUpload($picture, $activity_id)
	{
		return $this->db->insert('tb_picture', array(
			'activity_id' => $activity_id,
			'upload_date' => date('Y-m-d'),
			'picture' => $picture
		)) ? true : false;
	}

	public function insertTools($tools, $owners, $activity_id)
	{
		$count_tool = count($tools);
		$count_own = count($owners);

		for ($i = 0; $i < $count_tool; $i++) {
			$this->db->insert('tb_tool',
				array(
					'activity_id' =>  $activity_id,
					'tool' => $tools[$i],
					'tool_owner' => $owners[$i]
				)
			);
		}
	}

	public function addReport($data)
	{
		$data = array(
			'date_activity' => $data['date_activity'],
			'employee_id' => $this->session->userdata('uid'),
			'category_activity_id' => $data['category_activity_id'],
			'ticket_code' => NULL,
			'location' => strtoupper($data['location']),
			'location_address' => $data['location_address'],
			'shift' => $data['shift'],
			'activity' => $data['activity'],
			'problem' => $data['problem'],
			'action' => $data['action'],
			'result_activity' => $data['result_activity'],
			'status' => $data['status']
		);

		$insert = $this->db->insert('tb_activity', $data) ? true : false;
		return ($insert === true) ? $this->db->insert_id() : false;
	}

	private function _getActivityID($hash)
	{
		$this->db->select('activity_id');
		$this->db->where('md5(activity_id)', verify($hash));
		$id = $this->db->get('tb_activity')->row();
		return $id->activity_id;
	}

	public function editReport($data)
	{
		$object = array(
			'date_activity' => $data['date_activity'],
			'category_activity_id' => $data['category_activity_id'],
			'location' => strtoupper($data['location']),
			'location_address' => $data['location_address'],
			'shift' => $data['shift'],
			'activity' => $data['activity'],
			'problem' => $data['problem'],
			'action' => $data['action'],
			'result_activity' => $data['result_activity'],
			'status' => $data['status']
		);

		$this->db->where('md5(activity_id)', verify($data['activity_id']));
		$update = $this->db->update('tb_activity', $object) ? true : false;
		return ($update  === true) ? $this->_getActivityID($data['activity_id']) : false;
	}

	public function insertTool($tool, $owner, $activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$this->db->where('tool', $tool);
		$this->db->where('tool_owner', $owner);
		$count = $this->db->get('tb_tool')->num_rows();

		if($count > 0)
		{
			return true;
		}
		else
		{
			return $this->db->insert('tb_tool', [
				'activity_id' => $activity_id,
				'tool' => $tool,
				'tool_owner' => $owner
			]) ? true : false;
		}
	}

	public function removeTool($hash)
	{
		$this->db->where('md5(tool_id)', verify($hash));
		return $this->db->delete('tb_tool') ? true : false;
	}
}

/* End of file reports_m.php */
/* Location: ./application/models/reports_m.php */