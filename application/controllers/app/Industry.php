<?php
class Industry extends CI_Controller {


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function __construct() {
        parent::__construct();
        $this->load->model('app/model_company');
        $this->load->model('app/model_industry');
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
            $page_title = "Industries";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/general/'),'General'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            $forms = array(
                $this->load->view('app/industry/form_view','',true)
            );

            $data = array(
                'view' => $this->load->view("app/industry/table_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/industry/main.js','assets/js/app/industry/create.js'),
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
            array('industry_name','Industry Name','required|max_length[100]|min_length[1]|is_unique[erp_companies.name]'),
            array('industry_description','Industry Description','max_length[5000]|min_length[1]')
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
            $result = $this->model_industry ->create(
                $this->input->post('industry_name'),
                $this->input->post('industry_description'),
                en_dec('dec',$this->input->post('company_industry'))
            );

            $response['environment']    =   ENVIRONMENT;
            $response['success']        =   $result['success'];
            $response['message']        =   $result['message'];
            $response['id']             =   $result['id'];
            $response['csrf_hash']      =   $this->security->get_csrf_hash();

            echo json_encode($response);
        }
    }

    public function update()
    {

        $validation = array(
            array('industry_primary','ID','required|max_length[100]|min_length[1]'),
            array('industry_description','Industry Description','max_length[5000]|min_length[1]'),
        );

        $id = en_dec('dec',$this->input->post('industry_primary'));

        $industry = $this->model_industry->read($id);    

        if($industry['name']==$this->input->post('industry_name'))
        {
            array_push($validation,array('industry_name','Industry Name','required|max_length[100]|min_length[1]'));
        }
        else
        {
            array_push($validation,array('industry_name','Industry Name','required|max_length[100]|min_length[1]|is_unique[erp_industries.name]'));
        }

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
            $result = $this->model_industry->update(
                $this->input->post('industry_name'),
                $this->input->post('industry_description'),
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

            $result = $this->model_industry->table_data($read_args);

            $data = [];

            foreach($result['result'] as $row) {

                $nestedData = array();
                $nestedData[] = $row["name"];
                $nestedData[] = $row["description"];
                $nestedData[] = '
                    <button class="btn btn-primary industry_btn_view" id="'.en_dec('en',$row['id']).'"> view</button>
                    <button class="btn btn-danger industry_btn_delete" id="'.en_dec('en',$row['id']).'"> remove</button>
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
            $industry = $this->model_industry->read($id);
            $industry['id'] = en_dec('en',$industry['id']);
            echo json_encode($industry);
        }
    }   

    public function delete($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $result = $this->model_industry->delete($id);

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



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////Additional functions end////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}