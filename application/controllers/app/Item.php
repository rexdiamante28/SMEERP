<?php
class Item extends CI_Controller {


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function __construct() {
        parent::__construct();
        $this->load->model('app/model_item');
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
            $page_title = "Items";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/inventory/'),'Inventory'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            //get all active industries

            $form_data['companies']  = $this->model_company->get_active();

            $forms = array(
                $this->load->view('app/item/form_view',$form_data,true)
            );

            $data = array(
                'view' => $this->load->view("app/item/table_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/item/main.js','assets/js/app/item/create.js'),
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
                array('item_company','Company','required|max_length[100]|min_length[1]'),
                array('item_category','Item Category','required|max_length[100]|min_length[1]'),
                array('item_unit','Item Unit','max_length[100]|min_length[1]'),
                array('item_code','Item Code','required|max_length[100]|min_length[1]'),
                array('item_name','Item Name','required|max_length[100]|min_length[1]')
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

                //try to upload files. If successful, save the updated remittance record

                $file_name = "";

                if(count($_FILES)>0)
                {
                    $this->load->library('upload');

                    if($_FILES['item_image']['name']!="")
                    {
                        $_FILES['userfile']['name']     = $_FILES['item_image']['name'];
                        $_FILES['userfile']['type']     = $_FILES['item_image']['type'];
                        $_FILES['userfile']['tmp_name'] = $_FILES['item_image']['tmp_name'];
                        $_FILES['userfile']['error']    = $_FILES['item_image']['error'];
                        $_FILES['userfile']['size']     = $_FILES['item_image']['size'];

                        $mct =  microtime('get_as_float');
                        $mct = str_replace('.', '', $mct);

                        $config = array(
                          'file_name'     => $mct.$_FILES['userfile']['name'],
                          'allowed_types' => 'jpg|jpeg|png|pdf',
                          'max_size'      => 3000,
                          'overwrite'     => FALSE,
                          'upload_path'   =>  './assets/uploads/items'
                        );

                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload()) 
                        {
                             $error = $this->upload->display_errors();

                             $response = array(
                               'success'      => false,
                               'environment' => ENVIRONMENT,
                               'message'     => $error,
                               'csrf_name'   => $this->security->get_csrf_token_name(),
                               'csrf_hash'   => $this->security->get_csrf_hash()
                             );
                             echo json_encode($response);
                             die();
                        }
                        else 
                        {
                             $file_name = $this->upload->data()['file_name'];
                        }
                    }

                }


                $result = $this->model_item->create(
                    en_dec('dec',$this->input->post('item_company')),
                    en_dec('dec',$this->input->post('item_category')),
                    en_dec('dec',$this->input->post('item_unit')),
                    $this->input->post('item_code'),
                    $this->input->post('item_name'),
                    $file_name,
                    $this->input->post('item_unique_identifier') !== null ? 1 : 0,
                    $this->input->post('item_generic_name'),
                    $this->input->post('item_description')
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
                array('item_primary','ID','required|max_length[100]|min_length[1]'),
                array('item_company','Company','required|max_length[100]|min_length[1]'),
                array('item_branch','Branch','required|max_length[100]|min_length[1]'),
                array('item_parent_location','Parent Location','max_length[100]|min_length[1]'),
                array('item_name','Storage Location Name','required|max_length[45]|min_length[1]|is_unique[erp_item_categories.name]')
            );

            $id = en_dec('dec',$this->input->post('item_primary'));

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
                $result = $this->model_item->update(
                    en_dec('dec',$this->input->post('item_company')),
                    en_dec('dec',$this->input->post('item_branch')),
                    $this->input->post('item_parent_location')=="0" ? 0 : en_dec('dec',$this->input->post('item_parent_location')) ,
                    $this->input->post('item_name'),
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

            $result = $this->model_item->table_data($read_args);

            $data = [];

            foreach($result['result'] as $row) {

                $nestedData = array();
                $nestedData[] = $row["company_name"];
                $nestedData[] = $row["category_name"];
                $nestedData[] = $row["item_unit_name"];
                $nestedData[] = $row["item_code"];
                $nestedData[] = $row["item_name"];
                $nestedData[] = '
                    <button class="btn btn-primary item_btn_view" id="'.en_dec('en',$row['id']).'"> view</button>
                    <button class="btn btn-danger item_btn_delete" id="'.en_dec('en',$row['id']).'"> remove</button>
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
            $item = $this->model_item->read($id);
            $item['id'] = en_dec('en',$item['id']);
            $item['company'] = en_dec('en',$item['company']);
            $item['item_category'] = en_dec('en',$item['item_category']);
            $item['item_unit'] = en_dec('en',$item['item_unit']);
            echo json_encode($item);
        }
    }   

    public function delete($id)
    {
        $id = en_dec('dec',$id);

        if($this->loginstate->get_access()['overall_access'] == 1)
        {
            $result = $this->model_item->delete($id);

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
            $item_categories = $this->model_item->get_company_categories($id);

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