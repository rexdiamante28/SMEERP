<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemmovements extends CI_Controller {

	public function index()
	{
		$this->list_item_movements();
	}

	public function list_item_movements($id='')
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
			if($id==='')
			{
				$tempdata['id'] = 'add_record_modal';
				$tempdata['title'] = 'Item Movement Record';
				$tempdata['action'] = 'itemmovements/add_record';
				$tempdata['form'] = $this->load->view('account/itemmovement/add_item_movement','',TRUE);
				$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);
				$form2 = $this->load->view('account/itemmovement/details_modal',$tempdata,TRUE);
				$form2a = $this->load->view('account/itemmovement/details_modal_inb',$tempdata,TRUE);
				$form2b = $this->load->view('account/itemmovement/details_modal_accepted',$tempdata,TRUE);
				$form3 = $this->load->view('account/itemmovement/add_item_in_movement_modal',$tempdata,TRUE);
				$form4 = $this->load->view('account/itemmovement/add_item_in_movement_details_modal',$tempdata,TRUE);
				$form5 = $this->load->view('account/itemmovement/identifiers_modal',$tempdata,TRUE);
				$form5a = $this->load->view('account/itemmovement/identifiers_modal_accepted',$tempdata,TRUE);

				$data['forms'] = array($form1,$form2,$form2a,$form2b,$form3,$form4,$form5,$form5a);

				// additional styles

				// additional scripts
				$data['add_js'] = array('assets/scripts/account/itemmovements.js','assets/scripts/account/itemmovements_new.js');

				$data['title'] = "Item Movements";

				$data['view_data'] = $this->load->view('common/loading','',TRUE);
			}
			else
			{
				$data['title'] = "Item Movements";
				$data['view_data'] = "No Data Available";
			}

			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
			
	}

	public function list_item_movements2($id)
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
			$tempdata['id'] = 'add_record_modal';
			$tempdata['title'] = 'Item Movement Record';
			$tempdata['action'] = 'itemmovements/add_record';
			$tempdata['form'] = $this->load->view('account/itemmovement/add_item_movement','',TRUE);
			$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);

			$data['forms'] = array($form1);

			// additional styles

			// additional scripts
			//$data['add_js'] = array('assets/scripts/account/itemmovements.js');

			$data['title'] = "Item Movements";

			$data['view_data'] = $this->load->view('common/loading','',TRUE);

			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
			
	}


	public function get_item_movements()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/itemmovement_model');

			// load libraries

			// load helpers

			// load the data to common views
			$data['item_movements'] = $this->itemmovement_model->get_item_movements()->result_array();

			$data['table_content'] = $this->load->view('account/itemmovement/table_content',$data,TRUE);
			
			// print view
			echo ($this->load->view('common/table',$data,TRUE));
		}
			
	}


	public function get_stock_movement($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/itemmovement_model');
			echo json_encode($this->itemmovement_model->get_stock_movement($id)->row_array());
		}
	}

	public function remove_item_movement($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/itemmovement_model');

			echo json_encode($this->itemmovement_model->remove_item_movement($id));
		}
	}

	public function add_record()
	{

    	$this->load->library('form_validation');
    	$this->load->model('account/itemmovement_model');

    	$this->form_validation->set_rules('branch_id', 'Branch', 'trim|numeric|required');
    	$this->form_validation->set_rules('facilitator', 'Facilitator', 'trim|numeric|required');
    	$this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[20]');
    	if($this->input->post('type')==='Orders')
    	{
    		$this->form_validation->set_rules('date', 'Date', 'trim');
    	} 
    	else
    	{
    		$this->form_validation->set_rules('date', 'Date', 'trim|required');
    	}

    	if($this->input->post('type') === "Outbound"){
    		
    		$this->form_validation->set_rules('branch_id2', 'Move to branch', 'trim|required|numeric');
    	}
    	
    	$this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[20]');
    	$this->form_validation->set_rules('internal_notes', 'Internal Notes', 'trim|max_length[2000]');

    	if($this->input->post('id')==='')
	    {
	    	$this->form_validation->set_rules('code', 'Reference Code', 'trim|required|min_length[1]|max_length[45]|is_unique[item_movements.code]');
	    }
	    else
	    {
	    	$this->form_validation->set_rules('code', 'Reference Code', 'trim|required|min_length[1]|max_length[45]');
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
	        	echo json_encode($this->itemmovement_model->add_movement());
	        }
	        else
	        {
	        	echo json_encode($this->itemmovement_model->update_movement());
	        }
	    }
	}

	public function get_facilitators()
	{
		$this->load->model('account/itemmovement_model');
		echo json_encode($this->itemmovement_model->get_facilitators());
	}


	public function get_stock_movement_items($id)
	{
		$this->load->model('account/itemmovement_model');
		$data['movement_info'] = $this->itemmovement_model->get_stock_movement($id)->row_array();
		$data['item_movement_items'] = $this->itemmovement_model->get_stock_movement_items($id)->result_array();
		$data['table_content'] = $this->load->view('account/itemmovement/items_table',$data,TRUE);
		echo ($this->load->view('common/table',$data,TRUE));
	}


	public function get_items()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/itemmovement_model');

			// load libraries

			// load helpers

			// load the data to common views
			$data['items'] = $this->itemmovement_model->get_items()->result_array();
			$data['table_content'] = $this->load->view('account/itemmovement/thumbnail_content',$data,TRUE);
			
			// print view
			echo $data['table_content'];
		}
			
	}


	public function add_item_in_movement()
	{

    	$this->load->library('form_validation');
    	$this->load->model('account/itemmovement_model');

    	$item_movement = $this->itemmovement_model->get_stock_movement($this->input->post('movement_id'))->row_array();

    	$this->form_validation->set_rules('movement_id', 'Movement Id', 'trim|numeric|required');
    	$this->form_validation->set_rules('item_id', 'Item Id', 'trim|numeric|required');
    	$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric');

    	if($item_movement['type']=='Inbound')
    	{
    		$this->form_validation->set_rules('buying_price', 'Price', 'trim|max_length[8]|required|numeric');
    		$this->form_validation->set_rules('selling_price', 'Selling Price', 'trim|max_length[8]|required|numeric');
    		$this->form_validation->set_rules('incentives', 'Incentives', 'trim|max_length[8]|required|numeric');
    		$this->form_validation->set_rules('supplier', 'Supplier', 'trim|max_length[2000]|required');
	    	$this->form_validation->set_rules('remarks', 'DRNO', 'trim|max_length[2000]|required');
    	}
    	else if($item_movement['type']=='Orders')
    	{
    		
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
	        	echo json_encode($this->itemmovement_model->add_item_in_movement());
	        }
	        else
	        {
	        	echo json_encode($this->itemmovement_model->update_item_in_movement());
	        }
	    }
	}

	public function debug()
	{
		$this->load->model('account/itemmovement_model');
		$this->itemmovement_model->add_item_in_movement();
	}


	public function get_item_movement_item_uids()
	{
		$this->load->model('account/itemmovement_model');
		$item_movement_id = $this->input->post('id');
		$branch_id = $this->input->post('branch_id');
		$item_id = $this->input->post('item_id');

		$data['uids'] = $this->itemmovement_model->get_item_movement_item_uids($item_movement_id);
		$data['branch_id'] = $branch_id;
		$data['item_id'] = $item_id;
		// $data['available_imei'] = $this->itemmovement_model->get_item_imei($branch_id,$item_id);

		$this->load->view('account/itemmovement/uids',$data);
	}	

	public function get_item_movement_item_uids_acc($item_movement_id)
	{
		$this->load->model('account/itemmovement_model');
		$data['uids'] = $this->itemmovement_model->get_item_movement_item_uids_acc($item_movement_id);

		$this->load->view('account/itemmovement/uids_acc',$data);
	}


	public function update_uid()
	{
		$this->load->model('account/itemmovement_model');
		echo json_encode($this->itemmovement_model->update_uid());
	}


	public function delete_uid()
	{
		$this->load->model('account/itemmovement_model');
		echo json_encode($this->itemmovement_model->delete_uid());
	}

	public function import_item_out_to_inbound(){
		$this->load->model('account/itemmovement_model');
		echo json_encode ($this->itemmovement_model->import_item_out_to_inbound());
	}

	public function add_item_in_movement_thru_scanning(){
		$this->load->model('account/inventorymovement_model');
		echo json_encode($this->inventorymovement_model->add_item_in_movement_thru_scanning());
    }

}
