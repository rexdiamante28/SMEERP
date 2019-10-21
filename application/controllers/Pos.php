<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends CI_Controller {

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

			$data['title'] = "POS";

			$this->load->view('account/pos/pos',$data);
		}
			
	}


	public function debug()
	{
		$this->load->model('account/branch_model');

		echo $this->branch_model->get_branches();
	}



	public function get_store_items()
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/stock_model');

			$data['items'] = $this->stock_model->get_store_items()->result_array();

			echo $this->load->view('account/pos/thumbnail_content',$data,TRUE);

		}
	}

	public function get_temp_orders()
	{
		$this->load->model('account/stock_model');

		$data['orders'] = $this->stock_model->get_temp_orders()->result_array();

		echo $this->load->view('account/pos/orders_content',$data,TRUE);
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


	public function add_order()
	{
		$this->load->model('account/stock_model');
		$this->load->library('form_validation');

		$unique = false;

		if(null !== ($this->input->post('unique_id')))
        {
          	$this->form_validation->set_rules('unique_id', 'IMEI', 'trim|required|min_length[3]');
          	$this->form_validation->set_rules('store_item_id', 'IMEI', 'trim|required');
          	$unique = true;
        }
        else
        {
        	$this->form_validation->set_rules('item_movement_item_id', 'Item', 'trim|required|numeric');
    		$this->form_validation->set_rules('discount', 'Discount', 'trim|numeric');
    		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|numeric|required');
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
	        echo json_encode($this->stock_model->add_order($unique));
	    }

	}


	public function add_order_from_imei()
	{
		$this->load->model('account/stock_model');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('imei_barcode_scan', 'IMEI', 'trim|required|min_length[3]');

		if ($this->form_validation->run() === FALSE)
	    {
	        $response['success'] = false;
	        $response['message'] = validation_errors();
	        $response['environment'] = ENVIRONMENT;

	        echo json_encode($response);
	    }
	    else
	    {
	    	$imei = $this->input->post('imei_barcode_scan');

	        echo json_encode($this->stock_model->add_order_from_imei($imei));
	    }
	}


	public function remove_order($id)
	{
		$this->load->model('account/stock_model');
		echo json_encode($this->stock_model->remove_order($id));

	}

	public function pay_order()
	{	
		$this->load->model('account/stock_model');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('total', 'Total', 'trim|required|numeric');
    	$this->form_validation->set_rules('amount_due', 'Amount Due', 'trim|numeric|required');
    	$this->form_validation->set_rules('change', 'Change', 'trim|numeric|required');
    	$this->form_validation->set_rules('discount', 'Discount', 'trim|numeric|required');
    	$this->form_validation->set_rules('tax', 'Tax', 'trim|numeric|required');
    	$this->form_validation->set_rules('amount_balance', 'balance', 'trim|numeric');
    	$this->form_validation->set_rules('remarks', 'remarks', 'trim|max_length[50]');

		if ($this->form_validation->run() === FALSE)
	    {
	        $response['success'] = false;
	        $response['message'] = validation_errors();
	        $response['environment'] = ENVIRONMENT;

	        echo json_encode($response);
	    }
	    else
	    {
	        echo json_encode($this->stock_model->pay_order());
	    }

	}

	public function print_receipt($id)
	{
		$this->load->model('account/stock_model');
		

		$data['title'] = "Transaction Receipt";
		//$data['view_data'] = $this->load->view('web/login','',TRUE);

		$data['transaction'] = $this->stock_model->get_transaction($id)->row_array();

		$data['transaction_items'] = $this->stock_model->get_transaction_items($id)->result_array();

		$data['view_data'] = $this->load->view('account/pos/receipt',$data,TRUE);
		
		$this->load->view('templates/blank_template',$data);

		

	}


	public function print_sales()
	{
		$this->load->model('account/transaction_model');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('branch_id', 'Branch', 'trim|required|numeric');
    	$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
    	$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');

		if ($this->form_validation->run() === FALSE)
	    {
	        $response['success'] = false;
	        $response['message'] = validation_errors();
	        $response['environment'] = ENVIRONMENT;

	        echo json_encode($response);
	    }
	    else
	    {
	        //$data['title'] = "Sales Report";

			//$data['transactions'] = $this->stock_model->get_transaction_items($id)->result_array();

			//$data['view_data'] = $this->load->view('account/pos/sales_report',$data,TRUE);
			
			//$this->load->view('templates/blank_template',$data);

			$response['success'] = true;
	        $response['message'] = "success";
	        $response['environment'] = ENVIRONMENT;

	        echo json_encode($response);
	    }

	
	}

	public function print_sales_report($branch_id,$sdate,$edate)
	{
		$this->load->model('account/transaction_model');
		$this->load->model('account/branch_model');
		

		$data['title'] = "Sales Report";
		//$data['view_data'] = $this->load->view('web/login','',TRUE);

		$data['branch'] = $this->branch_model->get_branch($branch_id)->row();

		$data['transactions'] = $this->transaction_model->get_transactions_reports($branch_id,$sdate,$edate)->result();

		$data['view_data'] = $this->load->view('account/pos/sales_report',$data,TRUE);
		
		$this->load->view('templates/blank_template',$data);

		

	}


	public function print_inventory()
	{
		$this->load->model('account/transaction_model');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('branch_id', 'Branch', 'trim|required|numeric');

		if ($this->form_validation->run() === FALSE)
	    {
	        $response['success'] = false;
	        $response['message'] = 'Invalid Branch';
	        $response['environment'] = ENVIRONMENT;

	        echo json_encode($response);
	    }
	    else
	    {
	        //$data['title'] = "Sales Report";

			//$data['transactions'] = $this->stock_model->get_transaction_items($id)->result_array();

			//$data['view_data'] = $this->load->view('account/pos/sales_report',$data,TRUE);
			
			//$this->load->view('templates/blank_template',$data);

			$response['success'] = true;
	        $response['message'] = "success";
	        $response['environment'] = ENVIRONMENT;

	        echo json_encode($response);
	    }

	
	}

	public function print_inventory_report_old($branch_id)
	{
		$this->load->model('account/stock_model');
		$this->load->model('account/branch_model');
		

		$data['title'] = "Inventory Report";
		//$data['view_data'] = $this->load->view('web/login','',TRUE);

		$data['branch'] = $this->branch_model->get_branch($branch_id)->row();
		$data['items'] = $this->stock_model->get_all_stocks($branch_id)->result();
		$data['view_data'] = $this->load->view('account/pos/inventory_report',$data,TRUE);
		
		$this->load->view('templates/blank_template',$data);

	}	

	public function print_inventory_report($branch_id)
	{
		$this->load->model('account/stock_model');
		$this->load->model('account/branch_model');
		
		$data['title'] = "Inventory Report";

		$data['branch'] = $this->branch_model->get_branch($branch_id)->row();
		$data['items'] = $this->stock_model->inventory_report_new($branch_id)->result();
		$data['view_data'] = $this->load->view('account/pos/inventory_report',$data,TRUE);
		
		$this->load->view('templates/blank_template',$data);

	}

	function get_uid_via_itemprice(){
		
		$this->load->model('account/stock_model');
		$result = $this->stock_model->get_uid_via_itemprice();
		
		if(!empty($result)){

			$response['result'] = $result;
			$response['success'] = true;
	        $response['message'] = "success";
	        $response['environment'] = ENVIRONMENT;
		}else{
			$response['success'] = false;
	        $response['message'] = "No available IMEI found.";
	        $response['environment'] = ENVIRONMENT;
		}

        echo json_encode($response);
	}


}
