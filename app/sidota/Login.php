<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends SIDOTA_Core {

	public function __construct()
	{
		parent::__construct();
		$this->access_control->is_login();

		$this->_partial = array(
			'head',
			'body',
			'script'
		);

		$this->load->model('login_m');

		$this->_script = 'login_js';
	}

	public function index()
	{
		$this->_module 	= 'account/login_view';
		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Login',
			'custom_js'	=> $this->_script()
		);

		$this->load_view();
	}

	public function activation($hash = NULL)
	{
		$user = $this->login_m->getUserByToken($hash);
		if(empty($user) || $user === 0) redirect('page_error');

		$this->_module 	= 'account/activation_view';
		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Activation',
			'custom_js'	=> $this->_script(),
			'user_token'=> $hash
		);

		$this->load_view();
	}

	public function do_activation()
	{	
		if(isset($_POST['submit']))
		{
			$post = $this->input->post(null, TRUE);
			
			$form_rules = [
		       	array(
					'field' => 'user_token',
					'label' => 'Token',
					'rules' => 'required|regex_match[/^[a-zA-Z0-9\-_+]+$/]',
					'errors'=> array(
						'required' => '{field} required.',
						'regex_match' => 'Allowed charcter for {field} are [a-zA-Z0-9\-_+].'
					)
				),
		       	array(
					'field' => 'user_password',
					'label' => 'Password',
					'rules' => 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,32}$/]',
					'errors'=> array(
						'required' => '{field} required.',
						'regex_match' => '{field} must contain Uppercase, Lowercase, Numeric, and Symbol min. 8 characters.'
					)
				),
				array(
					'field' => 'repeat_password',
					'label' => 'Repeat Password',
					'rules' => 'required|matches[user_password]',
					'errors'=> array(
						'required' => '{field} required.',
						'matches' => '{field} not match.' 
					)
				),
		    ];

			$this->form_validation->set_rules($form_rules);

			if ($this->form_validation->run() == TRUE)
			{
				$pwd = passwordHash($post['user_password'], 
					[
						'memory_cost' => 2048, 
						'time_cost' => 4, 
						'threads' => 3
					]
				);

				$account = array(
					"user_password" => $pwd,
					"user_token" => NULL,
					"is_active" => 1
				);

				if($this->login_m->getUserByToken($post['user_token']) == 1)
				{
					if($this->login_m->doActivation($account, $post['user_token'])) 
					{
						$status = 1;
						$msg = 'Activation Success. Please wait... ';
					}
					else
					{
						$status = 0;
						$msg = 'Activation Failed. ';
					}
				}
				else
				{
					$status = 0;
					$msg = 'User Account not Found.';
				}
			}
			else
			{
				$status = 0;
				$msg = validation_errors();
			}

			$token = $this->security->get_csrf_hash();
			$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
			echo json_encode($result);
		}
		else
		{
			redirect('login');
		}
	}

	public function auth()
	{	
		if(isset($_POST['submit']))
		{
			$user = [];

			$post = $this->input->post(null, TRUE);
			
			$form_rules = [
		        ['field' => 'user_name',
		         'label' => 'User Name',
		         'rules' => 'trim|required|regex_match[/^[a-zA-Z0-9@\-_.]+$/]',
		         'errors'=> array('required' => '{field} required', 
		                    'regex_match' => '{field} only allowed alfa numeric, dash, @, and underscore')
		        ],
		        ['field' => 'user_password',
		         'label' => 'Password',
		         'rules' => 'trim|required',
		         'errors'=> array('required' => '{field} required')
		        ]
		    ];

			$this->form_validation->set_rules($form_rules);

			if ($this->form_validation->run() == TRUE)
			{
				$userData =  $this->login_m->verify($post['user_name']);

				if($userData->num_rows() == 1) 
				{
					$user = $userData->row_array();

					if(password_verify($post['user_password'], $user['user_password'])) :
		
					$now = new DateTime();
					$now->setTimezone(new DateTimeZone('Asia/Jakarta'));

					$index_page = $user['index_page'];

					$sessionLogin = array(  
						'uid' 	=> $user['user_id'],
						'gid' 	=> $user['type_id'],
						'time'	=> strtotime($now->format('Y-m-d H:i:s')),
					);

					$this->session->set_userdata($sessionLogin);

					$status = 1;
					$msg = 'Login Success. Please wait... ';

					else:

						$status = 0;
						$msg = 'Login Failed. Wrong Password!';
					endif;
				}
				else
				{
					$status = 0;
					$msg = 'Login Failed. Username not found or deactivated!';
				}
			}
			else
			{
				$status = 0;
				$msg = validation_errors();
			}

			$token = $this->security->get_csrf_hash();
			$result = array('result' => $status, 'msg' => $msg, 'token' => $token, 'url' => empty($user) ? '' : $user['index_page']);
			
			$this->output->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
		}
		else
		{
			redirect('login');
		}
	}
}