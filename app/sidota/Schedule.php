<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends SIDOTA_Core {

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
		
		$this->load->model('schedule_m');
	}

	public function index($period = NULL)
	{
		$this->access_control->check_role();

		if(is_null($period))
		{
			$period = strtotime(date('Y-m'));
			$month 	= date('m', $period);
			$year 	= date('Y', $period);
		}
		else
		{
			$period = (ctype_digit($period) && strtotime(date('Y-m', $period)) === (int)$period) ? $period : strtotime(date('Y-m'));
			$month 	= date('m', $period);
			$year 	= date('Y', $period);
		}

		if(isset($_POST['month']))
		{
			$this->form_validation->set_rules('month', 'Month', 'required|greater_than[0]|less_than[13]');
			$this->form_validation->set_rules('year', 'Year', 'required|exact_length[4]|integer');

			if ($this->form_validation->run() == TRUE) {
				
				$month 	= $this->input->post('month', TRUE);
				$year 	= $this->input->post('year', TRUE);
				$period = strtotime(date($year.'-'.$month));

				redirect('schedule/'.$period, 'location', 301);
			}
			else
			{
				$period = (ctype_digit($period) && strtotime(date('Ym', $period)) === (int)$period) ? $period : strtotime(date('Ym'));
				$month 	= date('m', $period);
				$year 	= date('Y', $period);
				redirect('schedule/'.$period, 'location', 301);
			}
		}

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min',
			'datatables/datatables.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons'
		);

		$this->_module 	= 'reports/employee_schedule';

		$this->_script 	= 'schedule_js';

		$this->_data	= array(
			'title'		=> $this->app->app_title_alt . ' - Schedule '.date('F Y', $period),
			'period'	=> $period,
			'calendar'	=> cal_days_in_month(CAL_GREGORIAN, $month, $year),
			'years'		=> $this->schedule_m->getYears(),
			'employees'	=> $this->schedule_m->getEmployees()
		);

		$this->load_view();		
	}
}