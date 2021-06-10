<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libraries extends SIDOTA_Core {

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

		$this->load->model('libraries_m');
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

		$this->_module 	= 'libraries/ebooks';

		$this->js 		= 'page_js/ebook';

		$this->_data	= array(
			'title'		=> $this->app->app_title_alt . ' - Libraries',
			'ebooks'	=> $this->libraries_m->getEbooks(),
			'btn_edit'	=> $this->app_m->getContentMenu('edit-ebook'),
			'btn_delete'=> $this->app_m->getContentMenu('delete-ebook'),
			'btn_download'=> $this->app_m->getContentMenu('download-ebook'),
		);

		$this->load_view();
	}

	public function add()
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
		
		$this->_module 	= 'libraries/add_ebook';

		$this->js  		= 'page_js/add_ebook';

		$this->_data	= array(
			'title'		=> $this->app->app_title_alt . ' - Add Ebook',
			'categories'=> $this->libraries_m->getCategories(),
		);

		$this->load_view();
	}

	public function upload()
	{
		$post = $this->input->post(null, TRUE);

		$this->load->library('form_filter');
		$this->form_validation->set_rules($this->form_filter->addEbook_validation());

		if ($this->form_validation->run() == TRUE) 
		{
			$salt = base64_encode(openssl_random_pseudo_bytes(16));
			$salt = preg_replace('~[^\\pL\d]+~u', '', $salt).'_'.random_string('alpha',8).'_'.random_string('nozero',4).'_'.random_string('numeric',9).'_'.random_string('alnum',6).'_'.time();

			$new_name = preg_replace('/[^A-Za-z0-9 ]/', '', $post['ebook_title']);
			$new_name = str_replace(' ', '-', $new_name).'-'.$salt;
			
			$user_dir = encrypt($this->session->userdata('uid')).'/'.date('Y/m');

			$config['upload_path'] 	= './_/files/'.$user_dir;
			$config['allowed_types']= 'pdf|docx|doc|txt|xls|xlsx|ppt|pptx';
			$config['max_size']  	= '20000';
			$config['detect_mime']	= TRUE;
			$config['file_name']	= $new_name;
			
			if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0755, true);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('file'))
			{
				$data = $this->upload->data();

				$insert = $this->libraries_m->addEbook($post, $data['file_name']);

				if($insert === TRUE)
				{
					$status = 1;
					$msg 	= 'Ebook Added.';
				}
				else
				{
					$status = 0;
					$msg 	= 'Failed to Add Ebook.';
				}
			}
			else
			{
				$status = 0;
				$msg 	= $this->upload->display_errors();
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
		
		$this->_module 	= 'libraries/edit_ebook';

		$this->_script 	= 'edit_ebook_js';

		$ebook_data		= $this->libraries_m->getEbookByHash($hash);
		$remote_file	= './_/files/'.encrypt($ebook_data->employee_id).'/'.$ebook_data->month.'/'.$ebook_data->ebook_file;

		if(empty($ebook_data)) redirect('page_error');
		
		$json_ebook = array(
			'type' => filetype($remote_file),
			'filetype' => mime_content_type($remote_file),
			'caption' => $ebook_data->ebook_title,
			'key' => encrypt($ebook_data->ebook_id)
		);


		$this->_data	= array(
			'title'		=> 'Edit Ebook - '.$ebook_data->ebook_title,
			'categories'=> $this->libraries_m->getCategories(),
			'ebook'		=> $ebook_data,
			'json_ebook'=> $json_ebook
		);

		$this->load_view();
	}

	public function update()
	{
		$msg  = [];

		$post = $this->input->post(null, TRUE);

		$this->load->library('form_filter');
		$this->form_validation->set_rules($this->form_filter->editEbook_validation());

		if(verify($post['ebook_id']) !== FALSE)
		{
			if ($this->form_validation->run() == TRUE) 
			{
				if(!empty($_FILES['file']['name']))
				{
					$salt = base64_encode(openssl_random_pseudo_bytes(16));
					$salt = preg_replace('~[^\\pL\d]+~u', '', $salt).'_'.random_string('alpha',8).'_'.random_string('nozero',4).'_'.random_string('numeric',9).'_'.random_string('alnum',6).'_'.time();

					$new_name = preg_replace('/[^A-Za-z0-9 ]/', '', $post['ebook_title']);
					$new_name = str_replace(' ', '-', $new_name).'-'.$salt;
					
					$user_dir = encrypt($this->session->userdata('uid')).'/'.date('Y/m');

					$config['upload_path'] 	= './_/files/'.$user_dir;
					$config['allowed_types']= 'pdf|docx|doc|txt|xls|xlsx|ppt|pptx';
					$config['max_size']  	= '20000';
					$config['detect_mime']	= TRUE;
					$config['file_name']	= $new_name;
					
					if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0755, true);

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('file'))
					{
						$data = $this->upload->data();
						$ebook= $data['file_name'];
					}
					else
					{
						$status = 0;
						$ebook  = $post['oldbook']; 
						$msg[] 	= $this->upload->display_errors();
					}
				}
				else
				{
					$ebook = $post['oldbook'];
				}

				$update = $this->libraries_m->editEbook($post, $ebook);

				if($update === TRUE)
				{
					$status = 1;
					$msg[] 	= 'Ebook Updated.';
				}
				else
				{
					$status = 0;
					$msg[] 	= 'Failed to Update Ebook.';
				}
			} 
			else 
			{
				$status = 0;
				$msg[] 	= validation_errors();
			}
		}
		else
		{
			$status = 0;
			$msg[] 	= 'Invalid Ebook ID.';
		}

		$messages 	= implode('<br/>', $msg);
		$token 		= $this->security->get_csrf_hash();
		$result 	= array('result' => $status, 'msg' => $messages, 'token' => $token);

		$this->output->set_status_header(200)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}

	public function download($hash = NULL)
	{
		$this->access_control->check_role();

		$ebook_data 	= $this->libraries_m->getEbookByHash($hash);

		if(empty($ebook_data)) redirect('page_error');

		$remote_file	= './_/files/'.encrypt($ebook_data->employee_id).'/'.$ebook_data->month.'/'.$ebook_data->ebook_file;
		$extension  	= pathinfo($remote_file, PATHINFO_EXTENSION);

		switch ($extension) {
			case 'pdf':
				$this->css_plugin = array(
					'fontawesome-free/css/all.min',
					'ionicons/css/ionicons.min'
				);

				$this->js_plugin = array(
					'ionicons/ionicons'
				);
				
				$this->_module 	= 'libraries/pdf_reader';

				$this->_data 	= array(
					'title'		=> 'Read - '.$ebook_data->ebook_title,
					'remotefile'=> $remote_file
				);

				$this->load_view();
				break;
			
			default:
				force_download($ebook_data->ebook_title.'.'.$extension, file_get_contents($remote_file));
				break;
		}
	}

	public function delete()
	{
		$this->access_control->check_role();

		$post = $this->input->post(null, TRUE);
		
		if( ! isset($post['hash']) || (verify($post['hash']) === false))
		{
			$code = 405;
			$status = 0;
			$msg = 'Choose Ebook to Delete.';
		}
		else
		{
			$ebook_data = $this->libraries_m->getEbook($post['hash']);

			if(empty($ebook_data)) 
			{
				$code = 404;
				$status = 0;
				$msg = 'Ebook not Found.';
			}
			else
			{
				$remote_file= './_/files/'.encrypt($ebook_data->employee_id).'/'.$ebook_data->month.'/'.$ebook_data->ebook_file;

				@unlink($remote_file);

				if($this->libraries_m->delete($post['hash'])) {
					$code = 200;
					$status = 1;
					$msg = 'Ebook Deleted.';
				}
				else {
					$code = 200;
					$status = 1;
					$msg = 'Failed to Delete Ebook.';
				}
			}
		}

		$token 	= $this->security->get_csrf_hash();
		$result = array('response' => $code, 'result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_status_header($code)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($result));
	}
}