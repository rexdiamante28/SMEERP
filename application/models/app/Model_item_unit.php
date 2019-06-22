<?php 
class Model_item_unit extends CI_Model {

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function create($company,$name,$description)
	{	

		$query="select * from erp_item_units where name = ? and company = ? and status = 1";

		$args = array(
			$name,
			$company
		);

		$result = $this->db->query($query,$args);

		if($result->num_rows()>0)
		{
			$response = array(
				'success' => false,
				'message' => '"'.$name.'" already exists',
				'id' => ''
			);
		}
		else
		{
			$query="insert into erp_item_units (company,name,description,created,updated,status)
			values (?,?,?,?,?,?)";

			$args = array(
				$company,
				$name,
				$description,
				date('Y-m-d H:i:s'),
				date('Y-m-d H:i:s'),
				1
			);

			if($this->db->query($query,$args))
			{
				$response = array(
					'success' => true,
					'message' => 'item unit added',
					'id' => en_dec('en',$this->db->insert_id())
				);
			}
			else
			{
				$response = array(
					'success' => false,
					'message' => 'Unable to add item unit. Please try again.'
				);
			}
		}

		return $response;
	}

	public function table_data($read_args)
	{
		$columns = array(
            0 => 'b.name',
            1 => 'a.name',
            2 => 'a.description'
        );


		$requestData = $_REQUEST;
		$totalData = 0;
		$totalFiltered = 0;

		$query="select a.id, a.name, a.description, b.name as company from erp_item_units as a left join erp_companies as b on a.company = b.id
		where a.status = 1 ";

		if($read_args['search_string']!='')
		{
			$query.=" and ( a.name like '%".$read_args['search_string']."%' or a.description like '%".$read_args['search_string']."%' or 
			b.name like '%".$read_args['search_string']."%' )";
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
		$query="select * from erp_item_units where id = ? ";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($company,$name,$description,$id)
	{
		$query="select * from erp_item_units where name = ? and company = ? and status = 1 and id != ?";

		$args = array(
			$name,
			$company,
			$id
		);

		$result = $this->db->query($query,$args);

		if($result->num_rows()>0)
		{
			$response = array(
				'success' => false,
				'message' => '"'.$name.'" already exists',
				'id' => ''
			);
		}
		else
		{

			$query="update erp_item_units set company = ?, name = ?, description = ?, updated = ?
			 where id = ?";

			$args = array(
				$company,
				$name,
				$description,
				date('Y-m-d H:i:s'),
				$id
			);

			if($this->db->query($query,$args))
			{
				$response = array(
					'success' => true,
					'message' => 'item unit updated',
					'id' => en_dec('en',$id)
				);
			}
			else
			{
				$response = array(
					'success' => false,
					'message' => 'Unable to update item unit. Please try again.'
				);
			}
		}

		return $response;
	}

	public function delete($id)
	{
		$query="update erp_item_units set status = 0 where id = ?";
		
		if($this->db->query($query,$id))
		{
			$response = array(
				'status' => true,
				'message' => "item unit deleted."
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


	public function get_company_item_units($id)
	{
		$query="select * from erp_item_units where status = 1 and company = ?";

		return $this->db->query($query,$id);
	}	


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////Additional functions end////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}