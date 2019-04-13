<?php 
class Model_access_control extends CI_Model {

private $access_control = array(
      'overall_access' => 1
);


public function generate_functions($data)
{
  if(isset($data['overall_access']))
  {
    $this->access_control['overall_access'] = 1;
  }
  return json_encode($this->access_control);
}
  
}