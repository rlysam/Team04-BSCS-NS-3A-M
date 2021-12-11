<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); //Since flutter is not a static url

class Pasabay_post extends CI_Controller {

    public function get_post(){
        $this->load->model("Pasabay_post_Model");

        $data = $this->Pasabay_post_Model->get_post();

        $output = json_encode($data[0]);
        echo $output;
    }

	function create_post(){
        if($this->input->post() > 0){
            $this->load->model('Pasabay_post_Model');
            
            if($this->Pasabay_post_Model->create_post()){
                $this->output->set_status_header('201');
            }
            else{
                $this->output->set_status_header('409');
            }
            echo json_encode($this->input->post());
        }
    }

    function deactivate_post($post_id){
        $this->load->model('Pasabay_post_Model');
        $status_code = $this->Pasabay_post_Model->deactivate_post($post_id);
        $this->output->set_status_header($status_code);
    }
}
