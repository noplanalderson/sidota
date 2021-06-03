<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_m extends CI_Model {

	public function getMainMenu()
	{
		$this->db->select('a.menu_id, a.menu_label, a.menu_link, a.menu_icon');
		$this->db->join('tb_roles b', 'a.menu_id = b.menu_id', 'inner');
		$this->db->where('a.menu_location', 'mainmenu');
		$this->db->where('b.type_id', $this->session->userdata('gid'));
		$this->db->order_by('a.menu_id', 'asc');
		return $this->db->get('tb_menu a')->result_array();
	}

	public function getSubMenu($parent_id)
	{
		$this->db->select('a.menu_label, a.menu_link, a.menu_icon');
		$this->db->join('tb_roles b', 'a.menu_id = b.menu_id', 'inner');
		$this->db->where('a.menu_location', 'submenu');
		$this->db->where('a.menu_parent', $parent_id);
		$this->db->where('b.type_id', $this->session->userdata('gid'));
		$this->db->order_by('a.menu_id', 'asc');
		return $this->db->get('tb_menu a')->result_array();
	}

	public function getContentMenu($link)
	{
		$this->db->select('a.menu_label, a.menu_link, a.menu_icon');
		$this->db->join('tb_roles b', 'a.menu_id = b.menu_id', 'inner');
		$this->db->where('a.menu_location', 'content');
		$this->db->where('b.type_id', $this->session->userdata('gid'));
		$this->db->where('a.menu_link', $link);
		$this->db->order_by('a.menu_id', 'asc');
		return $this->db->get('tb_menu a')->row();
	}

	public function checkRole($menu, $gid)
	{
		$this->db->select('a.role_id');
		$this->db->join('tb_menu b', 'a.menu_id = b.menu_id', 'inner');
		$this->db->where('a.type_id', $gid);
		$this->db->where('b.menu_link', $menu);
		return $this->db->get('tb_roles a')->num_rows();
	}

	public function getUserProfile()
	{
		$this->db->select("a.user_name, a.jobdesc_series, a.last_login, INET6_NTOA(a.last_ip) AS ip,
						   b.employee_picture, b.employee_name, b.employee_phone,
						   c.jobdesc_name, d.index_page");
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'inner');
		$this->db->join('tb_jobdesc c', 'a.jobdesc_id = c.jobdesc_id', 'inner');
		$this->db->join('tb_user_type d', 'c.type_id = d.type_id', 'inner');
		$this->db->where('a.user_id', $this->session->userdata('uid'));
		return $this->db->get('tb_user a')->row();
	}

	public function getAppSetting()
	{
		return $this->db->get('tb_app_setting', 1)->row();
	}

	public function updateSettings($settingData)
	{
		return $this->db->update('tb_app_setting', $settingData) ? true : false;
	}

	public function getActivityCategories()
	{
		return $this->db->get('tb_category_activity')->result();
	}

	public function uploadImage($index, $image)
	{
		return $this->db->update('tb_app_setting', [$index => $image]) ? true : false;
	}

	public function updateSetting($data)
	{
		$data = array(
			'app_title' => $data['app_title'],
			'app_title_alt' => strtoupper($data['app_title_alt']),
			'footer_text' => $data['footer_text'],
			'show_month' => $data['show_month'],
			'show_category' => implode(', ', $data['category_activity_id'])
		);

		return $this->db->update('tb_app_setting', $data) ? true : false;
	}
}

/* End of file App_m.php */
/* Location: ./application/models/App_m.php */