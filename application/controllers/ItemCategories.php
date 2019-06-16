<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemcategories extends CI_Controller {

	public function index()
	{
		$this->list_categories();
	}

	public function list_categories()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/itemcategories_model');
			// load libraries

			// load helpers

			// load forms
			$tempdata['id'] = 'add_record_modal';
			$tempdata['title'] = 'Item Category Record';
			$tempdata['action'] = 'itemcategories/add_category';
			$tempdata['form'] = $this->load->view('account/itemcategories/add_item_category','',TRUE);

			$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);

			$data['forms'] = array($form1);

			// additional styles

			// additional scripts
			$data['add_js'] = array('assets/scripts/account/itemCategories.js');

			$data['title'] = "Item Categories";

			$data['view_data'] = $this->load->view('common/loading','',TRUE);

			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
			
	}


	public function get_categories()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/itemcategories_model');

			// load libraries

			// load helpers

			// load the data to common views
			$data['itemcategories'] = $this->itemcategories_model->get_categories()->result_array();

			$data['table_content'] = $this->load->view('account/itemcategories/table_content',$data,TRUE);
			
			// print view
			echo ($this->load->view('common/table',$data,TRUE));
		}
			
	}


	public function get_category($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/itemcategories_model');

			echo json_encode($this->itemcategories_model->get_category($id)->row_array());
		}
	}

	public function remove_category($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/itemcategories_model');

			echo json_encode($this->itemcategories_model->remove_category($id));
		}
	}

	public function add_category()
	{
    	$this->load->library('form_validation');
    	$this->load->model('account/itemcategories_model');

    	$this->form_validation->set_rules('parent_category_id', 'Parent Category ID', 'trim|required');
    	$this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[3]|max_length[45]');
    	$this->form_validation->set_rules('sequence', 'Sequence Number', 'trim|required|numeric');


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
	        	echo json_encode($this->itemcategories_model->add_category());
	        }
	        else
	        {
	        	echo json_encode($this->itemcategories_model->update_category());
	        }
	    }
	}

	public function get_parent_category_options()
	{
		$this->load->model('account/itemcategories_model');
		echo json_encode($this->itemcategories_model->get_parent_category_options());
	}


}
