<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends CI_Controller {

	public function index()
	{
		$this->list_items();
	}

	public function list_items()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/stock_model');
			// load libraries

			// load helpers

			// load forms
			$tempdata['id'] = 'add_record_modal';
			$tempdata['title'] = 'Store Items';
			$tempdata['action'] = 'stocks/add_item';
			$tempdata['form'] = $this->load->view('account/stocks/add_item','',TRUE);
			$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);

			$data['forms'] = array($form1);

			// additional styles

			// additional scripts
			$data['add_js'] = array('assets/scripts/account/stocks.js');

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
			$this->load->model('account/stock_model');

			// load libraries

			// load helpers

			// load the data to common views
			$data['items'] = $this->stock_model->get_items()->result_array();

			$data['table_content'] = $this->load->view('account/stocks/thumbnail_content',$data,TRUE);
			
			// print view
			echo $data['table_content'];
		}
			
	}


	public function get_item($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/stock_model');

			$item = $this->stock_model->get_item($id)->row_array();

			$item['has_unique_identifier'] = $item['has_unique_identifier'] == '1' ? 'YES' : 'NO';

			echo json_encode($item);
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
    	$this->load->model('account/stock_model');

    	$this->form_validation->set_rules('threshold_min', 'Minimum Stock', 'trim|required|max_length[11]|numeric');
    	$this->form_validation->set_rules('threshold_max', 'Maximum Stock', 'trim|required|max_length[11]|numeric');

    	if ($this->form_validation->run() === FALSE)
	    {
	        $response['success'] = false;
	        $response['message'] = validation_errors();
	        $response['environment'] = ENVIRONMENT;

	        echo json_encode($response);
	    }
	    else
	    {
	        echo json_encode($this->stock_model->update_item());
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


}
