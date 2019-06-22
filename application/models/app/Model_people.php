<?php 
class Model_people extends CI_Model {

		public function table_data($read_args){

			$columns = array(
	            0 => 'fname',
	            1 => 'mname',
	            2 => 'lanme',
	            3 => 'contact_number',
	            4 => 'email',
	            5 => 'address'
	        );


			$requestData = $_REQUEST;
			$totalData = 0;
			$totalFiltered = 0;

			$query="SELECT *, ppl.id pid FROM `people` as ppl
					LEFT JOIN users as usr ON ppl.user_id = usr.id 
					WHERE usr.status = 1";

			if($read_args['search_string']!='')
			{
				$query.=" and ( a.name like '%".$read_args['search_string']."%' or a.description like '%".$read_args['search_string']."%') or 
				b.name like '%".$read_args['search_string']."%'";
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

		public function read($id) {
			$query = "SELECT * FROM `people` WHERE id = ?";

			return $this->db->query($query, $id)->row_array();
		}

		public function update($args, $id)
	{
		$query="UPDATE `people` 
				SET fname = ?, mname = ?, lname = ?, contact_number = ?, address =?, updated = ?
		 		WHERE id = ?";

		$args = array(
			$args['people_fname'],
			$args['people_mname'],
			$args['people_lname'],
			$args['people_contact'],
			$args['people_address'],
			date('Y-m-d H:i:s'),
			$id
		);

		if($this->db->query($query,$args))
		{
			$response = array(
				'success' => true,
				'message' => 'Info has been updated.',
				'id' => en_dec('en',$id)
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to update info. Please try again.'
			);
		}

		return $response;
	}


	public function create($args)
	{
		$query="INSERT INTO `people` (fname, mname, lname, contact_number, address)
				VALUES (?, ?, ?, ?, ?)";

		$args = array(
			$args['people_fname'],
			$args['people_mname'],
			$args['people_lname'],
			$args['people_contact'],
			$args['people_address']
		);

		if($this->db->query($query,$args))
		{
			$response = array(
				'success' => true,
				'message' => 'People added',
				'id' => en_dec('en',$this->db->insert_id())
			);
		}
		else
		{
			$response = array(
				'success' => false,
				'message' => 'Unable to add People. Please try again.'
			);
		}

		return $response;
	}

	public function user(){
		$query = "SELECT username, id FROM users ";

		return $this->db->query($query)->result_array();
	}

}
