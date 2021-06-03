<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_m extends CI_Model 
{
	public function getNotifications()
	{
		$this->db->select('a.problem_report, a.date_report, a.ticket_code, b.employee_name');
		$this->db->join('tb_employee b', 'a.created_by = b.employee_id', 'inner');
		$this->db->where('a.approved_by IS NULL');
		return $this->db->get('tb_ticket a', 5)->result();
	}

	public function getUnapprove()
	{
		$this->db->select('ticket_id');
		$this->db->where('approved_by IS NULL');
		return $this->db->get('tb_ticket')->num_rows();
	}

	public function getTickets($status)
	{	
		$this->db->select('a.ticket_code, a.problem_report, a.reporter, a.date_report,
							a.approved_by, a.solved_by, a.date_solved, a.status, a.created_by, 
							b.employee_name');
		$this->db->join('tb_employee b', 'a.created_by = b.employee_id', 'inner');
		if($status !== 'all') {
			$this->db->where('a.status', $status);
		}
		$this->db->order_by('a.date_report', 'desc');
		return $this->db->get('tb_ticket a')->result();
	}

	public function getTicketByHash($hash)
	{
		$this->db->where('md5(ticket_code)', verify($hash));
		return $this->db->get('tb_ticket')->row_array();
	}

	public function getTicketDetail($code)
	{	
		$this->db->select('a.*, b.category_activity');
		$this->db->join('tb_category_activity b', 'a.category_activity_id = b.category_activity_id', 'inner');
		$this->db->where('md5(a.ticket_code)', verify($code));
		return $this->db->get('tb_ticket a')->row();
	}

	public function getTicketByCode($code, $status)
	{
		$this->db->select('ticket_code, category_activity_id, problem_report, reporter, date_report, location');
		$this->db->where('md5(ticket_code)', verify($code));
		$this->db->where('status', $status);
		return $this->db->get('tb_ticket', 1)->row();
	}

	public function addToReport($data)
	{
		$data = array(
			'date_activity' => $data['date_activity'],
			'employee_id' => $this->session->userdata('uid'),
			'category_activity_id' => $data['category_activity_id'],
			'ticket_code' => $data['ticket_code'],
			'location' => strtoupper($data['location']),
			'location_address' => $data['location_address'],
			'shift' => $data['shift'],
			'activity' => $data['activity'],
			'problem' => $data['problem'],
			'action' => $data['action'],
			'result_activity' => $data['result_activity'],
			'status' => $data['status'],
			'form_activity' => isset($data['form_activity']) ? 'T' : 'F'
		);

		$insert = $this->db->insert('tb_activity', $data) ? true : false;
		return ($insert === true) ? $this->db->insert_id() : false;
	}

	public function approve($code, $employee)
	{
		$this->db->where('md5(ticket_code)', verify($code));
		$this->db->update('tb_ticket', 
			array(
				'approved_by' => $employee, 
				'date_solved' => date('Y-m-d'),
				'status' => 'approved'
			)
		);
	}

	public function close($code, $employee)
	{
		$this->db->where('md5(ticket_code)', verify($code));
		$this->db->update('tb_ticket', 
			array('solved_by' => $employee, 'status' => 'closed')
		);
	}

	public function getCategories()
	{
		$this->db->order_by('category_activity_id', 'asc');
		return $this->db->get('tb_category_activity')->result();
	}

	private function _codeGenerator()
	{
		$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($chars), 0, 8);
	}

	private function _checkCode($kode)
	{
		$this->db->select('ticket_code');
		$this->db->where('ticket_code', $kode);
		return $this->db->get('tb_ticket')->num_rows();
	}

	public function addTicket($post)
	{
		$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
		$ticket = array(
			'ticket_code' => substr(str_shuffle($chars), 0, 8),
			'created_by' => $this->session->userdata('uid'),
			'reporter' => strtoupper($post['reporter']),
			'problem_report' => $post['problem_report'],
			'date_report' => $post['date_report'],
			'location' => strtoupper($post['location']),
			'category_activity_id' => $post['category_activity_id']
		);

		return $this->db->insert('tb_ticket', $ticket) ? 1 : 0;
	}	

	public function deleteTicket($code)
	{
		$this->db->where('md5(ticket_code)', verify($code));
		return $this->db->delete('tb_ticket') ? 1 : 0;
	}

	public function editTicket($post)
	{
		$ticket = array(
			'reporter' => strtoupper($post['reporter']),
			'problem_report' => $post['problem_report'],
			'date_report' => $post['date_report'],
			'location' => strtoupper($post['location']),
			'category_activity_id' => $post['category_activity_id']
		);

		$this->db->where('md5(ticket_code)', verify($post['ticket_code']));
		return $this->db->update('tb_ticket', $ticket) ? 1 : 0;
	}
}

/* End of file tiket.php */
/* Location: ./application/models/tiket.php */