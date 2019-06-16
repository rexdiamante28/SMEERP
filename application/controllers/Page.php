<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
		$this->list_notifications();
	}

	public function list_notifications()
	{
		if($this->loginstate->login_state_check())
		{	
			// additional scripts
			$data['add_js'] = array('assets/scripts/account/notifications.js');

			$data['title'] = "Users";

			$data['view_data'] = $this->load->view('common/loading','',TRUE);

			// pass to the template
			$this->load->view('templates/account_template',$data);
		}
	}

	public function reports()
	{
		if($this->loginstate->login_state_check())
		{	
			
			$this->load->model('account/branch_model');

			$data['add_js'] = array('assets/scripts/account/reports.js');

			$data['title'] = "Reports";

			$data['view_data'] = $this->load->view('account/pages/reporting_view','',TRUE);

			// pass to the template
			$this->load->view('templates/account_template',$data);
			
		}
	}

	public function hashPassword($passwrod)
	{
		echo (password_hash($passwrod,PASSWORD_BCRYPT,array(
			'cost' => 12
		)));
	}

	public function sample()
	{
		 $this->notification_model->notify("Hyundai eon sold at carmona branch for P 2,000,000.00 with or # 00000034","Notification Sales");
		

		//$string = "Manage Users,Manage Branches,Manage Locations,Manage Items,Manage Stocks,Sell items,View Reports";

		//if (strpos($string, 'Manage Branches') !== false) {
		//    echo 'true';
		//}
	}

	
}
