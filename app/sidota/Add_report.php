<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_report extends SIDOTA_Core {

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
			'ionicons/css/ionicons.min',
			'select2/css/select2.min',
			'fileinput/css/fileinput.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'select2/js/select2.min',
			'tags/jquery.tagsinput.min',
			'jquery-ui/ui/widgets/datepicker',
			'fileinput/js/fileinput.min',
			'fileinput/js/plugins/piexif.min',
			'fileinput/js/plugins/sortable.min',
			'fileinput/themes/fas/theme.min'
		);

		$this->_module 	= 'reports/add_report';
		
		$this->_script 	= 'add_report_js';

		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Add Report',
			'categories'=> $this->reports_m->getCategories()
		);

		$this->load_view();
	}

	public function submit()
	{
		$data = $this->input->post(null, TRUE);
		$msg  = array();

		$this->load->library('form_filter');
		
		$this->form_validation->set_rules($this->form_filter->reportRules());
		
		if ($this->form_validation->run() == TRUE) 
		{
			$activity = $this->reports_m->addReport($data);

			if($activity === false)
			{
				$msg[] 	= 'Failed to Add Report/Activity.';
				$status = 1;
			}
			else
			{
				$this->reports_m->insertTools($data['tool'], $data['tool_owner'], $activity);

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
						$usertemp = FCPATH . '_/images/uploads/'.encrypt($this->session->userdata('uid')).'/tmp';

						// Userdir
						$userdir  = FCPATH . '_/images/uploads/'.encrypt($this->session->userdata('uid')).'/'.date('Y/m');

						$config = array(
							'form_name' => 'file', // Form upload's name
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

							//Create Thumbnail
							$imageSize = @getimagesize($img['full_path']);
							
							$t_config['image_library'] 	= 'gd2';
							$t_config['source_image'] 	= $img['full_path'];
							$t_config['create_thumb'] 	= TRUE;
							$t_config['quality']		= '95%';
							$t_config['maintain_ratio'] = FALSE;
							$t_config['thumb_marker'] 	= '';
							$t_config['width']         	= 200;
							$t_config['height']       	= 200;
							$t_config['new_image']		= $userdir.'/thumbnail/';
							$t_config['y_axis']			= ($imageSize[1] - 200) / 2;
							$t_config['x_axis']			= ($imageSize[0] - 200) / 2;

							if (!is_dir($t_config['new_image'])) mkdir($t_config['new_image'], 0755, true);

	                		$this->load->library('image_lib');
	                		$this->image_lib->initialize($t_config);

	                		if ( ! $this->image_lib->crop())
							{
								$msg[] = $this->image_lib->display_errors();
							}
							else
							{
								$this->image_lib->clear();

								$error = ($this->reports_m->singleUpload($img['file_name'],  $activity) === true) ? null : true;
								$msg[] = ($error === true) ? 'Failed to Insert Image' : 'Upload Success';
							}
						}
						else
						{
							$error = true;
							$msg[] = 'Failed to Upload Image';
						}
					}
				}
			}

			$msg[] 	= 'Success to Add Activity Report.';
			$status = 1;
		} 
		else 
		{
			$msg[] 	= validation_errors();
			$status = 0;
		}
	
		$messages 	= implode('<br/>', $msg);
		$token 		= $this->security->get_csrf_hash();
		$result 	= array('result' => $status, 'msg' => $messages, 'token' => $token);

		$this->output->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}
}