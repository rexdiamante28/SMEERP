<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Itemmovement_model extends CI_Model {

function __construct() {
	parent::__construct();
}

function get_item_movements()
{
	$query="";
	$search = $this->input->post('search');
	$limit = $this->input->post('record_per_page');

	if($search==='')
	{
		$query="select a.id,a.branch_id,a.code, a.type, a.date,
		a.internal_notes, a.facilitator, a.status, a.from_outbound, a.outbound_id,a.is_accepted, b.branch_name from item_movements
		as a left join branches as b on a.branch_id = b.id where
		b.id in (".$this->session->branches.")
		order by a.id DESC limit $limit";
	}
		else
	{
		$query="select a.id,a.branch_id,a.code, a.type, a.date,
		a.internal_notes, a.facilitator, a.status,  a.from_outbound, a.outbound_id, a.is_accepted,b.branch_name from item_movements
		as a left join branches as b on a.branch_id = b.id where (a.code like '%$search%'
		or a.type like '%$search%' or a.date like '%$search%' or a.internal_notes like '%$search%'
		or a.status like '%$search%' or b.branch_name like '%$search%') and b.id in (".$this->session->branches.")
		order by a.id DESC limit $limit";
	}

	return $this->_custom_query($query);
}

function add_movement()
{
	$query="select max(id) as id from item_movements";

	$id = intval($this->_custom_query($query)->row()->id)+1;
	$branch_id = $this->input->post('branch_id');
	$branch_id2 = $this->input->post('branch_id2');
	$code = $this->input->post('code');
	$type = $this->input->post('type');
	$date = $this->input->post('date');
	$internal_notes = $this->input->post('internal_notes');
	$facilitator = $this->input->post('facilitator');
	$encoder = $this->session->user_id;
	$status = $this->input->post('status');

	if($type==='Inbound')
	{
		$code = 'INBND-'.$code;
	}
	if($type==='Outbound')
	{
		$code1 = 'OUTB-'.$code;
		
	}
	if($type==='Orders')
	{
		$code = 'ORDR-'.$code;
	}
	if($type==='Damages')
	{
		$code = 'DMGS-'.$code;
	}
	if($type==='Quarantine')
	{
		$code = 'QRNTN-'.$code;
	}

	if($branch_id2 ==='')
	{

		$query = "insert into item_movements (id,branch_id,code,type,date,internal_notes,facilitator,
		encoder,status,from_outbound) values 
		('$id','$branch_id','$code','$type','$date','$internal_notes','$facilitator','$encoder','$status','0')";

	}
	else
	{	
		if($type === "Outbound"){

			$query = "insert into item_movements (id,branch_id,code,type,date,internal_notes,facilitator,
			encoder,status,from_outbound) values 
			('$id','$branch_id','$code1','$type','$date','$internal_notes','$facilitator','$encoder','$status','0')";
			$this->db->query($query);

			//ADD INBOUND
			$type = 'Inbound';
			$id2 = $id+1;
			$internal_notes = 'Created from '.$code;
			$code2 = 'INBD-'.$code;

			$query = "insert into item_movements (id,branch_id,code,type,date,internal_notes,facilitator,
			encoder,status,from_outbound, outbound_id) values 
			('$id2','$branch_id2','$code2','$type','$date','$internal_notes','$facilitator','$encoder','$status','1','$id')";

		}else{
			{

				$query = "insert into item_movements (id,branch_id,code,type,date,internal_notes,facilitator,
				encoder,status,from_outbound) values 
				('$id','$branch_id','$code','$type','$date','$internal_notes','$facilitator','$encoder','$status','0')";

			}
		}
	}

	

	if($this->_custom_query($query))
	{
		$notification = $this->session->first_name." ".$this->session->last_name." added new item movement with reference code ".$code.". ";
		$this->notification_model->notify($notification,"Notification Inventory");
		$this->notification_model->notify($notification,"Notification Users");

		$response['success'] = true;
	    $response['message'] = $id;
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	
}

