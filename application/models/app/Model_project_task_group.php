<?php 
class Model_project_task_group extends CI_Model {

	public function create($parent,$name,$group_string,$project)
	{
		$query="insert into app_project_task_groups (parent_group,name,group_string,project,created,updated,status)
		values (?,?,?,?,?,?,?)";

		$args = array(
			$parent,
			$name,
			$group_string,
			$project,
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
		$query="select * from app_project_task_groups where id = ?";

		return $this->db->query($query,$id)->row_array();
	}

	public function update($parent,$name,$group_string,$project_task_group_id)
	{
		$query="update app_project_task_groups set parent_group = ?, name = ?, group_string =?, updated = ? where id = ?";

		$args = array(
			$parent,
			$name,
			$group_string,
			date('Y-m-d H:i:s'),
			$project_task_group_id
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
		//check if there is a group or a task under this group. only delete if there are no task nor group

		$query="select (select count(id) from app_project_tasks where project_task_group = ?) as tasks ,
		 ( select count(id) from app_project_task_groups where parent_group = ?) as groups";

		$arguments = array($id,$id);

		$result = $this->db->query($query,$arguments)->row_array();

		if($result['tasks']=='0' && $result['groups'] == '0')
		{
			$query="update app_project_task_groups set status = 0 where id = ?";


			if($this->db->query($query,$id))
			{
				$response = array(
					'status' => true,
					'message' => 'Group Deleted'
				);
			}
			else
			{
				$response = array(
					'status' => false,
					'message' => 'Something went wrong. Please try again.'
				);
			}

			return $response;
		}
		else
		{
			$response = array(
				'status' => false,
				'message' => 'Only empty groups can be deleted.'
			);

			return $response;
		}
	}

	public function get_group_string($group_name,$parent_group)
	{
		if($parent_group=='0')
		{
			return $group_name;
		}
		else
		{
			$query="select group_string from app_project_task_groups where id = ?";

			$result = $this->db->query($query,$parent_group);

			if($result->num_rows()>0)
			{
				return $result->row_array()['group_string'].' > '.$group_name;
			}
			else
			{
				return $group_name;
			}
		}
	}

}