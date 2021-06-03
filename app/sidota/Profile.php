<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends SIDOTA_Core {

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

		$this->load->model('profile_m');
	}

	public function index($id = NULL)
	{
		$this->access_control->check_role();
		
		if(verify($id) === false) redirect('page_error');

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'chart.js/Chart.bundle.min'
		);

		$this->_module 	= 'profile/profile';
		
		$this->_script 	= 'profile_js';

		$employee 		= $this->profile_m->getProfile($id);

		if(empty($employee)) redirect('page_error');

		$this->_data 	= array(
			'title' 	=> 'Profile - '.$employee->employee_name,
			'profile'	=> $employee,
			'categories'=> $this->profile_m->countCategories($id),
			'periods'	=> json_encode($this->profile_m->period($id)),
			'activities'=> json_encode($this->profile_m->countActivities($id))
		);

		$this->load_view();
	}

	public function edit()
	{
		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min',
			'fileinput/css/fileinput.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'fileinput/js/fileinput.min',
			'fileinput/js/plugins/piexif.min',
			'fileinput/js/plugins/sortable.min',
			'fileinput/themes/fas/theme.min'
		);
		
		$this->_module 	= 'profile/edit_profile';

		$this->_script	= 'edit_profile_js';

		$id 			= encrypt($this->session->userdata('uid'));
		$employee 		= $this->profile_m->getProfile($id);
		$picture 		= array(
			'caption' => $employee->employee_name,
			'width' => '200px',
			'url' => base_url('delete-pp'),
			'key' => encrypt($employee->user_id)
		);

		if(empty($employee)) redirect('page_error');

		$this->_data 	= array(
			'title' 	=> 'Profile - '.$employee->employee_name,
			'employee'	=> $employee,
			'json_picture' => $picture
		);

		$this->load_view();
	}

	public function upload_pp()
	{
		$id = $this->input->post('id', TRUE);

		$image = null;

		if (verify($id) !== FALSE)
		{
			// Get Image's filename without extension
			$filename = pathinfo($_FILES['picture']['name'], PATHINFO_FILENAME);

			// Remove another character except alphanumeric, space, dash, and underscore in filename
			$filename = preg_replace("/[^a-zA-Z0-9 \-_]+/i", '', $filename);

			// Remove space in filename
			$filename = str_replace(' ', '-', $filename);

			//User temp
			$usertemp = FCPATH . '_/images/users/'.encrypt($this->session->userdata('uid')).'/tmp';

			// Userdir
			$userdir  = FCPATH . '_/images/users/'.encrypt($this->session->userdata('uid'));

			$config = array(
				'form_name' => 'picture', // Form upload's name
				'upload_path' => $usertemp, // Upload Directory. Default : ./uploads
				'allowed_types' => 'png|jpg|jpeg|webp', // Allowed Extension
				'max_size' => '5128', // Maximun image size. Default : 5120
				'detect_mime' => TRUE, // Detect image mime. TRUE|FALSE
				'file_ext_tolower' => TRUE, // Force extension to lower. TRUE|FALSE
				'overwrite' => TRUE, // Overwrite file. TRUE|FALSE
				'enable_salt' => TRUE, // Enable salt for image's filename. TRUE|FALSE
				'file_name' => $filename, // New Image's Filename
				'extension' => 'webp', // New Imaage's Extension. Default : webp
				'quality' => '100%', // New Image's Quality. Default : 95%
				'maintain_ratio' => true, // Maintain image's dimension ratio. TRUE|FALSE
				'cleared_path' => $userdir
			);

			// Load Library
			$this->load->library('secure_upload');

			// Send library configuration
			$this->secure_upload->initialize($config);

			// Run Library
			if($this->secure_upload->doUpload())
			{
				// Get Image(s) Data
				$data = $this->secure_upload->data();

				//Create Thumbnail

        		$imageSize = @getimagesize($data['full_path']);

				$t_config['image_library'] 	= 'gd2';
				$t_config['source_image'] 	= $data['full_path'];
				$t_config['create_thumb'] 	= TRUE;
				$t_config['quality']		= '95%';
				$t_config['maintain_ratio'] = FALSE;
				$t_config['thumb_marker'] 	= '';
				$t_config['width']         	= 300;
				$t_config['height']       	= 300;
				$t_config['new_image']		= $userdir.'/thumbnail/';
				$t_config['y_axis']			= ($imageSize[1] - 300) / 2;
				$t_config['x_axis']			= ($imageSize[0] - 300) / 2;

				if (!is_dir($t_config['new_image'])) mkdir($t_config['new_image'], 0755, true);

        		$this->load->library('image_lib');
        		$this->image_lib->initialize($t_config);
        		if ( ! $this->image_lib->crop())
				{
					$error = $this->image_lib->display_errors();
				}
				else
				{
					$this->image_lib->clear();

					$result = $this->profile_m->uploadPP($data['file_name'], $id);
					if($result === false) {
						$error = 'Failed to Insert Image';
					} else {
						$image = $id.'/'.$data['file_name'];
						$error = null;
					}
				}
			}
			else
			{
				$error = $this->upload->display_errors();
			}
		}
		else
		{
			$error = 'Invalid User ID.';
		}

		echo json_encode(['error' => $error, 'image' => $image]);
	}

	public function delete_pp()
	{
		$hash = $this->input->post('key', TRUE);;

		if(verify($hash) === false)
		{
			$error = true;
		}
		else
		{
			$data = $this->profile_m->getImageByHash($hash);
			
			if(!empty($data)) {

				if($this->profile_m->changeImageByHash($hash) == true) {
					
					$error = null;
				}
				else
				{
					$error = true;
				}
			}
			else
			{
				$error = true;
			}
		}
		
		$json = json_encode(array('error' => $error));

		$this->output->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output($json);
	}

	public function change()
	{
		$data = $this->input->post(null, TRUE);

		$this->load->library('form_filter');
		$this->form_validation->set_rules($this->form_filter->profile_validation());

		if($this->form_validation->run() == TRUE) 
		{
			if($this->profile_m->updateProfile($data) === true) {

				$msg 	= 'Profile Updated.';
				$status = 1;
			}
			else
			{
				$msg 	= 'Failed to Update Profile.';
				$status = 0;
			}
		} 
		else 
		{
			$msg 	= validation_errors();
			$status = 0;
		}
	
		$token 		= $this->security->get_csrf_hash();
		$result 	= array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}

	public function password()
	{
		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons'
		);
		
		$this->_module 	= 'profile/change_password';

		$this->_script 	= 'password_js';

		$id 			= encrypt($this->session->userdata('uid'));
		$employee 		= $this->profile_m->getProfile($id);

		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Change Password',
			'employee'	=> $employee
		);

		$this->load_view();
	}

	public function submit_pwd()
	{
		$post = $this->input->post(null, TRUE);

		$rules = array(
			array(
				'field' => 'user_password',
		        'label' => 'Password',
		        'rules' => 'regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/]|required',
		        'errors'=> array('required' => '{field} required.',
                    'regex_match' => 'Password must contain uppercase, lowercase, numeric, and symbol 8-20 characters.'
                )
			),
			array(
				'field' => 'user_password2',
		        'label' => 'Repeat Password',
		        'rules' => 'required|matches[user_password]'
			)
		);

		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) 
		{
			$pwd = passwordHash($post['user_password'], 
				[
					'memory_cost' => 2048, 
					'time_cost' => 4, 
					'threads' => 3
				]
			);
			if($this->profile_m->changePassword($pwd)) {
				$status = 1;
				$msg 	= 'Password Changed.';
			}
			else
			{
				$status = 0;
				$msg 	= 'Failed to Change Password';
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
}
