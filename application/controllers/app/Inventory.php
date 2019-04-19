<?php
class Inventory extends CI_Controller {


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function __construct() {
		parent::__construct();
	}

	public function index()
    {
        $this->loginstate->login_state_check();

        if($this->loginstate->get_access()['overall_access']==1)
        {
            $page_title = "Inventory";

            $sub_data['breadcrumb'] = array(
                array('',base_url('app/inventory'),$page_title),
            );

            $sub_data['breadcrumb'] = $this->load->view("common/breadcrumb",$sub_data,true);

            $data = array(
                'view' => $this->load->view("app/inventory/index",$sub_data,true),
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



    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Default functions end//////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////Additional functions start//////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////Additional functions end////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}