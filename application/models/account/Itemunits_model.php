<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Itemunits_model extends CI_Model {

function __construct() {
	parent::__construct();
}

function get_units()
{


	$query="";
	$search = $this->input->post('search');
	$limit = $this->input->post('record_per_page');

	if($search==='')
	{
		$query="select id,unit,description from item_units
		order by id limit $limit";
	}
		else
	{
		$query="select id,unit,description from item_units
		where unit like '%$search%' or description like '%$search%'
		order by id limit $limit";
	}


	return $this->_custom_query($query);
}

function add_unit()
{
	$query="select max(id) as id from item_units";

	$id = intval($this->_custom_query($query)->row()->id)+1;
	$unit = $this->input->post('item_unit');
	$description = $this->input->post('description');

	$query = "insert into item_units (id,unit,description) values 
			('$id','$unit','$description')";

	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = $id;
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	
}

function update_unit()
{
	$id = $this->input->post('id');
	$unit = $this->input->post('item_unit');
	$description = $this->input->post('description');

	$query="update item_units set unit = '$unit', description = '$description'
	where id = '$id'";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'update successful';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}


function get_unit($id)
{
	$query="select * from item_units where id = '$id' ";
	return $this->_custom_query($query);
}

function remove_unit($id)
{
	$query="delete from item_units where id = '$id' ";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'Item unit Successfully removed';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}



function _custom_query($mysql_query) {
	$result = $this->db->query($mysql_query);
	return $result;
}

}