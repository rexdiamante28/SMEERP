<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventorymovements extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('account/inventorymovement_model');
	}



}
