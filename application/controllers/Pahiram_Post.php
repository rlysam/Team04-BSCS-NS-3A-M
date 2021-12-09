
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


    class Pahiram_Post extends CI_Controller {

        function __constructor() {
            parent::__constructor();

            // load model
            $this->load->model('Pahiram_Post_Model');
        }


        function create_post() {

            if ($this->input->post() > 0) {
                if($this->Pahiram_post_Model->insert()) {
                    $this->output->set_status_header('201');
                } else {
                    // post already exists
                    $this->output->set_status_header('409');
                }
            } else {
                $this->set_header_status('400');
            }

            echo json_encode($this->input->post());

        }

        public function get_post() {

            $data = $this->Pahiram_Post_Model->get_post();

            if (count($data) > 0) {
                echo json_encode($data);
            } else {
                // internal server error
                $this->set_status_header('500');
            }
        }

    }