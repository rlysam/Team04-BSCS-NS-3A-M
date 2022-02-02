<?php
defined('BASEPATH') || exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Login extends CI_Controller
{
    public function get_user()
    {
        $this->load->model("Login_model");

        $data = $this->Login_model->get_user();

        $output = json_encode($data);
        echo $output;
    }

    public function get_user_by_email()
    {
        $this->load->model("Login_model");

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $data = $this->Login_model->get_user_by_email($email);

        $filtered_arr = array_filter($data);

        if (!empty($filtered_arr))
        {
            $is_match = $this->check_password_match($password, $data['password']);

            if ($is_match)
            {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
            } else 
            {
                $this->output->set_status_header('401');
            }
        } else
        {
            $this->output->set_status_header('404');
        }
    }

    public function check_password_match($password, $post_password)
    {
        if (strcmp($password, $post_password) == 0)
        {
            return true;
        }
        return false;
    }
}
