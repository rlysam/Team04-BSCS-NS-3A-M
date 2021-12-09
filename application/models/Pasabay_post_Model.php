<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasabay_post_Model extends CI_Model {

    private $db_table = "pasabay_post";

    public function get_post(){
        $query = $this->db->get($this->db_table);

        return $query -> result_array();
    }


    //FOR TESTING
    function create_post(){
        return $this->db->insert($this->db_table, $this->input->post());
    }
	
}
