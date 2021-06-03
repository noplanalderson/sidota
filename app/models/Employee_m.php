<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_m extends CI_Model {

	public function getEmployees()
	{
		$this->db->select("a.employee_name,
							 a.employee_address,
							 a.employee_phone,
							 b.user_name,
							 b.user_email,
							 b.user_id,
							 b.jobdesc_series,
							 IF(b.is_active = 1,'Active','Not Active') AS status,
							 c.jobdesc_name");
		$this->db->join('tb_user b', 'a.employee_id = b.employee_id', 'inner');
		$this->db->join('tb_jobdesc c', 'b.jobdesc_id = c.jobdesc_id', 'inner');
		$this->db->where('a.employee_id != ', $this->session->userdata('uid'));
		$this->db->order_by('a.employee_name', 'asc');
		
		return $this->db->get('tb_employee a')->result();
	}

	public function getJobdescs()
	{
		return $this->db->get('tb_jobdesc')->result();
	}

	public function getJobdescSeries($jobdesc_id)
	{
		$this->db->select('jobdesc_id');
		$this->db->where('jobdesc_id', $jobdesc_id);
		return $this->db->get('tb_user')->num_rows() + 1;
	}

	public function checkUser($username, $email)
	{
		$this->db->where('user_name', $username);
		$this->db->or_where('user_email', $email);
		return $this->db->get('tb_user')->num_rows();
	}

	public function addEmployee($data)
	{
		$object = array(
			'employee_name' => ucwords($data['employee_name']),
			'employee_place_ob' => strtoupper($data['employee_place_ob']),
			'employee_date_ob' => $data['employee_date_ob'],
			'employee_address' => $data['employee_address'],
			'employee_phone' => $data['employee_phone'],
			'facebook' => strtolower($data['facebook']),
			'instagram' => strtolower($data['instagram']),
			'website' => strtolower($data['website']),
			'employee_bio' => $data['employee_bio'],
			'employee_picture' => 'default.png'
		);

		return $this->db->insert('tb_employee', $object) ? $this->db->insert_id() : false;
	}

	public function addUser($data)
	{
		return $this->db->insert('tb_user', $data) ? true : false;
	}

	public function getEmployeeByHash($hash)
	{
		$this->db->select('a.employee_name, b.user_email, b.jobdesc_id, b.jobdesc_series, b.is_active');
		$this->db->join('tb_user b', 'a.employee_id = b.employee_id', 'inner');
		$this->db->where('md5(a.employee_id)', verify($hash));
		return $this->db->get('tb_employee a')->row();
	}

	public function checkEmail($email, $id)
	{
		$this->db->where('user_email', $email);
		$this->db->where('md5(employee_id) != ', verify($id));
		return $this->db->get('tb_user')->num_rows();
	}

	public function editEmployee($user, $name, $id)
	{
		$this->db->where('md5(employee_id)', verify($id));
		$update = $this->db->update('tb_user', $user) ? true : false;

		if($update) {
			$this->db->where('md5(employee_id)', verify($id));
			return $this->db->update('tb_employee', ['employee_name' => $name]) ? true : false;
		}
	}

	public function deleteEmployeeByHash($hash)
	{
		$this->db->where('md5(employee_id)', verify($hash));
		return $this->db->delete('tb_employee') ? true : false;
	}
}

/* End of file employee_m.php */
/* Location: ./app/models/employee_m.php */