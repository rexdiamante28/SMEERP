<?php
class Company extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('app/model_company');
        $this->load->model('app/model_industry');
    }

    public function list()
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $page_title = "Company List";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/general/'),'General'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            $forms = array(
                //$this->load->view('app/project/form_view','',true)
            );

            $data = array(
                'view' => $this->load->view("app/company/table_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/company/main.js'),
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
            $page_title = "Create Company";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/general/'),'General'),
                array('',base_url('app/company/list'),'Company'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);
            $sub_data['form_action'] = base_url('app/company/create_save');
            $sub_data['industries'] = $this->model_industry->get_active();
            $sub_data['form_empty'] = true;
            $dub_data['form_data'] = "";

            $data = array(
                'view' => $this->load->view("app/company/form_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/company/create.js')
            );
             
            $this->load->view('templates/template_admin',$data);
        }
        else
        {
            deny_access();
        }
    }


    public function view($id)
    {
        $id = en_dec('dec',$id);

        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $company = $this->model_company->read($id);

            $page_title = $company['name'];

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/general/'),'General'),
                array('',base_url('app/company/list'),'Company'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);
            $sub_data['form_action'] = base_url('app/company/update_save');
            $sub_data['industries'] = $this->model_industry->get_active();
            $sub_data['form_empty'] = false;
            $sub_data['form_data'] = $company;

            $data = array(
                'view' => $this->load->view("app/company/form_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/company/create.js')
            );
             
            $this->load->view('templates/template_admin',$data);
        }
        else
        {
            deny_access();
        }
    }




    public function create_save()
    {

        $validation = array(
            array('company_name','Company Name','required|max_length[100]|min_length[1]|is_unique[erp_companies.name]'),
            array('company_description','Company Description','max_length[5000]|min_length[1]'),
            array('company_industry','Company Industry','required|max_length[100]|min_length[1]')
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
            $result = $this->model_company->create_save(
                $this->input->post('company_name'),
                $this->input->post('company_description'),
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

    public function update_save()
    {

        $validation = array(
            array('primary','ID','required|max_length[100]|min_length[1]'),
            array('company_description','Company Description','max_length[5000]|min_length[1]'),
            array('company_industry','Company Industry','required|max_length[100]|min_length[1]')
        );

        $id = en_dec('dec',$this->input->post('primary'));

        $company = $this->model_company->read($id);    

        if($company['name']==$this->input->post('company_name'))
        {
            array_push($validation,array('company_name','Company Name','required|max_length[100]|min_length[1]'));
        }
        else
        {
            array_push($validation,array('company_name','Company Name','required|max_length[100]|min_length[1]|is_unique[erp_companies.name]'));
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
            $result = $this->model_company->update_save(
                $this->input->post('company_name'),
                $this->input->post('company_description'),
                en_dec('dec',$this->input->post('company_industry')),
                en_dec('dec',$this->input->post('primary'))
            );

            $response['environment']    =   ENVIRONMENT;
            $response['success']        =   $result['success'];
            $response['message']        =   $result['message'];
            $response['id']             =   $result['id'];
            $response['csrf_hash']      =   $this->security->get_csrf_hash();

            echo json_encode($response);
        }
    }

    public function table_view()
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

            $result = $this->model_company->table_view($read_args);

            $data = [];

            foreach($result['result'] as $row) {

                $nestedData = array();
                $nestedData[] = $row["name"];
                $nestedData[] = $row["description"];
                $nestedData[] = $row["industry_name"];
                $nestedData[] = '
                    <a href="'.base_url('app/company/view/').en_dec('en',$row['id']).'" class="btn btn-default company_edit_btn"><i class="fa fa-eye"></i></a>
                    <button class="btn btn-default project_role_delete_btn" id="'.en_dec('en',$row['id']).'"><i class="fa fa-remove"></i></button>
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
            $role = $this->model_project_role->read($id);
            $role['id_en'] = en_dec('en',$role['id']);
            echo json_encode($role);
        }
    }   

    public function delete($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $result = $this->model_project_role->delete($id);

            $response = array(
                'success' => $result['status'],
                'message' => $result['message']
            );

            echo json_encode($response);
        }
    }

}