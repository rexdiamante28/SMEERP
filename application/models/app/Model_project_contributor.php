<?php 
class Model_project_contributor extends CI_Model {

	public function create($project_id,$member,$role)
	{

		//avoid duplicate entry for of members in contributors record

		$query = "select id from app_project_contributors where member = ? and role in 
		(select id from app_project_roles where project = ?)";

		$arguments = array(
			$member,
			$project_id
		);


		if($this->db->query($query,$arguments)->num_rows()>0)
		{
			$response = array(
				'status' => false,
				'message' => "Selected member id already a contributor to this projeect"
			);

			return $response;
		}
		else
		{
			$query="insert into app_project_contributors (member,role,created,updated,status) values (?,?,?,?,?)";

			$args = array(
				$member,
				$role,
				date('Y-m-d H:i:s'),
				date('Y-m-d H:i:s'),
				1
			);

			if($this->db->query($query,$args))
			{
				$response = array(
					'status' => true,
					'message' => "Contributor added."
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

	public function list($read_args)
	{
		$columns = array( 
            0 => 'id',
            1 => 'project',
            2 => 'role'
        );


		$requestData = $_REQUEST;
		$totalData = 0;
		$totalFiltered = 0;

		$query="select a.id, concat(b.fname,' ',b.mname,' ',b.lname) as name, b.email,b.mobile_number, c.role 
		 from app_project_contributors as a left join app_members as b on a.member = b.id left join 
		 app_project_roles as c on a.role = c.id where a.status = 1 and c.project = '".$read_args['project_id']."'";

		if($read_args['search_string']!='')
		{
			$query.=" and ( c.role like '%".$read_args['search_string']."%' or b.fname like '%".$read_args['search_string']."%'
			or b.mname like '%".$read_args['search_string']."%' or b.lname like '%".$read_args['search_string']."%' 
			or b.email like '%".$read_args['search_string']."%' or b.mobile_number like '%".$read_args['search_string']."%') ";
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
		$query="select * from app_project_contributors where id = ?";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($member,$role,$id)
	{
		//avoid duplicate entry for of members in contributors record

		
		$query="update app_project_contributors set member = ?, role = ? , updated = ? where id = ?";

		$args = array(
			$member,
			$role,
			date('Y-m-d H:i:s'),
			$id
		);

		if($this->db->query($query,$args))
		{
			$response = array(
				'status' => true,
				'message' => "Contributor updated."
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

	public function delete($id)
	{
		$query="update app_projects set status = 0 where id = ?";
		
		return $this->db->query($query,$id);
	}

	public function get_categoories()
	{
		$query="select * from app_project_categories where status = 1";

		return $this->db->query($query)->result_array();
	}

	public function get_project_contributors($project_id)
	{
		$query="select a.id, concat (b.fname,' ',b.mname,' ',b.lname) as name, c.id as role_id, d.id as project_id from app_project_contributors as a left join 
		app_members as b on a.member = b.id left join app_project_roles as c on a.role = c.id left join app_projects as d on c.project = d.id where 
		d.id = ?";

		return $this->db->query($query,$project_id)->result_array();

	}

	public function get_progress($project_id,$contributor_id)
	{	
		$query = "select a.name as project, b.name as task_group_name, c.name as task, c.weight, c.task_status, d.project_contributor,e.add_to_progress from app_projects as a left join app_project_task_groups as b on a.id = b.project left join app_project_tasks as c on b.id = c.project_task_group left join app_project_task_assignees as d on c.id = d.project_task left join app_project_task_status as e on c.task_status = e.id where a.id = ? and d.project_contributor = ?";

		$arguments = array(
			$project_id,
			$contributor_id
		);

		$result = $this->db->query($query,$arguments)->result_array();

		$weight_completed = 0;
		$weight_assigned = 0;


		foreach ($result as $row) {
			$weight_assigned += doubleval($row['weight']);
			if($row['add_to_progress']=='1' || $row['add_to_progress']==1)
			{
				$weight_completed += doubleval($row['weight']);
			}
		}

		if($weight_assigned ==0)
		{
			return 0;
		}
		else
		{
			return ($weight_completed / $weight_assigned) * 100;
		}
		
	}

}

