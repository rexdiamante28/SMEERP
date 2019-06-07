<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Stock_model extends CI_Model {

function __construct() {
	parent::__construct();
}

function get_items()
{
	$query="";
	$search = $this->input->post('search');
	$limit = $this->input->post('record_per_page');

	if($search==='')
	{

		$query="select a.id as store_item_id, a.stock,a.threshold_min, a.threshold_max,
		b.item_code,b.bar_code,b.price,b.item_name,b.generic_name,b.item_description,b.item_image,
		c.category_string, d.unit, e.branch_name from store_items as a left join items as b on a.item_id = b.id
		left join item_categories as c on b.item_category = c.id left join item_units as d
		on b.item_unit = d.id left join branches as e on a.branch_id = e.id where e.id in (".$this->session->branches.")
		order by a.id limit $limit ";
	}
		else
	{
		$query="select a.id as store_item_id, a.stock,a.threshold_min, a.threshold_max,
		b.item_code,b.bar_code,b.price,b.item_name,b.generic_name,b.item_description,b.item_image,
		c.category_string, d.unit, e.branch_name from store_items as a left join items as b on a.item_id = b.id
		left join item_categories as c on b.item_category = c.id left join item_units as d
		on b.item_unit = d.id left join branches as e on a.branch_id = e.id 
		where (b.item_code like '%$search%' or b.price like '%$search%' or b.item_name like '%$search%' or
		b.generic_name like '%$search%' or b.item_description like '%$search%' or c.category_string like '%$search%'
		or d.unit like '%$search%' or e.branch_name like '%$search%') and e.id in (".$this->session->branches.")
		order by a.id limit $limit ";
	}


	return $this->_custom_query($query);
}


function get_all_stocks($branch_id)
{
	$query="select a.id as store_item_id, a.stock,a.threshold_min, a.threshold_max,
	b.item_code,b.bar_code,b.price,b.item_name,b.generic_name,b.item_description,b.item_image,
	c.category_string, d.unit, e.branch_name from store_items as a left join items as b on a.item_id = b.id
	left join item_categories as c on b.item_category = c.id left join item_units as d
	on b.item_unit = d.id left join branches as e on a.branch_id = e.id where e.id = '$branch_id'
	order by a.id
	";

	return $this->_custom_query($query);
}

function add_item()
{
	$query="select max(id) as id from items";

	$id = intval($this->_custom_query($query)->row()->id)+1;
	$item_code = $this->input->post('item_code');
	$bar_code = $this->input->post('bar_code');
	$item_name = $this->input->post('item_name');
	$price = $this->input->post('price');
	$generic_name = $this->input->post('generic_name');
	$item_description = $this->input->post('item_description');
	$image_name = $this->input->post('image_name');
	$item_category = $this->input->post('item_category');
	$item_unit = $this->input->post('item_unit');
	$status = $this->input->post('status');

	if($image_name === '')
	{
		$image_name = 'default.png';
	}


	$query = "insert into items (id,item_code,bar_code,item_name,price,generic_name,item_description,
	item_image,item_category,item_unit,status) values 
	('$id','$item_code','$bar_code','$item_name','$price','$generic_name','$item_description','$image_name',
	'$item_category','$item_unit','$status')";

	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = $id;
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	
}