function update_movement()
{
	$id = $this->input->post('id');
	$branch_id = $this->input->post('branch_id');
	$code = $this->input->post('code');
	$type = $this->input->post('type');
	$date = $this->input->post('date');
	$internal_notes = $this->input->post('internal_notes');
	$facilitator = $this->input->post('facilitator');
	$encoder = $this->session->user_id;
	$status = $this->input->post('status');

	if($type==='Inbound')
	{
		$code = str_replace('INBND-','INBND-', $code);
		$code = str_replace('OUTB-','INBND-', $code);
		$code = str_replace('ORDR-','INBND-', $code);
		$code = str_replace('DMGS-','INBND-', $code);
		$code = str_replace('QRNTN-','INBND-', $code);
	}
	if($type==='Outbound')
	{
		$code = str_replace('INBND-','OUTB-', $code);
		$code = str_replace('OUTB-','OUTB-', $code);
		$code = str_replace('ORDR-','OUTB-', $code);
		$code = str_replace('DMGS-','OUTB-', $code);
		$code = str_replace('QRNTN-','OUTB-', $code);
	}
	if($type==='Orders')
	{
		$code = str_replace('INBND-','ORDR-', $code);
		$code = str_replace('OUTB-','ORDR-', $code);
		$code = str_replace('ORDR-','ORDR-', $code);
		$code = str_replace('DMGS-','ORDR-', $code);
		$code = str_replace('QRNTN-','ORDR-', $code);
	}
	if($type==='Damages')
	{
		$code = str_replace('INBND-','DMGS-', $code);
		$code = str_replace('OUTB-','DMGS-', $code);
		$code = str_replace('ORDR-','DMGS-', $code);
		$code = str_replace('DMGS-','DMGS-', $code);
		$code = str_replace('QRNTN-','DMGS-', $code);
	}
	if($type==='Quarantine')
	{
		$code = str_replace('INBND-','QRNTN-', $code);
		$code = str_replace('OUTB-','QRNTN-', $code);
		$code = str_replace('ORDR-','QRNTN-', $code);
		$code = str_replace('DMGS-','QRNTN-', $code);
		$code = str_replace('QRNTN-','QRNTN-', $code);
	}

	if($this->input->post('date')==='')
	{

		$query = "update item_movements set branch_id = '$branch_id', code = '$code', type = '$type',
		internal_notes = '$internal_notes', facilitator = '$facilitator', encoder = '$encoder', status = '$status'
		where id = '$id' ";
	}
	else
	{

		$query = "update item_movements set branch_id = '$branch_id', code = '$code', type = '$type',
		internal_notes = '$internal_notes', facilitator = '$facilitator', encoder = '$encoder', status = '$status',
		date = '$date' where id = '$id' ";
	}
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'update successful';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}


function get_stock_movement($id)
{
	$query="select * from item_movements where id = '$id' ";
	return $this->_custom_query($query);
}

function remove_item_movement($id)
{
	$query="delete from item_movements where id = '$id' ";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'movement successfully removed';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}

function get_facilitators()
{
	$category = $this->input->post('branch_id');

	$query="select id, concat(first_name,' ',middle_name,' ',last_name) as name from users where id in 
	(select id from users where branches like '%$category%')";
	return  $this->_custom_query($query)->result();
}


function get_stock_movement_items($id)
{

	$movement_info = $this->get_stock_movement($id)->row_array();

	if($movement_info['from_outbound'] == 1){
		$id = $movement_info['outbound_id'];
	}

	$query="select a.id,a.item_id, a.quantity, a.remarks, a.stock, b.item_name, b.item_code,b.item_unit,
			b.item_image, c.unit, 
			(select count(*) from item_unique_identifiers where item_movement_items_id = a.id )
			as id_not_set,
			(select count(*) from item_unique_identifiers where item_movement_items_id = a.id and identifier != '0' )
			as id_set from item_movement_items as a
			left join items as b on a.item_id = b.id
			left join item_units as c on b.item_unit = c.id
			where a.item_movement_id = '$id'";
	
	return $this->_custom_query($query);
}


function get_items()
{
	$query="";
	$search = $this->input->post('search');
	$limit = $this->input->post('record_per_page');

	if($search==='')
	{
		$query="select a.id as item_id, a.item_code, a.item_name,
		a.item_image, a.price, a.status, b.id as item_units_id,
		b.unit, c.id as category_id, c.category_string
		from items as a 
		left join item_units as b on a.item_unit = b.id 
		left join item_categories as c on a.item_category = c.id
		order by a.id limit $limit";
	}
	else
	{
		$query="select a.id as item_id, a.item_code, a.item_name,
		a.item_image, a.price, a.status, b.id as item_units_id,
		b.unit, c.id as category_id, c.category_string
		from items as a 
		left join item_units as b on a.item_unit = b.id 
		left join item_categories as c on a.item_category = c.id 
		where a.item_code like '%$search%' or a.item_name like '%$search%'
		or b.unit like '%$search%' or c.category_string like '%$search%'
		order by a.id limit $limit";
	}


	return $this->_custom_query($query);
}


