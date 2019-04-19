<?php

    class Authentication extends CI_Controller {

        public function index() {

            $is_logged_in = $this->loginstate->login_state_check_without_redirect();

            if($is_logged_in===true)
            {
                $this->loginstate->find_first_module();
            }
            else
            {
                $data = array(
                    'view' => $this->load->view("auth/authentication/login",'',true),
                    'title' => 'Login Page',
                    'add_css' => array(),
                    'add_js' => array('assets/sys/auth/login.js')
                );
                
                $this->load->view('templates/template_web',$data);
        	}
        }


        public function aboutus() {

            $data = array(
                'view' => $this->load->view("app/aboutus",'',true),
                'title' => 'About us',
                'add_css' => array(),
                'add_js' => array('')
            );
            
            $this->load->view('templates/template_web',$data);
        }

        public function login()
        {
            $this->load->model('auth/model_authentication');

            $validation = array(
                array('username','User Name','required'),
                array('password','Password','required'),
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
                try {

                    //sanitize user input
                    $username = sanitize($this->input->post('username'));
                    $password =  sanitize($this->input->post('password'));

                    $result = $this->model_authentication->get_user($username);

                    //assume successful authentication
                    $response = array(
                            'success'       =>  true,
                            'message'       =>  'Authentication Successful',
                            'environment'   =>  ENVIRONMENT,
                            'csrf_name'     =>  '',
                            'csrf_hash'     =>  '',
                            'url'           =>  ''
                    );

                    if($result->num_rows()!==1)
                    {
                        $response['success'] = false;
                        $response['message'] = 'Oops! the username you entered is not enrolled in the system. If you
                        believe this is an error, please contact your administrator.';
                    }
                    else
                    {
                        $row = $result->row();

                        if(password_verify($password,$row->password)){

                            if($row->active==='0')
                            {
                                $response['success'] = false;
                                $response['message'] = 'Sorry, your account is currently disabled. Please contact your administrator.';
                            }
                            else
                            {
                                if(null !== ($this->input->post('app_key')))
                                {
                                    $app_data = $this->model_trusted_apps->authenticate_app($this->input->post('app_key'));
                                    if($app_data['value'])
                                    {
                                        //create session for the application
                                    }
                                    else
                                    {
                                        $response['success'] = false;
                                        $response['message'] = 'Access forbidden.';
                                    }
                                }
                                else
                                {
                                    $this->model_authentication->log_failed_login_attempts($row->id,0);

                                    $this->session->user_id             =       $row->id;
                                    $this->session->username            =       $row->username;
                                    $this->session->last_seen           =       $row->last_seen;
                                    $this->session->avatar              =       $row->avatar;
                                    $this->session->functions           =       $row->functions;

                                    $response['url'] =  base_url('auth/authentication/bring_to_landing'); 
                                }
                                
                            }

                        }
                        else{

                            if($row->failed_login_attempts > 4)
                            {
                                $response['success'] = false;
                                $response['message'] = 'Sorry, your account is currently disabled due to multiple login attempts. Please check your email on how to recover your account.';
                                $this->send_email_locked_account($row->id);
                            }else{

                                $this->model_authentication->log_failed_login_attempts($row->id,$row->failed_login_attempts+1);

                                $response['success']    =   false;
                                $response['message']    =   'Invalid password. Please try again.';
                                $response['csrf_hash']  =   $this->security->get_csrf_hash();
                            }
                        }
                    }

                    session_write_close();

                    if(!$response['success'])
                    {
                        $response['csrf_name'] = $this->security->get_csrf_token_name();
                        $response['csrf_hash'] = $this->security->get_csrf_hash();
                    }

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



        public function get_admin_components()
        {
            $this->loginstate->login_state_check(false,'','');

            if(null !== ($this->input->post('app_key')) && null !== ($this->input->post('session_id'))) // external application. Return data
            {

            }
            else // internal web application. return data containing views
            {  
                $navdata['user_data'] = $this->session->userdata();

                $data = array(
                    'nav'           =>  $this->load->view('auth/authentication/admin_nav',$navdata,true),
                    'environment'   =>  ENVIRONMENT
                );

                echo json_encode($data);
            }
        }

        public function get_token()
        {
            $response['csrf_name'] = $this->security->get_csrf_token_name();
            $response['csrf_hash'] = $this->security->get_csrf_hash();

            $data = array(
                'environment'   =>  ENVIRONMENT,
                'data'          => $response
            );

            echo json_encode($data);
        }


        public function generate_captcha()
        {
            $data = array(
                'environment'   =>  ENVIRONMENT,
                'data'          =>  $this->cp_captcha->generate_captcha(6,$this->input->ip_address())['image']
            );

            echo json_encode($data);
        }

        public function validate_captcha()
        {
            $this->form_validation->set_rules('captcha_text', 'Captcha Text', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                    $data = array(
                        'environment'   =>  ENVIRONMENT,
                        'data'          =>  validation_errors()
                    );

                    echo json_encode($data);
            }
            else
            {       
                    $this->load->library('cp_captcha');

                    $data = array(
                        'environment'   =>  ENVIRONMENT,
                        'data'          =>  $this->cp_captcha->validate_captcha($this->input->captcha_text,$this->input->ip_address())
                    );

                    echo json_encode($data);
            }
        }

        public function signout()
        {
            $this->session->sess_destroy();

            header("location: ".base_url('auth/authentication/'));
        }


        public function bring_to_landing()
        {   
            // Since this is the landing page upon successful login, execute a function where the system redirects the users to the first module
            // they have access. If no module found for the user, deny access.

            $this->loginstate->login_state_check();
            $this->loginstate->find_first_module();
        }

        public function reset_password(){

            $this->load->model('auth/model_authentication');

            $validation = array(
                array('user_email','Email','required|valid_email'),
            );

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
            }
            else
            {
                try {

                    //sanitize user input
                    $email = sanitize($this->input->post('user_email'));
                    $result = $this->model_authentication->get_user_thru_email($email);

                    //assume successful authentication
                    $response = array(
                            'success'       =>  true,
                            'message'       =>  'Authentication Successful',
                            'environment'   =>  ENVIRONMENT,
                            'csrf_name'     =>  '',
                            'csrf_hash'     =>  '',
                            'url'           =>  ''
                    );

                    if($result->num_rows()!==1){

                        $response['success'] = false;
                        $response['message'] = 'Oops! the email you entered is not enrolled in the system. If you
                        believe this is an error, please contact your administrator.';
                    }
                    else{
                        $row = $result->row();
                        if($row->active==='0'){
                            $response['success'] = false;
                            $response['message'] = 'Sorry, your account is currently disabled. Please contact your administrator.';
                        }else{
                            if(null !== ($this->input->post('app_key')))
                            {
                                $app_data = $this->model_trusted_apps->authenticate_app($this->input->post('app_key'));
                                if($app_data['value'])
                                {
                                    //create session for the application
                                }
                                else
                                {
                                    $response['success'] = false;
                                    $response['message'] = 'Access forbidden.';
                                }
                            }
                            else
                            {
                                $new_password = Generate_random_password();
                                $hash_password = password_hash($new_password,1,array('option'=>12));
                                $query = $this->model_authentication->reset_password($email, $hash_password);
                                $this->send_email_reset_password($email,$new_password);

                                $response['url'] =  base_url('auth/authentication/'); 
                                $response['message'] =  "Your temporary password has been sent to your email"; 
                                $response['csrf_name'] = $this->security->get_csrf_token_name();
                                $response['csrf_hash'] = $this->security->get_csrf_hash();
                            }
                        }
                    }

                    if(!$response['success']){

                        $response['csrf_name'] = $this->security->get_csrf_token_name();
                        $response['csrf_hash'] = $this->security->get_csrf_hash();
                    }

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

        public function send_email_reset_password($email, $password){

            $this->load->library('email');

            $subject = "New Password for ".$email;
            $message  = "Good day!\n\r";
            $message .= "Here is your temporary password: \n\r\n\r";
            $message .= "Temporary password: ".$password."\n\r\n\r";
            $message .= "Please change your password upon first login to your account for security purposes.\n\r\n\r";
            $message .= "Thank you!\n\r\n\r";
            $message .= "Rock and Roll!\n\r\n\r";
            $message .= "\r\n\r\n= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =\r\n\r\n";

            $result = $this->email
                ->from('edwndolor@gmail.com',"From: SME ERP")
                ->reply_to('')    // Optional, an account where a human being reads.
                ->to($email)
                ->subject($subject)
                ->message($message)
                ->send();
        }

}

