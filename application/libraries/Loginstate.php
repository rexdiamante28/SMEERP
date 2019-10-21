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


        function generate_barcode($length = 15) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            return $randomString;
        }
}