<?php
class Project_task extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('app/model_project_task');
        $this->load->model('app/model_project');
        $this->load->model('app/model_project_task_assignee');
        $this->load->model('app/model_project_task_status');
        $this->load->model('app/model_priority');
        $this->load->model('app/model_project_contributor');
	}

    public function get_groups_and_tasks($project_id)
    {   
        $this->loginstate->login_state_check();

        $project_id = en_dec('dec',$project_id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $result = $this->model_project_task->get_groups_and_tasks($project_id);

            $response = array(
                'success' => true,
                'message' => $result
            );

            echo json_encode($response);
        }
    }

	public function view($task_id)
	{
        $task_id = en_dec('dec',$task_id);

		$this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $task = $this->model_project_task->read($task_id);

        	$page_title = $task['name'];

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/project_management/'),'Project Management'),
                array('',base_url('app/project/view/'),'Projects List'),
                array('',base_url('app/project/view_project/'.en_dec('en',$task['project_id'])),$task['project']),
                array('','','Tasks'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);
            $sub_data['task'] = $task;
            $sub_data['task_assignees'] = $this->model_project_task_assignee->list($task['id']);

            $forms = array(
                
            );

            $data = array(
                'view' => $this->load->view("app/project_task/data_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/project_task/view_task.js'),
                'forms' => $forms
            );
             
            $this->load->view('templates/template_admin',$data);
        }
        else
        {
            deny_access();
        }
	}


    public function view_task($task_id)
    {
        $task_id = en_dec('dec',$task_id);

        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $task = $this->model_project_task->read($task_id);

            $page_title = $task['name'];

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/project_management/'),'Project Management'),
                array('',base_url('app/project/view/'),'Projects List'),
                array('',base_url('app/project/view_project/'.en_dec('en',$task['project_id'])),$task['project']),
                array('','','Tasks'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);
            $sub_data['task'] = $task;
            $sub_data['task_assignees'] = $this->model_project_task_assignee->list($task['id']);

            $project_id = $this->model_project_task->get_project_id($task_id);

            $project_task_form_data =array(
                'project_task_status_options' => $this->model_project_task_status->get_options(),
                'priority_options' => $this->model_priority->get_options(),
                'contributors' => $this->model_project_contributor->get_project_contributors($project_id)
            );

            $forms = array(
                $this->load->view('app/project_task/partial/form_view',$project_task_form_data,true)
            );

            $data = array(
                'view' => $this->load->view("app/project_task/data_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array('assets/css/app/project/project.css'),
                'add_js' =>  array('assets/js/app/project_task/view_task.js','assets/js/app/project_task_log/create.js','assets/js/app/project_task/create.js'),
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
            array('project_id','Project ID','max_length[100]|min_length[1]|required'),
    	    array('project_priority','Project Priority','required|max_length[11]|min_length[1]|numeric'),
            array('project_task_status','Project Status','required|max_length[11]|min_length[1]|numeric'),
    	    array('project_task_description','Project Task Description','max_length[65530]|min_length[2]'),
            array('project_task_man_hours','Project Man Hours','required|max_length[4]|min_length[1]|numeric'),
            array('project_task_task_group','Project Task Group','required|max_length[11]|min_length[1]|numeric'),
            array('project_task_task_name','Task Name','required|max_length[100]|min_length[1]'),
    	    array('project_task_weight','Project Weight','required|max_length[4]|min_length[1]|numeric'),
            array('project_task_deadline','Deadline','required'),
            array('project_task_start_date','Start Date','required')
    	);

        $project_id = en_dec('dec',$this->input->post('project_id'));

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
    		$success = $this->model_project_task->create(
    			$this->input->post('project_task_task_name'),
                $this->input->post('project_task_description'),
                $this->input->post('project_task_man_hours'),
                $this->input->post('project_task_weight'),
                $this->input->post('project_priority'),
                $this->input->post('project_task_status'),
                $this->input->post('project_task_task_group'),
                $this->input->post('project_task_deadline'),
                $this->input->post('project_task_start_date')
    		);

            if($success['status'])
            {

                $new_task_id = $success['task_id'];

                if($this->input->post('project_task_assignee'))
                {
                    $assignees = $this->input->post('project_task_assignee');

                    foreach ($assignees as $assignee) {
                        $success = $this->model_project_task_assignee->create(
                            $new_task_id,
                            $assignee
                        );

                        if(!$success)
                        {
                            $response['environment']    =   ENVIRONMENT;
                            $response['success']        =   false;
                            $response['message']        =   "Something went wrong. Please try again.";
                            $response['csrf_hash']      =   $this->security->get_csrf_hash();

                            echo json_encode($response);
                        }

                    }


                    $message = "";

                    if($success)
                    {
                        $message = "Task added";

                        $this->model_project->calculate_progress($project_id);
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
                else
                {

                    $response['environment']    =   ENVIRONMENT;
                    $response['success']        =   "Task added.";
                    $response['message']        =   $message;
                    $response['csrf_hash']      =   $this->security->get_csrf_hash();

                    echo json_encode($response);
                }
                
                
            }
            else
            {
                $response['environment']    =   ENVIRONMENT;
                $response['success']        =   false;
                $response['message']        =   "Something went wrong. Please try again.";
                $response['csrf_hash']      =   $this->security->get_csrf_hash();

                echo json_encode($response);
            }
    		
    	}
	}

	public function update()
	{
		$validation = array(
            array('project_id','Project ID','max_length[100]|min_length[1]|required'),
            array('project_priority','Project Priority','required|max_length[11]|min_length[1]|numeric'),
            array('project_task_status','Project Status','required|max_length[11]|min_length[1]|numeric'),
            array('project_task_description','Project Task Description','max_length[65530]|min_length[2]'),
            array('project_task_man_hours','Project Man Hours','required|max_length[4]|min_length[1]|numeric'),
            array('project_task_task_id','Project Task ID','max_length[100]|min_length[1]|required'),
            array('project_task_task_group','Project Task Group','required|max_length[11]|min_length[1]|numeric'),
            array('project_task_task_name','Task Name','required|max_length[100]|min_length[1]'),
            array('project_task_weight','Project Weight','required|max_length[4]|min_length[1]|numeric'),
            array('project_task_deadline','Deadline','required'),
            array('project_task_start_date','Start Date','required'),
        );


    	$project = $this->model_project->read($this->input->post('project_id'));

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
    		
            $success = $this->model_project_task->update(
                en_dec('dec',$this->input->post('project_task_task_id')),
                $this->input->post('project_task_task_name'),
                $this->input->post('project_task_description'),
                $this->input->post('project_task_man_hours'),
                $this->input->post('project_task_weight'),
                $this->input->post('project_priority'),
                $this->input->post('project_task_status'),
                $this->input->post('project_task_deadline'),
                $this->input->post('project_task_start_date')
            );

            if($success['status'])
            {

                $new_task_id = $success['task_id'];

                if($this->input->post('project_task_assignee'))
                {
                    $assignees = $this->input->post('project_task_assignee');

                    foreach ($assignees as $assignee) {
                        $success = $this->model_project_task_assignee->create(
                            $new_task_id,
                            $assignee
                        );

                        if(!$success)
                        {
                            $response['environment']    =   ENVIRONMENT;
                            $response['success']        =   false;
                            $response['message']        =   "Something went wrong. Please try again.";
                            $response['csrf_hash']      =   $this->security->get_csrf_hash();

                            echo json_encode($response);
                        }

                    }


                    $message = "";

                    if($success)
                    {
                        $message = "Task added";

                        $this->model_project->calculate_progress($project_id);
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
                else
                {

                    $response['environment']    =   ENVIRONMENT;
                    $response['success']        =   "Task added.";
                    $response['message']        =   $message;
                    $response['csrf_hash']      =   $this->security->get_csrf_hash();

                    echo json_encode($response);
                }
                
                
            }
            else
            {
                $response['environment']    =   ENVIRONMENT;
                $response['success']        =   false;
                $response['message']        =   "Something went wrong. Please try again.";
                $response['csrf_hash']      =   $this->security->get_csrf_hash();

                echo json_encode($response);
            }
    	}
	}

	public function list($project_id)
	{
        $project_id = en_dec('dec',$project_id);

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
        	$nestedData[] = $this->project_status_partial_view($row['project_status']);

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
			echo json_encode($this->model_project_task->read($id));
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


    private function project_status_partial_view($status)
    {
        $project_status = "";

        if($status=='1')
        {
            $project_status = "<label class='badge badge-info'>Ongoing</label>";
        }
        else if($status=='2')
        {
            $project_status = "<label class='badge badge-warning'>On-Hold</label>";
        }
        else if($status=='3')
        {
            $project_status = "<label class='badge badge-danger'>Cancelled</label>";
        }
        else if($status=='4')
        {
            $project_status = "<label class='badge badge-success'>Completed</label>";
        }

        return $project_status;
    }


    public function project_details_partial_view($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $project = $this->model_project->read($id);

            $data = array(
                'status_partial_view' => $this->project_status_partial_view($project['project_status']),
                'project' => $project
            );

            $this->load->view('app/project/partial/project_details_partial_view',$data);
        }
    }


    public function get_assignees($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $ids = array();

            $result = $this->model_project_task->get_assignees($id);
            foreach ($result as $value) {
                array_push($ids, $value['project_contributor']);
            }

            echo json_encode($ids);
        }
    }

}