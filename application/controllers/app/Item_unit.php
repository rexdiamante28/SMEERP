<?php
class Item_unit extends CI_Controller {


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function __construct() {
        parent::__construct();
        $this->load->model('app/model_company');
        $this->load->model('app/model_item_unit');
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
            $page_title = "Item units";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/inventory/'),'Inventory'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            //get all active industries

            $form_data['companies']  = $this->model_company->get_active();

            $forms = array(
                $this->load->view('app/item_unit/form_view',$form_data,true)
            );

            $data = array(
                'view' => $this->load->view("app/item_unit/table_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/item_unit/main.js','assets/js/app/item_unit/create.js'),
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
                array('item_unit_company','Company','required|max_length[100]|min_length[1]'),
                array('item_unit_description','Description','max_length[100]|min_length[1]'),
                array('item_unit_name','Unit Name','required|max_length[45]|min_length[1]')
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
                $result = $this->model_item_unit->create(
                    en_dec('dec',$this->input->post('item_unit_company')),
                    $this->input->post('item_unit_name'),
                    $this->input->post('item_unit_description')
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
                array('item_unit_primary','ID','required|max_length[100]|min_length[1]'),
                array('item_unit_company','Company','required|max_length[100]|min_length[1]'),
                array('item_unit_description','Description','max_length[100]|min_length[1]'),
                array('item_unit_name','Unit Name','required|max_length[45]|min_length[1]')
            );

            $id = en_dec('dec',$this->input->post('item_unit_primary'));

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
                $result = $this->model_item_unit->update(
                    en_dec('dec',$this->input->post('item_unit_company')),
                    $this->input->post('item_unit_name'),
                    $this->input->post('item_unit_description'),
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

            $result = $this->model_item_unit->table_data($read_args);

            $data = [];

            foreach($result['result'] as $row) {

                $nestedData = array();
                $nestedData[] = $row["company"];
                $nestedData[] = $row["name"];
                $nestedData[] = $row["description"];
                $nestedData[] = '
                    <button class="btn btn-primary item_unit_btn_view" id="'.en_dec('en',$row['id']).'"> view</button>
                    <button class="btn btn-danger item_unit_btn_delete" id="'.en_dec('en',$row['id']).'"> remove</button>
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
            $item_unit = $this->model_item_unit->read($id);
            $item_unit['id'] = en_dec('en',$item_unit['id']);
            $item_unit['company'] = en_dec('en',$item_unit['company']);
            echo json_encode($item_unit);
        }
    }   

    public function delete($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $result = $this->model_item_unit->delete($id);

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



    public function get_company_item_units($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $item_units = $this->model_item_unit->get_company_item_units($id);

            if($item_units->num_rows()>0)
            {
                $item_units = $item_units->result_array();

                for($a = 0; $a < count($item_units); $a++)
                {
                    $item_units[$a]['id'] = en_dec('en',$item_units[$a]['id']);
                }
            }
            else
            {
                $item_units = $item_units->result_array();
            }

            echo json_encode($item_units);
        }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////Additional functions end////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}