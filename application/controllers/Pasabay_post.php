<?php
defined('BASEPATH') || exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); //Since flutter is not a static url

class Pasabay_post extends CI_Controller
{

    public function get_post()
    {
        $this->load->model("Pasabay_post_model");
        $data = $this->Pasabay_post_model->get_post();

        $this->output->set_content_type('application/json');
        echo json_encode($data);;
    }

    public function create_post()
    {

        if ($this->input->post() > 0) {

            $this->load->model('Pasabay_post_model');

            if ($this->Pasabay_post_model->create_post()) {

                $this->output->set_status_header('201');
                $this->Pasabay_post_model->insert_image_location();
            } else {
                $this->output->set_status_header('409');
            }
            echo json_encode($this->input->post());
        }
    }

    public function update_post()
    {
        $this->load->model("Pasabay_post_model");
        if ($this->Pasabay_post_model->update_post()) {
            $this->output->set_status_header('200');
        } else {
            $this->output->set_status_header('409');
        }
    }

    public function deactivate_post()
    {
        $this->load->model('Pasabay_post_model');
        $status_code = $this->Pasabay_post_model->deactivate_post($this->input->post('post_id'));
        $this->output->set_status_header($status_code);
    }

    public function get_image()
    {
        $this->load->helper('file');
        $filename = $this->input->get('path');
        header('Content-type: ' . get_mime_by_extension($filename));
        echo file_get_contents($filename);
    }
}
