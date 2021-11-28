<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function get_user(){
        $this->load->model("Login_Model");

        $data = $this->Login_Model->get_user();

        $output = json_encode($data);
        echo $output;
    }
    
}
