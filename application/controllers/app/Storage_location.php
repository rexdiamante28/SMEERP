<?php
class Storage_location extends CI_Controller {


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function __construct() {
        parent::__construct();
        $this->load->model('app/model_storage_location');
        $this->load->model('app/model_company');
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
            $page_title = "Storage Locations";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/inventory/'),'Inventory'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            //get all active industries

            $form_data['companies']  = $this->model_company->get_active();

            $forms = array(
                $this->load->view('app/storage_location/form_view',$form_data,true)
            );

            $data = array(
                'view' => $this->load->view("app/storage_location/table_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/storage_location/main.js','assets/js/app/storage_location/create.js'),
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
                array('storage_location_company','Company','required|max_length[100]|min_length[1]'),
                array('storage_location_branch','Branch','required|max_length[100]|min_length[1]'),
                array('storage_location_parent_location','Parent Location','max_length[100]|min_length[1]'),
                array('storage_location_name','Storage Location Name','required|max_length[45]|min_length[1]|is_unique[erp_item_categories.name]')
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
                $result = $this->model_storage_location->create(
                    en_dec('dec',$this->input->post('storage_location_company')),
                    en_dec('dec',$this->input->post('storage_location_branch')),
                    $this->input->post('storage_location_parent_location')=="0" ? 0 : en_dec('dec',$this->input->post('storage_location_parent_location')) ,
                    $this->input->post('storage_location_name')
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
                array('storage_location_primary','ID','required|max_length[100]|min_length[1]'),
                array('storage_location_company','Company','required|max_length[100]|min_length[1]'),
                array('storage_location_branch','Branch','required|max_length[100]|min_length[1]'),
                array('storage_location_parent_location','Parent Location','max_length[100]|min_length[1]'),
                array('storage_location_name','Storage Location Name','required|max_length[45]|min_length[1]|is_unique[erp_item_categories.name]')
            );

            $id = en_dec('dec',$this->input->post('storage_location_primary'));

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
                $result = $this->model_storage_location->update(
                    en_dec('dec',$this->input->post('storage_location_company')),
                    en_dec('dec',$this->input->post('storage_location_branch')),
                    $this->input->post('storage_location_parent_location')=="0" ? 0 : en_dec('dec',$this->input->post('storage_location_parent_location')) ,
                    $this->input->post('storage_location_name'),
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

            $result = $this->model_storage_location->table_data($read_args);

            $data = [];

            foreach($result['result'] as $row) {

                $nestedData = array();
                $nestedData[] = $row["company_name"];
                $nestedData[] = $row["branch_name"];
                $nestedData[] = $row["location_string"];
                $nestedData[] = '
                    <button class="btn btn-primary storage_location_btn_view" id="'.en_dec('en',$row['id']).'"> view</button>
                    <button class="btn btn-danger storage_location_btn_delete" id="'.en_dec('en',$row['id']).'"> remove</button>
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
            $storage_location = $this->model_storage_location->read($id);
            $storage_location['id'] = en_dec('en',$storage_location['id']);
            $storage_location['company'] = en_dec('en',$storage_location['company']);
            $storage_location['branch'] = en_dec('en',$storage_location['branch']);
            $storage_location['parent_location'] = $storage_location['parent_location']=="0" ? "0" : en_dec('en',$storage_location['parent_location']);
            echo json_encode($storage_location);
        }
    }   

    public function delete($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $result = $this->model_storage_location->delete($id);

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

    public function get_company_categories($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $item_categories = $this->model_storage_location->get_company_categories($id);

            if($item_categories->num_rows()>0)
            {
                $item_categories = $item_categories->result_array();

                for($a = 0; $a < count($item_categories); $a++)
                {
                    $item_categories[$a]['id'] = en_dec('en',$item_categories[$a]['id']);
                }
            }
            else
            {
                $item_categories = $item_categories->result_array();
            }

            echo json_encode($item_categories);
        }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////Additional functions end////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}