function add_item_in_movement()
{
	$query="select max(id) as id from item_movement_items";

	$id = intval($this->_custom_query($query)->row()->id)+1;
	$item_movement_id  = $this->input->post('movement_id');
	$item_id = $this->input->post('item_id');
	$quantity =  intval($this->input->post('quantity'));
	$remarks = $this->input->post('remarks');
	$price = $this->input->post('buying_price');
	$selling_price = $this->input->post('selling_price');

	$this->load->model('account/item_model');

	$item = $this->item_model->get_item($item_id)->row_array();

	//check the type of movement
	//If if outbound,quarantine,damages check if item is avaliable in stocks and the quantity is sufficient. otherwise, show error
	$query="select * from item_movements where id = '$item_movement_id'";
	$item_movement = $this->_custom_query($query)->row();
	
	if($item_movement->from_outbound == 0){
		
		if($item_movement->type==='Inbound')
		{
			//check if the item is already in the stocks. If yes, just update quantity. else insert item.
			$query="select * from store_items where item_id = '$item_id' and branch_id = '".$item_movement->branch_id."'";
			$store_item = $this->_custom_query($query);
			if($store_item->num_rows()===0)
			{
				$query="select max(id) as id from store_items";
				$store_item_id = intval($this->_custom_query($query)->row()->id)+1;

				$query="insert into store_items (id,item_id,branch_id) values 
					('$store_item_id','$item_id','".$item_movement->branch_id."')";

				$this->db->query($query);
			}

			//insert entries to item unique identifiers table with value '0'

			if($item['has_unique_identifier']=='1')
			{
				$query="insert into item_movement_items (id,item_movement_id,item_id,price,selling_price,quantity,stock,remarks)
				values ('$id','$item_movement_id','$item_id','$price','$selling_price','$quantity','0','$remarks')";
			}
			else
			{
				$query="insert into item_movement_items (id,item_movement_id,item_id,price,selling_price,quantity,stock,remarks)
				values ('$id','$item_movement_id','$item_id','$price','$selling_price','$quantity','$quantity','$remarks')";
			}

			if($this->_custom_query($query))
			{

				if($item['has_unique_identifier']=='1')
				{
					for($a = 0; $a < $quantity; $a++)
					{
						$identifiers_insertion_query="insert into item_unique_identifiers (item_movement_items_id,identifier,available) values 
						('$id','0','0')";

						$this->_custom_query($identifiers_insertion_query);
					}
				}

				$response['success'] = true;
				$response['message'] = 'Item successfully added';
				$response['environment'] = ENVIRONMENT;

				return $response;
			}
			else
			{
				$response['success'] = false;
			    $response['message'] = 'something went wrong. '.$query;
			    $response['environment'] = ENVIRONMENT;

				return $response;
			}

		}
		else if($item_movement->type==='Orders')
		{


			$query="insert into item_movement_items (id,item_movement_id,item_id,quantity,remarks)
			values ('$id','$item_movement_id','$item_id','$quantity','$remarks')";

			if($this->_custom_query($query))
			{

				$response['success'] = true;
			    $response['message'] = 'Item successfully added';
			    $response['environment'] = ENVIRONMENT;

				return $response;
			}
			else
			{
				$response['success'] = false;
			    $response['message'] = 'something went wrong. '.$query;
			    $response['environment'] = ENVIRONMENT;

				return $response;
			}
				
		}
		else
		{
			//check if the item is already in the stocks and current stocks is greater than or equal to the quantity
			$query = "select *, (select sum(stock) from item_movement_items where item_movement_id in 
			(select id from item_movements where branch_id = '".$item_movement->branch_id."' and type = 'Inbound') 
			and item_id = '$item_id') as stock_count from store_items where item_id = '$item_id' and branch_id = '".$item_movement->branch_id."'";

			$store_item = $this->_custom_query($query);

			if($store_item->num_rows()===0)
			{
				$response['success'] = false;
				$response['message'] = 'Item not found in store.'.$query;
				$response['environment'] = ENVIRONMENT;

				return $response;
			}
			else
			{
				$store_item = $store_item->row();
				$current_stock = floatval($store_item->stock_count);
				$current_stock-=floatval($quantity);

				
				if($current_stock<0)
				{
					$response['success'] = false;
					$response['message'] = 'Insuficient Item. Please check.';
					$response['environment'] = ENVIRONMENT;

					return $response;
				}
				else
				{

					if($item['has_unique_identifier']=='1')
					{
						$query="insert into item_movement_items (id,item_movement_id,item_id,price,selling_price,quantity,stock,remarks)
						values ('$id','$item_movement_id','$item_id','$price','$selling_price','$quantity','0','$remarks')";
					}
					else
					{
						$query="insert into item_movement_items (id,item_movement_id,item_id,price,selling_price,quantity,stock,remarks)
						values ('$id','$item_movement_id','$item_id','$price','$selling_price','$quantity','$quantity','$remarks')";
					}

					if($this->_custom_query($query))
					{

						if($item['has_unique_identifier']=='1')
						{
							for($a = 0; $a < $quantity; $a++)
							{
								$identifiers_insertion_query="insert into item_unique_identifiers (item_movement_items_id,identifier,available) values 
								('$id','0','0')";

								$this->_custom_query($identifiers_insertion_query);
							}
						}
						else
						{
							$removed = intval($quantity);

							$query="select * from item_movement_items where item_movement_id in (select id from item_movements where
							 branch_id = '".$item_movement->branch_id."' and type = 'Inbound') and item_id = '$item_id' order by id";

							$result = $this->db->query($query)->result_array();

						

							foreach ($result as $value) {
								if($removed>0)
								{
									$current_stock = intval($value['stock']);

									$row_diff = $current_stock - $removed;

									if($row_diff<0)
									{
										$query="update item_movement_items set stock = '0' where id = '".$value['id']."'";

										$this->db->query($query);

										$removed -= $current_stock;
									}
									else
									{
										$query="update item_movement_items set stock = '$row_diff' where id = '".$value['id']."'";

										$this->db->query($query);

										$removed = 0;
									}

								}
							}
						}

						$response['success'] = true;
					    $response['message'] = 'Item successfully added';
					    $response['environment'] = ENVIRONMENT;


						return $response;
					}
					else
					{
						$response['success'] = false;
					    $response['message'] = 'something went wrong. '.$query;
					    $response['environment'] = ENVIRONMENT;

						return $response;
					}
				}

			}
		}
	}else{

		$response['success'] = false;
		$response['message'] = 'You cannot add item from this Item Movement.';
		$response['environment'] = ENVIRONMENT;

		return $response;
	}
}

