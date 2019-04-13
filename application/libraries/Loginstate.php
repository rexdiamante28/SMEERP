<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginstate {

protected $CI;
                        
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('url');
    }

    public function login_state_check()
    {
       //initial checking: Check if a certain session variable is set
        if($this->CI->session->user_id)
        {
                return true;
        }
        else
        {
                header("location: ".base_url()."auth/authentication/");
        }

    }

    public function login_state_check_without_redirect()
    {
        //initial checking: Check if a certain session variable is set
        if($this->CI->session->user_id)
        {
            $loggedIn = true;
        }
        else
        {
            $loggedIn = false;
        }
        
        if($loggedIn === true)
        {
            return $loggedIn;
        }
        else
        {
            return false;
        }
    }
        

    public function get_access()
    {       
        if($this->CI->session->functions)
        {
            return  json_decode($this->CI->session->functions,true);
        }
    }

    public function find_first_module()
    {
        if($this->get_access()['overall_access']==1)
        {
            header("location: ".base_url('app/home/'));
            die();
        }
    }
}