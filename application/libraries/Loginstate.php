<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginState {

		protected $CI;
			
		public function __construct(){
			$this->CI =& get_instance();
			$this->CI->load->library('session');
			$this->CI->load->helper('url');
		}

        public function login_state_check()
        {

        	if($this->CI->session->user_id){
        		return true;
        	}
        	else
        	{
        		header("location: ".base_url()."web/login");
        		return false;
        		die();
        	}
        }
}