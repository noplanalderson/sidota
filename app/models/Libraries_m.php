<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libraries_m extends CI_Model {

	public function getEbooks()
	{
		$this->db->select("a.ebook_id, a.ebook_categories, a.employee_id, a.ebook_title, a.ebook_description,
			date_format(upload_date, '%d %M %Y') AS uploadDate, a.ebook_file, b.employee_name");
		$this->db->join('tb_employee b', 'a.employee_id = b.employee_id', 'inner');
		$this->db->order_by('a.upload_date', 'asc');
		return $this->db->get('tb_ebook a')->result();
	}

	public function getCategories()
	{
		$this->db->select('category');
		$this->db->order_by('category', 'asc');
		return $this->db->get('tb_ebook_category')->result();
	}

	public function getEbookByHash($hash)
	{
		$this->db->select("*, date_format(upload_date, '%Y/%m') AS month");
		$this->db->where('md5(ebook_id)', verify($hash));
		return $this->db->get('tb_ebook', 1)->row();
	}

	public function getEbook($hash)
	{
		$this->db->select("employee_id, upload_date, ebook_file, date_format(upload_date, '%Y/%m') AS month");
		$this->db->where('md5(ebook_id)', verify($hash));
		$this->db->where('employee_id', $this->session->userdata('uid'));
		return $this->db->get('tb_ebook', 1)->row();
	}

	public function delete($hash)
	{
		$this->db->where('md5(ebook_id)', verify($hash));
		$this->db->delete('tb_ebook');

		return ($this->db->affected_rows() === 1) ? true : false;
	}

	public function addEbook($data, $file)
	{
		$object = array(
			'ebook_categories' => implode(', ', $data['category']),
			'employee_id' => $this->session->userdata('uid'),
			'ebook_title' => ucwords($data['ebook_title']),
			'ebook_description' => $data['ebook_description'],
			'upload_date' => date('Y-m-d'),
			'ebook_file' => $file
		);

		return $this->db->insert('tb_ebook', $object) ? true : false;
	}

	public function editEbook($data, $file)
	{
		$object = array(
			'ebook_categories' => implode(', ', $data['category']),
			'employee_id' => $this->session->userdata('uid'),
			'ebook_title' => ucwords($data['ebook_title']),
			'ebook_description' => $data['ebook_description'],
			'ebook_file' => $file
		);
		$this->db->where('md5(ebook_id)', verify($data['ebook_id']));
		return $this->db->update('tb_ebook', $object) ? true : false;
	}
}

/* End of file libraries_m.php */
/* Location: ./application/models/libraries_m.php */