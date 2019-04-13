<?php

    class Settings extends CI_Controller {

        public function index(){

            $this->loginstate->login_state_check();

            if($this->loginstate->get_access()['overall_access']==1)
            {
                $sub_data['breadcrumb'] = array(
                    array('active','','Settings'),
                );

                $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

                $data = array(
                    'view' => $this->load->view("sys/settings/index",$sub_data,true),
                    'title' => 'Settings',
                    'add_css' => array(),
                    'add_js' => array(),
                    'breadcrumb' => $this->load->view("common/breadcrumb",'',true)
                );
                
                $this->load->view('templates/template_admin',$data);
            }
            else
            {
                deny_access();
            }
        }


        public function get_date()
        {
            echo date('m/d/Y');
        }


}