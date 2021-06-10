<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class On_going extends SIDOTA_Core {

	public function __construct()
	{
		parent::__construct();

		$this->access_control->check_login();
		$this->access_control->check_role();
		
		$this->_partial = array(
			'head',
			'header',
			'menubar',
			'body',
			'footer',
			'script'
		);

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min',
			'datatables/datatables.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'datatables/datatables.min'
		);

		$this->load->model('on_going_m');
	}

	public function index()
	{
		$this->_module 	= 'ongoing/on_going';
		
		$this->js 		= 'page_js/ongoing';

		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - On Going',
			'on_goings'	=> $this->on_going_m->onGoing(),
			'btn_update'=> $this->app_m->getContentMenu('update-progress'),
			'btn_detail'=> $this->app_m->getContentMenu('report-detail')
		);

		$this->load_view();
	}

	public function update()
	{
		$this->access_control->check_role();
		
		$status = 0;
		$msg = 'Report not Found.';

		$activity_id 	= $this->input->post('id', TRUE);
		$progress 		= $this->input->post('status', TRUE);

		$this->form_validation->set_rules('status', 'Status', 'trim|required|regex_match[/(finished|on-progress|pending)$/]', ['regex_match' => 'Invalid Report Status']);

		if ($this->form_validation->run() == TRUE) {

			if(verify($activity_id) !== false) 
			{
				if($this->on_going_m->updateStatus($activity_id, $progress) === true) {
					$status = 1;
					$msg = 'Adding Activity to '.$progress.' status.';
				}
			}
		} 
		else
		{
			$status = 0;
			$msg = validation_errors();
		}

		$token 	= $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token, 'progress' => $progress);

		$this->output->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}
}