/*
function add_item_in_movement()
{
	$query="select max(id) as id from item_movement_items";
	$id = intval($this->_custom_query($query)->row()->id)+1;
	$item_movement_id  = $this->input->post('movement_id');
	$item_id = $this->input->post('item_id');
	$quantity = $this->input->post('quantity');
	$remarks = $this->input->post('remarks');

	//check the type of movement
	//If if outbound,quarantine,damages check if item is avaliable in stocks and the quantity is sufficient. otherwise, show error
	$query="select * from item_movements where id = item_movement_id";
	if()
	{

	}

	$query="insert into item_movement_items (id,item_movement_id,item_id,quantity,remarks)
	values ('$id','$item_movement_id','$item_id','$quantity','$remarks')";

	if($this->_custom_query($query))
	{

		$response['success'] = true;
	    $response['message'] = 'Item successfully added';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}

}

*/


public function get_item_movement_item_uids($item_movement_id)
{


	$query = "select a.*, c.from_outbound, c.is_accepted, c.id as im_id from item_unique_identifiers a
	left join item_movement_items b on a.item_movement_items_id = b.id
	left join item_movements c on b.item_movement_id = c.id
	where item_movement_items_id = '$item_movement_id' and available != '6' and available != '2'";
	return $this->db->query($query)->result_array();
	
	
}

public function get_item_movement_item_uids_acc($item_movement_id)
{


	$query = "select a.*, c.from_outbound, c.is_accepted, c.id from item_unique_identifiers a
	left join item_movement_items b on a.item_movement_items_id = b.id
	left join item_movements c on b.item_movement_id = c.id
	where item_movement_items_id = '$item_movement_id' and available != '6' and available != '2'";
	return $this->db->query($query)->result_array();
	
	
}


