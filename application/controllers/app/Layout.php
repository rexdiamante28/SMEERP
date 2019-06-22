<?php 

class Layout extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('app/model_account');
    }

    public function index()
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $page_title = "Layouts";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/layout'),$page_title),
            );
            $sub_data['id'] = en_dec('en', $this->session->user_id);
            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            $data = array(
                'view' => $this->load->view("app/layout/index",$sub_data,true),
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

    public function stepwizard()
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $page_title = "Step Wizard";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/layout/'),"Layout"),
                array('',base_url('app/layout/stepwizard'), $page_title),
            );
            $sub_data['id'] = en_dec('en', $this->session->user_id);
            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            $data = array(
                'view' => $this->load->view("app/layout/stepwizard",$sub_data,true),
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

    public function form()
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $page_title = "Form";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/layout/'),"Layout"),
                array('',base_url('app/layout/form'), $page_title),
            );
            $sub_data['id'] = en_dec('en', $this->session->user_id);
            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            $data = array(
                'view' => $this->load->view("app/layout/form",$sub_data,true),
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
}

?>