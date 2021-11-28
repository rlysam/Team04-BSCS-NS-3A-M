<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); //Since flutter is not a static url

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

    public function send_email_verification(){
        $code = $this->generate_verification_code();
        
        mail("kiroro.christianne@gmail.com","Pahire-am verification code", "Enter this verification code: ". $code, "From: forheejin123@gmail.com");
        $output = array('code' => $code);
        echo json_encode($output);
    }

    //FOR TESTING
    public function insert_user(){
        
        $this->load->model("Register_Model");
        $data = $this->Register_Model->insert_user();
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
