<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Branch_model extends CI_Model {

function __construct() {
	parent::__construct();
}

function get_branches()
{
		$query="";
		$search = $this->input->post('search');
		$limit = $this->input->post('record_per_page');

		if($search==='')
		{
			$query = "select * from branches order by id limit $limit";
		}
		else
		{
			$query = "select * from branches where branch_name like '%$search%' or 
			address like '%$search%' order by id limit $limit";
		}


		return $this->_custom_query($query);
}

function create_branch()
{
	$query="select max(id) as id from branches";

	$id = intval($this->_custom_query($query)->row()->id)+1;
	$branch_name = $this->input->post('branch_name');
	$address = $this->input->post('address');
	$status = $this->input->post('status');

	$query = "insert into branches (id,branch_name,address,status) values 
			('$id','$branch_name','$address','$status')";

	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = $id;
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	
}

function update_branch()
{
	$id = $this->input->post('id');
	$branch_name = $this->input->post('branch_name');
	$address = $this->input->post('address');
	$status = $this->input->post('status');

	$query="update branches set branch_name = '$branch_name', address = '$address',
	status = '$status' where id = '$id'";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'update successful';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}


function get_branch($id)
{
	$query="select * from branches where id = '$id' ";
	return $this->_custom_query($query);
}

function remove_branch($id)
{
	$query="delete from branches where id = '$id' ";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'Branch Successfully removed';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}



function _custom_query($mysql_query) {
	$result = $this->db->query($mysql_query);
	return $result;
}

}