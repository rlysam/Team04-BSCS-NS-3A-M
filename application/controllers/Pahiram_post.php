<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Pahiram_post extends CI_Controller
{

    public function get_post()
    {

        $this->load->model('Pahiram_post_model');

        $data = $this->Pahiram_post_model->get_post();

        $this->output->set_content_type('application/json');
        echo json_encode($data);
    }

    public function create_post()
    {

        if ($this->input->post() > 0) {

            $this->load->model('Pahiram_post_model');

            if ($this->Pahiram_post_model->insert()) {

                $this->output->set_status_header('201');
                $this->Pahiram_post_model->insert_image_location();
            } else {
                $this->output->set_status_header('409');
            }

            echo json_encode($this->input->post());
        }
    }

    public function update_post()
    {
        $this->load->model("Pahiram_post_model");
        if ($this->Pahiram_post_model->update_post()) {
            $this->output->set_status_header('200');
        } else {
            $this->output->set_status_header('409');
        }
    }

    public function get_image()
    {
        $this->load->helper('file');
        $filename = $this->input->get('path');
        header('Content-type: ' . get_mime_by_extension($filename));
        echo file_get_contents($filename);
    }

    public function deactivate_post()
    {
        $this->load->model('Pahiram_post_model');
        $status_code = $this->Pahiram_post_model->set_status($_POST['post_id']);
        $this->output->set_status_header($status_code);
    }
    // public function deactivate_post($post_id) {
    //     $this->load->model('Pahiram_post_model');
    //     $status_code = $this->Pahiram_post_model->set_status($post_id, $this->STATUS_DEACTIVATED);
    //     $this->output->set_status_header($status_code);
    // }


    public function send_request()
    {
        $this->load->model("Pahiram_post_model");
        if ($this->Pahiram_post_model->create_request()) {
            $this->output->set_status_header('201');
        } else {
            $this->output->set_status_header('409');
        }
    }

    public function accept_request()
    {
        $this->load->model("Pahiram_post_model");
        if ($this->Pahiram_post_model->update_post()) {
            $this->output->set_status_header('200');
        } else {
            $this->output->set_status_header('409');
        }
    }

    public function decline_request()
    {
        $this->load->model("Pahiram_post_model");
        $status_code = $this->Pahiram_post_model->decline_request();
        $this->output->set_status_header($status_code);
    }

    public function get_request()
    {
        $this->load->model("Pahiram_post_model");
        $data = $this->Pahiram_post_model->get_request();
        $this->output->set_content_type('application/json');
        echo json_encode($data);
    }
}
