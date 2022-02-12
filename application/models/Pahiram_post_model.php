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
            $totalRows  = $this->db->count_all($this->db_table);
            $total_pages = ceil($totalRows / 9);
            $this->db->where('status', 'active');
            $query = $this->db->get($this->db_table, 9, ($this->input->get('page') - 1) * 9);

            return array(
                "total_posts" => $totalRows,
                "total_pages" => $total_pages,
                "posts" => $query->result_array()
            );
        } else if ($this->input->get('post_id') != null) {
            $data = array(
                'post_id' => $this->input->get('post_id'),
                'status' => 'active'
            );
            $query = $this->db->get_where($this->db_table, $data);
            $result = $query->result_array();
            return $result;
        } else if ($this->input->get('user_id') != null) {
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

        $data = array(
            'user_id' => $this->input->post('user_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'type' => $this->input->post('type'),
            'title' => $this->input->post('title'),
            'points' => $this->input->post('points'),
            'rate' => $this->input->post('rate'),
            'time_posted' => $this->input->post('time_posted'),
            'date' => $this->input->post('date'),
            'location' => $this->input->post('location'),
        );
        return $this->db->insert($this->db_table, $data);
    }

    #NOT TESTED YET
    public function update_post()
    {
        $this->db->where('post_id', $this->input->post('post_id'));
        unset($_POST['post_id']);
        return $this->db->update($this->db_table, $this->input->post());
    }

    //Insert Image Base64 encoding
    public function insert_image()
    {
        $image = base64_decode($this->input->post('image'));
        $fileExtension = pathinfo($this->input->post('image_name'), PATHINFO_EXTENSION);
        $url = "http://localhost/Team04-BSCS-NS-3A-M/Pahiram_post/get_image/?path=";
        $path = 'uploads/posts/pahiram/' . $this->db->insert_id() . "." . $fileExtension;
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
            'poster_id' => $this->input->post('user_id'),
            'status' => 'active'
        );
        $query = $this->db->get_where($this->db_request, $data);
        return $query->result_array();
    }

    public function accept_request()
    {
        $data = array(
            'request_id' => $this->input->post('request_id'),
            'status' => 'active'
        );
        $query = $this->db->get_where($this->db_request, $data);
        $query = $query->result_array();
        $this->db->set('status', 'accepted');
        $acceptedData = array(
            'participant_id ' => $query[0]['user_id'],
            'participant_first_name	' => $query[0]['first_name'],
            'participant_last_name' => $query[0]['last_name'],
            'rate' => $query[0]['rate'],
            'status' => 'accepted'
        );  
        $this->db->where('post_id', $query[0]['post_id']);
        $this->db->update($this->db_table, $acceptedData);

        $this->db->set('status', 'accepted');
        $this->db->where('request_id', $this->input->post('request_id'));
        $this->db->update($this->db_request);
        return ($this->db->affected_rows() > 0) ? '200' : '409';
    }

    public function decline_request()
    {
        $this->db->set('status', 'deactivated');
        $this->db->where('request_id', $this->input->post('request_id'));
        $this->db->update($this->db_request);
        return ($this->db->affected_rows() > 0) ? '200' : '409';
    }
}
