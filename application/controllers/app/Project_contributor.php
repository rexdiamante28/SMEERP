<?php
class Project_contributor extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('app/model_project_contributor');
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

        $validation = array(
            array('project_id','Project ID','required|max_length[100]|min_length[2]'),
            array('project_contributor_member','Member','required|max_length[11]|min_length[1]|numeric'),
            array('project_contributor_role','Role','required|max_length[11]|min_length[1]|numeric')
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
    		$result = $this->model_project_contributor->create(
                en_dec('dec',$this->input->post('project_id')),
    			$this->input->post('project_contributor_member'),
    			$this->input->post('project_contributor_role')
    		);

    		$response['environment']    =   ENVIRONMENT;
    	   	$response['success']        =   $result['status'];
    	   	$response['message']        =   $result['message'];
    	   	$response['csrf_hash']      =   $this->security->get_csrf_hash();

    	   	echo json_encode($response);
    	}
	}

	public function update()
	{
		$validation = array(
            array('project_contributor_id','Contributor ID','required|max_length[11]|min_length[1]|numeric'),
            array('project_contributor_member','Member','required|max_length[11]|min_length[1]|numeric'),
            array('project_contributor_role','Role','required|max_length[11]|min_length[1]|numeric')
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
    		$result = $this->model_project_contributor->update(
                $this->input->post('project_contributor_member'),
                $this->input->post('project_contributor_role'),
                $this->input->post('project_contributor_id')
    		);

    		$response['environment']    =   ENVIRONMENT;
            $response['success']        =   $result['status'];
            $response['message']        =   $result['message'];
            $response['csrf_hash']      =   $this->security->get_csrf_hash();

            echo json_encode($response);
    	}
	}

	public function list()
	{

        $project_id = en_dec('dec',$this->input->get('project_id'));

		if($this->loginstate->get_access()['overall_access'] == 1)
		{
		    $get_data = $this->input->get();

        	$read_args = array(
        	   'start' => $get_data['start'],
        	   'end' => $get_data['length'],
        	   'order_column' => $get_data['order'][0]['column'],
        	   'order_direction' => $get_data['order'][0]['dir'],
        	   'search_string' => $get_data['search']['value'],
               'project_id' => $project_id
        	);

        	$result = $this->model_project_contributor->list($read_args);

        	$data = [];

        	foreach($result['result'] as $row) {

            	$nestedData = array();
            	$nestedData[] = $row["role"];
                $nestedData[] = $row["name"];

                $progress = $this->model_project_contributor->get_progress($project_id,$row['id']);

                $progress = round($progress);

                $nestedData[] = '
                    <div class="progress">
                      <div class="progress-bar bg-info" role="progressbar" style="width: '.$progress.'%;" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100">'.$progress.'%</div>
                    </div>
                ';

                $nestedData[] = $row["email"];
                $nestedData[] = $row["mobile_number"];

            	$nestedData[] = '
                    <button class="btn btn-primary project_contributor_edit_btn" id="'.en_dec('en',$row['id']).'">Edit</button>
            		<button class="btn btn-danger project_coontributor_delete_btn" id="'.en_dec('en',$row['id']).'">Delete</button>
            	';

            	  $data[] = $nestedData;
            	}

            	$json_data = array(
            	 "draw"            => intval($get_data['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
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
			echo json_encode($this->model_project_contributor->read($id));
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


    public function get_category_options()
    {
        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            echo json_encode($this->model_project_category->get_categoories());
        }
    }

}