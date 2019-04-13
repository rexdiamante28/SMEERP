<?php 
class Model_authentication extends CI_Model {

	public function get_user($username)
	{
		$query = "SELECT * FROM sys_users WHERE username = ? and active = '1' ";

        return $this->db->query($query,$username);
	}
}
