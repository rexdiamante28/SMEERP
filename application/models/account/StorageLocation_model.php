<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class StorageLocation_model extends CI_Model {

function __construct() {
	parent::__construct();
}

function get_locations()
{
	$query="";
	$search = $this->input->post('search');
	$limit = $this->input->post('record_per_page');

	if($search==='')
	{
		$query="select a.id,a.name,a.description,b.branch_name from
		storage_locations as a left join branches as b on a.branch_id = b.id 
		where b.id in (".$this->session->branches.")
		order by a.id limit $limit";
	}
		else
	{
		$query="select a.id,a.name,a.description,b.branch_name from
		storage_locations as a left join branches as b on a.branch_id = b.id 
		where (a.name like '%$search%' or a.description like '%$search%' or
		b.branch_name like '%$search%') and b.id in (".$this->session->branches.")
		order by a.id limit $limit";
	}


	return $this->_custom_query($query);
}

function add_location()
{
	$query="select max(id) as id from storage_locations";

	$id = intval($this->_custom_query($query)->row()->id)+1;
	$branch_id = $this->input->post('branch_id');
	$location_name = $this->input->post('location_name');
	$description = $this->input->post('description');

	$query = "insert into storage_locations (id,branch_id,name,description) values 
			('$id','$branch_id','$location_name','$description')";

	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = $id;
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	
}

function update_location()
{
	$id = $this->input->post('id');
	$branch_id = $this->input->post('branch_id');
	$location_name = $this->input->post('location_name');
	$description = $this->input->post('description');

	$query="update storage_locations set branch_id = '$branch_id', name = '$location_name',
	description = '$description' where id = '$id'";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'update successful';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}


function get_location($id)
{
	$query="select * from storage_locations where id = '$id' ";
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