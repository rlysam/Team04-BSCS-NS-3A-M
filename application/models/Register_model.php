<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Register_model extends CI_Model
{

    private $db_table = "users";

    public function get_user($email = null, $tup_id = null)
    {

        if ($email != null && $tup_id != null) 
        {
            $this->db->where('email', $email);
            $this->db->where('tup_id', $tup_id);
        }
        $query = $this->db->get($this->db_table);

        return $query->result_array();
    }


    //FOR TESTING
    public function insert_user()
    {
        $this->db->insert($this->db_table, $this->input->post());
    }
}
