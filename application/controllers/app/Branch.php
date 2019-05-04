<?php
class Branch extends CI_Controller {


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function __construct() {
        parent::__construct();
        $this->load->model('app/model_branch');
        $this->load->model('app/model_branch');
    }

    public function index()
    {
        $this->list();
    }

    public function list()
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $page_title = "Company Branches";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/general/'),'General'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            //get all active industries

            $form_data['companies']  = $this->model_branch->get_active();

            $forms = array(
                $this->load->view('app/branch/form_view',$form_data,true)
            );

            $data = array(
                'view' => $this->load->view("app/branch/table_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/branch/main.js','assets/js/app/branch/create.js'),
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

        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $validation = array(
                array('branch_company','Company','required|max_length[100]|min_length[1]'),
                array('branch_name','Branch Name','required|max_length[50]|min_length[1]'),
                array('branch_description','Company Description','max_length[5000]|min_length[5]'),
                array('branch_address','Address','max_length[2000]|min_length[5]')
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
                $result = $this->model_branch->create(
                    en_dec('dec',$this->input->post('branch_company')),
                    $this->input->post('branch_name'),
                    $this->input->post('branch_description'),
                    $this->input->post('branch_address')
                );

                $response['environment']    =   ENVIRONMENT;
                $response['success']        =   $result['success'];
                $response['message']        =   $result['message'];
                $response['id']             =   $result['id'];
                $response['csrf_hash']      =   $this->security->get_csrf_hash();

                echo json_encode($response);
            }

        }
    }

    public function update()
    {

        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {

            $validation = array(
                array('branch_primary','Branch','required|max_length[100]|min_length[1]'),
                array('branch_company','Company','required|max_length[100]|min_length[1]'),
                array('branch_name','Branch Name','required|max_length[50]|min_length[1]'),
                array('branch_description','Company Description','max_length[5000]|min_length[5]'),
                array('branch_address','Address','max_length[2000]|min_length[5]')
            );

            $id = en_dec('dec',$this->input->post('branch_primary'));

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
                $result = $this->model_branch->update(
                    en_dec('dec',$this->input->post('branch_company')),
                    $this->input->post('branch_name'),
                    $this->input->post('branch_description'),
                    $this->input->post('branch_address'),
                    $id
                );

                $response['environment']    =   ENVIRONMENT;
                $response['success']        =   $result['success'];
                $response['message']        =   $result['message'];
                $response['id']             =   $result['id'];
                $response['csrf_hash']      =   $this->security->get_csrf_hash();

                echo json_encode($response);
            }
        }
    }

    public function table_data()
    {
        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $get_data = $this->input->get();

            $read_args = array(
               'start' => $get_data['start'],
               'end' => $get_data['length'],
               'order_column' => $get_data['order'][0]['column'],
               'order_direction' => $get_data['order'][0]['dir'],
               'search_string' => $get_data['search_string']
            );

            $result = $this->model_branch->table_data($read_args);

            $data = [];

            foreach($result['result'] as $row) {

                $nestedData = array();
                $nestedData[] = $row["company_name"];
                $nestedData[] = $row["branch"];
                $nestedData[] = '
                    <button class="btn btn-primary branch_btn_view" id="'.en_dec('en',$row['id']).'"> view</button>
                    <button class="btn btn-danger branch_btn_delete" id="'.en_dec('en',$row['id']).'"> remove</button>
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
            $branch = $this->model_branch->read($id);
            $branch['id'] = en_dec('en',$branch['id']);
            $branch['company'] = en_dec('en',$branch['company']);
            echo json_encode($branch);
        }
    }   

    public function delete($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $result = $this->model_branch->delete($id);

            $response = array(
                'success' => $result['status'],
                'message' => $result['message']
            );

            echo json_encode($response);
        }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Default functions end//////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////Additional functions start//////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function get_active_locations($branch_id)
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {   
            $id = en_dec('dec',$branch_id);
            $result = $this->model_branch->get_active_locations($id);
            $count = $result->num_rows();
            $locations = $result->result_array();
            if($count>0)
            {
                for($a=0; $a<$count; $a++)
                {
                    $locations[$a]['id'] = en_dec('en',$locations[$a]['id']);
                    $locations[$a]['branch'] = en_dec('en',$locations[$a]['branch']);
                }
            }

            echo json_encode($locations);
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////Additional functions end////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}