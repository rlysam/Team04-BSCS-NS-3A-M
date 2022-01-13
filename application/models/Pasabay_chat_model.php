<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasabay_chat_model extends CI_Model {

    private $db_table = 'pasabay_chat';
    private $users_table = 'users';

    public function store_message(){

        $user = $this->db->get_where($this->users_table, array('user_id' => (int) $this->input->post('user_id')));
        $user = $user->result_array();
        $_POST['first_name'] = $user[0]['first_name'];
        $_POST['last_name'] = $user[0]['last_name']; 
        return $this->db->insert($this->db_table, $this->input->post());
    }
    
}