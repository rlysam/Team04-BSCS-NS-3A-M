<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Pahiram_Post extends CI_Controller {
    
    private $STATUS_AVAILABLE = 'available';
    private $STATUS_UNAVAILABLE = 'unavailable';
    private $STATUS_RENTING = 'renting';
    private $STATUS_REQUESTING = 'requesting';
    private $STATUS_DEACTIVATED = 'deactivated';


    #function __constructor() {
    #    parent::__constructor();
    #}


    function create_post() {

        if($this->input->post() > 0){
            $this->load->model('Pahiram_Post_Model');

            $path = $this->input->post('path');
            unset($_POST['path']);

            if($this->Pahiram_Post_Model->insert()){
                $this->output->set_status_header('201');

                $new_path = $this->Pahiram_Post_Model->insert_image_location($path);

                $this->upload_image($path, $new_path);
            }
            else{
                $this->output->set_status_header('409');
            }

            echo json_encode($this->input->post());
        }

    }

    public function upload_image($path, $new_path){
        if (!copy($path, $new_path)) {
            return false;
        }
        return true;
    }

    public function get_image(){
        $this->load->helper('file');
        $filename = $this->input->get('path');
        header('Content-type: ' . get_mime_by_extension($filename));
        echo file_get_contents($filename); 
    }

    public function get_post() {

        $this->load->model('Pahiram_Post_Model');

        $data = $this->Pahiram_Post_Model->get_post();

        echo json_encode($data[0]);
    }

    function set_post_available($post_id) { 
        $this->load->model('Pahiram_Post_Model');
        $status_code = $this->Pahiram_Post_Model->set_status($post_id, $this->STATUS_AVAILABLE);
        $this->output->set_status_header($status_code);
    }

    function set_post_unavailable($post_id) {
        $this->load->model('Pahiram_Post_Model');
        $status_code = $this->Pahiram_Post_Model->set_status($post_id, $this->STATUS_UNAVAILABLE);
        $this->output->set_status_header($status_code);
    }

    function set_post_renting($post_id) {
        $this->load->model('Pahiram_Post_Model');
        $status_code = $this->Pahiram_Post_Model->set_status($post_id, $this->STATUS_RENTING);
        $this->output->set_status_header($status_code);
    }

    function set_post_requesting($post_id) {
        $this->load->model('Pahiram_Post_Model');
        $status_code = $this->Pahiram_Post_Model->set_status($post_id, $this->STATUS_REQUESTING);
        $this->output->set_status_header($status_code);
    }

    function deactivate_post($post_id) {
        $this->load->model('Pahiram_Post_Model');
        $status_code = $this->Pahiram_Post_Model->set_status($post_id, $this->STATUS_DEACTIVATED);
        $this->output->set_status_header($status_code);
    }

}