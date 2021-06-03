<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_m extends CI_Model {

	public function getUserType()
	{
		return $this->db->get('tb_user_type')->result();
	}

	public function getAccessList($type_id)
	{
		$this->db->select('a.menu_label');
		$this->db->join('tb_roles b', 'a.menu_id = b.menu_id', 'inner');
		$this->db->where('b.type_id', $type_id);
		$this->db->order_by('menu_label', 'asc');
		$result = $this->db->get('tb_menu a');
		
		$data = $result->result_array();
		$count= $result->num_rows();

		if($count !== 0)
		{
			foreach ($data as $row) 
			{
				$priv[] = $row['menu_label'];
			}

			return implode(', ', $priv);
		}
	}

	public function getIndexPage($type_id)
	{
		$this->db->select('a.menu_label, a.menu_link');
		$this->db->join('tb_roles b', 'a.menu_id = b.menu_id', 'inner');
		$this->db->where('b.type_id', $type_id);
		$this->db->where('a.menu_location != ', 'content');
		$this->db->where('a.menu_link != ', '#');
		$this->db->order_by('menu_label', 'asc');
		$result = $this->db->get('tb_menu a');
		
		return $result->result();
	}

	public function getMenus()
	{
		$this->db->select('menu_id, menu_label');
		$this->db->order_by('menu_label', 'asc');
		return $this->db->get('tb_menu')->result();
	}

	private function _getRolesByHash($hash)
	{
		$this->db->select('menu_id');
		$this->db->where('md5(type_id)', $hash);
		$result = $this->db->get('tb_roles');

		$data = $result->result_array();
		$count= $result->num_rows();

		if($count !== 0)
		{
			foreach ($data as $row) 
			{
				$priv[] = $row['menu_id'];
			}

			return implode(',', $priv);
		}
	}

	public function getAccessByHash($id)
	{
		$id 	= verify($id);
		$priv 	= array('priv' => $this->_getRolesByHash($id));
		
		$this->db->where('md5(type_id)', $id);
		$user_type =  $this->db->get('tb_user_type')->row_array();

		return array_merge($user_type, $priv);
	}

	public function addAccess($access)
	{
		$insert = $this->db->insert('tb_user_type', array('type_code' => $access['type_code'])) ? true : false;

		$id = $this->db->insert_id();

		if($insert)
		{
			$loop = count($access['menu_id']);

			for ($i = 0; $i < $loop; $i++)
			{
				$this->_addRoles($id, $access['menu_id'][$i]);
			}

			return true;
		}
	}

	private function _addRoles($id, $priv)
	{
		$object = array('type_id' => $id, 'menu_id' => $priv);
		return $this->db->insert('tb_roles', $object) ? true : false;
	}

	public function checkAccess($type, $id)
	{
		$this->db->select('type_code');
		$this->db->where('type_code', $type);
		$this->db->where('md5(type_id) !=', verify($id));
		return $this->db->get('tb_user_type')->num_rows();
	}

	private function _getAccessID($hash)
	{
		$this->db->select('type_id');
		$this->db->where('md5(type_id)', $hash);
		$id = $this->db->get('tb_user_type')->row();
		
		return $id->type_id;
	}

	public function editAccess($access)
	{
		$this->db->where('md5(type_id)', verify($access['type_id']));
		$delete = $this->db->delete('tb_roles') ? true : false;

		if($delete) {
			$this->db->where('md5(type_id)', verify($access['type_id']));
			$update = $this->db->update('tb_user_type', array('type_code' => $access['type_code']));
			if($update) {

				$id = $this->_getAccessID(verify($access['type_id']));
				$loop = count($access['menu_id']);

				for ($i = 0; $i < $loop; $i++)
				{
					$this->_addRoles($id, $access['menu_id'][$i]);
				}

				return true;
			}
		}
	}

	public function deleteAccess($hash)
	{
		$this->db->where('md5(type_id)', verify($hash));
		return $this->db->delete('tb_user_type') ? true : false;
	}

	public function updateIndex($data)
	{
		$this->db->where('md5(type_id)', verify($data['id']));
		return $this->db->update('tb_user_type', ['index_page' => $data['index_page']]) ? true : false;
	}
}

/* End of file access_m.php */
/* Location: ./application/models/access_m.php */