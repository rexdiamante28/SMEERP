<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

function __construct() {
	parent::__construct();
}

function get_users()
{
	$query="";
	$search = $this->input->post('search');
	$limit = $this->input->post('record_per_page');

	if($search==='')
	{
		$query="select * from users
		order by id limit $limit";
	}
		else
	{
		$query="select * from users where username like '%$search%' or
		first_name like '%$search%' or middle_name like '%$search%' or
		last_name like '%$search%' or telephone_number like '%$search%' or
		mobile_number like '%$search%' or email_address like '%$search%'
		order by id limit $limit";
	}
	
	return $this->_custom_query($query);
}

function change_password()
{
	$current_password = $this->input->post('current_password');
	$new_password = $this->input->post('new_password');
	$confirm_password = $this->input->post('confirm_password');

	$new_password = (password_hash($new_password,PASSWORD_BCRYPT,array(
			'cost' => 12
		)));

	$query="select password from users where id = '".$this->session->user_id."'";
	$pass = $this->_custom_query($query)->row()->password;

	if(password_verify($current_password,$pass))
	{
		$query="update users set password = '$new_password' where id = '".$this->session->user_id."'";
		if($this->_custom_query($query))
		{
			$response['success'] = true;
		    $response['message'] = "Password Updated";
		    $response['environment'] = ENVIRONMENT;

			return $response;
		}
		else
		{
			$response['success'] = false;
		    $response['message'] = "error:".$query;
		    $response['environment'] = ENVIRONMENT;

			return $response;
		}
		
	}
	else
	{
		$response['success'] = false;
	    $response['message'] = "Invalid Password";
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}

function add_user()
{
	$query="select max(id) as id from users";

	$id = intval($this->_custom_query($query)->row()->id)+1;
	$username = $this->input->post('username');
	$password = '$2y$12$j.TH5b40Vw/gaMGvuadOB.bFgl9jqYq5q088ebFe4gTGa5Sfe4iM2';
	$first_name = $this->input->post('first_name');
	$middle_name = $this->input->post('middle_name');
	$last_name = $this->input->post('last_name');
	$telephone_number = $this->input->post('telephone_number');
	$mobile_number = $this->input->post('mobile_number');
	$email_address = $this->input->post('email_address');
	$status = $this->input->post('status');
	$avatar = $this->input->post('image_name');
	$branches = $this->input->post('branches_list');
	$functions = $this->input->post('functions_list');

	if($avatar==='')
	{
		$avatar = 'user-avatar.jpg';
	}

	$query ="insert into users (id,username,password,first_name,middle_name,last_name,telephone_number,
	mobile_number, email_address,status,avatar,branches, functions) values 
	('$id','$username','$password','$first_name','$middle_name','$last_name','$telephone_number',
	'$mobile_number','$email_address','$status','$avatar','$branches','$functions')";

	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = $id;
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	
}

function update_user()
{
	$id = $this->input->post('id');
	$username = $this->input->post('username');
	$first_name = $this->input->post('first_name');
	$middle_name = $this->input->post('middle_name');
	$last_name = $this->input->post('last_name');
	$telephone_number = $this->input->post('telephone_number');
	$mobile_number = $this->input->post('mobile_number');
	$email_address = $this->input->post('email_address');
	$status = $this->input->post('status');
	$avatar = $this->input->post('image_name');
	$branches = $this->input->post('branches_list');
	$functions = $this->input->post('functions_list');

	if($avatar==='')
	{
		$avatar = 'user-avatar.jpg';
	}

	$query="update users set username = '$username',first_name = '$first_name',
	middle_name = '$middle_name', last_name = '$last_name', telephone_number = '$telephone_number',
	mobile_number = '$mobile_number', email_address = '$email_address', status = '$status',
	avatar = '$avatar', branches = '$branches' , functions = '$functions'
	where id = '$id'";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'update successful';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}


function get_user($id)
{
	$query="select * from users where id = '$id' ";
	return $this->_custom_query($query);
}

function remove_location($id)
{
	$query="delete from storage_locations where id = '$id' ";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'Location successfully removed';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}



function _custom_query($mysql_query) {
	$result = $this->db->query($mysql_query);
	return $result;
}

}