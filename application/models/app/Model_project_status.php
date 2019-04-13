<?php 
class Model_project_status extends CI_Model {


	public function get_groups_and_tasks($project_id)
	{	
		$result = array(
			'task_groups' => array(),
			'tasks'		=> array()
		);

		//get all task groups under the project
		$query="select * from app_project_task_groups where project = ? order by parent_group asc";

		
		$task_groups = $this->db->query($query,$project_id)->result_array();

		foreach ($task_groups as $group) {
			$group['id_en'] = en_dec('en',$group['id']);
			array_push($result['task_groups'], $group);
		}


		//get all tasks under the project
		$query="select * from app_project_tasks where project_task_group in (select id from app_project_task_groups where project = ?) ";

		$tasks = $this->db->query($query,$project_id)->result_array();

		foreach ($tasks as $task) {
			$task['id_en'] = en_dec('en',$task['id']);
			array_push($result['tasks'], $task);
		}

		return $result;

	}


	public function create($name,$description,$project_status,$project_category,$project_progress)
	{
		$query="insert into app_projects (name,description,project_status,category,progress,created,updated,status)
		values (?,?,?,?,?,?,?,?)";

		$args = array(
			$name,
			$description,
			$project_status,
			$project_category,
			$project_progress,
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
		$query="select a.id,a.name,a.description,a.man_hours,a.project_task_group,a.created,a.updated,b.name as task_group,b.group_string, c.id as project_id, c.name as project, d.name as task_status from app_project_tasks as a left join app_project_task_groups as b on a.project_task_group = b.id left 
		join app_projects as c on b.project = c.id  left join app_project_task_status as d on a.task_status = d.id
		where a.id = ? ";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($name,$description,$project_status,$id,$project_category,$project_progress)
	{
		$query="update app_projects set name = ? , description = ? , project_status = ? , updated = ?, category = ?, progress = ? where 
		id = ?";

		$args = array(
			$name,
			$description,
			$project_status, 
			date('Y-m-d H:i:s'),
			$project_category,
			$project_progress,
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


	public function get_options()
	{
		$query="select * from app_project_status where status = 1";

		return $this->db->query($query)->result_array();
	}

}
