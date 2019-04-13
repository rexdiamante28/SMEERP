<?php 
class Model_project_task_log extends CI_Model {

	public function create($task,$task_assignee,$log)
	{
		$query="insert into app_project_task_logs (task,task_assignee,log,created,updated,status)
		values (?,?,?,?,?,?)";

		$args = array(
			$task,
			$task_assignee,
			$log,
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

	public function list($task_id)
	{
		$query="select a.id,a.log, a.created, b.id as task_assignee_id,c.id as contributor_id, concat(d.fname,' ',d.mname, ' ', d.lname) as name, e.avatar
		 from app_project_task_logs as a left join app_project_task_assignees as b on a.task_assignee = b.id left 
		 join app_project_contributors as c on b.project_contributor  = c.id left join app_members as d on c.member  = d.id
		 left join sys_users as e on d. sys_user = e.id where a.task = ? and a.status = 1 order by a.created desc";
		 
		return $this->db->query($query,$task_id)->result_array();
	}

	public function read($id)
	{
		$query="select a.id,a.name,a.description,a.status,a.created,a.updated,a.project_status,a.category,a.progress, b.category_string from app_projects as a
		 left join app_project_categories as b on a.category =  b. id where a.id = ?";

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

}