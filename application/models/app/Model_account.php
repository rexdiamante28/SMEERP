<?php 
class Model_account extends CI_Model {

	public function read($id)
	{
		$query="select * from sys_users where id = ? and active='1'";

		return $this->db->query($query,$id)->row_array();
	}

	public function update_save($first_name,$middle_name,$last_name,$phone_number,$mobile_number,$email,$id)
	{
		$query="update sys_users set first_name = ?, middle_name = ?, last_name = ?, phone_number = ?,mobile_number=?,email=?
		 where id = ?";

		$args = array($first_name,$middle_name,$last_name,$phone_number,$mobile_number,$email,$id);

		if($this->db->query($query,$args))
		{
			$response = array(
				'success' => true,
				'message' => 'Profile updated',
				'id' => en_dec('en',$id)
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to update profile. Please try again.'
			);
		}

		return $response;
	}

	public function update_password($new_password, $id){

		$query="update sys_users set password=? where id = ? and active='1'";
		$args = array($new_password,$id);

		if($this->db->query($query,$args))
		{
			$response = array(
				'success' => true,
				'message' => 'Password updated',
				'id' => en_dec('en',$id)
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to update password. Please try again.'
			);
		}

		return $response;
	}

	public function get_active(){

		$query="SELECT * FROM users a
				LEFT JOIN employees b ON a.emp_id = b.id
				LEFT JOIN people c ON b.people_id = c.id 
				WHERE a.status = 1";

		return $this->db->query($query)->result_array();
	}

}