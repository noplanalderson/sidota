<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_m extends CI_Model 
{

	public function getProfile($id)
	{
		$this->db->select('a.user_id, a.user_name,
							a.user_email,
							a.jobdesc_series,
							b.employee_name, b.employee_place_ob,
							b.employee_date_ob, b.employee_address,
							b.employee_phone, b.employee_picture,
							b.facebook, b.instagram, b.website,
							b.employee_bio,
							c.jobdesc_name');
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'inner');
		$this->db->join('tb_jobdesc c', 'a.jobdesc_id = c.jobdesc_id', 'inner');
		$this->db->where('md5(a.user_id)', verify($id));

		return $this->db->get('tb_user a', 1)->row();
	}

	private function _getCategories()
	{
		$this->db->select('show_category');
		$result = $this->db->get('tb_app_setting')->row();
		return $result->show_category;
	}

	public function countCategories($id)
	{
		$list 	= $this->app->show_category;
		$array 	= array_map('intval', explode(',', $list));
		$array 	= implode("','",$array);

		$sql = "SELECT `b`.`category_activity`, 
				COUNT(`a`.`category_activity_id`) AS count,
					(SELECT COUNT(*) AS total FROM tb_activity a
						INNER JOIN tb_employee b
						ON `a`.`employee_id`=`b`.`employee_id`
					WHERE md5(`b`.`employee_id`) = ?
					AND `a`.`category_activity_id` IN ('".$array."')) AS total
				FROM tb_activity a
				INNER JOIN tb_category_activity b
				ON `a`.`category_activity_id`=`b`.`category_activity_id`
				INNER JOIN tb_employee c
				ON `a`.`employee_id`=`c`.`employee_id`
				WHERE md5(`c`.`employee_id`) = ?
				AND `a`.`category_activity_id` IN ('".$array."')
				GROUP BY `a`.`category_activity_id`
				ORDER BY count DESC LIMIT 0,5";
		return $this->db->query($sql, array(verify($id), verify($id)))->result();
	}

	public function period($id)
	{
		$this->db->select('date_format(a.date_activity, "%m/%Y") AS period');
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'inner');
		$this->db->where('md5(b.employee_id)', verify($id));
		$this->db->group_by('date_format(a.date_activity, "%M %Y")');
		$this->db->order_by('a.date_activity', 'desc');
		$this->db->limit($this->app->show_month);

		$result = $this->db->get('tb_activity a')->result();
		$result = array_reverse($result);

		$months = [];

		foreach ($result as $month) {
			$months[] = $month->period;
		}

		return $months;
	}

	public function countActivities($id)
	{
		$this->db->select('COUNT(a.activity) AS total');
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'inner');
		$this->db->where('md5(b.employee_id)', verify($id));
		$this->db->group_by('date_format(a.date_activity, "%Y-%m")');
		$this->db->order_by('a.date_activity', 'desc');
		$this->db->limit($this->app->show_month);
		
		$result = $this->db->get('tb_activity a')->result();
		$result = array_reverse($result);

		$activities = [];

		foreach ($result as $act) {
			$activities[] = $act->total;
		}

		return $activities;
	}
	
	public function uploadPP($pp, $id)
	{
		$this->db->where('md5(employee_id)', verify($id));
		return $this->db->update('tb_employee', ['employee_picture' => $pp]) ? true : false;
	}

	public function getImageByHash($hash)
	{
		$this->db->select('employee_picture');
		$this->db->where('md5(employee_id)', verify($hash));
		return $this->db->get('tb_employee')->row();
	}

	public function changeImageByHash($hash)
	{
		$this->db->where('md5(employee_id)', verify($hash));
		return $this->db->update('tb_employee', ['employee_picture' => 'default.png']) ? true : false;
	}

	public function updateProfile($data)
	{
		$profile = array(
			'employee_place_ob' => $data['employee_place_ob'],
			'employee_date_ob' => $data['employee_date_ob'],
			'employee_address' => $data['employee_address'],
			'employee_bio' => $data['employee_bio'],
			'employee_phone' => $data['employee_phone'],
			'facebook' => $data['facebook'],
			'instagram' => $data['instagram'],
			'website' => $data['website']
		);

		$account = array(
			'user_name' => strtolower($data['user_name']),
			'user_email' => strtolower($data['user_email'])
		);

		$this->db->where('user_id', $this->session->userdata('uid'));
		$account = $this->db->update('tb_user', $account) ?  true : false;

		if($account) {
			$this->db->where('employee_id', $this->session->userdata('uid'));
			return $this->db->update('tb_employee', $profile) ? true : false;
		}
	}

	public function changePassword($pwd)
	{
		$this->db->where('user_id', $this->session->userdata('uid'));
		return $this->db->update('tb_user', ['user_password' => $pwd]) ? true : false;
	}
}

/* End of file profil_m.php */
/* Location: ./application/models/profil_m.php */