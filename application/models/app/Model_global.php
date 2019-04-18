<?php 
class Model_global extends CI_Model {

	public function custom_query($quuery,$arguments)
	{
		if($arguments!=false)
		{
			return $this->db->query($query,$arguments);
		}
		else
		{
			return $this->db->query($query);
		}
	}

}