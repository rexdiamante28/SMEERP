<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemUnits extends CI_Controller {

	public function index()
	{
		$this->list_item_units();
	}

	public function list_item_units()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models

			// load libraries

			// load helpers

			// load forms
			$tempdata['id'] = 'add_record_modal';
			$tempdata['title'] = 'Item Unit Record';
			$tempdata['action'] = 'itemunits/add_unit';
			$tempdata['form'] = $this->load->view('account/itemunits/add_unit','',TRUE);

			$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);

			$data['forms'] = array($form1);

			// additional styles

			// additional scripts
			$data['add_js'] = array('assets/scripts/account/itemunits.js');

			$data['title'] = "Item Units";

			$data['view_data'] = $this->load->view('common/loading','',TRUE);

			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
			
	}



	public function get_units()
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/itemunits_model');

			$data['itemunits'] = $this->itemunits_model->get_units()->result_array();

			$data['table_content'] = $this->load->view('account/itemunits/table_content',$data,TRUE);
			
			echo ($this->load->view('common/table',$data,TRUE));
		}
	}


	public function get_unit($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/itemunits_model');

			echo json_encode($this->itemunits_model->get_unit($id)->row_array());
		}
	}

	public function remove_unit($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/itemunits_model');

			echo json_encode($this->itemunits_model->remove_unit($id));
		}
	}

	public function add_unit()
	{
    	$this->load->library('form_validation');
    	$this->load->model('account/itemunits_model');

    	$this->form_validation->set_rules('item_unit', 'Item Unit', 'trim|required|min_length[3]|max_length[45]');
    	$this->form_validation->set_rules('description', 'Description', 'trim|min_length[5]|max_length[100]');


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
	        	echo json_encode($this->itemunits_model->add_unit());
	        }
	        else
	        {
	        	echo json_encode($this->itemunits_model->update_unit());
	        }
	    }
	}

}
