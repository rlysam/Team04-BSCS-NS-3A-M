<?php
/*
* Pahiream, TUP student resource sharing and delivery
* Copyright (C) 2022
*/
defined('BASEPATH') || exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Register extends CI_Controller
{

    public function get_user()
    {
        $this->load->model("Register_model");

        $data = $this->Register_model->get_user();

        $output = json_encode($data);
        echo $output;
    }

    public function generate_verification_code()
    {

        $CHARS_LENGTH = 8;

        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charsLen = strlen($chars);
        $order = '';
        $code = '';


        for ($i = 0; $i < $CHARS_LENGTH; $i++) {
            //generate at least one uppercase
            if ($i == 0) {
                $order[$i] = chr(rand(65, 90));
                //generate at least one lowercase
            } else if ($i == 1) {
                $order[$i] = chr(rand(97, 122));
                //generate at least one number (0-9)
            } else if ($i == 2) {
                $order[$i] = chr(rand(48, 57));
            } else {
                $order[$i] = $chars[rand(0, $charsLen) - 1];
            }
        }

        return str_shuffle($order);
    }

    public function send_email_verification($email)
    {
        $this->load->library('email');
        $code = $this->generate_verification_code();
        $this->load->config('email');

        $from = $this->config->item('smtp_user');
        $to = $email;
        $subject = 'Pahiream verification code';
        $message = $code;

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            $output = array('code' => $code);
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        } else {
            show_error($this->email->print_debugger());
            $this->output->set_status_header('502');
        }
    }

    //FOR TESTING
    public function insert_user()
    {

        $this->load->model("Register_model");
        if ($this->input->post()) {
            $this->output->set_header('HTTP/1.1 201 GOODS ATA');

            $this->Register_model->insert_user();
            $data = $this->Register_model->get_user($this->input->post('email'), $this->input->post('tup_id'));

            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        }
    }

    public function verify_user()
    {

        // load register model
        $this->load->model('Register_model');

        // receive post request from front-end
        $email = $this->input->post('email');
        $tupId = $this->input->post('tup_id');
        $data = $this->Register_model->get_user($email, $tupId);

        if (!empty($data)) {
            // check if user exists within database
            $this->output->set_status_header('409');
        } else {
            $this->send_email_verification($email);
        }
    }
}
