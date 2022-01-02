<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function get_user(){
        $this->load->model("login_model");

        $data = $this->login_model->get_user();

        $output = json_encode($data);
        echo $output;
    }

    public function get_user_by_email() {
        $this->load->model("login_model");

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $data = $this->login_model->get_user_by_email($email);

        //check if array is "empty"
        //di nagana empty($data) may explanation si stackoverflow: https://stackoverflow.com/questions/2216052/how-to-check-whether-an-array-is-empty-using-php
        $filtered_arr = array_filter($data);

        if (!empty($filtered_arr)) {
            // user exists
            // check if matches with password
            $is_match = $this->check_password_match($password, $data['password']);

            if ($is_match) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
            } else {
                $this->output->set_status_header('401');
                //->set_content_type('application/json')
                //->set_output("Invalid credential(s)");
            }
        } else {
            //user doesnt exists
            $this->output->set_status_header('404');
                //->set_content_type('application/json')
                //->set_output("User doesn't exist");
        }

    }

    public function check_password_match($password, $post_password) {
        //return (strcmp($password, $post_password)) ? true : false;
        if(strcmp($password, $post_password) == 0)
            return true;
        return false;
    }   
}
