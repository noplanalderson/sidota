<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backgrounds extends SIDOTA_Core {

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

		$this->load->model('background_m');
	}

	public function index()
	{
		$this->access_control->check_role();
		
		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min',
			'fileinput/css/fileinput.min',
			'datatables/datatables.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'fileinput/js/fileinput.min',
			'fileinput/js/plugins/piexif.min',
			'fileinput/js/plugins/sortable.min',
			'fileinput/themes/fas/theme.min',
			'datatables/datatables.min'
		);

		$this->_module 	= 'background/background';
		
		$this->js 		= 'page_js/background';

		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Login Background',
			'btn_delete'=> $this->app_m->getContentMenu('delete-bg-login'),
			'btn_add'	=> $this->app_m->getContentMenu('add-bg-login'),
			'path' 		=> site_url('_/images/sites/bg-login/'),
			'images'	=> $this->background_m->getImages('login'),
			'add_url' 	=> 'add-bg-login',
			'delete_url'=> 'delete-bg-login'
		);

		$this->load_view();
	}

	public function dashboard()
	{
		$this->access_control->check_role();
		
		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min',
			'fileinput/css/fileinput.min',
			'datatables/datatables.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'fileinput/js/fileinput.min',
			'fileinput/js/plugins/piexif.min',
			'fileinput/js/plugins/sortable.min',
			'fileinput/themes/fas/theme.min',
			'datatables/datatables.min'
		);

		$this->_module 	= 'background/background';
		
		$this->js 		= 'page_js/background';

		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Dashboard Background',
			'btn_delete'=> $this->app_m->getContentMenu('delete-bg-dashboard'),
			'btn_add'	=> $this->app_m->getContentMenu('add-bg-dashboard'),
			'path' 		=> site_url('_/images/sites/backgrounds/'),
			'images'	=> $this->background_m->getImages('dashboard'),
			'add_url' 	=> 'add-bg-dashboard',
			'delete_url'=> 'delete-bg-dashboard'
		);

		$this->load_view();
	}

	public function add_bg_login()
	{
		$this->access_control->check_role();

		if(!empty($_FILES['files']['name']))
		{
			$filesCount = count($_FILES['files']['name']);

            for($i = 0; $i < $filesCount; $i++)
            {
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

				// Get Image's filename without extension
				$filename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);

				// Remove another character except alphanumeric, space, dash, and underscore in filename
				$filename = preg_replace("/[^a-zA-Z0-9 \-_]+/i", '', $filename);

				// Remove space in filename
				$filename = str_replace(' ', '-', $filename);

				//User temp
				$usertemp = FCPATH . '_/images/sites/bg-login/tmp';

				// Userdir
				$userdir  = FCPATH . '_/images/sites/bg-login/';

				$config = array(
					'form_name' => 'file', // Form upload's name
					'upload_path' => $usertemp, // Upload Directory. Default : ./uploads
					'allowed_types' => 'png|jpg|jpeg|webp', // Allowed Extension
					'max_size' => '8096', // Maximun image size. Default : 5120
					'detect_mime' => TRUE, // Detect image mime. TRUE|FALSE
					'file_ext_tolower' => TRUE, // Force extension to lower. TRUE|FALSE
					'overwrite' => TRUE, // Overwrite file. TRUE|FALSE
					'enable_salt' => TRUE, // Enable salt for image's filename. TRUE|FALSE
					'file_name' => $filename, // New Image's Filename
					'extension' => 'webp', // New Imaage's Extension. Default : webp
					'quality' => '95%', // New Image's Quality. Default : 95%
					'maintain_ratio' => true, // Maintain image's dimension ratio. TRUE|FALSE
					'cleared_path' => $userdir,
					'width' => 4096,
					'height' => 1080
				);

				// Load Library
				$this->load->library('secure_upload');

				// Send library configuration
				$this->secure_upload->initialize($config);

				// Run Library
				if($this->secure_upload->doUpload())
				{
					// Get Image(s) Data
					$img 	= $this->secure_upload->data();
					$error 	= ($this->background_m->upload($img['file_name'], 'login') === true) ? null : true;

					$code 	= ($error === true) ? 'Failed to Insert Image' : 'Upload Success';
				}
				else
				{
					$error 	= true;
					$code 	= 'Failed to Upload Image';
				}
			}
		}

		echo json_encode(['error' => $error, 'code' => $code]);
	}

	public function add_bg_dashboard()
	{
		$this->access_control->check_role();
	
		if(!empty($_FILES['files']['name']))
		{
			$filesCount = count($_FILES['files']['name']);

            for($i = 0; $i < $filesCount; $i++)
            {
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

				// Get Image's filename without extension
				$filename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);

				// Remove another character except alphanumeric, space, dash, and underscore in filename
				$filename = preg_replace("/[^a-zA-Z0-9 \-_]+/i", '', $filename);

				// Remove space in filename
				$filename = str_replace(' ', '-', $filename);

				//User temp
				$usertemp = FCPATH . '_/images/sites/backgrounds/tmp';

				// Userdir
				$userdir  = FCPATH . '_/images/sites/backgrounds/';

				$config = array(
					'form_name' => 'file', // Form upload's name
					'upload_path' => $usertemp, // Upload Directory. Default : ./uploads
					'allowed_types' => 'png|jpg|jpeg|webp', // Allowed Extension
					'max_size' => '8096', // Maximun image size. Default : 5120
					'detect_mime' => TRUE, // Detect image mime. TRUE|FALSE
					'file_ext_tolower' => TRUE, // Force extension to lower. TRUE|FALSE
					'overwrite' => TRUE, // Overwrite file. TRUE|FALSE
					'enable_salt' => TRUE, // Enable salt for image's filename. TRUE|FALSE
					'file_name' => $filename, // New Image's Filename
					'extension' => 'webp', // New Imaage's Extension. Default : webp
					'quality' => '90%', // New Image's Quality. Default : 95%
					'maintain_ratio' => true, // Maintain image's dimension ratio. TRUE|FALSE
					'cleared_path' => $userdir,
					'width' => 4096,
					'height' => 1080
				);

				// Load Library
				$this->load->library('secure_upload');

				// Send library configuration
				$this->secure_upload->initialize($config);

				// Run Library
				if($this->secure_upload->doUpload())
				{
					// Get Image(s) Data
					$img 	= $this->secure_upload->data();
					$error 	= ($this->background_m->upload($img['file_name'], 'dashboard') === true) ? null : true;
					$code 	= ($error === true) ? 'Failed to Insert Image' : 'Upload Success';
				}
				else
				{
					$error 	= true;
					$code 	= 'Failed to Upload Image';
				}
			}
		}

		echo json_encode(['error' => $error, 'code' => $code]);
	}

	public function delete_bg_login()
	{
		$this->access_control->check_role();

		$hash = $this->input->post('hash', TRUE);

		$this->form_validation->set_rules('hash', 'Image Hash', 'trim|required|regex_match[/[a-zA-Z0-9\-_]+$/]');

		if ($this->form_validation->run() == TRUE) {

			$data = $this->background_m->getImageByHash($hash);
			
			if(!empty($data)) {
					
				@unlink(FCPATH . '_/images/sites/bg-login/' . $data->image);
				
				if($this->background_m->deleteImageByHash($hash) == true) {
				
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
		else
		{
			$code = 200;
			$status = 0;
			$msg = validation_errors();
		}

		$token 	= $this->security->get_csrf_hash();
		$json = json_encode(['result' => $status, 'msg' => $msg, 'token' => $token]);

		$this->output->set_status_header($code)
					 ->set_content_type('application/json')
					 ->set_output($json);
	}

	public function delete_bg_dashboard()
	{
		$this->access_control->check_role();

		$hash = $this->input->post('hash', TRUE);

		$this->form_validation->set_rules('hash', 'Image Hash', 'trim|required|regex_match[/[a-zA-Z0-9\-_]+$/]');

		if ($this->form_validation->run() == TRUE) {

			$data = $this->background_m->getImageByHash($hash);
			
			if(!empty($data)) {
					
				@unlink(FCPATH . '_/images/sites/backgrounds/' . $data->image);
				
				if($this->background_m->deleteImageByHash($hash) == true) {
				
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
		else
		{
			$code = 200;
			$status = 0;
			$msg = validation_errors();
		}

		$token 	= $this->security->get_csrf_hash();
		$json = json_encode(['result' => $status, 'msg' => $msg, 'token' => $token]);

		$this->output->set_status_header($code)
					 ->set_content_type('application/json')
					 ->set_output($json);
	}
}