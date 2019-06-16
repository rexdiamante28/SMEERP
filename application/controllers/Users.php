<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


	public function index()
	{
		$this->list_users();
	}

	public function list_users()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/user_model');
			$this->load->model('account/branch_model');
			// load libraries

			// load helpers

			// load forms
			//$tempdata['id'] = 'add_record_modal';
			//$tempdata['title'] = 'User Record';
			//$tempdata['action'] = 'users/add_user';
			//$tempdata['form'] = $this->load->view('account/users/add_user','',TRUE);

			//$form1 = $this->load->view('common/modal_form',$tempdata,TRUE);

			$form1 = $this->load->view('account/users/custom_modal','',TRUE);

			$data['forms'] = array($form1);

			// additional styles

			// additional scripts
			$data['add_js'] = array('assets/scripts/account/users.js');

			$data['title'] = "Users";

			$data['view_data'] = $this->load->view('common/loading','',TRUE);

			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
			
	}


	public function get_users()
	{
		if($this->loginstate->login_state_check())
		{	
			// load models
			$this->load->model('account/user_model');

			// load libraries

			// load helpers

			// load the data to common views
			$data['users'] = $this->user_model->get_users()->result_array();

			$data['table_content'] = $this->load->view('account/users/thumbnail_content',$data,TRUE);
			
			// print view
			echo $data['table_content'];
		}
			
	}

	public function change_password()
	{
		$this->load->model('account/user_model');
		$this->load->library('form_validation');


		$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
    	$this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
    	$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');

    	if ($this->form_validation->run() === FALSE)
	    {
	    	$notification = $this->session->first_name." ".$this->session->last_name." changed password. ";
			$this->notification_model->notify($notification,"Notification Users");

	        $response['success'] = false;
	        $response['message'] = validation_errors();
	        $response['environment'] = ENVIRONMENT;

	        echo json_encode($response);
	    }
	    else
	    {
	        echo json_encode($this->user_model->change_password());
	    }
		
	}


	public function get_user($id)
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/user_model');

			echo json_encode($this->user_model->get_user($id)->row_array());
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

	public function add_user()
	{
    	$this->load->library('form_validation');
    	$this->load->model('account/user_model');

    	$this->form_validation->set_rules('branches_list', 'Branch Assignment', 'trim|required|max_length[2000]');
    	$this->form_validation->set_rules('functions_list', 'User Fucntions', 'trim|required|max_length[2000]');
    	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[50]');
    	$this->form_validation->set_rules('middle_name', 'Middle Name', 'trim|max_length[50]');
    	$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[50]');
    	$this->form_validation->set_rules('telephone_number', 'Telephone Number', 'trim|max_length[20]|numeric');
    	$this->form_validation->set_rules('status', 'Status', 'trim|required|numeric');

    	if($this->input->post('id')==='')
    	{
    		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[150]|is_unique[users.username]');
	    	$this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|max_length[15]|numeric|is_unique[users.mobile_number]');
	    	$this->form_validation->set_rules('email_address', 'Email Address', 'trim|max_length[100]|is_unique[users.email_address]');
    	}
    	else
    	{
    		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[150]');
	    	$this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|max_length[15]|numeric');
	    	$this->form_validation->set_rules('email_address', 'Email Address', 'trim|max_length[100]');
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
	        	echo json_encode($this->user_model->add_user());
	        }
	        else
	        {
	        	echo json_encode($this->user_model->update_user());
	        }
	    }
	}


	public function logout()
	{
		$notification = $this->session->first_name." ".$this->session->last_name." Logged out. ";
		$this->notification_model->notify($notification,"Notification Users");

		$this->session->sess_destroy();
		header("location: ".base_url()."web/login");
	}


	public function authenticate()
	{
		try {

				$this->load->helper(array('form','url'));

				//sanitize user input
				$username = $this->db->escape($this->input->post('username'));
				$password = $this->input->post('password');

				$query = "SELECT * FROM users WHERE username = $username";

				$result = $this->db->query($query);

				$response = array(
						'success'		=>	true,
						'message'		=>	'login successfull',
						'environment'	=>	ENVIRONMENT
				);

				if($result->num_rows()!==1)
				{
					$response['success'] = false;
					$response['message'] = 'Oops! the username you entered is not enrolled in the system. If you
					believe this is an error, please contact your administrator.';
				}
				else
				{
					$row = $result->row();

					if(password_verify($password,$row->password)){

						if($row->status==='0')
						{
							$response['success'] = false;
							$response['message'] = 'Sorry, your account is currently suspended. Please contact your administrator.';
						}
						else
						{
							$this->session->user_id				=		$row->id;
							$this->session->username			=		$row->username;
							$this->session->email_address		=		$row->email_address;
							$this->session->last_login			=		$row->last_login;
							$this->session->avatar				=		$row->avatar;
							$this->session->first_name			=		$row->first_name;
							$this->session->middle_name			=		$row->middle_name;
							$this->session->last_name			=		$row->last_name;
							$this->session->mobile_number		=		$row->mobile_number;
							$this->session->telephone_number	=		$row->telephone_number;
							$this->session->branches			=		$row->branches;
							$this->session->functions 			=		$row->functions;

							$notification = $this->session->first_name." ".$this->session->last_name." logged in. ";
							$this->notification_model->notify($notification,"Notification Users");
						}
						
					}
					else{
						$response['success'] = false;
						$response['message'] = 'Invalid password. Please try again.';
					}
				}

				session_write_close();

				echo json_encode($response);

			} catch (Exception $e) {

			$response = array(
					'success'		=>	"error",
					'message'		=>	$e->message(),
					'environment'	=>	ENVIRONMENT
			);

			return $response;
		}
	}


	public function upload_photo()
	{
		$config['upload_path']          = './assets/images/avatar/';
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
