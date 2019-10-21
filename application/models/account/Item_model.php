<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Item_model extends CI_Model {

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
			$query="SELECT a.id as item_id, a.item_code, a.item_name, a.bar_code,
			a.item_image, a.price, a.status, b.id as item_units_id,
			b.unit, c.id as category_id, c.category_string
			from items as a left join item_units as b on 
			a.item_unit = b.id left join item_categories as c
			on a.item_category = c.id
			order by a.id limit $limit";
		}
			else
		{
			$query="SELECT a.id as item_id, a.item_code, a.item_name, a.bar_code,
			a.item_image, a.price, a.status, b.id as item_units_id,
			b.unit, c.id as category_id, c.category_string
			from items as a left join item_units as b on 
			a.item_unit = b.id left join item_categories as c
			on a.item_category = c.id where
			a.item_code like '%$search%' or a.item_name like '%$search%'
			or b.unit like '%$search%' or c.category_string like '%$search%'
			order by a.id limit $limit";
		}


		return $this->_custom_query($query);
	}

	function add_item()
	{
		$query="SELECT max(id) as id from items";

		$id = intval($this->_custom_query($query)->row()->id)+1;
		$item_code = $this->generate_itemno();
		$has_unique_identifier = $this->input->post('unique_identifier') !== null ? 1 : 0;
		$bar_code = $this->generate_barcode();
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


		$query = "INSERT into items (id,item_code,has_unique_identifier,bar_code,item_name,price,generic_name,item_description,
		item_image,item_category,item_unit,status) values 
		('$id','$item_code','$has_unique_identifier','$bar_code','$item_name','$price','$generic_name','$item_description','$image_name',
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
		// $item_code = $this->input->post('item_code');
		$has_unique_identifier = $this->input->post('unique_identifier') !== null ? 1 : 0;
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

		$query="UPDATE items set has_unique_identifier = '$has_unique_identifier', bar_code = '$bar_code', item_name = '$item_name',
			generic_name = '$generic_name', item_description = '$item_description', item_image = '$image_name',
			item_category = '$item_category', item_unit = '$item_unit', status = '$status', price = '$price'
			where id = '$id'";
		
		if($this->_custom_query($query))
		{
			$response['success'] = true;
		    $response['message'] = 'update successful';
		    $response['environment'] = ENVIRONMENT;

			return $response;
		}
	}


	function get_item($id)
	{
		$query="select * from items where id = '$id' ";
		return $this->_custom_query($query);
	}

	function remove_item($id)
	{
		$query="delete from items where id = '$id' ";
		
		if($this->_custom_query($query))
		{
			$response['success'] = true;
		    $response['message'] = 'Item successfully removed';
		    $response['environment'] = ENVIRONMENT;

			return $response;
		}
	}


 
	function getmax_itemno(){

		$sql = "SELECT max(id) as item_code FROM items";
		return $this->db->query($sql);
	}

	function generate_itemno(){

        //get maxno of onlineshopso_no if 1st insertion default to '000000000'
        $max_item_no = $this->getmax_itemno();

        if ($max_item_no->num_rows() > 0){
            $item_no = $max_item_no->row()->item_code;

            if ($item_no == null || $item_no == "" || (int)$item_no < 0){
                $item_no = '000000001';
            }else{
			    try {
                	$item_no = str_pad($item_no + 1, 9, 0, STR_PAD_LEFT);
			    } catch (Exception $e) {
			        $item_no = '000000001';
			    }
                
            }
        }else{
            //if the first time insertion
            $item_no = '000000001';
        }
      
        $item_no = "ASS_".$item_no; //to add AO in the first 6 character

        return $item_no;
    }

   	function generate_barcode(){

		$barcode = uniqid();
		$sql = "SELECT bar_code from items where bar_code='$barcode'";

		if($this->db->query($sql)->num_rows() > 0){
			$this->generate_barcode();
		}else{
			return strtoupper($barcode);
		}
	}


	function _custom_query($mysql_query) {
		$result = $this->db->query($mysql_query);
		return $result;
	}


	public function validate_barcode($barcode='')
	{
		$query = "select * from items where bar_code = ? ";

		$result = $this->db->query($query,$barcode);

		if($result->num_rows()>0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

}