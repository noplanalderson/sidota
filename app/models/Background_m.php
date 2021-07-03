<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Background_m extends CI_Model {

	public function upload($image, $used_for)
	{
		$hash = base64url_encode(openssl_random_pseudo_bytes(64));

		return $this->db->insert('tb_background', [
			'bg_hash' => $hash,
			'image' => $image,
			'used_for' => $used_for
		]) ? true : false;
	}

	public function getImages($used_for)
	{
		$this->db->select('bg_hash, image, upload_date');
		$this->db->where('used_for', $used_for);
		$this->db->order_by('upload_date', 'desc');
		return $this->db->get('tb_background')->result();
	}

	public function getImageByHash($hash)
	{
		$this->db->select('image');
		$this->db->where('bg_hash', $hash);
		return $this->db->get('tb_background')->row();
	}

	public function deleteImageByHash($hash)
	{
		$this->db->where('bg_hash', $hash);
		return $this->db->delete('tb_background') ? true : false;
	}
}

/* End of file background_m.php */
/* Location: ./application/models/background_m.php */