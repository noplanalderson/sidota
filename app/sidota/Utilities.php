<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities extends SIDOTA_Core {

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

		$this->load->model('utilities_m');
	}

	public function index()
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'ionicons/css/ionicons.min',
			'select2/css/select2.min',
			'datatables/datatables.min'
		);

		$this->js_plugin = array(
			'ionicons/ionicons',
			'select2/js/select2.full.min',
			'datatables/datatables.min'
		);

		$this->_module 	= 'utilities/utility_view';

		$this->js 		= 'page_js/utilities';

		$this->_data	= array(
			'title'				=> $this->app->app_title_alt . ' - Utilities',
			'act_categories'	=> $this->utilities_m->getActivityCategories(),
			'ebook_categories'	=> $this->utilities_m->getEbookCategories(),
			'jobdescs'			=> $this->utilities_m->getJobescs(),
			'user_type'			=> $this->utilities_m->getUserTypes(),
			'btn_edit'			=> $this->app_m->getContentMenu('edit-utility'),
			'btn_delete'		=> $this->app_m->getContentMenu('delete-utility'),
			'btn_add'			=> $this->app_m->getContentMenu('add-utility'),
		);

		$this->load_view();
	}

	public function get_jobdesc()
	{
		$post = $this->input->post(null, TRUE);
		
		if( ! isset($post['id']) && verify($post['id'] === FALSE)) :
			return false;
		else :
			$token 	= array('token' => $this->security->get_csrf_hash());
			$data 	= $this->utilities_m->getJobdescByHash($post['id']);
			$array 	= array_merge($token, $data);
			echo json_encode($array);
		endif;
	}

	public function get_act_category()
	{
		$post = $this->input->post(null, TRUE);
		
		if( ! isset($post['id']) && verify($post['id'] === FALSE)) :
			return false;
		else :
			$token 	= array('token' => $this->security->get_csrf_hash());
			$data 	= $this->utilities_m->getActivityCategoryByHash($post['id']);
			$array 	= array_merge($token, $data);
			echo json_encode($array);
		endif;
	}

	public function get_ebook_category()
	{
		$post = $this->input->post(null, TRUE);
		
		if( ! isset($post['id']) && verify($post['id'] === FALSE)) :
			return false;
		else :
			$token 	= array('token' => $this->security->get_csrf_hash());
			$data 	= $this->utilities_m->getEbookCategoryByHash($post['id']);
			$array 	= array_merge($token, $data);
			echo json_encode($array);
		endif;
	}

	function verify_hash($hash)
	{
		return (!verify($hash)) ? FALSE : TRUE;
	}

	public function add($item = NULL)
	{
		$this->access_control->check_role();

		$data 	= $this->input->post(null, TRUE);
		$status = 0;

		switch ($item) {
			case 'jobdesc':
				$this->form_validation->set_rules('jobdesc_name', 'Jobdesc Name', 'trim|required|min_length[3]|max_length[255]|regex_match[/[a-zA-Z0-9 \-]+$/]');
				$this->form_validation->set_rules('type_id', 'User Type', 'required|integer');

				if ($this->form_validation->run() == TRUE) {
					$status = $this->utilities_m->addJobdesc($data) ? 1 : 0;
					$msg 	= ($status == 1) ? 'Jobdesc Added.' : 'Failed to Add Jobdesc';
				} else {
					$status = 0;
					$msg	= validation_errors();
				}
				
				break;
			
			case 'act-category':
				$this->form_validation->set_rules('category_activity', 'Category', 'trim|required|min_length[3]|max_length[128]|regex_match[/[a-zA-Z0-9 \-]+$/]');

				if ($this->form_validation->run() == TRUE) {
					$status = $this->utilities_m->addActCategory($data) ? 1 : 0;
					$msg 	= ($status == 1) ? 'Category Added.' : 'Failed to Add Category';
				} else {
					$status = 0;
					$msg	= validation_errors();
				}
				break;

			case 'ebook-category':
				$this->form_validation->set_rules('category', 'Ebook Category', 'trim|required|min_length[3]|max_length[100]|regex_match[/[a-zA-Z0-9 \-]+$/]');

				if ($this->form_validation->run() == TRUE) {
					$status = $this->utilities_m->addEbookCategory($data) ? 1 : 0;
					$msg 	= ($status == 1) ? 'Category Added.' : 'Failed to Add Category';
				} else {
					$status = 0;
					$msg	= validation_errors();
				}
				break;
			default:
				$status = 0;
				$msg 	= 'Unknown Error Occured.';
				break;
		}

		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
		echo json_encode($result);
	}

	public function edit($item = NULL)
	{
		$this->access_control->check_role();

		$data 	= $this->input->post(null, TRUE);
		$status = 0;

		switch ($item) {
			case 'jobdesc':
				$this->form_validation->set_rules('jobdesc_id', 'Jobdesc ID', 'trim|required|callback_verify_hash');
				$this->form_validation->set_rules('jobdesc_name', 'Jobdesc Name', 'trim|required|min_length[3]|max_length[255]|regex_match[/[a-zA-Z0-9 \-]+$/]');
				$this->form_validation->set_rules('type_id', 'User Type', 'required|integer');

				if ($this->form_validation->run() == TRUE) {
					$status = $this->utilities_m->editJobdesc($data) ? 1 : 0;
					$msg 	= ($status == 1) ? 'Jobdesc Edited.' : 'Failed to Edit Jobdesc';
				} else {
					$status = 0;
					$msg	= validation_errors();
				}
				
				break;
			
			case 'act-category':
				$this->form_validation->set_rules('category_activity_id', 'Category ID', 'trim|required|callback_verify_hash');
				$this->form_validation->set_rules('category_activity', 'Category', 'trim|required|min_length[3]|max_length[128]|regex_match[/[a-zA-Z0-9 \-]+$/]');

				if ($this->form_validation->run() == TRUE) {
					$status = $this->utilities_m->editActCategory($data) ? 1 : 0;
					$msg 	= ($status == 1) ? 'Category Edited.' : 'Failed to Edit Category';
				} else {
					$status = 0;
					$msg	= validation_errors();
				}
				break;

			case 'ebook-category':
				$this->form_validation->set_rules('id_category', 'Category ID', 'trim|required|callback_verify_hash');
				$this->form_validation->set_rules('category', 'Ebook Category', 'trim|required|min_length[3]|max_length[100]|regex_match[/[a-zA-Z0-9 \-]+$/]');

				if ($this->form_validation->run() == TRUE) {
					$status = $this->utilities_m->editEbookCategory($data) ? 1 : 0;
					$msg 	= ($status == 1) ? 'Category Edited.' : 'Failed to Edit Category';
				} else {
					$status = 0;
					$msg	= validation_errors();
				}
				break;
			default:
				$status = 0;
				$msg 	= 'Unknown Error Occured.';
				break;
		}

		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
		echo json_encode($result);
	}

	public function delete($item = NULL)
	{
		$this->access_control->check_role();

		$id 	= $this->input->post('id', TRUE);
		$status = 0;

		switch ($item) {
			case 'jobdesc':
				$this->form_validation->set_rules('id', 'ID', 'trim|required|callback_verify_hash');

				if ($this->form_validation->run() == TRUE) {
					$status = $this->utilities_m->deleteJobdesc($id) ? 1 : 0;
					$msg 	= ($status == 1) ? 'Jobdesc Deleted.' : 'Failed to Delete Jobdesc';
				} else {
					$status = 0;
					$msg	= validation_errors();
				}
				
				break;
			
			case 'act-category':
				$this->form_validation->set_rules('id', 'ID', 'trim|required|callback_verify_hash');

				if ($this->form_validation->run() == TRUE) {
					$status = $this->utilities_m->deleteActCategory($id) ? 1 : 0;
					$msg 	= ($status == 1) ? 'Category Deleted.' : 'Failed to Delete Category';
				} else {
					$status = 0;
					$msg	= validation_errors();
				}
				break;

			case 'ebook-category':
				$this->form_validation->set_rules('id', 'ID', 'trim|required|callback_verify_hash');

				if ($this->form_validation->run() == TRUE) {
					$status = $this->utilities_m->deleteEbookCategory($id) ? 1 : 0;
					$msg 	= ($status == 1) ? 'Category Deleted.' : 'Failed to Delete Category';
				} else {
					$status = 0;
					$msg	= validation_errors();
				}
				break;
			default:
				$status = 0;
				$msg 	= 'Unknown Error Occured.';
				break;
		}

		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
		echo json_encode($result);
	}
}