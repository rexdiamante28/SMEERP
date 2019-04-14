<?php 
class Model_industry extends CI_Model {

	public function create($project_id,$role_name)
	{
		$query="insert into app_project_roles (project,role,created,updated,status)
		values (?,?,?,?,?)";

		$args = array(
			$project_id,
			$role_name,
			date('Y-m-d H:i:s'),
			date('Y-m-d H:i:s'),
			1
		);

		if($this->db->query($query,$args))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function table_view($read_args)
	{
		$columns = array( 
            0 => 'id',
            1 => 'name',
            2 => 'industry'
        );


		$requestData = $_REQUEST;
		$totalData = 0;
		$totalFiltered = 0;

		$query="select a.*, b.name as industry_name from erp_companies as a left join erp_industries as b on a.industry = b.id where a.status = 1 ";

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

	public function read($id)
	{
		$query="select * from app_project_roles where id = ? ";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($role_id,$role_name)
	{
		$query="update app_project_roles set role  = ?, updated = ? where id = ?";

		$args = array(
			$role_name,
			date('Y-m-d'),
			$role_id
		);

		if($this->db->query($query,$args))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete($id)
	{
		// only delete role that are not in use

		$query = "select * from app_project_contributors where role = ? and status = 1";

		$result = $this->db->query($query,$id);

		if($result->num_rows()>0)
		{
			$response = array(
				'status' => false,
				'message' => "Role is currenty in use. It cannot be deleted."
			);

			return $response;
		}
		else
		{
			$query="update app_project_roles set status = 0 where id = ?";
		
			if($this->db->query($query,$id))
			{
				$response = array(
					'status' => true,
					'message' => "Role deleted."
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

		
	}

	public function get_active()
	{
		$query="select * from erp_industries where status = 1";

		return $this->db->query($query)->result_array();
	}

}