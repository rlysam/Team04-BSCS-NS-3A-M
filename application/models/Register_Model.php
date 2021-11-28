<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_Model extends CI_Model {

    private $db_table = "users";

    public function get_user(){
        $query = $this->db->get($this->db_table);

        return $query -> result_array();
    }


    //FOR TESTING
    function insert_user(){
        $data = array(
            'title' => 'My title',
            'name' => 'My Name',
            'date' => 'My date'
        );
    
        $this->db->insert($this->db_table, $data);
    }
	
}
