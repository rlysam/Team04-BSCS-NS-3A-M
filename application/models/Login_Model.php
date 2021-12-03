<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

    private $db_table = "users";

    public function get_user(){
        $query = $this->db->get($this->db_table);

        return $query -> result_array();
    }
	
    public function get_user_by_email($email) {

        //get results where email is given
        $this->db->select($this->db_table)->where('email', $email);
        // $this->db->get_where($this->db_table, array('email' => $email));

        // return a count if the email exists in the table
        $count = $this->db->count_all_results($this->db_table);

        if ($count > 0){
            // email exists in the database
            // get the result
            $result = $this->db->get_where($this->db_table, array('email' => $email));
        } else {
            $result = array();
            return $result;
        }


        return $result->row_array();
    }
}