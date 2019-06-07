<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function index()
	{
		$this->home();
	}

	public function home()
	{	
		$data['title'] = "Home Page";
		$data['view_data'] = $this->load->view('web/homepage','',TRUE);
		$this->load->view('templates/web_template',$data);
	}

	public function about_us()
	{
		$data['title'] = "About Us";
		$data['view_data'] = $this->load->view('web/about_us','',TRUE);
		$this->load->view('templates/web_template',$data);
	}

	public function developers()
	{
		$data['title'] = "Developers";
		$data['view_data'] = $this->load->view('web/developers','',TRUE);
		$this->load->view('templates/web_template',$data);
	}

	public function login()
	{
		$data['add_js'] = array('assets/scripts/web/login.js');
		$data['title'] = "Log in";
		$data['view_data'] = $this->load->view('web/login','',TRUE);
		
		$this->load->view('templates/web_template',$data);
	}



}
