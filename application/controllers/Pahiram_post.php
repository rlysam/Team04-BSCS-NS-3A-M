<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Pahiram_post extends CI_Controller {
    
    private $STATUS_AVAILABLE = 'available';
    private $STATUS_UNAVAILABLE = 'unavailable';
    private $STATUS_RENTING = 'renting';
    private $STATUS_REQUESTING = 'requesting';
    private $STATUS_DEACTIVATED = 'deactivated';


    public function get_post() {

        $this->load->model('pahiram_post_model');

        $data = $this->pahiram_post_model->get_post();
        
        $this->output->set_content_type('application/json');
        echo json_encode($data);
    }

    public function create_post() {

        if($this->input->post() > 0){

            $this->load->model('pahiram_post_model');

            if($this->pahiram_post_model->insert()){

                $this->output->set_status_header('201');
                $this->pahiram_post_model->insert_image_location();
            }
            else{
                $this->output->set_status_header('409');
            }

            echo json_encode($this->input->post());
        }
    }

    public function get_image(){
        $this->load->helper('file');
        $filename = $this->input->get('path');
        header('Content-type: ' . get_mime_by_extension($filename));
        echo file_get_contents($filename); 
    }

    public function set_post_available($post_id) { 
        $this->load->model('pahiram_post_model');
        $status_code = $this->pahiram_post_model->set_status($post_id, $this->STATUS_AVAILABLE);
        $this->output->set_status_header($status_code);
    }

    public function set_post_unavailable($post_id) {
        $this->load->model('pahiram_post_model');
        $status_code = $this->pahiram_post_model->set_status($post_id, $this->STATUS_UNAVAILABLE);
        $this->output->set_status_header($status_code);
    }

    public function set_post_renting($post_id) {
        $this->load->model('pahiram_post_model');
        $status_code = $this->pahiram_post_model->set_status($post_id, $this->STATUS_RENTING);
        $this->output->set_status_header($status_code);
    }

    public function set_post_requesting($post_id) {
        $this->load->model('pahiram_post_model');
        $status_code = $this->pahiram_post_model->set_status($post_id, $this->STATUS_REQUESTING);
        $this->output->set_status_header($status_code);
    }

    public function deactivate_post($post_id) {
        $this->load->model('pahiram_post_model');
        $status_code = $this->pahiram_post_model->set_status($post_id, $this->STATUS_DEACTIVATED);
        $this->output->set_status_header($status_code);
    }

}