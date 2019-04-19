<?php 
class Model_authentication extends CI_Model {

	public function get_user($username)
	{
		$query = "SELECT * FROM sys_users WHERE username = ? and active = '1' ";

        return $this->db->query($query,$username);
	}

	public function log_failed_login_attempts($id, $ctr){
		
		$query = "UPDATE sys_users SET failed_login_attempts=? WHERE id = ? and active='1'";
		$this->db->query($query,array($ctr,$id));
	}

	public function get_user_thru_email($email){
		$query = "SELECT * FROM sys_users WHERE email = ? and active = '1' ";
        return $this->db->query($query,$email);
	}

	public function reset_password($email, $password){

		$query = "UPDATE sys_users SET password=? WHERE email = ? and active = '1' ";
        return $this->db->query($query,array($password,$email));
	}

}
