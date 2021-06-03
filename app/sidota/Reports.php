<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends SIDOTA_Core {

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

	public function index($uid = NULL)
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min',
			'select2/css/select2.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'select2/js/select2.min',
			'tags/jquery.tagsinput.min',
			'jquery-ui/ui/widgets/datepicker'
		);

		$urlID 		= empty($uid) ? encrypt($this->session->userdata('uid')) : $uid; 
		$employeeID = (verify($urlID) === false) ? redirect('page_error') : $urlID;
		$employee	= $this->reports_m->getEmployeeName($employeeID);

		$this->_module 	= 'reports/month';

		$this->_script 	= 'month_js';

		$this->_data	= array(
			'title'		=> 'Reports - ' . $employee->employee_name,
			'months'	=> $this->reports_m->getMonth($uid),
			'employeeID'=> $employeeID
		);

		$this->load_view();
	}

	public function monthly($month = NULL, $uid = NULL)
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

		$urlID 		= empty($uid) ? encrypt($this->session->userdata('uid')) : $uid; 
		$employeeID = (verify($urlID) === false) ? redirect('page_error') : $urlID;
		$employee	= $this->reports_m->getEmployeeName($employeeID);

		$this->_module 	= 'reports/monthly_report';

		$this->_script 	= 'monthly_report_js';

		$this->_data	= array(
			'title'		=> $employee->employee_name . ' - ' . date('F Y', $month),
			'reports'	=> $this->reports_m->monthly($month, $uid),
			'employee'	=> $employee,
			'employeeID'=> $employeeID,
			'btn_copy'	=> $this->app_m->getContentMenu('copy-report'),
			'btn_edit'	=> $this->app_m->getContentMenu('edit-report'),
			'btn_delete'=> $this->app_m->getContentMenu('delete-report'),
			'btn_detail' => $this->app_m->getContentMenu('report-detail')
		);

		$this->load_view();
	}

	public function periodic($period = NULL, $uid = NULL)
	{
		$this->access_control->check_role();

		if(preg_match('/([0-9]{10}-[0-9]{10})$/', $period))
		{
			$period = explode('-', $period);
			$from = $period[0];
			$to = $period[1];
		}
		else
		{
			redirect('page_error');
		}

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

		$urlID 		= empty($uid) ? encrypt($this->session->userdata('uid')) : $uid; 
		$employeeID = (verify($urlID) === false) ? redirect('page_error') : $urlID;
		$employee	= $this->reports_m->getEmployeeName($employeeID);
		$title 		= $employee->employee_name . ' - ' . date('F Y', $from) . ' to ' . date('F Y', $to); 

		$this->_module 	= 'reports/monthly_report';

		$this->_script 	= 'monthly_report_js';

		$this->_data	= array(
			'title'		=> $title,
			'reports'	=> $this->reports_m->periodic($from, $to, $uid),
			'employee'	=> $employee,
			'employeeID'=> $employeeID,
			'btn_copy'	=> $this->app_m->getContentMenu('copy-report'),
			'btn_edit'	=> $this->app_m->getContentMenu('edit-report'),
			'btn_delete'=> $this->app_m->getContentMenu('delete-report'),
			'btn_detail' => $this->app_m->getContentMenu('report-detail')
		);

		$this->load_view();
	}

	public function delete()
	{
		$this->access_control->check_role();

		$id = $this->input->post('id', TRUE);
		
		if( ! isset($id) || (verify($id) === false))
		{
			$code = 405;
			$status = 0;
			$msg = 'Choose Report to Delete.';
		}
		else
		{
			if($this->reports_m->deleteReportByID($id))
			{
				$code = 200;
				$status = 1;
				$msg = 'Report Deleted.';
			}
			else
			{
				$code = 200;
				$status = 0;
				$msg = 'Failed to Delete Report.';
			}
		}

		$token 	= $this->security->get_csrf_hash();
		$result = array('response' => $code, 'result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_status_header($code)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}

	public function detail($id = NULL)
	{
		$this->access_control->check_role();

		if(verify($id) === false) redirect('page_error');

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
		);

		$this->_module 	= 'reports/report_detail';

		$this->_script	= 'report_detail_js';
		
		$report 		= $this->reports_m->getReportDetailByID($id);

		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Report Detail',
			'report'	=> $report,
			'employee' 	=> $this->reports_m->getEmployeeName(encrypt($report->employee_id))
		);

		$this->load_view();	
	}

	public function daily($shift = NULL, $date = NULL, $jobdesc = NULL)
	{
		$this->access_control->check_role();

		if(is_null($shift) || is_null($date) || is_null($jobdesc)) {
	    	$shift 	= 'pagi';
			$date 	= strtotime(date('Ymd'));
			$jobdesc = NULL;
		}
		else
		{
			$shift 	= preg_match("/[a-z]+$/", $shift) ? $shift : 'pagi';
			$date 	= (ctype_digit($date) && strtotime(date('Ymd', $date)) === (int)$date) ? $date : strtotime(date('Ymd'));
			$jobdesc= (verify($jobdesc) === false) ? encrypt(1) : $jobdesc;
		}

		if(isset($_POST['shift']))
        {
        	$this->form_validation->set_rules('shift', 'Shift', 'trim|required|regex_match[/^(pagi|siang|malam|wfh)$/]');
        	$this->form_validation->set_rules('date', 'Date', 'trim|required|regex_date');
        	$this->form_validation->set_rules('jobdesc_id', 'Jobdesc', 'required|integer|min_length[1]|max_length[11]');

        	if ($this->form_validation->run() == TRUE)
        	{
        		$shift  = $this->input->post('shift', TRUE);
        		$date   = strtotime($this->input->post('date', TRUE));
        		$jobdesc= encrypt($this->input->post('jobdesc_id', TRUE));

        		redirect('daily-report/'.$shift.'/'.$date.'/'.$jobdesc, 'location', 301);
        	}
        }
        
		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'jquery-ui/ui/widgets/datepicker'
		);

        $this->_module 	= 'reports/daily_report';

        $this->_script	= 'daily_js';

		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Daily Report',
			'reports'	=> $this->reports_m->getDailyReport($date, $shift, $jobdesc),
			'pic_list'	=> $this->reports_m->getPic($date, $shift, $jobdesc),
			'jobdescs'	=> $this->reports_m->getJobdesc(),
			'date'		=> $date,
			'shift'		=> $shift,
			'jobdesc_selected'	=> $jobdesc
		);

		$this->load_view();	
	}
}
