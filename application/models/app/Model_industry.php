<?php 
class Model_industry extends CI_Model {

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function create($name,$description)
	{
		$query="insert into erp_industries (name,description,created,updated,status)
		values (?,?,?,?,?)";

		$args = array(
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
				'message' => 'Industry added',
				'id' => en_dec('en',$this->db->insert_id())
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to add industry. Please try again.'
			);
		}

		return $response;
	}

	public function table_data($read_args)
	{
		$columns = array(
            0 => 'name',
            1 => 'description'
        );


		$requestData = $_REQUEST;
		$totalData = 0;
		$totalFiltered = 0;

		$query="select * from erp_industries where status = 1 ";

		if($read_args['search_string']!='')
		{
			$query.=" and (name like '%".$read_args['search_string']."%' or description like '%".$read_args['search_string']."%')";
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
		$query="select * from erp_industries where id = ? ";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($name,$description,$id)
	{
		$query="update erp_industries set name = ?, description = ?, updated = ?
		 where id = ?";

		$args = array(
			$name,
			$description,
			date('Y-m-d H:i:s'),
			$id
		);

		if($this->db->query($query,$args))
		{
			$response = array(
				'success' => true,
				'message' => 'Industry updated',
				'id' => en_dec('en',$id)
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to update industry. Please try again.'
			);
		}

		return $response;
	}

	public function delete($id)
	{
		$query="update erp_industries set status = 0 where id = ?";
		
		if($this->db->query($query,$id))
		{
			$response = array(
				'status' => true,
				'message' => "Industry deleted."
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

	public function get_active()
	{
		$query="select * from erp_industries where status = 1";

		return $this->db->query($query)->result_array();
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////Additional functions end////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}