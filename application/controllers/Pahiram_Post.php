
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');


class Pahiram_Post extends CI_Controller {
    
    private $STATUS_AVAILABLE = 'available';
    private $STATUS_UNAVAILABLE = 'unavailable';
    private $STATUS_RENTING = 'renting';
    private $STATUS_REQUESTING = 'requesting';
    private $STATUS_DEACTIVATED = 'deactivated';


    function __constructor() {
        parent::__constructor();

        // load model
        $this->load->model('Pahiram_Post_Model');
    }


    function create_post() {

        if ($this->input->post() > 0) {
            if($this->Pahiram_post_Model->insert())
                $this->output->set_status_header('200');
        } else {
            $this->set_header_status('400');
        }

        echo json_encode($this->input->post());

    }

    public function get_post() {

        $data = $this->Pahiram_Post_Model->get_post();

        echo json_encode($data[0]);
    }

    function set_post_available($post_id) { 
        $status_code = $this->Pahiram_Post_Model->set_status($post_id, $STATUS_AVAILABLE);
        $this->output->set_status_header($status_code);
    }

    function set_post_unavailable($post_id) {
        $status_code = $this->Pahiram_Post_Model->set_status($post_id, $STATUS_UNAVAILABLE);
        $this->output->set_status_header($status_code);
    }

    function set_post_renting($post_id) {
        $status_code = $this->Pahiram_Post_Model->set_status($post_id, $STATUS_RENTING);
        $this->output->set_status_header($status_code);
    }

    function set_post_requesting($post_id) {
        $status_code = $this->Pahiram_Post_Model->set_status($post_id, $STATUS_REQUESTING);
        $this->output->set_status_header($status_code);
    }

    function deactivate_post($post_id) {
        $status_code = $this->Pahiram_Post_Model->set_status($post_id, $STATUS_DEACTIVATED);
        $this->output->set_status_header($status_code);
    }

}