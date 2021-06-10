<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_report extends SIDOTA_Core {

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

	public function index($id = NULL)
	{
		$this->access_control->check_role();

		if(verify($id) === false) redirect('page_error');

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

		$this->_module 	= 'reports/copy_report';
		
		$this->_script 	= 'edit_report_js';

		$report 		=$this->reports_m->getReportByID($id);
		$pictures 		=$this->reports_m->getPictures($id);

		if(empty($report)) redirect('page_error'); 

		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Edit Report',
			'card_title'=> 'EDIT REPORT',
			'categories'=> $this->reports_m->getCategories(),
			'report'	=> $report,
			'pictures'	=> $pictures,
			'json_pictures'	=> $this->reports_m->getJSON($pictures),
			'tools'		=> $this->reports_m->getToolsByActivity($id, TRUE)
		);

		$this->load_view();
	}

	public function copy($id = NULL)
	{
		$this->access_control->check_role();

		if(verify($id) === false) redirect('page_error');

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

		$this->_module 	= 'reports/copy_report';
		
		$this->js 		= 'page_js/add_report';

		$report = $this->reports_m->getReportByID($id);
		if(empty($report)) redirect('page_error'); 

		$this->_data 	= array(
			'title' 	=> $this->app->app_title_alt . ' - Copy Report',
			'card_title'=> 'COPY REPORT',
			'categories'=> $this->reports_m->getCategories(),
			'report'	=> $report,
			'tools'		=> $this->reports_m->getToolsByActivity($id, TRUE)
		);

		$this->load_view();
	}

	public function delete_picture()
	{
		$hash = $this->input->post('key', TRUE);;

		if(verify($hash) === false)
		{
			$error = true;
		}
		else
		{
			$data = $this->documentation_m->getImageByHash($hash);
			
			if(!empty($data)) {

				$remoteFile = encrypt($data->employee_id).'/'.$data->month.'/'.$data->picture;
				
				if($this->documentation_m->deleteImageByHash($hash) == true) {
					
					@unlink(FCPATH .'/_/images/uploads/'.$remoteFile);
					@unlink(FCPATH .'/_/images/uploads/thumbnail/'.$remoteFile);
					
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

	public function single_upload()
	{
		$id = $this->input->post('id', TRUE);
		$date = $this->input->post('date_activity', TRUE);

		$this->form_validation->set_rules('id', 'ID', 'required|integer');
		$this->form_validation->set_rules('date_activity', 'Date', 'required|regex_date');

		if ($this->form_validation->run() == TRUE)
		{
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
						$data = $this->secure_upload->data();

						//Create Thumbnail

                		$imageSize = @getimagesize($data['full_path']);

						$t_config['image_library'] 	= 'gd2';
						$t_config['source_image'] 	= $data['full_path'];
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
							$error = true;
							$code = $this->image_lib->display_errors();
						}
						else
						{
							$this->image_lib->clear();

							$error = ($this->reports_m->singleUpload($data['file_name'], $id) === true) ? null : true;
							$code = ($error === true) ? 'Failed to Insert Image' : 'Upload Success';
						}
					}
					else
					{
						$error = true;
						$code = 'Failed to Upload Image';
					}
				}
			}
		}
		else
		{
			$error = true;
			$code = 'Validation Failed';
		}

		echo json_encode(['error' => $error, 'code' => $code]);
	}

	public function submit()
	{
		$data = $this->input->post(null, TRUE);

		$this->load->library('form_filter');
		$this->form_validation->set_rules($this->form_filter->reportRules());
		
		if ($this->form_validation->run() == TRUE) 
		{
			$activity = $this->reports_m->editReport($data);

			if($activity === false)
			{
				$msg 	= 'Failed to Edit Report/Activity.';
				$status = 0;
			}
			else
			{
				$msg 	= 'Success to Edit Activity Report.';
				$status = 1;
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

	public function remove_tool($hash)
	{
		$result = 0;

		if(verify($hash) !== false) {
			$result = ($this->reports_m->removeTool($hash) === true ) ? 1 : 0;
		}

		echo json_encode(['result' => $result]);
	}

	public function add_tool()
	{
		$activity = $this->input->post('activity_id', TRUE);
		$tool = $this->input->post('tool', TRUE);
		$owner = $this->input->post('tool_owner', TRUE);

		$rules = array(
			['field' => 'activity_id',
             'label' => 'ID Activity',
             'rules' => 'required|is_natural_no_zero',
             'errors'=> array('is_natural_no_zero' => '{field} must integer.')
            ],
			['field' => 'tool',
             'label' => 'Tools',
             'rules' => 'trim|max_length[200]|regex_match[/[a-zA-Z0-9 \/\-_,.]+$/]',
             'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 \/\-_,.].')
            ],
            ['field' => 'tool_owner',
             'label' => 'Tool Owneer',
             'rules' => 'trim|max_length[200]|regex_match[/[a-zA-Z0-9 \/\-_,.]+$/]',
             'errors'=> array('regex_match' => 'Allowed characeter for {field} are [a-zA-Z0-9 \/\-_,.].')
            ],
		);	
		
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) 
		{
			$insert = $this->reports_m->insertTool($tool, $owner, $activity);
			$result = ($insert === true) ? 1 : 0;
			$msg 	= ($insert === true) ? 'Tool Added' : 'Failed to Add Tool';

		} 
		else 
		{
			$msg	= validation_errors();
			$result = 0;
		}

		echo json_encode(['result' => $result, 'msg' => $msg]);
	}
}