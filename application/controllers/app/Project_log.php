<?php
class Project_log extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('app/model_project_log');
	}

	public function view()
	{
		$this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
        	$page_title = "Projects List";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/project_management/'),'Project Management'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            $forms = array(
            	$this->load->view('app/project/form_view','',true)
            );

            $data = array(
                'view' => $this->load->view("app/project/table_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/project/create.js','assets/js/app/project/main.js'),
                'forms' => $forms
            );
             
            $this->load->view('templates/template_admin',$data);
        }
        else
        {
            deny_access();
        }
	}


    public function view_project($id)
    {
        $id = en_dec('dec',$id);
        $project = $this->model_project->read($id);

        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {

            $page_title = $project['name'];

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/project_management/'),'Project Management'),
                array('',base_url('app/project/view'),'Projects List'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);
            $sub_data['project_id'] = en_dec('en',$id);

            $forms = array(

            );

            $data = array(
                'view' => $this->load->view("app/project/data_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/project/view_project.js'),
                'forms' => $forms
            );
             
            $this->load->view('templates/template_admin',$data);
        }
        else
        {
            deny_access();
        }
    }


	public function create()
	{

        $this->load->model('app/model_project_log');
        $this->load->model('app/model_member');

        $member = $this->model_member->read_from_user_id($this->session->user_id);

		$validation = array(
    	    array('project_log_project','Project ID','required|max_length[100]|min_length[1]'),
    	    array('project_log_log','Project Log','required|max_length[2000]|min_length[2]')
    	);

        $project_id = en_dec('dec',$this->input->post('project_log_project'));

    	foreach ($validation as $value) {
    	    $this->form_validation->set_rules($value[0],$value[1],$value[2]);
    	}

    	if ($this->form_validation->run() == FALSE)
    	{
    	        $response['environment']    =   ENVIRONMENT;
    	        $response['success']        =   false;
    	        $response['message']        =   validation_errors();
    	        $response['csrf_name']      =   $this->security->get_csrf_token_name();
    	        $response['csrf_hash']      =   $this->security->get_csrf_hash();

    	        echo json_encode($response);
    	}
    	else
    	{
    		$success = $this->model_project_log->create(
    			$project_id,
                $member['member_id'],
                $this->input->post('project_log_log')
    		);

    		$message = "";

    		if($success)
    		{
    			$message = "log saved.";
    		}
    		else
    		{
    			$message = "Something went wrong. Please try again.";
    		}

    		$response['environment']    =   ENVIRONMENT;
    	   	$response['success']        =   $success;
    	   	$response['message']        =   $message;
    	   	$response['csrf_hash']      =   $this->security->get_csrf_hash();

    	   	echo json_encode($response);
    	}
	}

	public function update()
	{
		$validation = array(
			array('project_id','Project ID','required|max_length[11]|min_length[1]|numeric'),
    	    array('project_description','Project Description','max_length[2000]|min_length[2]'),
    	    array('project_project_status','Project Status','required|max_length[1]|min_length[1]|numeric'),
            array('project_category','Project Category','required|max_length[11]|min_length[1]|numeric'),
            array('project_progress','Project Progress','required|max_length[3]|min_length[1]|numeric')
    	);

    	$add_validation = array('project_name','Project Name','required|max_length[100]|min_length[2]');

    	$project = $this->model_project->read($this->input->post('project_id'));

    	if($project['name']!=$this->input->post('project_name'))
    	{
    		$add_validation = array('project_name','Project Name','required|max_length[100]|min_length[2]|is_unique[app_projects.name]');
    	}

    	array_push($validation, $add_validation);

    	foreach ($validation as $value) {
    	    $this->form_validation->set_rules($value[0],$value[1],$value[2]);
    	}

    	if ($this->form_validation->run() == FALSE)
    	{
    	        $response['environment']    =   ENVIRONMENT;
    	        $response['success']        =   false;
    	        $response['message']        =   validation_errors();
    	        $response['csrf_name']      =   $this->security->get_csrf_token_name();
    	        $response['csrf_hash']      =   $this->security->get_csrf_hash();

    	        echo json_encode($response);
    	}
    	else
    	{
    		$success = $this->model_project->update(
    			$this->input->post('project_name'),
    			$this->input->post('project_description'),
    			$this->input->post('project_project_status'),
    			$this->input->post('project_id'),
                $this->input->post('project_category'),
                $this->input->post('project_progress')
    		);

    		$message = "";

    		if($success)
    		{
    			$message = "Project updated";
    		}
    		else
    		{
    			$message = "Something went wrong. Please try again.";
    		}

    		$response['environment']    =   ENVIRONMENT;
    	   	$response['success']        =   $success;
    	   	$response['message']        =   $message;
    	   	$response['csrf_hash']      =   $this->security->get_csrf_hash();

    	   	echo json_encode($response);
    	}
	}

	public function list($project_id)
	{
        $project_id = en_dec('dec',$project_id);

		if($this->loginstate->get_access()['overall_access'] == 1)
		{
		    $post_data = $this->input->post();

            $data['project_logs'] = $this->model_project_log->list($project_id);

            $this->load->view('app/project_log/partial/project_logs_partial_view',$data);
   		}
   		else
   		{
   		    deny_access();
   		}
	}

	public function read($id)
	{
        $id = en_dec('dec',$id);

		if($this->loginstate->get_access()['overall_access'] == 1)
		{
			echo json_encode($this->model_project->read($id));
		}
	}	

	public function delete($id)
	{
        $id = en_dec('dec',$id);

		if($this->loginstate->get_access()['overall_access'] == 1)
		{
			if($this->model_project->delete($id))
			{
				$response = array(
					'success' => true,
					'message' => "Project deleted."
				);
			}
			else
			{
				$response = array(
					'success' => true,
					'message' => "Something went wrong. Please try again."
				);
			}

			echo json_encode($response);
		}
	}



}