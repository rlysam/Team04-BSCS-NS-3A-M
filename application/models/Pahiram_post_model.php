<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pahiram_post_model extends CI_Model
{

    private $db_table = 'pahiram_post';
    private $db_request = 'pahiram_request';
    // get post (by id)
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
        } else if ($this->input->get('user_id')) {
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

    // create post
    public function insert()
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

    //Insert Image Base64 encoding
    public function insert_image()
    {
        $image = base64_decode($this->input->post('image'));
        $file_extension = pathinfo($this->input->post('image_name'), PATHINFO_EXTENSION);
        $url = "http://localhost/Team04-BSCS-NS-3A-M/Pahiram_post/get_image/?path=";
        $path = 'uploads/chat/pahiram/' . $this->db->insert_id() . "." . $file_extension;
        file_put_contents($path, $image);
        $this->db->set('image_location', $url . $path);
        $this->db->where('post_id', $this->db->insert_id());
        $this->db->update($this->db_table);
    }

    // set post status post (e.g deactivate post)
    public function set_status($post_id)
    {
        $this->db->set('status', 'deactivated');
        $this->db->where('post_id', $post_id);
        $this->db->update($this->db_table);
        return ($this->db->affected_rows() > 0) ? '200' : '409';
    }

    public function create_request()
    {
        return $this->db->insert($this->db_request, $this->input->post());
    }

    public function get_request()
    {
        $data = array(
            'user_id' => $this->input->get('user_id'),
            'status' => 'active'
        );
        $query = $this->db->get_where($this->db_request, $data);
        return $query->result_array();
    }

    public function decline_request()
    {
        $this->db->set('status', 'deactivated');
        $this->db->where('request_id', $this->input->post('request_id'));
        $this->db->update($this->db_request);
        return ($this->db->affected_rows() > 0) ? '200' : '409';
    }
}
