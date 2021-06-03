<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends SIDOTA_Core {

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

		$this->load->model('dashboard_m');
	}

	public function index()
	{
		$this->_module 	= 'dashboard/dashboard';
		
		$this->_script 	= 'dashboard_js';

		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Dashboard',
			'categories'=> $this->dashboard_m->countCategories(),
			'activities'=> $this->dashboard_m->getActivities(),
			'tickets' 	=> $this->dashboard_m->getTickets(),
			'now'		=> date('Y-m-d'),
			'yesterday'	=> date('Y-m-d', strtotime("-7 day", time())),
			'btn_update'=> $this->app_m->getContentMenu('update-progress'),
			'btn_detail'=> $this->app_m->getContentMenu('report-detail')
		);

		$this->load_view();
	}
}
