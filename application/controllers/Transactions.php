<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

	public function index()
	{
		$this->list_transactions();
	}

	public function list_transactions()
	{
		if($this->loginstate->login_state_check())
		{	

			$tempdata['id'] = 'receive_payment_modal';
			$tempdata['form_id'] = 'receive_payment_form';
			$tempdata['title'] = 'Receive Payment';
			$tempdata['action'] = 'transactions/receive_payment';
			$tempdata['form'] = $this->load->view('account/transactions/receive_payment','',TRUE);

			$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);

			$data['forms'] = array($form1);

			// additional scripts
			$data['add_js'] = array('assets/scripts/account/transactions.js');

			$data['title'] = "Transactions";

			$data['view_data'] = $this->load->view('common/loading','',TRUE);

			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
			
	}



	public function get_transactions()
	{
		if($this->loginstate->login_state_check())
		{	

			$this->load->model('account/transaction_model');

			$data['transactions'] = $this->transaction_model->get_transactions()->result_array();

			$data['table_content'] = $this->load->view('account/transactions/transactions_table',$data,TRUE);
			
			echo ($this->load->view('common/table',$data,TRUE));
		}
	}


	public function receive_payment()
	{
		if($this->loginstate->login_state_check())
		{

			$this->load->library('form_validation');

			$this->load->model('account/transaction_model');

			$this->form_validation->set_rules('transaction_id', 'Transaction ID', 'trim|required|min_length[1]|max_length[8]|numeric');
	    	$this->form_validation->set_rules('amount_received', 'Amount', 'trim|required|numeric|max_length[11]');

	    	if ($this->form_validation->run() === FALSE)
		    {
		        $response['success'] = false;
		        $response['message'] = validation_errors();
		        $response['environment'] = ENVIRONMENT;

		        echo json_encode($response);
		    }
		    else
		    {
		       echo json_encode($this->transaction_model->receive_payment());
		    }
		}
	}

}
