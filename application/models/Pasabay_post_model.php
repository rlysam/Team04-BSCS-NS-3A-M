<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pasabay_post_model extends CI_Model
{
    private $db_table = "pasabay_post";
    public function get_post()
    {
        if ($this->input->get('page') != null) {
            $total_rows  = $this->db->count_all($this->db_table);
            $total_pages = ceil($total_rows / 10);
            $this->db->where('status', 'active');
            $query = $this->db->get($this->db_table, 10, ($this->input->get('page') - 1) * 10);
            $data = array(
                "total_posts" => $total_rows,
                "total_pages" => $total_pages,
                "posts" => $query->result_array()
            );
            return $data;
        } else if ($this->input->get('post_id') != null) {
            $data = array(
                'post_id' => $this->input->get('post_id'),
                'status' => 'active'
            );
            $query = $this->db->get_where($this->db_table, $data);
            $result = $query->result_array();
            return $result[0];
        } else if ($this->post->get('user_id') != null) {
            $data = array(
                'user_id' => $this->input->get('user_id'),
                'status' => 'active'
            );
            $query = $this->db->get_where($this->db_table, $data); 
        } else {
            $query = $this->db->get($this->db_table);
        }
        return $query->result_array();
    }

    public function create_post() 
    {
        return $this->db->insert($this->db_table, $this->input->post());
    }

    #NOT TESTED YET
    public function update_post()
    {
        $this->db->where('post_id', $this->input->post('post_id'));
        unset($this->input->post('post_id'));
        return $this->db->update($this->db_table, $this->input->post());
    }

    //Image base64 encoding
    public function insert_image_location()
    {
        $image = base64_decode($this->input->post('image'));
        $file_extension = pathinfo($this->input->post('image_name'), PATHINFO_EXTENSION);
        $url = "http://localhost/Team04-BSCS-NS-3A-M/Pasabay_chat/get_image/?path=";
        $path = 'uploads/chat/pasabay/' . $this->db->insert_id() . "." . $file_extension;
        file_put_contents($path, $image);
        $this->db->set('image_location', $url . $path);
        $this->db->where('post_id', $this->db->insert_id());
        $this->db->update($this->db_table);
    }

    public function deactivate_post($post_id)
    {
        $this->db->set('status', 'deactivated');
        $this->db->where('post_id', $post_id);
        $this->db->update($this->db_table);
        return ($this->db->affected_rows() > 0) ? '200' : '409';
    }
}
