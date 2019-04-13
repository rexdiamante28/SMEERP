<?php 
class Model_project_log extends CI_Model {

	public function create($project,$member,$log)
	{
		$query="insert into app_project_logs (project,member,log,created,updated,status)
		values (?,?,?,?,?,?)";

		$args = array(
			$project,
			$member,
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

	public function list($project_id)
	{
		$query="select a.id,a.log, a.created, concat(b.fname,' ',b.mname, ' ', b.lname) as name, c.avatar from app_project_logs as a left join app_members 
		 as b on a.member = b.id  left join sys_users as c on b. sys_user = c.id where a.project = ? and a.status = 1 order by created desc";
		 
		return $this->db->query($query,$project_id)->result_array();
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