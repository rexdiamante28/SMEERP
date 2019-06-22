<?php
class People extends CI_Controller {


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function __construct(){
        parent::__construct();
        $this->load->model('app/model_people');
        $this->load->model('app/model_industry');
    }

    public function index(){
        $this->list();
    }

    public function list()
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $page_title = "People";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/general/'),'General'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            //get all active industries

            $form_data['user']  = $this->model_people->user();

            $forms = array(
                $this->load->view('app/people/form_view',$form_data,true)
            );

            $data = array(
                'view' => $this->load->view("app/people/table_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/people/main.js', 'assets/js/app/people/create.js'),
                'forms' => $forms
            );
             
            $this->load->view('templates/template_admin',$data);
        }
        else
        {
            deny_access();
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

            $result = $this->model_people->table_data($read_args);

            $data = [];

            foreach($result['result'] as $row) {

                $nestedData = array();
                $nestedData[] = $row["fname"];
                $nestedData[] = $row["mname"];
                $nestedData[] = $row["lname"];
                $nestedData[] = $row["contact_number"];
                $nestedData[] = $row["email"];
                $nestedData[] = $row["address"];
                $nestedData[] = '
                    <button class="btn btn-primary people_btn_view" id="'.en_dec('en',$row['pid']).'"> view</button>
                    <button class="btn btn-danger people_btn_delete" id="'.en_dec('en',$row['pid']).'"> remove</button>
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
            $people = $this->model_people->read($id);
            $people['id'] = en_dec('en',$people['id']);
            echo json_encode($people);
        }
    }

    public function update()
    {

        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {

            $validation = array(
                array('people_primary','ID','required|max_length[100]|min_length[1]'),
                array('people_fname','First Name','max_length[64]|min_length[2]'),
                array('people_mname','Middle Name','max_length[64]|min_length[2]'),
                array('people_lname','Last Name','max_length[64]|min_length[2]'),
                array('people_address','Address','max_length[300]|min_length[2]'),
                array('people_contact','Contact Number','max_length[16]|min_length[11]'),
            );

            $id = en_dec('dec',$this->input->post('people_primary'));

            $people = $this->model_people->read($id);    

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
                $result = $this->model_people->update(
                    $this->input->post(),
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


    public function create()
    {

        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $validation = array(
                array('people_primary','ID','required|max_length[100]|min_length[1]'),
                array('people_fname','First Name','max_length[64]|min_length[2]'),
                array('people_mname','Middle Name','max_length[64]|min_length[2]'),
                array('people_lname','Last Name','max_length[64]|min_length[2]'),
                array('people_address','Address','max_length[300]|min_length[2]'),
                array('people_contact','Contact Number','max_length[16]|min_length[11]'),
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
                $result = $this->model_people->create(
                    $this->input->post()
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
   

}