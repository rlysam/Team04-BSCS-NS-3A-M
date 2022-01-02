<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); //Since flutter is not a static url

class Pasabay_post extends CI_Controller {

    public function get_post(){
        $this->load->model("pasabay_post_model");

        $data = $this->pasabay_post_model->get_post();

        $output = json_encode($data[0]);
        echo $output;
    }

	function create_post(){
        if($this->input->post() > 0){
            $this->load->model('pasabay_post_model');

            $path = $this->input->post('path');
            unset($_POST['path']);

            if($this->pasabay_post_model->create_post()){
                $this->output->set_status_header('201');

                $new_path = $this->pasabay_post_model->insert_image_location($path);

                $this->upload_image($path, $new_path);
            }
            else{
                $this->output->set_status_header('409');
            }

            echo json_encode($this->input->post());
        }
    }

    function deactivate_post($post_id){
        $this->load->model('pasabay_post_model');
        $status_code = $this->pasabay_post_model->deactivate_post($post_id);
        $this->output->set_status_header($status_code);
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
}