public function update_uid()
{
	$id = $this->input->post('id');
	$uid = $this->input->post('uid');

	if($uid=='0')
	{
		$response = array(
			'success' => false,
			'message' => 'Invalid UID'
		);

		return $response;

		die();
	}


	$query="select * from  item_movements where id = (select item_movement_id from  item_movement_items where id = 
		(select item_movement_items_id from item_unique_identifiers where id = '$id'))";

	$item_movement = $this->db->query($query)->row_array();

	if($item_movement['type'] == 'Inbound')
	{
		$query = "select * from item_unique_identifiers where identifier = '$uid' and id != '$id' and available = '1' ";

		$result = $this->db->query($query);
		if($result->num_rows()>0)
		{
			$response = array(
				'success' => false,
				'message' => 'UID Already set'
			);
		}
		else
		{
			//add to stock

			// subtract from stocks

			$query="select * from item_unique_identifiers where id = '$id' ";

			$unid = $this->db->query($query)->row_array();

			if($unid['available']=='0')
			{
				$query = "update item_movement_items set stock = stock + 1 where id =  ( select item_movement_items_id from item_unique_identifiers
				 where id = '$id' )";

				$this->db->query($query);
			}


			$query = "update item_unique_identifiers set identifier = '$uid', available = '1' where id = '$id' ";

			$this->db->query($query);

			$response = array(
				'success' => true,
				'message' => 'UID Updated'
			);
		}

		return $response;
	}
	else
	{
		$query = "select * from item_unique_identifiers where identifier = '$uid' and id != '$id' and (available = '1' or available = '3' or available = '6') "; // 0 = not set yet 3 = returned 1 = available  2 = sold 4 = outbound | Damaged | Quarantined

		$result = $this->db->query($query);
		if($result->num_rows()<1)
		{
			$response = array(
				'success' => false,
				'message' => 'UID not existing or already been sold'
			);
		}
		else
		{
			//add to stock

			// subtract from stocks

			$query="select * from item_unique_identifiers where id = '$id' ";

			$unid = $this->db->query($query)->row_array();

			if($unid['available']=='0')
			{

				$query = "update item_movement_items set stock = stock - 1 where id in ( select item_movement_items_id from item_unique_identifiers
				 where identifier = '$uid' and available = '1' )";

				$this->db->query($query);


				$query = "update item_movement_items set stock = stock + 1 where id =  ( select item_movement_items_id from item_unique_identifiers
				 where id = '$id' )";

				$this->db->query($query);
			}

			$query = "update item_unique_identifiers set available = '6' where identifier = '$uid' ";

			$this->db->query($query);

			$query = "update item_unique_identifiers set identifier = '$uid', available = '4' where id = '$id' ";

			$this->db->query($query);

			$response = array(
				'success' => true,
				'message' => 'UID Updated'
			);
		}

		return $response;
	}

	
}


public function delete_uid()
{
	$id = $this->input->post('id');

	$query="select * from item_unique_identifiers where id = '$id'";

	$result = $this->db->query($query)->row_array();

	if($result['available']=='2')
	{
		$response = array(
			'success' => false,
			'message' => 'Item Already sold. It Cannot be deleted'
		);
	}
	else
	{
		
		//subtract from item movement items

		$query="select * from item_movement_items where id = (select item_movement_items_id from item_unique_identifiers
		where id = '$id')";

		$quantity  = intval($this->db->query($query)->row_array()['quantity']);

		$quantity -= 1;

		$query="update item_movement_items set quantity = '$quantity' where id = (select item_movement_items_id from item_unique_identifiers
		where id = '$id') ";

		$this->db->query($query);

		// subtract from stocks

		$query="select * from store_items where item_id = (select item_id from item_movement_items where id = 
                 	(select item_movement_items_id from item_unique_identifiers
                 		where id = '$id'
                 	)
                                          
                        ) and branch_id = 
                        (select branch_id from item_movements where id = 
                        	(select item_movement_id from item_movement_items
                          	where id = (
                              	select item_movement_items_id from item_unique_identifiers
                                  where id = '$id'
                              )
                          )
                        )
                 ";

        $quantity  = intval($this->db->query($query)->row_array()['stock']);


        $quantity -= 1;


        $query="update store_items set stock = '$quantity'  where item_id = (select item_id from item_movement_items where id = 
                 	(select item_movement_items_id from item_unique_identifiers
                 		where id = '$id'
                 	)                
                        ) and branch_id = 
                        (select branch_id from item_movements where id = 
                        	(select item_movement_id from item_movement_items
                          	where id = (
                              	select item_movement_items_id from item_unique_identifiers
                                  where id = '$id'
                              )
                          )
                        )";

        $this->db->query($query);


		//delete from uids
		$query="delete from item_unique_identifiers where id = '$id' ";
		$this->db->query($query);

		$response = array(
			'success' => true,
			'message' => 'Item Deleted'
		);
	}

	return $response;



}


