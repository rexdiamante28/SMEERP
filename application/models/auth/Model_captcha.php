<?php 
class Model_captcha extends CI_Model {

	public function insert_data($captcha_time, $ip_address, $word)
	{
		$arguments = array(
			$captcha_time,
			$ip_address,
			$word
		);

		$query="insert into sys_captcha (captcha_time,ip_address,word) values (?,?,?)";

		return $this->db->query($query,$arguments);
	}
}
