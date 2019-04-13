<?php 
class Model_project_file extends CI_Model {

	public function create($name,$description,$project_status,$project_category,$project_priority)
	{
		$query="insert into app_projects (name,description,project_status,category,priority,progress,created,updated,status)
		values (?,?,?,?,?,?,?,?,?)";

		$args = array(
			$name,
			$description,
			$project_status,
			$project_category,
			$project_priority,
			0,
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

		$query="select a.id,a.name,a.description,a.status,a.project_status,a.progress, b.category_string, c.name 
		as status_name, c.color_code, d.priority, d.color_code as priority_color_code from app_projects as a left join app_project_categories
		 as b on a.category = b.id left join app_project_status as c on a.project_status = c.id left join app_priorities as d on a.priority = d.id 
		 where a.status > 0 ";

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
		$query="select a.id,a.name,a.description,a.status,a.created,a.updated,a.project_status,a.category,a.progress, a.priority as priority_id, b.category_string, c.name 
		as status_name, c.color_code, d.priority, d.color_code as priority_color_code  from app_projects as a  left join app_project_categories as 
		b on a.category = b. id left 
		join app_project_status as c on a.project_status = c.id left join app_priorities as d on a.priority = d.id  where a.id = ?";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($name,$description,$project_status,$id,$project_category,$project_priority)
	{
		$query="update app_projects set name = ? , description = ? , project_status = ? , updated = ?, category = ?, priority = ? where 
		id = ?";

		$args = array(
			$name,
			$description,
			$project_status, 
			date('Y-m-d H:i:s'),
			$project_category,
			$project_priority,
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


	public function calculate_progress($project_id)
	{
		$query="select a.weight, c.add_to_progress from app_project_tasks as a left join app_project_task_groups as b on a.project_task_group = b.id left join app_project_task_status as c on a.task_status = c.id where b.project = ? and a.status = 1";

		$result = $this->db->query($query,$project_id)->result_array();

		$weight_done = 0;
		$weight_perfect = 0;

		foreach ($result as $row) {
			$weight_perfect += doubleval($row['weight']);
			if($row['add_to_progress']=='1')
			{
				$weight_done += doubleval($row['weight']);
			}
		}

		$progress = ($weight_done / $weight_perfect) * 100;

		$query="update app_projects set progress = ? where id = ?";

		$arguments = array(
			$progress,
			$project_id
		);

		if($this->db->query($query,$arguments))
		{
			return true;
		}
		else
		{
			return false;
		}

	}

}