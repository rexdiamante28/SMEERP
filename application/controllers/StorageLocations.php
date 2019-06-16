<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storagelocations extends CI_Controller {

	public function index()
	{
		$this->list_locations();
	}

	public function list_locations()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/storagelocation_model');
			$this->load->model('account/branch_model');
			// load libraries

			// load helpers

			// load forms
			$tempdata['id'] = 'add_record_modal';
			$tempdata['title'] = 'Storage Location Record';
			$tempdata['action'] = 'storagelocations/add_location';
			$tempdata['form'] = $this->load->view('account/storagelocations/add_location','',TRUE);

			$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);

			$data['forms'] = array($form1);

			// additional styles

			// additional scripts
			$data['add_js'] = array('assets/scripts/account/storageLocations.js');

			$data['title'] = "Storage Locations";

			$data['view_data'] = $this->load->view('common/loading','',TRUE);

			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
			
	}


	public function get_locations()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/storagelocation_model');

			// load libraries

			// load helpers

			// load the data to common views
			$data['storagelocations'] = $this->storagelocation_model->get_locations()->result_array();

			$data['table_content'] = $this->load->view('account/storagelocations/table_content',$data,TRUE);
			
			// print view
			echo ($this->load->view('common/table',$data,TRUE));
		}
			
	}


	public function get_location($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/storagelocation_model');

			echo json_encode($this->storagelocation_model->get_location($id)->row_array());
		}
	}

	public function remove_location($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/storagelocation_model');

			echo json_encode($this->storagelocation_model->remove_location($id));
		}
	}

	public function add_location()
	{
    	$this->load->library('form_validation');
    	$this->load->model('account/storagelocation_model');

    	$this->form_validation->set_rules('branch_id', 'Branch', 'trim|required');
    	$this->form_validation->set_rules('location_name', 'Location Name', 'trim|required|min_length[5]|max_length[45]');
    	$this->form_validation->set_rules('description', 'Description', 'trim|min_length[5]|max_length[150]');


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
	        	echo json_encode($this->storagelocation_model->add_location());
	        }
	        else
	        {
	        	echo json_encode($this->storagelocation_model->update_location());
	        }
	    }
	}


}
