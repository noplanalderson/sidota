<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities_m extends CI_Model {

	public function getActivityCategories()
	{
		$this->db->order_by('category_activity', 'asc');
		return $this->db->get('tb_category_activity')->result();
	}

	public function getEbookCategories()
	{
		$this->db->order_by('category', 'asc');
		return $this->db->get('tb_ebook_category')->result();
	}

	public function getJobescs()
	{
		$this->db->select('a.jobdesc_id, a.jobdesc_name, b.type_code');
		$this->db->join('tb_user_type b', 'a.type_id = b.type_id', 'inner');
		$this->db->order_by('a.jobdesc_name', 'asc');
		return $this->db->get('tb_jobdesc a')->result();
	}

	public function getUserTypes()
	{
		return $this->db->get('tb_user_type')->result();
	}

	public function getJobdescByHash($hash)
	{
		$this->db->where('md5(jobdesc_id)', verify($hash));
		return $this->db->get('tb_jobdesc')->row_array();
	}

	public function getActivityCategoryByHash($hash)
	{
		$this->db->where('md5(category_activity_id)', verify($hash));
		return $this->db->get('tb_category_activity')->row_array();
	}

	public function getEbookCategoryByHash($hash)
	{
		$this->db->where('md5(id_category)', verify($hash));
		return $this->db->get('tb_ebook_category')->row_array();
	}

	public function addJobdesc($data)
	{
		return $this->db->insert('tb_jobdesc', array(
				'jobdesc_name' => ucwords($data['jobdesc_name']),
				'type_id' => $data['type_id']
		)) ? true  : false;
	}

	public function addActCategory($data)
	{
		return $this->db->insert('tb_category_activity', array(
			'category_activity'  => ucwords($data['category_activity'])
		)) ? true : false;
	}

	public function addEbookCategory($data)
	{
		return $this->db->insert('tb_ebook_category', array(
			'category'  => ucwords($data['category'])
		)) ? true : false;
	}

	public function editJobdesc($data)
	{
		$this->db->where('md5(jobdesc_id)', verify($data['jobdesc_id']));
		return $this->db->update('tb_jobdesc', array(
				'jobdesc_name' => ucwords($data['jobdesc_name']),
				'type_id' => $data['type_id']
		)) ? true  : false;
	}

	public function editActCategory($data)
	{
		$this->db->where('md5(category_activity_id)', verify($data['category_activity_id']));
		return $this->db->update('tb_category_activity', array(
			'category_activity'  => ucwords($data['category_activity'])
		)) ? true : false;
	}

	public function editEbookCategory($data)
	{
		$this->db->where('md5(id_category)', verify($data['id_category']));
		return $this->db->update('tb_ebook_category', array(
			'category'  => ucwords($data['category'])
		)) ? true : false;
	}

	public function deleteJobdesc($id)
	{
		$this->db->where('md5(jobdesc_id)', verify($id));
		return $this->db->delete('tb_jobdesc') ? true : false;
	}

	public function deleteActCategory($id)
	{
		$this->db->where('md5(category_activity_id)', verify($id));
		return $this->db->delete('tb_category_activity') ? true : false;
	}

	public function deleteEbookCategory($id)
	{
		$this->db->where('md5(id_category)', verify($id));
		return $this->db->delete('tb_ebook_category') ? true : false;
	}
}

/* End of file utili.php */
/* Location: ./application/models/utili.php */