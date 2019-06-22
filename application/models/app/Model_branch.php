<?php 
class Model_branch extends CI_Model {

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////Default functions start////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function create($company,$name,$description,$address)
	{
		$query="insert into erp_branches (company,branch,description,address,created,updated,status)
		values (?,?,?,?,?,?,?)";

		$args = array(
			$company,
			$name,
			$description,
			$address,
			date('Y-m-d H:i:s'),
			date('Y-m-d H:i:s'),
			1
		);

		if($this->db->query($query,$args))
		{
			$response = array(
				'success' => true,
				'message' => 'Company added',
				'id' => en_dec('en',$this->db->insert_id())
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to add company. Please try again.'
			);
		}

		return $response;
	}

	public function table_data($read_args)
	{
		$columns = array(
            0 => 'company',
            1 => 'branch',
        );


		$requestData = $_REQUEST;
		$totalData = 0;
		$totalFiltered = 0;

		$query="select a.*, b.name as company_name from erp_branches as a left join erp_companies as b on a.company = b.id where a.status = 1 ";

		if($read_args['search_string']!='')
		{
			$query.=" and ( a.branch like '%".$read_args['search_string']."%' or a.description like '%".$read_args['search_string']."%' or 
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
		$query="select * from erp_branches where id = ? ";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($company,$name,$description,$address,$id)
	{
		$query="update erp_branches set company = ?, branch =?,  description = ?, address = ?, updated = ?
		 where id = ?";

		$args = array(
			$company,
			$name,
			$description,
			$address,
			date('Y-m-d H:i:s'),
			$id
		);

		if($this->db->query($query,$args))
		{
			$response = array(
				'success' => true,
				'message' => 'Branch updated',
				'id' => en_dec('en',$id)
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to update branch. Please try again.'
			);
		}

		return $response;
	}

	public function delete($id)
	{
		$query="update erp_branches set status = 0 where id = ?";
		
		if($this->db->query($query,$id))
		{
			$response = array(
				'status' => true,
				'message' => "Branch deleted."
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
		$query="select * from erp_companies where status = 1";

		return $this->db->query($query)->result_array();
	}

	public function get_active_locations($branch_id)
	{
		$query="select * from erp_storage_locations where branch = ? and status = 1";

		return $this->db->query($query,$branch_id);
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////Additional functions end////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}