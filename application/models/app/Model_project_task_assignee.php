<?php 
class Model_project_task_assignee extends CI_Model {


	public function create($project_task,$project_contributor)
	{
		$query="insert into app_project_task_assignees(project_task,project_contributor,created,updated,status)
		values (?,?,?,?,?)";

		$args = array(
			$project_task,
			$project_contributor,
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
		$query="select a.id as assignee_id, b.id as contributor_id, concat(c.fname,' ',c.mname,' ',c.lname) as name, c.email,c.mobile_number, d.avatar from
		 app_project_task_assignees as a left join app_project_contributors as b on a.project_contributor = b.id left join app_members as c on b.member = c.id 
		 left join sys_users as d on c.sys_user = d.id where a.project_task = ?";

		return $this->db->query($query,$task_id)->result_array();
	}

	public function read($id)
	{
		$query="select a.id,a.name,a.description,a.man_hours,a.task_status,a.project_task_group,a.created,a.updated,b.name as task_group, c.id as project_id, 
		c.name as project from app_project_tasks as a left join app_project_task_groups as b on a.project_task_group = b.id left 
		join app_projects as c on b.project = c.id 
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

	public function get_assignee_id_from_user_id($user_id,$task_id)
	{
		$query="select id from app_project_task_assignees where project_contributor = 
		 (select id from app_project_contributors where member = 
		 	(select id from app_members where sys_user = ?)
		 ) and project_task = ?";

		$arguments = array(
			$user_id,
			$task_id
		);

		return $this->db->query($query,$arguments)->row_array()['id'];
	}

}