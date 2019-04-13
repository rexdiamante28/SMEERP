<?php 
class Model_project_task extends CI_Model {


	public function get_groups_and_tasks($project_id)
	{	
		$result = array(
			'task_groups' => array(),
			'tasks'		=> array()
		);

		//get all task groups under the project
		$query="select * from app_project_task_groups where project = ? and status = '1' order by parent_group asc";

		
		$task_groups = $this->db->query($query,$project_id)->result_array();

		foreach ($task_groups as $group) {
			$group['id_en'] = en_dec('en',$group['id']);
			array_push($result['task_groups'], $group);
		}


		//get all tasks under the project
		$query="select a.*, b.name as status_name, b.color_code, c.priority, c.color_code as priority_color_code from app_project_tasks as a left join app_project_task_status as b on a.task_status = b.id left join app_priorities as c on a.priority = c.id where a.project_task_group in (select id from app_project_task_groups where project = ?) ";

		$tasks = $this->db->query($query,$project_id)->result_array();

		foreach ($tasks as $task) {
			$task['id_en'] = en_dec('en',$task['id']);
			array_push($result['tasks'], $task);
		}

		return $result;

	}


	public function create($name,$description,$man_hours,$weight,$priority,$task_status,$project_task_group,$deadline,$start_date)
	{
		$query="insert into app_project_tasks (name,description,man_hours,weight,priority,task_status,project_task_group,deadline,target_start_date,created,updated,status)
		values (?,?,?,?,?,?,?,?,?,?,?,?)";

		$args = array(
			$name,
			$description,
			$man_hours,
			$weight,
			$priority,
			$task_status,
			$project_task_group,
			$deadline,
			$start_date,
			date('Y-m-d H:i:s'),
			date('Y-m-d H:i:s'),
			1
		);

		$response = array(
			'status' =>  true,
			'task_id' => 0
		);

		if($this->db->query($query,$args))
		{
			$response['task_id'] = $this->db->insert_id();
		}
		else
		{
			$response['status'] = false;
		}

		return $response;
	}

	public function list($read_args)
	{
		$columns = array( 
            0 => 'id',
            1 => 'name',
        );


		$requestData = $_REQUEST;
		$totalData = 0;
		$totalFiltered = 0;

		$query="select a.id,a.name,a.description,a.status,a.project_status,a.progress, b.category_string from app_projects as a left join app_project_categories
		 as b on a.category = b.id where a.status > 0 ";

		if($read_args['search_string']!='')
		{
			$query.=" and a.name like '%".$read_args['search_string']."%' ";
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
		$query="select a.id,a.name,a.description,a.priority as priority_id, a.weight, a.task_status as task_status_id, a.deadline, a.target_start_date, a.man_hours,a.project_task_group,a.created,a.updated,b.name as task_group,b.group_string, c.id as project_id, c.name as project, d.name as task_status, d.color_code, e.priority, e.color_code as priority_color_code from app_project_tasks as a left join app_project_task_groups as b on a.project_task_group = b.id left 
		join app_projects as c on b.project = c.id  left join app_project_task_status as d on a.task_status = d.id left join app_priorities as e
		on a.priority = e.id
		where a.id = ? ";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($task_id,$name,$description,$man_hours,$weight,$priority,$task_status,$deadline,$start_date)
	{
		$query="update app_project_tasks set name = ? , description = ? , man_hours = ? , weight = ?, priority = ?, task_status = ?,
		deadline = ?, target_start_date = ?, updated = ? where 
		id = ?";

		$args = array(
			$name,
			$description,
			$man_hours,
			$weight,
			$priority,
			$task_status,
			$deadline,
			$start_date,
			date('Y-m-d H:i:s'),
			$task_id
		);

		echo $query;

		echo json_encode($args);


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


	public function get_project_id($task_id)
	{
		$query="select project from app_project_task_groups where id = (select project_task_group from app_project_tasks where id = ? ) ";

		return $this->db->query($query,$task_id)->row_array()['project'];
	}


	public function get_assignees($id)
	{
		$query="select project_contributor from app_project_task_assignees where project_task = ?";

		return $this->db->query($query,$id)->result_array();
	}

}