<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Terminal_model extends CI_Model {

function __construct() {
	parent::__construct();
}

function get_terminals()
{
	$query="";
	$search = $this->input->post('search');
	$limit = $this->input->post('record_per_page');

	if($search==='')
	{
		$query="select a.id,a.terminal_code,a.terminal_number,a.status, b.branch_name from
		terminals as a left join branches as b on a.branch_id = b.id where
		b.id in (".$this->session->branches.")
		order by a.id limit $limit";
	}
		else
	{

		$query="select a.id,a.terminal_code,a.terminal_number,a.status, b.branch_name from
		terminals as a left join branches as b on a.branch_id = b.id  where
		(a.terminal_code like '%$search%' or a.terminal_number like '%$search%' or a.status
		like '%$search%' or b.branch_name like '%$search%') and b.id in (".$this->session->branches.")
		order by a.id limit $limit";
	}


	return $this->_custom_query($query);
}

function add_terminal()
{
	$query="select max(id) as id from terminals";

	$id = intval($this->_custom_query($query)->row()->id)+1;
	$branch_id = $this->input->post('branch_id');
	$terminal_code = $this->input->post('terminal_code');
	$terminal_number = $this->input->post('terminal_number');
	$status = 'Inactive';


	$query = "insert into terminals (id,branch_id,terminal_code,terminal_number,status) values 
			('$id','$branch_id','$terminal_code','$terminal_number','$status')";

	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = $id;
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	
}

function update_terminal()
{
	$id = $this->input->post('id');
	$branch_id = $this->input->post('branch_id');
	$terminal_code = $this->input->post('terminal_code');
	$terminal_number = $this->input->post('terminal_number');

	$query="update terminals set branch_id = '$branch_id', terminal_code = '$terminal_code',
	terminal_number  = '$terminal_number' where id = '$id'";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'update successful';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}


function get_terminal($id)
{
	$query="select * from terminals where id = '$id' ";
	return $this->_custom_query($query);
}

function remove_terminal($id)
{
	$query="delete from terminals where id = '$id' ";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'Terminal successfully removed';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}



function _custom_query($mysql_query) {
	$result = $this->db->query($mysql_query);
	return $result;
}

}