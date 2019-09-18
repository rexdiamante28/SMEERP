<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

	public function index()
	{
		$this->list_items();
	}

	public function list_items()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/item_model');
			$this->load->model('account/itemcategories_model');
			$this->load->model('account/itemunits_model');
			// load libraries

			// load helpers

			// load forms
			//$tempdata['id'] = 'add_record_modal';
			//$tempdata['title'] = 'Item Record';
			//$tempdata['action'] = 'items/add_item';
			//$//tempdata['form'] = $this->load->view('account/items/add_item','',TRUE);
			$form1 = $this->load->view('common/modal_form_custom','',TRUE);

			$data['forms'] = array($form1);

			// additional styles

			// additional scripts
			$data['add_js'] = array('assets/scripts/account/items.js');
			$data['title'] = "Items";
			$data['view_data'] = $this->load->view('common/loading','',TRUE);

			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
			
	}


	public function get_items()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/item_model');

			// load libraries

			// load helpers

			// load the data to common views
			$data['items'] = $this->item_model->get_items()->result_array();
			$data['controller'] = $this; 
			$data['table_content'] = $this->load->view('account/items/thumbnail_content',$data,TRUE);
			
			// print view
			echo $data['table_content'];
		}
			
	}


	public function get_item($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/item_model');

			echo json_encode($this->item_model->get_item($id)->row_array());
		}
	}

	public function remove_item($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/item_model');

			echo json_encode($this->item_model->remove_item($id));
		}
	}

	public function add_item()
	{

    	$this->load->library('form_validation');
    	$this->load->model('account/item_model');

    	$this->form_validation->set_rules('item_category', 'Item Category', 'trim|numeric');
    	$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required|min_length[3]|max_length[100]');
    	$this->form_validation->set_rules('price', 'Item Price', 'trim|required|min_length[1]|max_length[11]|numeric');
    	$this->form_validation->set_rules('generic_name', 'Generic Name', 'trim|min_length[3]|max_length[100]');
    	$this->form_validation->set_rules('item_description', 'Description', 'trim|min_length[5]|max_length[2000]');
    	$this->form_validation->set_rules('item_unit', 'Item Unit', 'trim|numeric|required');
    	$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
    	
    	if($this->input->post('id')==='')
	    {
	    	// $this->form_validation->set_rules('item_code', 'Item Code', 'trim|required|min_length[3]|max_length[45]|is_unique[items.item_code]');
	    	// $this->form_validation->set_rules('bar_code', 'Bar Code', 'trim|min_length[3]|max_length[150]|is_unique[items.bar_code]');
	    }
	    else
	    {
	    	// $this->form_validation->set_rules('item_code', 'Item Code', 'trim|required|min_length[3]|max_length[45]');
	    	// $this->form_validation->set_rules('bar_code', 'Bar Code', 'trim|min_length[3]|max_length[150]');
	    }


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
	        	echo json_encode($this->item_model->add_item());
	        }
	        else
	        {
	        	echo json_encode($this->item_model->update_item());
	        }
	    }
	}

	public function upload_photo()
	{
		$config['upload_path']          = './assets/images/items/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 2000;
        $config['max_height']           = 1400;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('item_image'))
        {
            echo json_encode(array('error' => $this->upload->display_errors()));
        }
        else
        {
            echo json_encode(array('upload_data' => $this->upload->data()));
        }
	}


	public function unique_identifier()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/branch_model');
			//$this->load->model('account/itemcategories_model');
			//$this->load->model('account/itemunits_model');
			// load libraries

			// load helpers

			// load forms
			$tempdata['id'] = 'edit_item_identifier_modal';
			$tempdata['title'] = 'Items Unique Identifiers';
			$tempdata['action'] = 'items/set_identifier';
			$tempdata['form'] = $this->load->view('account/items/edit_identifier_form','',TRUE);
			$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);

			$data['forms'] = array($form1);

			// additional styles

			// additional scripts
			$data['add_js'] = array('assets/scripts/account/unique_identifier.js');

			$data['title'] = "";

			$data['view_data'] = $this->load->view('common/loading','',TRUE);


			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
			
	}


	public function get_unique_items()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/item_model');

			// load libraries

			// load helpers

			// load the data to common views
			$data['unique_items'] = $this->item_model->get_unique_items()->result_array();

			$data['table_content'] = $this->load->view('account/items/table_content',$data,TRUE);
			
			// print view
			echo ($this->load->view('common/table',$data,TRUE));
		}
			
	}

	function print_barcode_process($code){

		$this->load->library('Zend');
		$this->zend->load('Zend/Barcode');
		echo Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	
	}




}
