<?php 
class Model_storage_location extends CI_Model {

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function create($company,$branch,$parent,$name)
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

		$query="insert into erp_storage_locations (branch,name,parent_location,location_string,created,updated,status)
		values (?,?,?,?,?,?,?)";

		$args = array(
			$branch,
			$name,
			$parent,
			$location_string,
			date('Y-m-d H:i:s'),
			date('Y-m-d H:i:s'),
			1
		);

		if($this->db->query($query,$args))
		{
			$response = array(
				'success' => true,
				'message' => 'storage location added',
				'id' => en_dec('en',$this->db->insert_id())
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to add storage location. Please try again.'
			);
		}

		return $response;
	}

	public function table_data($read_args)
	{
		$columns = array(
            0 => 'c.name',
            1 => 'b.branch',
            3 => 'c.name'
        );


		$requestData = $_REQUEST;
		$totalData = 0;
		$totalFiltered = 0;

		$query="select a.id, a.location_string, a.name as storage_name, b.branch as branch_name, c.name as company_name from erp_storage_locations as a left join 
		erp_branches as b on a.branch = b.id left join erp_companies as c on b.company = c.id
		where a.status = 1 ";

		if($read_args['search_string']!='')
		{
			$query.=" and ( a.name like '%".$read_args['search_string']."%' or a.location_string like '%".$read_args['search_string']."%' or 
			b.branch like '%".$read_args['search_string']."%' or c.name like '%".$read_args['search_string']."%')";
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
		$query="select a.*, b.company as company from erp_storage_locations as a left join erp_branches as b on a.branch = b.id where a.id = ? ";

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

		$query="update erp_storage_locations set branch = ?, parent_location = ?, name = ?, location_string = ?, updated = ?
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
		$query="update erp_storage_locations set status = 0 where id = ?";
		
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