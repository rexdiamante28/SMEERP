<?php

    class Users extends CI_Controller {

       public function __construct() {
           parent::__construct();
           $this->load->model('sys/model_users');
           $this->load->model('sys/model_access_control');
       }

       public function list_users()
       {
           $this->loginstate->login_state_check();

           if($this->loginstate->get_access()['overall_access']==1)
           {
               $sub_data['breadcrumb'] = array(
                   array('',base_url('sys/settings/'),'Settings'),
                   array('active','','Users List'),
               );

               $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

               $data = array(
                   'view' => $this->load->view("sys/users/users_list_table",$sub_data,true),
                   'title' => 'Users List',
                   'add_css' => array(),
                   'add_js' => array('assets/sys/users.js'),
                   'breadcrumb' => $this->load->view("common/breadcrumb",'',true)
               );
                
               $this->load->view('templates/template_admin',$data);
           }
           else
           {
               deny_access();
           }
           
       }


       public function users_list_table()
       {
          $this->loginstate->login_state_check();

          if($this->loginstate->get_access()['overall_access']==1)
          {
              $searchstring = $this->input->post('searchstring');
              $result = $this->model_users->users_list_table($searchstring);
              echo json_encode($result);
          }
          else
          {
            deny_access();
          }
          
       }


       public function create_user()
        {

            $this->loginstate->login_state_check();

            if($this->loginstate->get_access()['overall_access']==1)
            {
                $file_name = "";

                //if there is a file, upload it first and take note of the file name

                if(count($_FILES)>1)
                {
                       $this->load->library('upload');

                       $_FILES['userfile']['name']     = $_FILES['avatar_image']['name'];
                       $_FILES['userfile']['type']     = $_FILES['avatar_image']['type'];
                       $_FILES['userfile']['tmp_name'] = $_FILES['avatar_image']['tmp_name'];
                       $_FILES['userfile']['error']    = $_FILES['avatar_image']['error'];
                       $_FILES['userfile']['size']     = $_FILES['avatar_image']['size'];

                       $mct =  microtime('get_as_float');
                       $mct = str_replace('.', '', $mct);

                      $config = array(
                        'file_name'     => $mct.$_FILES['userfile']['name'],
                        'allowed_types' => 'jpg|jpeg|png|pdf',
                        'max_size'      => 3000,
                        'overwrite'     => FALSE,
                        'upload_path'
                          =>  './assets/uploads/avatars'
                      );
                      $this->upload->initialize($config);
                      if ( ! $this->upload->do_upload()) 
                      {
                           $error = array('error' => $this->upload->display_errors());
                           $response = array(
                             'status'      => false,
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


                $mode = "insert";

                if($this->input->post('f_id') == '') // create
                {
                    if($file_name == "") // merchant logo is required upon merchant creation
                    {
                        $response = array(
                          'success'      => false,
                          'environment' => ENVIRONMENT,
                          'message'     => 'No merhcant logo specified',
                          'csrf_name'   => $this->security->get_csrf_token_name(),
                          'csrf_hash'   => $this->security->get_csrf_hash()
                        );
                        echo json_encode($response);
                        die();
                    }
                }
                else  // update
                {
                    $mode = "update";
                }
                

                //validate fields
                if($mode == "insert")
                {
                    $validation = array(
                       array('f_user_status','User Status','required|numeric'),
                       array('f_password','Password','required'),
                       array('f_email','Username','required|max_length[100]|min_length[5]|valid_email|is_unique[sys_users.username]'),
                    );
                }
                else
                {
                    $validation = array(
                       array('f_user_status','User Status','required|numeric'),
                       array('f_password','Password','required'),
                       array('f_email','Username','required|max_length[100]|min_length[5]|valid_email|is_unique[sys_users.username]'),
                    );
                }

                $this->form_validation->set_message('is_unique', 'The %s is already taken');

                foreach ($validation as $value) {
                    $this->form_validation->set_rules($value[0],$value[1],$value[2]);
                }

                if ($this->form_validation->run() == FALSE)
                {
                    $response = array(
                      'success'      => false,
                      'environment' => ENVIRONMENT,
                      'message'     => validation_errors(),
                      'csrf_name'   => $this->security->get_csrf_token_name(),
                      'csrf_hash'   => $this->security->get_csrf_hash()
                    );

                    //remove uploaded image
                    if($file_name!="")
                    {
                        unlink('./assets/uploads/avatars/'.$file_name);
                    }

                    echo json_encode($response);
                }
                else
                {
                    //generate functions json
                    $functions = $this->model_access_control->generate_functions($this->input->post());

                    if($mode == "insert")
                    {
                        $this->model_users->create_user(
                            $this->input->post('f_user_status'),
                            $this->input->post('f_password'),
                            $this->input->post('f_email'),
                            $file_name,
                            $functions
                        );


                        $response = array(
                          'success'      => true,
                          'environment' => ENVIRONMENT,
                          'message'     => 'user added',
                          'csrf_name'   => $this->security->get_csrf_token_name(),
                          'csrf_hash'   => $this->security->get_csrf_hash()
                        );

                        echo json_encode($response);
                        die();
                    }
                    else if($mode == "update")
                    {
                        $this->model_users->update_user(
                            $this->input->post('f_user_status'),
                            $this->input->post('f_password'),
                            $this->input->post('f_email'),
                            $file_name,
                            $functions
                        );


                        $response = array(
                          'success'      => true,
                          'environment' => ENVIRONMENT,
                          'message'     => 'merchant updated',
                          'csrf_name'   => $this->security->get_csrf_token_name(),
                          'csrf_hash'   => $this->security->get_csrf_hash()
                        );

                        echo json_encode($response);
                        die();
                    }
                }
            }
            else
            {
              deny_access();
            }
            

        }


       public function change_password()
       {
           $this->loginstate->login_state_check();

           if($this->loginstate->get_access()['overall_access']==1)
           {
               $sub_data['breadcrumb'] = array(
                   array('',base_url('sys/settings/'),'Settings'),
                   array('active','','Change Password'),
               );

               $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

               $data = array(
                   'view' => $this->load->view("sys/users/change_password",$sub_data,true),
                   'title' => 'Change Password',
                   'add_css' => array(),
                   'add_js' => array('assets/sys/change_password.js'),
                   'breadcrumb' => $this->load->view("common/breadcrumb",'',true)
               );
                
               $this->load->view('templates/template_admin',$data);
           }
           else
           {
               deny_access();
           }
           
       }



       public function change_password_save()
       {

            $this->loginstate->login_state_check();

           if($this->loginstate->get_access()['overall_access']==1)
           {
              
                $validation = array(
                   array('old_password','Old Password','required|max_length[45]'),
                   array('new_password','New Password','required|max_length[45]'),
                   array('confirm_password','Password Confirmation','required|max_length[45]|matches[new_password]'),
                );

                $this->form_validation->set_message('is_unique', 'The %s is already taken');

                foreach ($validation as $value) {
                    $this->form_validation->set_rules($value[0],$value[1],$value[2]);
                }

                if ($this->form_validation->run() == FALSE)
                {
                    $response = array(
                      'success'      => false,
                      'environment' => ENVIRONMENT,
                      'message'     => validation_errors(),
                      'csrf_name'   => $this->security->get_csrf_token_name(),
                      'csrf_hash'   => $this->security->get_csrf_hash()
                    );

                    echo json_encode($response);
                }
                else
                {
                    try {

                        //sanitize user input
                        $username = $this->session->username;
                        $password = $this->input->post('old_password');

                        $query = "SELECT * FROM sys_users WHERE username = '$username' and active = 1";

                        $result = $this->db->query($query);

                        //assume successful authentication
                        $response = array(
                                'success'       =>  true,
                                'message'       =>  'Password Updated',
                                'environment'   =>  ENVIRONMENT,
                                'csrf_name'     =>  '',
                                'csrf_hash'     =>  ''
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
                                       $this->model_users->update_password($this->session->user_id,$this->input->post('new_password'));
                                    }

                                    
                                }

                            }
                            else{
                                $response['success']    =   false;
                                $response['message']    =   'Invalid password. Please try again.';
                                $response['csrf_hash']  =   $this->security->get_csrf_hash();
                            }
                        }

                        session_write_close();

                        
                        $response['csrf_name'] = $this->security->get_csrf_token_name();
                        $response['csrf_hash'] = $this->security->get_csrf_hash();
                        

                        echo json_encode($response);

                    } catch (Exception $e) {

                        $response = array(
                                'success'       =>  "error",
                                'message'       =>  $e->message(),
                                'environment'   =>  ENVIRONMENT
                        );

                        echo $response;
                    }
                }
           }
           else
           {
               deny_access();
           }

       }

}