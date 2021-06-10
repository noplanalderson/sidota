<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentations extends SIDOTA_Core {

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
		$this->load->model('documentation_m');
	}

	public function index($uid = NULL)
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'jquery-ui/ui/widgets/datepicker'
		);

		$urlID 		= empty($uid) ? encrypt($this->session->userdata('uid')) : $uid; 
		$employeeID = (verify($urlID) === false) ? redirect('page_error') : $urlID;
		$employee	= $this->reports_m->getEmployeeName($employeeID);

		$this->_module 	= 'documentation/month';

		$this->js 		= 'page_js/month';

		$this->_data	= array(
			'title'		=> 'Documentation - ' . $employee->employee_name,
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
			'ionicons/css/ionicons.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons'
		);

		$urlID 		= empty($uid) ? encrypt($this->session->userdata('uid')) : $uid; 
		$employeeID = (verify($urlID) === false) ? redirect('page_error') : $urlID;
		$employee	= $this->reports_m->getEmployeeName($employeeID);

		$this->_module 	= 'documentation/monthly_documentation';

		$this->js 		= 'page_js/documentation';

		$this->_data	= array(
			'title'		=> $employee->employee_name . ' - ' . date('F Y', $month),
			'documentations' => $this->documentation_m->monthly($month, $uid),
			'employee'	=> $employee,
			'employeeID'=> $employeeID,
			'month'		=> $month,
			'btn_download' => $this->app_m->getContentMenu('download-documentation'),
			'btn_print' => $this->app_m->getContentMenu('print-documentation'),
			'btn_delete'=> $this->app_m->getContentMenu('delete-documentation')
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

		$this->_module 	= 'documentation/print_documentation';

		$this->js 		= 'page_js/documentation';

		$this->_data	= array(
			'title'		=> $title,
			'employee'	=> $employee,
			'employeeID'=> $employeeID,
			'documentations' => $this->documentation_m->periodic($from, $to, $uid)
		);

		$this->load_view();
	}

	public function preview($image = NULL)
	{
		$this->access_control->check_role();
		
		if(verify($image) === false) {
			$status = 404;
		}

		sleep(3);

		$image = $this->documentation_m->getImageByHash($image);

		if(!empty($image)) {

			$remoteFile = encrypt($image->employee_id).'/'.$image->month.'/'.$image->picture;
			$dir = site_url('_/images/uploads/'.$remoteFile);
			$status = 200;
		}
		else 
		{
			$dir = site_url('_/images/photo-gallery2.png');
			$status = 200;
		}

		$json = json_encode(array('picture' => $dir));

		$this->output->set_status_header($status)
					 ->set_content_type('application/json')
					 ->set_output($json);
	}

	public function delete()
	{
		$this->access_control->check_role();

		$hash = $this->input->post('hash', TRUE);
		
		if( ! isset($hash) || (verify($hash) === false))
		{
			$code = 405;
			$status = 0;
			$msg = 'Choose Image to Delete.';
		}
		else
		{
			$data = $this->documentation_m->getImageByHash($hash);
			
			if(!empty($data)) {

				$remoteFile = encrypt($data->employee_id).'/'.$data->month.'/'.$data->picture;
				$thumbnail 	= encrypt($data->employee_id).'/'.$data->month.'/thumbnail/'.$data->picture;
				
				if($this->documentation_m->deleteImageByHash($hash) == true) {
					
					@unlink(FCPATH .'/_/images/uploads/'.$remoteFile);
					@unlink(FCPATH .'/_/images/uploads/'.$thumbnail);
					
					$code = 200;
					$status = 1;
					$msg = 'Image Deleted.';
				}
				else
				{
					$code = 200;
					$status = 0;
					$msg = 'Failed to Delete Image.';
				}
			}
			else
			{
				$code = 200;
				$status = 0;
				$msg = 'Failed to Delete Image. Image not Found.';
			}
		}

		$token 	= $this->security->get_csrf_hash();
		$result = array('response' => $code, 'result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_status_header($code)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}

	public function download($mode = NULL, $hash = NULL)
	{
		$this->access_control->check_role();

		if(verify($hash) === false) redirect('page_error');
		
		switch ($mode) 
		{
			case 'single':

				$image = $this->documentation_m->getImageByHash($hash);

				if(!empty($image)) {

					$remoteFile = './_/images/uploads/'.encrypt($image->employee_id).'/'.$image->month.'/'.$image->picture;
					$fileinfo 	= getimagesize($remoteFile);
					$contents 	= file_get_contents($remoteFile);
					$title 		= str_replace(' ', '-', $image->activity);
					$extension	= image_type_to_extension($fileinfo[2]);

					force_download($title.$extension, $contents);
				}
				else
				{
					redirect('page_error');
				}
			break;
			
			default:

				$this->load->library('zip');

				if(ctype_digit($mode) 
			    	&& strtotime(date('Y-m-d H:i:s',$mode)) === (int)$mode) 
			    {
					$image = $this->documentation_m->monthly($mode, $hash);

					if(!empty($image))
					{
						$employee = $this->reports_m->getEmployeeName($hash);

						$zip_name 	= $employee->employee_name.'-'.date('Ymd', $mode).'.zip';
						$path_img 	= glob(FCPATH.'/_/images/uploads/'.$hash.'/'.date('Y/m', $mode).'/*.{jpg,png,jpeg,webp}', GLOB_BRACE);
						
						if(is_dir(FCPATH.'/_/images/uploads/'.$hash.'/'.$image->month))
						{
							foreach ($path_img as $image) 
							{
								$this->zip->read_file($image);	
							}

							$this->zip->download($zip_name);
						}
					}
					else
					{
						redirect('page_error');
					}
				}
				else
				{
					redirect('page_error');
				}
			break;
		}
	}

	public function print($month = NULL, $uid = NULL)
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons'
		);

		$urlID 		= empty($uid) ? encrypt($this->session->userdata('uid')) : $uid; 
		$employeeID = (verify($urlID) === false) ? redirect('page_error') : $urlID;
		$employee	= $this->reports_m->getEmployeeName($employeeID);

		$this->_module 	= 'documentation/print_documentation';

		$this->js 		= 'page_js/documentation';

		$this->_data	= array(
			'title'		=> $employee->employee_name . ' - ' . date('F Y', $month),
			'documentations' => $this->documentation_m->monthly($month, $uid),
			'employee'	=> $employee,
			'employeeID'=> $employeeID
		);

		$this->load_view();
	}
}

/* End of file documentations.php */
/* Location: ./application/controllers/documentations.php */