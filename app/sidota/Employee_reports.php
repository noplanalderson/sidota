<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_reports extends SIDOTA_Core {

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

		$this->load->model('reports_m');
	}

	public function index()
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons'
		);

		$this->_module 	= 'reports/employee_reports';

		$this->_data	= array(
			'title'		=> $this->app->app_title_alt . ' - Employee Reports',
			'employees'	=> $this->reports_m->getEmployees()
		);

		$this->load_view();
	}
}