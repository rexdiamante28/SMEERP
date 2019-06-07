<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ItemCategories_model extends CI_Model {

function __construct() {
	parent::__construct();
}

function get_categories()
{
	$query="";
	$search = $this->input->post('search');
	$limit = $this->input->post('record_per_page');

	if($search==='')
	{
		$query="select a.id,a.category,a.parent_category,a.category_string,a.sequence_number,
		(select category_string from item_categories where id = a.parent_category) as parent_category_string
		from item_categories as a order by a.sequence_number limit $limit";
	}
		else
	{
		$query="select a.id,a.category,a.parent_category,a.category_string,a.sequence_number,
		(select category_string from item_categories where id = a.parent_category) as 
		parent_category_string from item_categories as a where a.category like '%$search%'
		order by a.sequence_number limit $limit";
	}


	return $this->_custom_query($query);
}

function add_category()
{

	$query="select max(id) as id from item_categories";

	$id = intval($this->_custom_query($query)->row()->id)+1;
	$category = $this->input->post('category');
	$parent_category = $this->input->post('parent_category_id');

	$query="select category_string from item_categories where id = '$parent_category' ";
	$result = $this->_custom_query($query);
	if($result->num_rows()>0)
	{
		$category_string = $result->row()->category_string.' / '.$category;
	}
	else
	{
		$category_string = $category;
	}

	$sequence_number = $this->input->post('sequence');

	$query = "insert into item_categories (id,category,parent_category,category_string,sequence_number) values 
			('$id','$category','$parent_category','$category_string','$sequence_number')";

	if($this->_custom_query($query))
	{
		$response['success'] = true;
	    $response['message'] = $id;
	    $response['environment'] = ENVIRONMENT;

		return $response;
	}
	
}

function update_category()
{
	$id = $this->input->post('id');
	$category = $this->input->post('category');
	$parent_category = $this->input->post('parent_category_id');
	$sequence_number = $this->input->post('sequence');
	$valid = true;
	$category_string = "";

	//category must have no child category to update else, do not allow
	$query="select * from item_categories where parent_category = '$id' ";
	$result = $this->_custom_query($query);
	if($result->num_rows()>0)
	{
		$valid = false;
	}
	else
	{
		$query="select category_string from item_categories where id = '$parent_category' ";
		$result = $this->_custom_query($query);
		if($result->num_rows()>0)
		{
			$category_string = $result->row()->category_string.' / '.$category;
		}
		else
		{
			$category_string = $category;
		}
	}

	if($valid===true&&$parent_category!=$id)
	{

		$query="update item_categories set category = '$category', parent_category = '$parent_category',
		category_string = '$category_string', sequence_number = '$sequence_number' 
		where id = '$id' ";
		
		if($this->_custom_query($query))
		{
			$response['success'] = true;
		    $response['message'] = 'update successful';
		    $response['environment'] = ENVIRONMENT;

			return $response;
		}

	}
	else
	{
			$response['success'] = false;
		    $response['message'] = '<strong>Note: Not allowed</strong><p>Updating category with child categories<br/>Making a category child of its own</p>';
		    $response['environment'] = ENVIRONMENT;

			return $response;
	}
}


function get_category($id)
{
	$query="select * from item_categories where id = '$id' ";
	return $this->_custom_query($query);
}

function remove_category($id)
{
	//category must have no child category to delete else, do not allow
	$query="select * from item_categories where parent_category = '$id' ";
	$result = $this->_custom_query($query);
	if($result->num_rows()>0)
	{
			$response['success'] = false;
			$response['message'] = '<strong>Note: Not allowed</strong><p>deleting category with child categories</p>';
			$response['environment'] = ENVIRONMENT;

			return $response;
	}
	else
	{
		$query="delete from item_categories where id = '$id' ";
		if($this->_custom_query($query))
		{
			$response['success'] = true;
		    $response['message'] = 'Item category successfully deleted';
		    $response['environment'] = ENVIRONMENT;

			return $response;
		}
	}
}



function _custom_query($mysql_query) {
	$result = $this->db->query($mysql_query);
	return $result;
}

function get_parent_category_options()
{
	$category = $this->input->post('category');

	if($category==='none')
	{
		$query="select * from item_categories";
		return  $this->_custom_query($query)->result();
	}
	else
	{
		$query="select a.* from item_categories as a where a.id != '$category' and a.parent_category != '$category' ";
		return  $this->_custom_query($query)->result();
	}


}

}
