<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_Model extends CI_Model {

    private $db_table = "users";

    public function get_user($f_name = null, $tup_id = null){

        if($f_name != null && $tup_id != null){
            $this->db->where('email', $_POST['email']);
            $this->db->where('tup_id', $_POST['tup_id']);
        }
        $query = $this->db->get($this->db_table);

        return $query -> result_array();
    }


    //FOR TESTING
    function insert_user(){
        $this->db->insert($this->db_table, $this->input->post());
    }
	
}
