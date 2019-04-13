<?php

class Web extends CI_Controller {

    public function index() {
        header("location: ".base_url()."auth/authentication");
    }

}