function update_item()
{
	$id = $this->input->post('id');
	$min = $this->input->post('threshold_min');
	$max = $this->input->post('threshold_max');

	$query="select a.stock,b.item_name, c.branch_name, d.unit from store_items as a left join
	items as b on a.item_id = b.id left join branches as c on a.branch_id = c.id left join item_units
	as d on b.item_unit = d.id
	 where a.id = '$id'";

	$row = $this->_custom_query($query)->row();

	$query="update store_items set threshold_min = '$min', threshold_max = '$max' where id = '$id'";

	$query1 = "select first_name, last_name from users where id = '".$this->session->user_id."'";
	$me = $this->_custom_query($query1)->row();
	
	if($this->_custom_query($query))
	{
		$notification = $me->first_name." ".$me->last_name." changed ".$row->item_name."\'s minimum and maximun stock threshold. 
		$min and $max respectively.";

		$this->notification_model->notify($notification,"Notification Inventory");
		$this->notification_model->notify($notification,"Notification Users");

		if(floatval($row->stock)<floatval($min))
		{
			$notification = $row->item_name." of ".$row->branch_name." is running out. Only ".$row->stock." ".$row->unit."/s remaining.";
			$this->notification_model->notify($notification,"Notification Inventory");
		}

		if(floatval($row->stock)>floatval($max))
		{
			$notification = $row->item_name." of ".$row->branch_name." is over stocked. ".$row->stock." ".$row->unit."/s remaining.";
			$this->notification_model->notify($notification,"Notification Inventory");
		}



		$response['success'] = true;
	    $response['message'] = 'update successful';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}


function get_item($id)
{
	$query="select a.id as store_item_id, a.stock,a.threshold_min, a.threshold_max, b.has_unique_identifier,
	b.item_code,b.bar_code,b.price,b.item_name,b.generic_name,b.item_description,b.item_image,
	c.category_string, d.unit, e.branch_name, 

	(select sum(stock) from item_movement_items where item_movement_id in (select id from item_movements where branch_id = e.id and type = 'Inbound') and item_id = b.id) as stock_count

	 from store_items as a left join items as b on a.item_id = b.id
	left join item_categories as c on b.item_category = c.id left join item_units as d
	on b.item_unit = d.id left join branches as e on a.branch_id = e.id where a.id = '$id'";
	return $this->_custom_query($query);
}

function remove_order($id)
{
	$query="delete from temp_orders where id = '$id' ";
	
	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = 'order successfully removed';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	else
	{
		$response['success'] = false;
	    $response['message'] = 'cannot remove order';
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
}



function _custom_query($mysql_query) {
	$result = $this->db->query($mysql_query);
	return $result;
}

function get_store_items()
{
	$query="";
	$search = $this->input->post('search');
	$branch_id = $this->session->branch_id;

	if($search==='')
	{
/*
		$query="select a.id as store_item_id, a.stock,a.threshold_min, a.threshold_max,
		b.item_code,b.bar_code,b.price,b.item_name,b.generic_name,b.item_description,b.item_image,
		c.category_string, d.unit, e.branch_name from store_items as a left join items as b on a.item_id = b.id
		left join item_categories as c on b.item_category = c.id left join item_units as d
		on b.item_unit = d.id left join branches as e on a.branch_id = e.id
		where a.branch_id = '$branch_id' order by a.id limit 1000 ";*/

		$query = "
			select a.id as item_movement_item_id, a.price,a.selling_price,a.quantity, a.stock, b.item_code, b.item_name, b.has_unique_identifier, d.id as store_item_id, d.threshold_min, d.threshold_max, b.item_code,b.bar_code,b.item_name,b.generic_name,b.item_description,b.item_image, e.category_string, f.unit, g.branch_name from item_movement_items as a left join items as b on a.item_id = b.id left join item_movements as c on a.item_movement_id = c.id left join store_items as d on b.id = d.item_id left join item_categories as e on b.item_category = e.id left join item_units as f on b.item_unit = f.id left join branches as g on d.branch_id = g.id where c.branch_id = '$branch_id' and c.type = 'Inbound' and a.stock > 0
		";
	}
		else
	{
		/*$query="select a.id as store_item_id, a.stock,a.threshold_min, a.threshold_max,
		b.item_code,b.bar_code,b.price,b.item_name,b.generic_name,b.item_description,b.item_image,
		c.category_string, d.unit, e.branch_name from store_items as a left join items as b on a.item_id = b.id
		left join item_categories as c on b.item_category = c.id left join item_units as d
		on b.item_unit = d.id left join branches as e on a.branch_id = e.id 
		where a.branch_id = '$branch_id' and (b.item_code like '%$search%' or b.price like '%$search%' or b.item_name like '%$search%' or
		b.generic_name like '%$search%' or b.item_description like '%$search%' or c.category_string like '%$search%'
		or d.unit like '%$search%' or e.branch_name like '%$search%')
		order by a.id limit 1000 ";*/

		$query = "
			select a.id as item_movement_id, a.price,a.selling_price,a.quantity, a.stock, b.item_code, b.item_name,b.has_unique_identifier, d.id as store_item_id, d.threshold_min, d.threshold_max, b.item_code,b.bar_code,b.item_name,b.generic_name,b.item_description,b.item_image, e.category_string, f.unit, g.branch_name from item_movement_items as a left join items as b on a.item_id = b.id left join item_movements as c on a.item_movement_id = c.id left join store_items as d on b.id = d.item_id left join item_categories as e on b.item_category = e.id left join item_units as f on b.item_unit = f.id left join branches as g on d.branch_id = g.id where c.branch_id = '$branch_id' and c.type = 'Inbound' and a.stock > 0

			and

			(b.item_code like '%$search%' or a.selling_price like '%$search%' or b.item_name like '%$search%' or
			b.generic_name like '%$search%' or b.item_description like '%$search%' or e.category_string like '%$search%'
			or f.unit like '%$search%' or g.branch_name like '%$search%')


		";
	}


	return $this->_custom_query($query);
}

function get_temp_orders()
{
	$user_id = $this->session->user_id;
	$terminal_id = $this->session->terminal_id;

	$query="select a.*, b.id as item_movement_item_id , c.item_code, d.unit,c.item_name
	from temp_orders as a
	left join item_movement_items as b on a.item_movement_item_id = b.id left join items as c on 
	b.item_id = c.id left join item_units as d on c.item_unit = d.id
	 where terminal_id  = '$terminal_id' and user_id = '$user_id' ";
	return $this->_custom_query($query);
}


function get_transaction($id)
{
	$query="select a.or_number,a.total,a.amount_due,a.tax, a.balance, a.due_date, a.payment_change, a.date_time,
	b.terminal_code,b.terminal_number, c.branch_name, d.first_name, d.last_name from
	transactions as a left join terminals as b on a.terminal_id = b.id left join 
	branches as c on b.branch_id = c.id left join users as d on a.user_id = d.id where
	a.id = '$id'";
	return $this->_custom_query($query);
}


function get_transaction_items($id)
{
	$query="select a.price,a.quantity,a.discount,a.row_total,a.row_total_discount, b.id as just_ignore, c.item_name,d.unit from transaction_items as a left join item_movement_items as b on a.item_movement_item_id = b.id left join items as c on b.item_id = c.id left join item_units as d on c.item_unit = d.id where a.transaction_id = '$id'";
	return $this->_custom_query($query);
}

function pay_order()
{
	$user_id = $this->session->user_id;
	$terminal_id = $this->session->terminal_id;

	$query="select max(id) as id from transactions";



	$id = intval($this->_custom_query($query)->row()->id)+1;
	$or_number = str_pad($id, 8, "0", STR_PAD_LEFT);
	$total = $this->input->post('total');
	$amount_due = $this->input->post('amount_due');
	$change = $this->input->post('change');
	$tax = $this->input->post('tax');
	$balance = $this->input->post('amount_balance');
	$due_date = $this->input->post('balance_due_date');
	$remarks = $this->input->post('remarks');

	if(floatval($total)>0.00)
	{
		$query="insert into transactions (id,user_id,terminal_id,or_number,total,amount_due,balance,due_date, remarks, tax,capital,revenue,payment_change,date_time)
		values ('$id','$user_id','$terminal_id','$or_number','$total','$amount_due','$balance','$due_date','$remarks','$tax','0','0','$change',(select now()))";

		if($this->_custom_query($query))
		{
			$query="select * from temp_orders where terminal_id  = '$terminal_id' and user_id = '$user_id'";

			$notification = $this->session->first_name." ".$this->session->last_name." sold new items with or number  ".$or_number.". ";
			$this->notification_model->notify($notification,"Notification Sales");
			$this->notification_model->notify($notification,"Notification Users");


			$orders = $this->_custom_query($query)->result();


			foreach ($orders as $value)
			{
				$query="select max(id) as id from transaction_items";
				$transaction_item_id = intval($this->_custom_query($query)->row()->id)+1;
				$query="insert into transaction_items (id, transaction_id, item_movement_item_id,unique_id,vat,price,quantity,discount,row_total,row_total_discount)
				values ('$transaction_item_id','$id','".$value->item_movement_item_id."','".$value->unique_id."','".$value->vat."','".$value->price."',
				'".$value->quantity."','".$value->discount."','".$value->row_total."','".$value->row_total_discount."')";
				$this->_custom_query($query);

				$query="update item_movement_items set stock = (stock - ".$value->quantity.") where id = '".$value->item_movement_item_id."'";
				$this->_custom_query($query);


				$query = "update item_unique_identifiers set available = '2' where identifier = '".$value->unique_id."' and available = '1'";
				$this->db->query($query);


				$query="select * from item_movement_items where id = '".$value->item_movement_item_id."'";

				$result = $this->db->query($query)->row_array();

				$cur_capital = doubleval($value->quantity) * doubleval($result['price']); 

				$cur_revenue = (doubleval($value->quantity) * doubleval($result['selling_price'])) - ($cur_capital + doubleval($value->row_total_discount));

				$query = "update transactions set capital = capital + $cur_capital, revenue = revenue + $cur_revenue where id = '$id'"; 

				$this->db->query($query);

/*
				$query="select a.stock, a.threshold_min, b.item_name, c.branch_name, d.unit from store_items as a left join
				items as b on a.item_id = b.id left join branches as c on a.branch_id = c.id left join item_units
				as d on b.item_unit = d.id
				 where a.id = '".$value->store_item_id."'";*/

				$query = "select a.*, b.item_name,c.branch_name,d.unit, (select sum(stock) from item_movement_items where item_movement_id in (select id from item_movements where branch_id = (select branch_id from terminals where id = '".$value->terminal_id."') and type = 'Inbound') and item_id = (select item_id from item_movement_items where id = '".$value->item_movement_item_id."') ) as stock_count from store_items as a left join items as b on a.item_id = b.id left JOIN branches as c on a.branch_id = c.id 
					left join item_units as d on b.item_unit = d.id
					where item_id = (select item_id from item_movement_items where id = '".$value->item_movement_item_id."') and branch_id = (select branch_id from terminals where id = '".$value->terminal_id."')";

				$row = $this->_custom_query($query)->row();

				if(floatval($row->stock)<floatval($row->threshold_min))
				{
					$notification = $row->item_name." of ".$row->branch_name." is running out. Only ".$row->stock." ".$row->unit."/s remaining.";
					$this->notification_model->notify($notification,"Notification Inventory");
				}


			}

			$query="delete  from temp_orders where terminal_id  = '$terminal_id' and user_id = '$user_id'";
			$this->_custom_query($query);

			$response['success'] = true;
		    $response['message'] = $id;
		    $response['environment'] = ENVIRONMENT;
			return $response;


		}
		else
		{
			$response['success'] = false;
		    $response['message'] = 'error:';
		    $response['environment'] = ENVIRONMENT;

			return $response;
		}
	}
	else
	{
		$response['success'] = false;
		$response['message'] = 'Empty transactions are not allowed.';
		$response['environment'] = ENVIRONMENT;

		return $response;
	}
}

function add_order($unique = false)
{
	$user_id = $this->session->user_id;
	$terminal_id = $this->session->terminal_id;
	$unique_id = "";
	if($unique==false)
	{
		$item_movement_item_id = $this->input->post('item_movement_item_id');
		$quantity = $this->input->post('quantity');
	}
	else
	{
		$quantity = 1;
		$unique_id = $this->input->post('unique_id');

		$query="select * from temp_orders where unique_id = '$unique_id' ";
		$result = $this->db->query($query);

		if($result->num_rows()>0)
		{
			$response['success'] = false;
			$response['message'] = "Item has already been ordered.";

			return $response;

			die();
		}

		$query="select * from item_unique_identifiers where identifier = '$unique_id' and available = '1' ";
		$result = $this->db->query($query);

		if($result->num_rows()<1)
		{
			$response['success'] = false;
			$response['message'] = "Invalid UID";

			return $response;

			die();
		}
		else
		{
			$row = $result->row_array();
			$item_movement_item_id = $row['item_movement_items_id'];
		}
	}
	$discount = $this->input->post('discount');

	if($discount==='')
	{
		$discount=0.00;
	}

	//check if the stocks are sufficient

	$query="select  a.stock, a.id as item_movement_item_id, a.selling_price, b.item_code from item_movement_items as a 
	left join items as b on a.item_id = b.id where a.id = '$item_movement_item_id'";

	$result = $this->_custom_query($query)->row();

	$query = "select sum(quantity) as total_order from temp_orders where item_movement_item_id = '$item_movement_item_id' and terminal_id 
	= '$terminal_id' and user_id = '$user_id' ";

	$total_order = floatval($this->_custom_query($query)->row()->total_order);
	$quantity = floatval($quantity);
	$remaining_stock = floatval($result->stock);

	if(($quantity+$total_order)>$remaining_stock)
	{
		$response['success'] = false;
	    if($total_order>0.00)
	    {
	    	$response['message'] = "Insufficient stocks. Only $remaining_stock available. $total_order is already ordered.";
	    }
	    else
	    {
	    	$response['message'] = "Insufficient stocks. Only $remaining_stock available.";
	    }
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	else
	{
		//check if the item is in the order already. If it is, and the discount is the same, just add the quantity

		$query="select * from temp_orders where item_movement_item_id = '$item_movement_item_id' and terminal_id 
		= '$terminal_id' and user_id = '$user_id' and discount = '$discount'";
		$result2 = $this->_custom_query($query);

		if($result2->num_rows()===0)
		{
			$query="select max(id) as id from temp_orders";
			$id = intval($this->_custom_query($query)->row()->id)+1;

			//compute row total
			$c_price =  doubleval(floatval($result->selling_price));
			$c_discount = doubleval(floatval($discount));
			$c_quantity = doubleval(floatval($quantity));


			$row_total = $c_quantity * $c_price;
			$row_total = $row_total - ($row_total * ($c_discount/100));

			$row_total_discount = $c_quantity * $c_price;
			$row_total_discount = $row_total_discount * ($c_discount/100);
			

			$query="insert into temp_orders (id,terminal_id,user_id,item_movement_item_id,unique_id,vat,price,quantity,discount,row_total,row_total_discount)
			values ('$id','$terminal_id','$user_id','$item_movement_item_id','$unique_id','12.00','".$result->selling_price."','$quantity','$discount','$row_total',
			'$row_total_discount')";

			if($this->_custom_query($query))
			{
				$response['success'] = true;
			    $response['message'] = 'Order added';
			    $response['environment'] = ENVIRONMENT;

				return $response;
			}
			else
			{
				$response['success'] = false;
			    $response['message'] = 'error:';
			    $response['environment'] = ENVIRONMENT;

				return $response;
			}
		}
		else
		{
			$order_row = $result2->row();

			$t_quantity = floatval($order_row->quantity) + $quantity;
			$t_price = floatval($result->selling_price);
			$t_discount = floatval($discount);

			$row_total = $t_quantity * $t_price;
			$row_total = $row_total - ($row_total * ($t_discount/100));

			$row_total_discount = $t_quantity * $t_price;
			$row_total_discount = $row_total_discount * ($t_discount/100);


			$query="update temp_orders set quantity = '$t_quantity', row_total = '$row_total', row_total_discount = '$row_total_discount' where
			id = '".$order_row->id."'";

			if($this->_custom_query($query))
			{
				$response['success'] = true;
			    $response['message'] = 'Order added';
			    $response['environment'] = ENVIRONMENT;

				return $response;
			}
			else
			{
				$response['success'] = false;
			    $response['message'] = 'error:';
			    $response['environment'] = ENVIRONMENT;

				return $response;
			}


		}

	}

}

}


