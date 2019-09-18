<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inventorymovement_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


	//THIS FUNCTION IS EXCLUSIVE TO ADDING ITEMS FROM OUTBOUND->INBOUND USING SCANNER
	function add_item_in_movement_thru_scanning(){
		
		$this->load->model('account/item_model');
		$item_movement_id = $this->input->post('item_movement_id'); // ITEM_MOVEMENT TABLE ID
		$imei = $this->input->post('imei'); //IMEI
		$item_movement = $this->get_item_movement_info($item_movement_id);
		$branch_id = $item_movement['branch_id'];

		$is_imei_available = $this->is_imei_available($imei,$branch_id);
		// print_r($is_imei_available);die();
		if(empty($is_imei_available)){
			return $this->add_item_in_movement_thru_scanning_not_unique($imei,$item_movement_id);
		}else{

			$item_movement_items_id = $is_imei_available['item_movement_items_id'];
			$sql = "SELECT * FROM item_movement_items WHERE id=?";
			$data = array($item_movement_items_id);
			$result = $this->db->query($sql,$data)->row_array();

			$item_id = $result['item_id'];
			$quantity =  1;
			$remarks = $result['remarks'];
			$price = $result['price'];
			$selling_price = $result['selling_price'];
			$supplier = $result['supplier'];
			$incentives = $result['incentives'];
			$date_delivered = $result['date_delivered'];

			$query="select max(id) as id from item_movement_items";
			$id = intval($this->db->query($query)->row()->id)+1;
			
			if($item_movement['from_outbound'] == 0){
		
				// SUBTRACT STOCKS FROM THE OUTBOUNDING BRANCH
				$tbd_item_movement_items_id = $is_imei_available['item_movement_items_id'];
				$sql = "UPDATE item_movement_items set stock=(stock-1) where id='$tbd_item_movement_items_id'";
				$this->db->query($sql);

				//INSERT ITEM MOVEMENTS FOR OUTBOUNDING BRANCH
				$sql = "INSERT INTO item_movement_items (id,item_movement_id,item_id,price,selling_price,quantity,stock,remarks, supplier, incentives, date_delivered)
						VALUES ('$id','$item_movement_id','$item_id','$price','$selling_price','$quantity','0','$remarks', '$supplier', '$incentives', '$date_delivered')";
				$this->db->query($sql);

				//UPDATE IMEI STATUS TO 4 (OUTBOUNDED)
				$tbd_unique_identifier_id = $is_imei_available['id'];
				$sql = "UPDATE item_unique_identifiers set available = '4' where identifier = '$imei' and id = '$tbd_unique_identifier_id'";
				$this->db->query($sql);

				//CREATE NEW IDENTIFIER WITH STATUS 6 (FLOATING)
				$color = $is_imei_available['color'];
				$sql ="INSERT into item_unique_identifiers (item_movement_items_id,identifier,available, color) values ('$id','$imei','6','$color')";
				$this->db->query($sql);

				$response['success'] = true;
			    $response['message'] = 'Successfully added item';
			    $response['environment'] = ENVIRONMENT;

				return $response;
		
			}else{

				$response['success'] = false;
				$response['message'] = 'You cannot add item from this Item Movement.';
				$response['environment'] = ENVIRONMENT;
				return $response;
			}
		}
	}

	function get_item_movement_info($id){
		$sql = "SELECT * from item_movements where id=?";
		$data = array($id);
		$result = $this->db->query($sql,$data);
		return $result->row_array();
	}

	function is_imei_available($uid,$branch_id){

		$query = "SELECT * FROM item_unique_identifiers 
					WHERE item_movement_items_id in 
					(select id from item_movement_items where item_movement_id in 
						(select id from item_movements where branch_id = '$branch_id' and type ='Inbound')
					)
					AND identifier = '$uid' AND (available = '1' or available = '3' or available = '6')";

		$result= $this->db->query($query);	

		return $result->row_array();
	}

	function add_item_in_movement_thru_scanning_not_unique($barcode, $movement_id){
		
		$query ="select max(id) as id from item_movement_items";
		$id = intval($this->db->query($query)->row()->id)+1;

		//GET ITEM INFO AND SEARCH IF MAY AVAILABLE SA OUTBOUNDING BRANCH
		$sql = "SELECT * from items where bar_code=? and has_unique_identifier=0";
		$data = array($barcode);
		$result = $this->db->query($sql,$data)->row_array();

		if(empty($result)){
			$response['success'] = false;
		    $response['message'] = 'Barcode not found.';
		    $response['environment'] = ENVIRONMENT;
		}else{

			$item_movement = $this->get_item_movement_info($movement_id);
			$branch_id = $item_movement['branch_id'];
			$item_id = $result['id'];

			//GET AVAILABLE STOCK COUNT
			$sql = "SELECT *, sum(stock) as stock_count from item_movement_items where item_movement_id 
					in (select id from item_movements where branch_id=? and type = 'Inbound') and item_id =?";
			$data = array($branch_id,$item_id);
			$row = $this->db->query($sql,$data)->row_array();
			$stock_count = $row['stock_count'];
			
			if($stock_count > 0){

				$sql = "INSERT into item_movement_items 
						(id,item_movement_id,item_id,price,selling_price,quantity,stock,remarks,date_delivered,supplier,incentives)
						values (?,?,?,?,?,?,?,?,?,?,?)";
				$data= array($id,$movement_id,$item_id,$row['price'],$row['selling_price'],1,1,$row['remarks'], $row['date_delivered'],$row['supplier'], $row['incentives'] );

				if($this->db->query($sql,$data)){

					$removed = 1;
					$sql ="select * from item_movement_items where item_movement_id in (select id from item_movements where
							 branch_id =? and type = 'Inbound') and item_id = ? order by id";
					$data = array($branch_id,$item_id);
					$result = $this->db->query($sql,$data)->result_array();						
					
					foreach ($result as $value) {

						if($removed>0) {

							$current_stock = intval($value['stock']);
							$row_diff = $current_stock - $removed;

							if($row_diff<0){
								$query="update item_movement_items set stock = '0' where id = '".$value['id']."'";
								$this->db->query($query);
								$removed -= $current_stock;
							}
							else{
								$query="update item_movement_items set stock = '$row_diff' where id = '".$value['id']."'";
								$this->db->query($query);
								$removed = 0;
							}
						}
					}
					$response['success'] = true;
				    $response['message'] = 'Item successfully added';
				    $response['environment'] = ENVIRONMENT;
				}else{
					$response['success'] = false;
				    $response['message'] = 'something went wrong. '.$sql;
				    $response['environment'] = ENVIRONMENT;
				}

			}else{
				$response['success'] = false;
			    $response['message'] = 'Item not found in store';
			    $response['environment'] = ENVIRONMENT;
			}
		}
		return $response;
	}
}