function _custom_query($mysql_query) {
	$result = $this->db->query($mysql_query);
	return $result;
}

function import_item_out_to_inbound(){

	$this->load->model('account/item_model');
	$inbound_id = $this->input->post('inbound_id');
	$movement_info = $this->get_stock_movement($inbound_id)->row_array();
	$branch_id = $movement_info['branch_id'];

	if($movement_info['from_outbound'] == 1){
		$outbound_id = $movement_info['outbound_id'];
	}else{
		$outbound_id = 0;
	}

	//GET ITEMS
	$items = $this->get_stock_movement_items_custom($outbound_id)->result_array();
	// print_r($items);die();
	$query="select max(id) as id from item_movement_items";
	$item_movement_items_id = intval($this->_custom_query($query)->row()->id)+1;
	$item_movement_id  = $inbound_id;
	$checker = 1;
	
	foreach ($items as $item) {
		
		//SA ITEM_MOVEMENT_ITEM MUNA
		$item_id = $item['item_id'];
		$price =  $item['price'];
		$selling_price =  $item['selling_price'];
		$quantity =  $item['quantity'];
		$stock =  $item['stock'];
		$remarks =  $item['remarks'];
		$item_imid = $item['id'];

		$query="insert into item_movement_items (id,item_movement_id,item_id,price,selling_price,quantity,stock,remarks)
			values ('$item_movement_items_id','$item_movement_id','$item_id','$price','$selling_price','$quantity','$stock','$remarks')";
		if($this->_custom_query($query)){
			$checker *= 1;
		}else{
			$checker *= 0;
		};
		
		//check if the item is already in the stocks
		$query="select * from store_items where item_id = '$item_id' and branch_id = '".$branch_id."'";
		$store_item = $this->_custom_query($query);

		if($store_item->num_rows()===0)
		{
			$query="select max(id) as id from store_items";
			$store_item_id = intval($this->_custom_query($query)->row()->id)+1;

			$query="insert into store_items (id,item_id,branch_id) values 
				('$store_item_id','$item_id','".$branch_id."')";
			
			if($this->_custom_query($query)){
				$checker *= 1;
			}else{
				$checker *= 0;
			};
		
		}

		$identifiers = $this->get_unique_identifiers($item_imid)->result_array();

		//TAPOS NA SA STORE_ITEMS NEXT IS SA item_unique_identifiers
		if(!empty($identifiers))
		{
			foreach ($identifiers as $value) {
				$identifier = $value['identifier'];
				$identifiers_insertion_query ="insert into item_unique_identifiers (item_movement_items_id,identifier,available) values 
					('$item_movement_items_id','$identifier','1')";
				$this->db->query($identifiers_insertion_query);
			}
		}

		$item_movement_items_id++;
	}

	if($checker == 1){

		$query="update item_movements set is_accepted=1,status='Approved' where id in ('$inbound_id', '$outbound_id')";
		if($this->_custom_query($query)){
			$response = array(
				'success' => true,
				'message' => 'Successfully transferred items.'
			);
		}else{
			$response = array(
				'success' => false,
				'message' => 'Something went wrong.'.$query
			);
		}
	}else{
		$response = array(
			'success' => false,
			'message' => 'Something went wrong. Please contact your administrator.'
		);

	}

	return $response;

}


function get_stock_movement_items_custom($movement_id){

	$query="select a.*, b.item_name, b.item_code,b.item_unit,
			b.item_image, c.unit
			from item_movement_items as a
			left join items as b on a.item_id = b.id
			left join item_units as c on b.item_unit = c.id
			where a.item_movement_id = '$movement_id'";
	return $this->_custom_query($query);
}

function get_unique_identifiers($item_movement_items_id){

	$query="select identifier from item_unique_identifiers where item_movement_items_id = '$item_movement_items_id'";
	return $this->_custom_query($query);
}


}