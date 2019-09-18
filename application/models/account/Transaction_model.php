<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Transaction_model extends CI_Model {

function __construct() {
	parent::__construct();
}

function get_transactions()
{
	
	$query="";
	$search = $this->input->post('search');
	$limit = $this->input->post('record_per_page');

	if($search==='')
	{
		$query="select a.id, a.or_number,a.total,a.amount_due,a.balance, a.remarks, a.due_date,a.tax, a.payment_change, a.date_time,
		b.terminal_code,b.terminal_number, c.branch_name, c.id as branch_id, d.first_name, d.last_name from
		transactions as a left join terminals as b on a.terminal_id = b.id left join 
		branches as c on b.branch_id = c.id left join users as d on a.user_id = d.id 
		where c.id in (".$this->session->branches.") order by a.id desc";
	}
		else
	{
		$query="select a.id, a.or_number,a.total,a.amount_due,a.balance, a.remarks, a.due_date,a.tax, a.payment_change, a.date_time,
		b.terminal_code,b.terminal_number, c.branch_name, d.first_name, d.last_name from
		transactions as a left join terminals as b on a.terminal_id = b.id left join 
		branches as c on b.branch_id = c.id left join users as d on a.user_id = d.id 
		where (a.or_number like '%$search%' or a.total like '%$search%' or b.terminal_code like '%$search%'
		or b.terminal_number like '%$search%' or c.branch_name like '%$search%' or d.first_name like '%$search%'
		or d.last_name like '%$search%') and c.id  in (".$this->session->branches.")";
	}


	return $this->_custom_query($query);
}

function _custom_query($mysql_query) {
	$result = $this->db->query($mysql_query);
	return $result;
}


function get_transactions_reports($id,$sdate,$edate)
{
	$query="select a.or_number,a.total,a.amount_due,a.tax, a.capital, a.revenue,a.balance as receivable, a.payment_change, a.date_time,
	b.terminal_code,b.terminal_number, c.branch_name, d.first_name, d.last_name from
	transactions as a left join terminals as b on a.terminal_id = b.id left join 
	branches as c on b.branch_id = c.id left join users as d on a.user_id = d.id where
	c.id = '$id' and a.date_time between '$sdate' and '$edate' ";
	return $this->_custom_query($query);
}


public function receive_payment()
{
	$id = $this->input->post('transaction_id');
	$amount = $this->input->post('amount_received');

	$query="select * from transactions where id = '$id' ";

	$result = $this->db->query($query)->row_array();

	if(doubleval($amount)==doubleval($result['balance']))
	{
		$query = "update transactions set balance = '0', amount_due = amount_due + $amount where id = '$id' ";

		$this->db->query($query);

		$response['success'] = true;
		$response['message'] = 'Transaction has been updated';
		$response['environment'] = ENVIRONMENT;

		return $response;
	}
	else
	{
		$response['success'] = false;
		$response['message'] = 'Amount does not match balance. Please check and try again.';
		$response['environment'] = ENVIRONMENT;

		return $response;
	}
}


public function load_transaction($or_number)
{
	$query = "";
}

}