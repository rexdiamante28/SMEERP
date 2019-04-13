<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captchalib {

	protected $CI;
			
	public function __construct(){
	       $this->CI =& get_instance();
	       $this->CI->load->library('database');
	       $this->CI->load->helper('url','captcha');
	}

        public function generate_captcha($length)
         {

            $vals = array(
                    'word'          => $this->_generateRandomString($length),
                    'img_path'      => './assets/captcha/',
                    'img_url'       => base_url('assets/captcha/'),
                    'font_path'     => base_url('assets/captcha_font/OpenSans-Bold.ttf'),
                    'img_width'     => '150',
                    'img_height'    => 30,
                    'expiration'    => 7200,
                    'word_length'   => $length,
                    'font_size'     => 16,
                    'img_id'        => 'Imageid',
                    'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

                    // White background and border, black text and red grid
                    'colors'        => array(
                            'background' => array(255, 255, 255),
                            'border' => array(255, 255, 255),
                            'text' => array(0, 0, 0),
                            'grid' => array(255, 40, 40)
                    )
            );

            $cap = create_captcha($vals);

            $this->insert_data($cap['time'], $this->input->ip_address() ,$cap['word']);

         }


         function _generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
         }


         public function insert_data($captcha_time, $ip_address, $word)
         {
                $arguments = array(
                        $captcha_time,
                        $ip_address,
                        $word
                );

                $query="insert into sys_captcha (captcha_time,ip_address,word) values (?,?,?)";

                return $this->CI->db->query($query,$arguments);
         }


}