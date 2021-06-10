<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends SIDOTA_Core {

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

		$this->load->model('employee_m');
	}

	public function index()
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min',
			'datatables/datatables.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'datatables/datatables.min'
		);

		$this->_module 	= 'employee/employee_list';

		$this->js 		= 'page_js/employee';

		$this->_data	= array(
			'title'		=> $this->app->app_title_alt . ' - Employee List',
			'employees'	=> $this->employee_m->getEmployees(),
			'btn_add'	=> $this->app_m->getContentMenu('add-employee'),
			'btn_edit'	=> $this->app_m->getContentMenu('edit-employee'),
			'btn_delete'=> $this->app_m->getContentMenu('delete-employee')
		);

		$this->load_view();
	}

	public function add()
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons'
		);

		$this->_module 	= 'employee/add_employee';

		$this->js		= 'page_js/add_employee';

		$this->_data 	= array(
			'title'		=> $this->app->app_title_alt . ' - Add Employee',
			'jobdescs'	=> $this->employee_m->getJobdescs()
		);

		$this->load_view();
	}

	public function submit()
	{
		$post = $this->input->post(null, TRUE); 

		$this->load->library('form_filter');
		$this->form_validation->set_rules($this->form_filter->employee_validation());

		if ($this->form_validation->run() == TRUE) 
		{
			$jobdesc_series = $this->employee_m->getJobdescSeries($post['jobdesc_id']);
			
			if($this->employee_m->checkUser($post['user_name'], $post['user_email']) == 0)
			{
				$addEmployee 	= $this->employee_m->addEmployee($post);

				if($addEmployee !== FALSE)
				{
					$user = array(
						'employee_id' => $addEmployee,
						'user_name' => strtolower($post['user_name']),
						'user_email' => strtolower($post['user_email']),
						'user_password' => '', 
						'jobdesc_id' => $post['jobdesc_id'],
						'jobdesc_series' => $jobdesc_series,
						'user_token' => base64url_encode(hash_hmac('sha3-256', random_char(16,true), openssl_random_pseudo_bytes(16))),
						'is_active' => 0
					);

					if($this->employee_m->addUser($user) === true) 
					{
						$from = $this->config->item('smtp_user');
						$this->load->library('email');
						
						$this->email->from($from, 'Sistem Dokumentasi Data Center [SIDOTA]');
						$this->email->to($user['user_email']);
						
						$this->email->subject('SIDOTA - Account Activation');
						$this->email->message("Your email was registered. You can log into application with your email after you set password and activating your account.\nClick this link below to activating your SIDOTA user account\n\n" . base_url('activation/'.$user['user_token']));
						
						$this->email->send();

						$assetDir	= FCPATH . '/_/images/users/';
						$userDir 	= $assetDir.encrypt($addEmployee).'/';
						$userThumb 	= $assetDir.encrypt($addEmployee).'/thumbnail/';

						if (!is_dir($userDir)) mkdir($userDir, 0755, true);
						if (!is_dir($userThumb)) mkdir($userThumb, 0755, true);

						copy($assetDir.'default.png', $userDir.'default.png');
						copy($assetDir.'default.png', $userThumb.'default.png');

						$status = 1;
						$msg	= 'Employee Added.';
					}
					else
					{
						$status = 0;
						$msg	= 'Failed to Add User.';
					}
				}
				else
				{
					$status = 0;
					$msg	= 'Failed to Add Employee.';
				}
			}
			else
			{
				$status = 0;
				$msg 	= 'Username or Email was Registered.';	
			}
		} 
		else 
		{
			$status = 0;
			$msg 	= validation_errors();
		}

		$token 		= $this->security->get_csrf_hash();
		$result 	= array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}

	public function edit($hash = NULL)
	{
		$this->access_control->check_role();
		
		if(verify($hash) === FALSE) redirect('page_error');

		$employee = $this->employee_m->getEmployeeByHash($hash);
		if(empty($employee)) redirect('page_error');

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons'
		);

		$this->_module 	= 'employee/edit_employee';

		$this->js 		= 'page_js/add_employee';

		$this->_data	= array(
			'title'		=> $this->app->app_title_alt . ' - Edit Employee',
			'employee'	=> $employee,
			'jobdescs'	=> $this->employee_m->getJobdescs(),
			'employee_id' => $hash
		);

		$this->load_view();
	}

	public function do_edit()
	{
		$post = $this->input->post(null, TRUE); 

		$this->load->library('form_filter');
		$this->form_validation->set_rules($this->form_filter->editEmployee_validation());

		if ($this->form_validation->run() == TRUE) 
		{
			if($this->employee_m->checkEmail($post['user_email'], $post['employee_id']) == 0)
			{
				$user_token  = isset($post['is_active']) ? base64url_encode(hash_hmac('sha3-256', random_char(16,true), openssl_random_pseudo_bytes(16))) : NULL;

				$user = array(
					'user_email' => strtolower($post['user_email']),
					'jobdesc_id' => $post['jobdesc_id'],
					'jobdesc_series' => $post['jobdesc_series'],
					'user_token' => $user_token,
					'is_active' => isset($post['is_active']) ? 1 : 0
				);

				if($this->employee_m->editEmployee($user, $post['employee_name'], $post['employee_id']) === true) 
				{
					if(isset($post['is_active'])) 
					{
						$from = $this->config->item('smtp_user');
						$this->load->library('email');
						
						$this->email->from($from, 'Sistem Dokumentasi Data Center [SIDOTA]');
						$this->email->to($user['user_email']);
						
						$this->email->subject('SIDOTA - Account Re-activation');
						$this->email->message("Your email was edited by Admin. You can log into application with your email after you set password and re-activating your account.\nClick this link below to re-activating your SIDOTA user account\n\n" . base_url('activation/'.$user['user_token']));
						
						$this->email->send();
					}

					$status = 1;
					$msg	= 'Employee Edited.';
				}
				else
				{
					$status = 0;
					$msg	= 'Failed to Edit User.';
				}
			}
			else
			{
				$status = 0;
				$msg 	= 'Email was registered.';	
			}
		} 
		else 
		{
			$status = 0;
			$msg 	= validation_errors();
		}

		$token 		= $this->security->get_csrf_hash();
		$result 	= array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}

	public function delete()
	{
		$this->access_control->check_role();

		$hash = $this->input->post('id', TRUE);
		
		if( ! isset($hash) || (verify($hash) === false))
		{
			$code = 405;
			$status = 0;
			$msg = 'Choose Employee to Delete.';
		}
		else
		{
			if($this->employee_m->deleteEmployeeByHash($hash))
			{
				$this->load->helper('remove_dir');

				remove_dir('./_/images/users/'.$hash);
				remove_dir('./_/images/uploads/'.$hash);
				remove_dir('./_/files/documents/'.$hash);
				
				$code = 200;
				$status = 1;
				$msg = 'Employee Deleted.';
			}
			else
			{
				$code = 200;
				$status = 0;
				$msg = 'Failed to Delete Employee.';
			}
		}

		$token 	= $this->security->get_csrf_hash();
		$result = array('response' => $code, 'result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_status_header($code)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}
}