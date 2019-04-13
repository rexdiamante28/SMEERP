<?php 
class Model_users extends CI_Model {

	public function users_list_table($searchstring)
	{
		$requestData = $_REQUEST; 
		$totalData = 0;
		$totalFiltered = 0;

		$columns = array( 
			// datatable column index  => database column name for sorting
				0 => 'id',
				1 => 'username'
		);


		$query="select * from sys_users where id > 0";

		if($searchstring!='')
		{
			$query.=" and username like '%".$searchstring."%' ";

			$totalData = $this->db->query($query)->num_rows();

			$subquery = $query . " ORDER BY " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . "";

			$result1 = $this->db->query($subquery);

			$totalFiltered = $result1->num_rows();

			$query .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " LIMIT " . $requestData['start'] . ", " . $requestData['length'] . " ";

			$result = $this->db->query($query);
		}
		else
		{
			$totalData = $this->db->query($query)->num_rows();

			$subquery = $query . " ORDER BY " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . "";

			$result1 = $this->db->query($subquery);

			$totalFiltered = $result1->num_rows();

			$query .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " LIMIT " . $requestData['start'] . ", " . $requestData['length'] . " ";

			$result = $this->db->query($query);
		}

		

		$data = array();

		foreach($result->result_array() as $row) {
			$nestedData = array(); 
			$nestedData[] = '<img class="img-thumbnail" style="width: 50px;" src="'.base_url('assets/uploads/avatars/'.$row['avatar']).'">';
			$nestedData[] = $row["username"];
			$nestedData[] = '<button class="btn btn-primary view" id="'.$row['id'].'">View</button>';
			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval($totalData),  // total number of records
			"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
		);

		return $json_data;
	}


	public function create_user($status,$password,$username,$avatar,$functions)
	{
		$argument = array(
			$status,
			password_hash($password,PASSWORD_BCRYPT,array('cost' => 12)),
			$username,
			$avatar,
			$functions,
			0
		);

		$query="insert into sys_users (active,password,username,avatar,functions,failed_login_attempts)
		 values (?,?,?,?,?,?)";

		 $this->db->query($query,$argument);
	}


	public function update_password($user_id, $password)
	{
		$argument = array(	
			password_hash($password,PASSWORD_BCRYPT,array('cost' => 12)),
			$user_id
		);

		$query="update sys_users set password = ? where id = ?";

		$this->db->query($query,$argument);
	}


	
}