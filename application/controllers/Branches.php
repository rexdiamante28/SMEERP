<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branches extends CI_Controller {

	public function index()
	{
		$this->list_branches();
	}

	public function list_branches()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models

			// load libraries

			// load helpers

			// load forms
			$tempdata['id'] = 'add_record_modal';
			$tempdata['title'] = 'Branch Record';
			$tempdata['action'] = 'branches/create_branch';
			$tempdata['form'] = $this->load->view('account/branches/create_branch','',TRUE);

			$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);

			$data['forms'] = array($form1);

			// additional styles

			// additional scripts
			$data['add_js'] = array('assets/scripts/account/branches.js');

			$data['title'] = "Branches";

			$data['view_data'] = $this->load->view('common/loading','',TRUE);

			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
			
	}


	public function debug()
	{
		$this->load->model('account/branch_model');

		echo $this->branch_model->get_branches();
	}



	public function get_branches()
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/branch_model');

			$data['branches'] = $this->branch_model->get_branches()->result_array();

			$data['table_content'] = $this->load->view('account/branches/table_content',$data,TRUE);
			
			echo ($this->load->view('common/table',$data,TRUE));
		}
	}


	public function get_branch($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/branch_model');

			echo json_encode($this->branch_model->get_branch($id)->row_array());
		}
	}

	public function remove_branch($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/branch_model');

			echo json_encode($this->branch_model->remove_branch($id));
		}
	}

	public function create_branch()
	{
    	$this->load->library('form_validation');
    	$this->load->model('account/branch_model');

    	$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|min_length[5]|max_length[150]');
    	$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[150]');
    	$this->form_validation->set_rules('status', 'Status', 'trim|required|min_length[1]|max_length[1]');


    	if ($this->form_validation->run() === FALSE)
	    {
	        $response['success'] = false;
	        $response['message'] = validation_errors();
	        $response['environment'] = ENVIRONMENT;

	        echo json_encode($response);
	    }
	    else
	    {
	        if($this->input->post('id')==='')
	        {
	        	echo json_encode($this->branch_model->create_branch());
	        }
	        else
	        {
	        	echo json_encode($this->branch_model->update_branch());
	        }
	    }
	}

}
