<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Ilovepdf\Ilovepdf;
use Ilovepdf\CompressTask;

class PDFTool extends SIDOTA_Core {

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
	}

	public function index()
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

		$this->_module 	= 'pdftool/merge_pdf';

		$this->js 		= 'page_js/merge';

		$this->_data	= array(
			'title'		=> $this->app->app_title_alt . ' - Merge PDF'
		);

		$this->load_view();		
	}

	public function mergefile()
	{	
		$pdfFiles = [];

		$title = $this->input->post('file_title', TRUE);
		$title = str_replace(' ', '-', $title);
		
		$this->form_validation->set_rules('file_title', 'File Title', 'trim|required|min_length[5]|max_length[100]|regex_match[/^[a-zA-Z0-9 \-_+]+$/]');

		if ($this->form_validation->run() == TRUE) {
		
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

		            $config['upload_path'] 	= './_/files/pdf/';
		            $config['allowed_types']= 'pdf';
		            $config['max_size']  	= '5200';
		            $config['file_name']	= $title.'-'.random_string('alnum',32).'.pdf';
		            $config['detect_mime']	= TRUE;

		            if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0755, true);
		               
		            $this->load->library('upload', $config);
	            	$this->upload->initialize($config);
	               
					if ($this->upload->do_upload('file'))
					{
		               	$data = $this->upload->data();
		               	$pdfFiles[] = $data['full_path'];
					}
					else
					{
						echo $this->upload->display_errors();
					}
	            }

	            $datadir 	= FCPATH . '/_/files/pdf/merged-compressed/';
	            $file_name 	= $title.'-'.random_string('alnum',32)."-merged";
	            $extension 	= '.pdf';
				$outputName = $datadir . $file_name . $extension;

				$cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";

				foreach($pdfFiles as $file) {
				    $cmd .= $file." ";
				}
				$result = shell_exec($cmd);

				$ilovepdf = new Ilovepdf('project_public_c274990fc319aa38069ea0b2ba69d187_KZabi10cb1e70ca2f48d18b9597b8a7651925','secret_key_9e439fa7ea41110df52a627861af2fc0_Deoa148c6964acc33e3ebf3ee9f94f345c741');
				$task = $ilovepdf->newTask('compress');
				$task->setCompressionLevel('recommended');
				$file = $task->addFile($outputName);
				$task->setOutputFilename($file_name.'-compressed'.$extension);
				$task->execute();
				$task->download($datadir);

				$status = 200;
				$res 	= 1;
				$msg 	= "File merged successfully. Download your file <a href='".base_url('_/files/pdf/merged-compressed/'.$file_name.'-compressed'.$extension)."'  download />here</a>.";
			}
			else
			{
				$status = 200;
				$res 	= 0;
				$msg 	= "Failed to merging files";
			}
		}
		else
		{
			$status = 200;
			$res 	= 0;
			$msg 	= validation_errors();
		}

		$token = $this->security->get_csrf_hash();
		$json = json_encode(array('result' => $res, 'msg' => $msg, 'token' => $token));

		$this->output->set_status_header($status)
					 ->set_content_type('application/json')
					 ->set_output($json);
	}
}

/* End of file documentations.php */
/* Location: ./application/controllers/documentations.php */