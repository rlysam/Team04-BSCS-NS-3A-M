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
        //$_POST['first_name'] = $user[0]['first_name'];
        //$_POST['last_name'] = $user[0]['last_name'];
        $imageBase64 = $_POST['image'];
        $image_name = $_POST['image_name'];
        unset($_POST['image']);
        unset($_POST['image_name']);
        $query = $this->db->insert($this->db_table, $this->input->post());
        if (strcmp($_POST['chat_type'], 'image') == 0) 
        {
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
