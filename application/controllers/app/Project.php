<?php
class Project extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('app/model_project');
        $this->load->model('app/model_project_category');
        $this->load->model('app/model_priority');
        $this->load->model('app/model_project_status');
        $this->load->model('app/model_project_task_status');
        $this->load->model('app/model_project_contributor');
        $this->load->model('app/model_project_role');
        $this->load->model('app/model_member');
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


            $form_data = array(
                'project_status_options' => $this->model_project_status->get_options(),
                'project_category_options' => $this->model_project_category->get_categories(),
                'priority_options' => $this->model_priority->get_options()
            );

            $forms = array(
            	$this->load->view('app/project/form_view',$form_data,true)
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

            $project_task_form_data =array(
                'project_task_status_options' => $this->model_project_task_status->get_options(),
                'priority_options' => $this->model_priority->get_options(),
                'contributors' => $this->model_project_contributor->get_project_contributors($id)
            );

            $project_contributors_form_data =array(
                'members' => $this->model_member->get_members(),
                'roles' => $this->model_project_role->get_project_roles($id)
            );

            $forms = array(
                $this->load->view('app/project_log/partial/form_view','',true),
                $this->load->view('app/project_task_group/partial/form_view','',true),
                $this->load->view('app/project_task/partial/form_view',$project_task_form_data,true),
                $this->load->view('app/project_role/partial/form_view','',true),
                $this->load->view('app/project_contributor/partial/form_view',$project_contributors_form_data,true)
            );

            $data = array(
                'view' => $this->load->view("app/project/data_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(
                    'assets/css/app/project/project.css',
                    //'assets/admin/css/chosen_autoselect/style.css',
                    //'assets/admin/css/chosen_autoselect/prism.css',
                    //'assets/admin/css/chosen_autoselect/chosen.css',
                ),
                'add_js' =>  array(
                    'assets/js/app/project/view_project.js',
                    'assets/js/app/project_log/create.js',
                    'assets/js/app/project_role/main.js',
                    'assets/js/app/project_role/create.js',
                    'assets/js/app/project_contributor/main.js',
                    'assets/js/app/project_contributor/create.js',
                    'assets/js/app/project_task/main.js',
                    'assets/js/app/project_task/create.js',
                    'assets/js/app/project_task_group/create.js',
                    //'assets/admin/js/chosen_autoselect/chosen.jquery.js',
                    //'assets/admin/js/chosen_autoselect/prism.js',
                    //'assets/admin/js/chosen_autoselect/init.js',
                ),
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
		$validation = array(
    	    array('project_name','Project Name','required|max_length[100]|min_length[2]|is_unique[app_projects.name]'),
    	    array('project_description','Project Description','max_length[2000]|min_length[2]'),
    	    array('project_project_status','Project Status','required|max_length[1]|min_length[1]|numeric'),
            array('project_category','Project Category','required|max_length[11]|min_length[1]|numeric'),
            array('project_priority','Project Priority','required|max_length[11]|min_length[1]|numeric')
            //array('project_progress','Project Progress','required|max_length[3]|min_length[1]|numeric')
    	);

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
    		$success = $this->model_project->create(
    			$this->input->post('project_name'),
    			$this->input->post('project_description'),
    			$this->input->post('project_project_status'),
                $this->input->post('project_category'),
                $this->input->post('project_priority')
    		);

    		$message = "";

    		if($success)
    		{
    			$message = "Project added";
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
            array('project_priority','Project Priority','required|max_length[11]|min_length[1]|numeric')
            //array('project_progress','Project Progress','required|max_length[3]|min_length[1]|numeric')
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
                $this->input->post('project_priority')
    		);

    		$message = "";

    		if($success)
    		{
    			$message = "Project updated";

                //insert log
                /*$this->load->model('app/model_project_log');
                $this->load->model('app/model_member');

                $log = "Updated project progress to ".$this->input->post('project_progress')."%. ";
                $member = $this->model_member->read_from_user_id($this->session->user_id);

                $this->model_project_log->create(
                    $this->input->post('project_id'),
                    $member['member_id'],
                    $log
                );*/
                
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

	public function list()
	{
		if($this->loginstate->get_access()['overall_access'] == 1)
		{
		    $post_data = $this->input->post();

        	$read_args = array(
        	   'start' => $post_data['start'],
        	   'end' => $post_data['length'],
        	   'order_column' => $post_data['order'][0]['column'],
        	   'order_direction' => $post_data['order'][0]['dir'],
        	   'search_string' => $post_data['search_string']
        	);

        	$result = $this->model_project->list($read_args);

        	$data = [];

        	foreach($result['result'] as $row) {

        	$nestedData = array();
        	$nestedData[] = $row["name"];
            $nestedData[] = $row["category_string"];
        	$nestedData[] ='
                <div class="progress">
                  <div class="progress-bar bg-info" role="progressbar" style="width: '.$row['progress'].'%;" aria-valuenow="'.$row['progress'].'" aria-valuemin="0" aria-valuemax="100">'.$row['progress'].'%</div>
                </div>

            ';

            $nestedData[] = '<span class="badge badge-default" style="background-color:'.$row['priority_color_code'].' !important;">'.$row['priority'].'</span>';
        	$nestedData[] = '<span class="badge badge-default" style="background-color:'.$row['color_code'].' !important;">'.$row['status_name'].'</span>';

            $url = base_url('app/project/view_project/').en_dec('en',$row['id']);

        	$nestedData[] = '
        		<a href="'.$url.'" class="btn btn-info project_view_btn" id="'.en_dec('en',$row['id']).'">View</a>
                <button class="btn btn-primary project_edit_btn" id="'.en_dec('en',$row['id']).'">Edit</button>
        		<button class="btn btn-danger project_delete_btn" id="'.en_dec('en',$row['id']).'">Delete</button>
        	';

        	  $data[] = $nestedData;
        	}

        	$json_data = array(
        	 "draw"            => intval($post_data['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
        	 "recordsTotal"    => intval($result{'recordsTotal'}),  // total number of records
        	 "recordsFiltered" => intval($result{'recordsFiltered'}), // total number of records after searching, if there is no searching then totalFiltered = totalData
        	 "data"            => $data   // total data array
        	);

        	echo json_encode($json_data);
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



    public function project_details_partial_view($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $project = $this->model_project->read($id);

            $data = array(
                'project' => $project
            );

            $this->load->view('app/project/partial/project_details_partial_view',$data);
        }
    }

}