<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

	public function index()
	{
		$this->list_notifications();
	}

	public function list_notifications()
	{
		if($this->loginstate->login_state_check())
		{	

			 if ((strpos($this->session->functions, 'Notification Sales') === false) && (strpos($this->session->functions, 'Notification Inventory') === false) && (strpos($this->session->functions, 'Notification Users') === false) && (strpos($this->session->functions, 'Notification Items') === false)) 
	        {
	            header("location: ".base_url()."transactions/index");
			}

			else
			{
				// load models
				// load libraries

				// load helpers

				// load forms
				//$tempdata['id'] = 'add_record_modal';
				//$tempdata['title'] = 'Terminal Record';
				//$tempdata['action'] = 'terminals/add_terminal';
				//$tempdata['form'] = $this->load->view('account/terminals/add_terminal','',TRUE);

				//$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);

				//$data['forms'] = array($form1);

				// additional styles

				// additional scripts
				$data['add_js'] = array('assets/scripts/account/notifications.js');

				$data['title'] = "Notifications";

				$data['view_data'] = $this->load->view('common/loading','',TRUE);

				// pass to the template
				$this->load->view('templates/account_template',$data);
			}
		}
			
	}

	public function set_read($id)
	{
		if($this->loginstate->login_state_check())
		{	
			echo json_encode($this->notification_model->set_read($id));
		}
	}

	public function toggle_important($id)
	{
		if($this->loginstate->login_state_check())
		{	
			echo json_encode($this->notification_model->toggle_important($id));
		}
	}


	public function get_notifications()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			//$this->load->model('account/terminal_model');

			// load libraries

			// load helpers

			// load the data to common views
			$data['notifications'] = $this->notification_model->get_notifications()->result_array();

			$data['table_content'] = $this->load->view('account/pages/notifications_table',$data,TRUE);
			
			// print view
			echo ($this->load->view('common/table',$data,TRUE));
		}
			
	}


	public function get_terminal($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/terminal_model');

			echo json_encode($this->terminal_model->get_terminal($id)->row_array());
		}
	}

	public function remove_terminal($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/terminal_model');

			echo json_encode($this->terminal_model->remove_terminal($id));
		}
	}

	public function add_terminal()
	{
    	$this->load->library('form_validation');
    	$this->load->model('account/terminal_model');

    	$this->form_validation->set_rules('branch_id', 'Branch', 'trim|required|numeric');
    	
    	if($this->input->post('id')==='')
    	{
    		$this->form_validation->set_rules('terminal_code', 'Terminal Code', 'trim|required|min_length[1]|max_length[45]|is_unique[terminals.terminal_code]');
    		$this->form_validation->set_rules('terminal_number', 'Terminal Number', 'trim|required|numeric|max_length[11]');
    	}
    	else
    	{
    		$this->form_validation->set_rules('terminal_code', 'Terminal Code', 'trim|required|min_length[1]|max_length[45]');
    		$this->form_validation->set_rules('terminal_number', 'Terminal Number', 'trim|required|numeric|max_length[11]');
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
	        	echo json_encode($this->terminal_model->add_terminal());
	        }
	        else
	        {
	        	echo json_encode($this->terminal_model->update_terminal());
	        }
	    }
	}


	public function open_terminal($id)
	{	

		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/terminal_model');

			$terminal  = $this->terminal_model->get_terminal($id)->row();
			$this->session->terminal_id = $terminal->id;
			$this->session->branch_id = $terminal->branch_id;

			if(intval($this->session->terminal_id)>0 && intval($this->session->branch_id)>0)
			{
				$response['success'] = true;
			    $response['message'] = '';
			    $response['environment'] = ENVIRONMENT;

			    echo json_encode($response);
			}
		}
		
		
	}


}
