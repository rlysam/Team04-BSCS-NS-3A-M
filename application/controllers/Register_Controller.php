<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_Controller extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function get_user(){
        $this->load->model("Register_Model");

        $data = $this->Register_Model->get_user();

        $output = json_encode($data);
        echo $output;
    }
}
