<?php
class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $page_title = "General";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/general'),$page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            $data = array(
                'view' => $this->load->view("app/home/index",$sub_data,true),
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