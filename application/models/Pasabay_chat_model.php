<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pasabay_chat_model extends CI_Model 
{

    private $db_table = 'pasabay_chat';
    private $users_table = 'users';

    public function store_message() 
    {

        $user = $this->db->get_where($this->users_table, array('user_id' => (int) $this->input->post('user_id')));
        $user = $user->result_array();
        //$this->input->post('first_name') = $user[0]['first_name'];
        //$this->input->post('last_name') = $user[0]['last_name'];
        $imageBase64 = $this->input->post('image');
        $image_name = $this->input->post('image_name');
        unset($this->input->post('image'));
        unset($this->input->post('image_name'));
        $query = $this->db->insert($this->db_table, $this->input->post());
        if (strcmp($this->input->post('chat_type'), 'image') == 0) {
            $image = base64_decode($imageBase64);
            $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $url = "http://localhost/Team04-BSCS-NS-3A-M/Pasabay_chat/get_image/?path=";
            $path = 'uploads/chat/pasabay/' . $this->db->insert_id() . "." . $file_extension;
            file_put_contents($path, $image);
            $this->db->set('image_location', $url . $path);
            $this->db->where('chat_id', $this->db->insert_id());
            $this->db->update($this->db_table);
        }
    }
}
