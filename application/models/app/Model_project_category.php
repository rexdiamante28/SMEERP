<?php 
class Model_project_category extends CI_Model {

	public function create($name,$description,$project_status)
	{
		$query="insert into app_projects (name,description,project_status,created,updated,status)
		values (?,?,?,?,?,?)";

		$args = array(
			$name,
			$description,
			$project_status,
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

	public function list($read_args)
	{
		$columns = array( 
            0 => 'id',
            1 => 'name',
            2 => 'email'
        );


		$requestData = $_REQUEST;
		$totalData = 0;
		$totalFiltered = 0;

		$query="select a.id, a.sys_user, concat(a.fname,' ',a.mname,' ',a.lname) as name, a.email,a.mobile_number, b.avatar from app_members as a
		 left join sys_users as b on a.sys_user = b.id where a.status = 1 ";

		if($read_args['search_string']!='')
		{
			$query.=" and ( a.fname like '%".$read_args['search_string']."%' or a.mname like '%".$read_args['search_string']."%'  or a.lname like '%".$read_args['search_string']."%') ";
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
		$query="select a.id,a.name,a.description,a.status,a.created,a.updated,a.project_status,a.category,a.progress, b.category_string from app_projects as a
		 left join app_project_categories as b on a.category = b. id where a.id = ?";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($name,$description,$project_status,$id)
	{
		$query="update app_projects set name = ? , description = ? , project_status = ? , updated = ? where 
		id = ?";

		$args = array(
			$name,
			$description,
			$project_status,
			date('Y-m-d H:i:s'),
			$id
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
		$query="update app_projects set status = 0 where id = ?";
		
		return $this->db->query($query,$id);
	}

	public function get_categories()
	{
		$query="select * from app_project_categories where status = 1";

		return $this->db->query($query)->result_array();
	}

}