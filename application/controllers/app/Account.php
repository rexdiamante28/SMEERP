<?php
class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('app/model_account');
    }

    public function index()
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $page_title = "Account";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/account'),$page_title),
            );
            $sub_data['id'] = en_dec('en', $this->session->user_id);
            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            $data = array(
                'view' => $this->load->view("app/account/index",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array(),
            );
             
            $this->load->view('templates/template_admin',$data);
        }
        else
        {
            deny_access();
        }
    }

    // public function index()
    // {
    //     $this->list();
    // }

    public function view($id)
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $profile = $this->model_account->read($this->session->user_id);

            $page_title = $profile['first_name']." ".$profile['middle_name']." ".$profile['last_name'];

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/account/'),'Account'),
                array('',base_url('app/account/view/'),'Profile'),
                // array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);
            $sub_data['form_action'] = base_url('app/account/update_save');
            // $sub_data['industries'] = $this->model_industry->get_active();
            $sub_data['form_empty'] = false;
            $sub_data['form_data'] = $profile;

            $data = array(
                'view' => $this->load->view("app/account/form_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/account/create.js')
            );
             
            $this->load->view('templates/template_admin',$data);
        }
        else
        {
            deny_access();
        }
    }

    public function update_save()
    {

        $validation = array(
            array('primary','ID','required|max_length[100]|min_length[1]'),
            array('first_name','First Name','required|max_length[100]|min_length[2]'),
            array('last_name','Last Name','required|max_length[100]|min_length[2]'),
            array('mobile_number','Company Industry','required|max_length[11]|min_length[11]'),
            array('email','Email','requiredrequired|valid_email'),
        );

        $id = en_dec('dec',$this->input->post('primary'));

        $profile = $this->model_account->read($id);    

        if($profile['email']== $this->input->post('email'))
        {
            array_push($validation,array('email','Email','required|valid_email'));
        }
        else
        {
            array_push($validation,array('email','Email','required|valid_email|is_unique[sys_users.email]'));
        }

        foreach ($validation as $value) {
            $this->form_validation->set_rules($value[0],$value[1],$value[2]);
        }

        if ($this->form_validation->run() == FALSE){
                $response['environment']    =   ENVIRONMENT;
                $response['success']        =   false;
                $response['message']        =   validation_errors();
                $response['csrf_name']      =   $this->security->get_csrf_token_name();
                $response['csrf_hash']      =   $this->security->get_csrf_hash();

                echo json_encode($response);
        }else{
            try {

                $first_name     = sanitize($this->input->post('first_name'));
                $middle_name    = sanitize($this->input->post('middle_name'));
                $last_name      = sanitize($this->input->post('last_name'));
                $phone_number   = sanitize($this->input->post('phone_number'));
                $mobile_number  = sanitize($this->input->post('mobile_number'));
                $email          = sanitize($this->input->post('email'));

                $result = $this->model_account->update_save($first_name,$middle_name,$last_name,$phone_number,$mobile_number,$email,$id);

                $response['environment']    =   ENVIRONMENT;
                $response['success']        =   $result['success'];
                $response['message']        =   $result['message'];
                $response['id']             =   $result['id'];
                $response['csrf_hash']      =   $this->security->get_csrf_hash();

                echo json_encode($response);

            } catch (Exception $e) {

                $response = array(
                        'success'       =>  "error",
                        'message'       =>  $e->message(),
                        'environment'   =>  ENVIRONMENT
                );

                echo json_encode($response);
            }
        }
    }

    public function change_password(){

        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $profile = $this->model_account->read($this->session->user_id);

            $page_title = $profile['first_name']." ".$profile['middle_name']." ".$profile['last_name'];

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/account/'),'Account'),
                array('',base_url('app/account/change_password/'),'Change Password'),
                // array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);
            $sub_data['form_action'] = base_url('app/account/update_password');
            $sub_data['form_empty'] = false;
            $sub_data['form_data'] = $profile;

            $data = array(
                'view' => $this->load->view("app/account/form_changepassword",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/account/create.js')
            );
             
            $this->load->view('templates/template_admin',$data);
        }
        else
        {
            deny_access();
        }

    }

    public function update_password(){

        $validation = array(
            array('primary','ID','required|max_length[100]|min_length[1]'),
            array('current_password','Password','required'),
            array('new_password','New Password','required|min_length[8]'),
            array('confirm_password','Confirm Password','required|matches[new_password]'),
        );

        $id = en_dec('dec',$this->input->post('primary'));

        $profile = $this->model_account->read($id);    

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
            try{

                $current_password    = sanitize($this->input->post('current_password'));

                if(password_verify($current_password,$profile['password'])){
                    
                    $new_password        = sanitize($this->input->post('new_password'));
                    $confirm_password    = sanitize($this->input->post('confirm_password'));
                    $hash_password       = password_hash($new_password,1,array('option'=>12));

                    $result = $this->model_account->update_password($hash_password,$id);

                    $response['environment']    =   ENVIRONMENT;
                    $response['success']        =   $result['success'];
                    $response['message']        =   $result['message'];
                    $response['id']             =   $result['id'];
                    $response['csrf_hash']      =   $this->security->get_csrf_hash();


                }else{

                    $response['success']    =   false;
                    $response['message']    =   'Current password is incorrect.';
                    $response['csrf_name']  =   $this->security->get_csrf_token_name();
                    $response['csrf_hash']  =   $this->security->get_csrf_hash();
                }
                
                echo json_encode($response);

            }catch(Exception $e){

                 $response = array(
                        'success'       =>  "error",
                        'message'       =>  $e->message(),
                        'environment'   =>  ENVIRONMENT
                );

                echo json_encode($response);
            }
        }
    }

    public function list()
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $page_title = "Users";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/general/'),'Account'),
                array('active','', $page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            //get all active industries

            $form_data['users']  = $this->model_account->get_active();

            $forms = array(
                $this->load->view('app/account/form_view',$form_data,true)
            );

            $data = array(
                'view' => $this->load->view("app/account/table_view",$sub_data,true),
                'title' => $page_title,
                'add_css' => array(),
                'add_js' =>  array('assets/js/app/account/main.js','assets/js/app/company/create.js'),
                'forms' => $forms
            );
             
            $this->load->view('templates/template_admin',$data);
        }
        else
        {
            deny_access();
        }
    }

}