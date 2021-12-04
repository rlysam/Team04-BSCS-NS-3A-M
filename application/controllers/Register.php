<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); //Since flutter is not a static url

class Register extends CI_Controller {

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

    public function generate_verification_code(){

        $CHARS_LENGTH = 8;

        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $chars_len = strlen($chars);
        $order = '';
        $code = '';


        for ($i = 0; $i < $CHARS_LENGTH; $i++){
            //generate at least one uppercase
            if ($i == 0) {
                $order[$i] = chr(rand(65, 90));
             //generate at least one lowercase
            } else if ($i == 1) {
                $order[$i] = chr(rand(97,122));
            //generate at least one number (0-9)
            } else if ($i == 2) {
                $order[$i] = chr(rand(48,57));
            } else {
                $order[$i] = $chars[rand(0, $chars_len) - 1];
            }
        }

        $code = str_shuffle($order);
        
        return $code;
    }

    public function send_email_verification($email){
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
            // echo 'Email sent';
            $output = array('code' => $code);
            // echo json_encode($output);
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        } else {
            show_error($this->email->print_debugger());
        }

    }

    //FOR TESTING
    public function insert_user(){
        
        $this->load->model("Register_Model");
        if($this->input->post()){
            $this->output->set_header('HTTP/1.1 201 GOODS ATA');
            
            $this->Register_Model->insert_user();
            $data = $this->Register_Model->get_user($_POST['email'],$_POST['tup_id']);

            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        }

        
    }

    public function verify_user() {

        // load register model
        $this->load->model('Register_Model');

        // receive post request from front-end
        $email = $this->input->post('email');
        $tup_id = $this->input->post('tup_id');
        $data = $this->Register_Model->get_user($email, $tup_id);

        // check if the array is empty
        // if array is empty; user isnt registered yet
        $filtered_data = array_filter($data); 
        if (!empty($filtered_data)) {
            //generate error 409 response
            $this->output->set_status_header('409');
        } else {
            // email isnt registered yet
            $this->send_email_verification($email);
        }
    }

    public function get_post(){
        $input = $this->input->post();

        //log_message('Debug', 'lumabas = '. $output);
        
        if(isset($input['fname'])){
            log_message('Debug', 'post = '.print_r($input, true));
        }
        else
            log_message('Debug', 'geegee ;pds = '.print_r($input, true));
    }
}
