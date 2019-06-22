<?php 
class Model_item extends CI_Model {

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	public function create($item_company,$item_category,$item_unit,$item_code,$item_name,$item_image,$item_unique_identifier,$item_generic_name,$item_description)
	{	

		$query="insert into erp_items (company,item_category,item_unit,item_code,has_unique_identifier,item_name,generic_name,description,image,created,updated,status)
		values (?,?,?,?,?,?,?,?,?,?,?,?)";

		$args = array(
			$item_company,
			$item_category,
			$item_unit,
			$item_code,
			$item_unique_identifier,
			$item_name,
			$item_generic_name,
			$item_description,
			$item_image,
			date('Y-m-d H:i:s'),
			date('Y-m-d H:i:s'),
			1
		);

		if($this->db->query($query,$args))
		{
			$response = array(
				'success' => true,
				'message' => 'item added',
				'id' => en_dec('en',$this->db->insert_id())
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to add item. Please try again.'
			);
		}

		return $response;
	}

	public function table_data($read_args)
	{
		$columns = array(
            0 => 'a.company',
            1 => 'a.item_category',
            3 => 'a.item_unit',
            4 => 'a.item_code',
            5 => 'a.item_name'
        );


		$requestData = $_REQUEST;
		$totalData = 0;
		$totalFiltered = 0;

		$query = "select a.*,b.name as company_name, c.category_string as category_name, d.name as item_unit_name from erp_items as a left join erp_companies as b on a.company = b.id
		 left join erp_item_categories as c on a.item_category = c.id left join erp_item_units as d on a.item_unit = d.id where a.status = 1
		";

		if($read_args['search_string']!='')
		{
			$query.=" and ( a.item_code like '%".$read_args['search_string']."%' or a.item_name like '%".$read_args['search_string']."%' or 
			b.generic_name like '%".$read_args['search_string']."%' or a.description like '%".$read_args['search_string']."%' or b.name like '%".$read_args['search_string']."%'
			or c.name like '%".$read_args['search_string']."%' or d.name like '%".$read_args['search_string']."%')";
		}

		$totalData = $this->db->query($query)->num_rows();

		$subquery = $query . " ORDER BY " . $columns[$read_args['order_column']] . " " . $read_args['order_direction'] . "";

		$result1 = $this->db->query($subquery);

		$totalFiltered = $result1->num_rows();

		$query .= " ORDER BY " . $columns[$read_args['order_column']] . " " . $read_args['order_direction'] . " LIMIT " . $read_args['start'] . ", " . $read_args['end'] . " ";


		$result = $this->db->query($query);

		$json_data = array(
			"recordsTotal"    => intval($totalData),  // total number of records
			"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"result"          => $result->result_array()   // total data array
		);
		
		return $json_data;
	}

	public function read($id)
	{
		$query="select * from erp_items where id = ? ";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($company,$branch,$parent,$name,$id)
	{
		$location_string = "";

		if($parent!="0")
		{
			$location_string = $this->read($parent)['location_string'];
		}

		if($location_string!="")
		{
			$location_string = $location_string.' / '.$name;
		}
		else
		{
			$location_string = $name;
		}

		$query="update erp_items set branch = ?, parent_location = ?, name = ?, location_string = ?, updated = ?
		 where id = ?";

		$args = array(
			$branch,
			$parent,
			$name,
			$location_string,
			date('Y-m-d H:i:s'),
			$id
		);

		if($this->db->query($query,$args))
		{
			$response = array(
				'success' => true,
				'message' => 'item category updated',
				'id' => en_dec('en',$id)
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to update item category. Please try again.'
			);
		}

		return $response;
	}

	public function delete($id)
	{
		$query="update erp_items set status = 0 where id = ?";
		
		if($this->db->query($query,$id))
		{
			$response = array(
				'status' => true,
				'message' => "item category deleted."
			);

			return $response;
		}
		else
		{
			$response = array(
				'status' => false,
				'message' => "Something went wrong. Please try again."
			);

			return $response;
		}
		
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////Default functions end//////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////Additional functions start//////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function get_company_categories($id)
	{
		$query="select * from erp_item_categories where status = 1 and company = ?";

		return $this->db->query($query,$id);
	}	

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////Additional functions end////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}