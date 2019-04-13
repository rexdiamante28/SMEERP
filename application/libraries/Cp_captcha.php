<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cp_captcha {

	protected $CI;
			
	public function __construct(){
		$this->CI =& get_instance();
	}

        
        public function generate_captcha($length,$ip_address)
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
                    'img_id'        => 'cp_captcha_id',
                    'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

                    // White background and border, black text and red grid
                    'colors' => array(
                            'background' => array(255, 255, 255),
                            'border' => array(255, 255, 255),
                            'text' => array(0, 0, 0),
                            'grid' => array(255, 40, 40)
                    )
            );

            $cap = create_captcha($vals);

            $this->insert_data($cap['time'], $ip_address ,$cap['word'],$cap['filename']);

            return $cap;
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


         public function insert_data($captcha_time, $ip_address, $word, $filename)
         {
                $arguments = array(
                        $captcha_time,
                        $ip_address,
                        strtolower($word),
                        $filename
                );

                $query="insert into sys_captcha (captcha_time,ip_address,word,filename) values (?,?,?,?)";

                return $this->CI->db->query($query,$arguments);
         }


         public function validate_captcha($word, $ip_address)
         {      
                $expiration = time() - 7200; // Two hour limit

                $this->delete_data($word,$expiration);

                // Then see if a captcha exists:
                $query="select * from sys_captcha where captcha_time > ? and ip_address = ? and word = ?";

                $arguments = array(
                        $expiration,
                        $ip_address,
                        strtolower($word)
                );

                $result = $this->CI->db->query($query,$arguments);



                if ($result->num_rows() < 1)
                {
                        return false;
                }
                else
                {
                        return true;
                }
         }

         private function delete_data($word,$expiration)
         {

                $query="select * from sys_captcha where captcha_time < ?";
                $result = $this->CI->db->query($query,$expiration)->result_array();

                $this->delete_captcha_images($result);

                $query="delete from sys_captcha where captcha_time < ? ";
                $this->CI->db->query($query,$expiration);
         }

         private function delete_captcha_images($result)
         {      
                foreach ($result as $row) {
                        unlink('./assets/captcha/'.$row['filename']);
                }
         }

}
