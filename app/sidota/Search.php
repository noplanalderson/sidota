<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends SIDOTA_Core {

	public function __construct()
	{
		parent::__construct();

		$this->access_control->check_login();

		$this->_partial = array(
			'head',
			'header',
			'menubar',
			'body',
			'footer',
			'script'
		);

		$this->load->model('search_m');
	}

	public function index()
	{
		$query = $this->input->post('query', TRUE);

		$this->form_validation->set_rules('query', 'Query', 'trim|required|regex_match[/[a-zA-Z0-9\s]+$/]|min_length[3]');
		
		if ($this->form_validation->run() == TRUE) 
		{
			$result = 1;
			$msg = NULL;
			$url = 'search-result/'.urlencode($query);

			// redirect('search-result/'.urlencode($query), 'location', 301);
		} 
		else 
		{
			$result = 0;
			$msg = strip_tags(validation_errors());
			$url = NULL;
			// redirect('page_error');
		}

		$token = $this->security->get_csrf_hash();
		$result = array('result' => $result, 'msg' => $msg, 'token' => $token, 'url' => $url);
			
		$this->output->set_status_header(200)
				 ->set_content_type('application/json')
				 ->set_output(json_encode($result));
	}

	public function result($query = NULL)
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min',
			'datatables/datatables.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'datatables/datatables.min',
			'jquery-ui/ui/widgets/datepicker'
		);

		$this->_module 	= 'search/search_result';

		$this->_script 	= 'search_js';

		$query 			= urldecode($query);
		$reports 		= $this->search_m->result($query);

		$this->_data	= array(
			'title'		=> 'Search - '.$query,
			'reports'	=> $reports,
			'countResult' => $this->search_m->countResult($query),
			'query'		=> $query
		);

		$this->load_view();
	}
}