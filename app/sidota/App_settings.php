<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_settings extends SIDOTA_Core {

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

		$this->load->model('app_m');
	}

	public function index()
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min',
			'select2/css/select2.min',
			'fileinput/css/fileinput.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'select2/js/select2.min',
			'fileinput/js/fileinput.min',
			'fileinput/js/plugins/piexif.min',
			'fileinput/js/plugins/sortable.min',
			'fileinput/themes/fas/theme.min'
		);

		$this->_module 	= 'app_setting/setting_view';

		$this->_script 	= 'setting_js';

		$app_icon 		= array(
			'type' => 'image',
			'filetype' => mime_content_type(FCPATH . '/_/images/sites/'.$this->app->app_icon),
			'caption' => 'Application Icon',
			'key' => encrypt($this->app->app_id)
		);

		$app_logo 		= array(
			'type' => 'image',
			'filetype' => mime_content_type(FCPATH . '/_/images/sites/'.$this->app->app_logo),
			'caption' => 'Application Logo',
			'key' => encrypt($this->app->app_id)
		);

		$app_logo_login = array(
			'type' => 'image',
			'filetype' => mime_content_type(FCPATH . '/_/images/sites/'.$this->app->app_logo_login),
			'caption' => 'Application Logo Login',
			'key' => encrypt($this->app->app_id)
		);

		$this->_data	= array(
			'title'		=> $this->app->app_title_alt . ' - App Setting',
			'categories'=> $this->app_m->getActivityCategories(),
			'json_icon' => $app_icon,
			'json_logo' => $app_logo,
			'json_logo_login' =>  $app_logo_login
		);

		$this->load_view();
	}

	public function upload()
	{
		$index = $this->input->post('id', TRUE);

		$this->form_validation->set_rules('id', 'Index ID', 'required|regex_match[/(app_icon|app_logo|app_logo_login)$/]');

		if ($this->form_validation->run() == TRUE)
		{
			// Get Image's filename without extension
			$filename = pathinfo($_FILES[$index]['name'], PATHINFO_FILENAME);

			// Remove another character except alphanumeric, space, dash, and underscore in filename
			$filename = preg_replace("/[^a-zA-Z0-9 \-_]+/i", '', $filename);

			// Remove space in filename
			$filename = str_replace(' ', '-', $filename);

			//User temp
			$usertemp = FCPATH . '_/images/tmp';

			// Userdir
			$userdir  = FCPATH . '_/images/sites';

			$config = array(
				'form_name' => $index, // Form upload's name
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
				$img = $this->secure_upload->data();

				if($this->app_m->uploadImage($index, $img['file_name']) === TRUE)
				{
					$error = null;
					$image = $img['file_name'];

					$this->cache->memcached->clean();
				}
				else
				{
					$error = 'Failed to Update Image.';
				}
			}
			else
			{
				$error 	= $this->secure_upload->show_errors();
			}
		}
		else
		{
			$error = validation_errors();
		}

		$result = array('error' => $error, 'image' => $image);

		$this->output->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}

	public function submit()
	{
		$post = $this->input->post(null, TRUE);

		$this->load->library('form_filter');
		$this->form_validation->set_rules($this->form_filter->appSetting_validation());

		if ($this->form_validation->run() == TRUE) 
		{
			if($this->app_m->updateSetting($post) === TRUE)
			{
				$status = 1;
				$msg 	= 'Settings Updated.';

				$this->cache->delete('sidota_setting');
			}
			else
			{
				$status = 0;
				$msg 	= 'Failed to Update Settings.';
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