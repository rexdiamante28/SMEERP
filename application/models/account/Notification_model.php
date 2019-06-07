<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Notification_model extends CI_Model {

function __construct() {
	parent::__construct();
}

function notify($notfication,$selector)
{
	
	$query = "select * from users where functions like '%$selector%'";
	$result = $this->_custom_query($query)->result();

	foreach ($result as $value) 
	{

		$query="insert into notifications (user_id,notification,date,checked) values 
		('".$value->id."','$notfication',(select now()),'0')";
		$this->_custom_query($query);
	}

}

function set_read($id)
{
	$query="update notifications set checked = '1'  where id = '$id' ";
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = "update successfull";
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	else
	{
		$response['success'] = false;
		$response['message'] = "unable to update";
		$response['environment'] = ENVIRONMENT;

		return $response;
	}
}


function toggle_important($id)
{
	$query="select important from notifications where id = '$id' ";
	if($this->_custom_query($query)->row()->important==='1')
	{
		$query="update notifications set important = '0'  where id = '$id' ";
	}
	else
	{
		$query="update notifications set important = '1'  where id = '$id' ";
	}
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = "update successfull";
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	else
	{
		$response['success'] = false;
		$response['message'] = "unable to update";
		$response['environment'] = ENVIRONMENT;

		return $response;
	}
}

function get_notifications()
{
	$query="";
	$search = $this->input->post('search');
	$limit = $this->input->post('record_per_page');

	if($search==='')
	{
		$query="select * from notifications where user_id ='".$this->session->user_id."' order by  date desc , important desc , checked desc limit $limit ";
	}
		else
	{
		$query="select * from notifications where user_id = '".$this->session->user_id."' and 
		notification like '%$search%'
		order by date,checked,important desc limit $limit ";
	}
	
	return $this->_custom_query($query);
}

function _custom_query($mysql_query) {
	$result = $this->db->query($mysql_query);
	return $result;
}

}