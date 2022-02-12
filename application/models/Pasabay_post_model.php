<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pasabay_post_model extends CI_Model
{
    private $db_table = "pasabay_post";
    private $db_delivery = "pasabay_delivery";
    private $db_request = "pasabay_request";
    public function get_post()
    {
        if ($this->input->get('page') != null) {
            $total_rows  = $this->db->count_all($this->db_table);
            $total_pages = ceil($total_rows / 10);
            $this->db->where('status', 'active');
            $query = $this->db->get($this->db_table, 10, ($this->input->get('page') - 1) * 10);
            return array(
                "total_posts" => $total_rows,
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

    //Image base64 encoding
    public function insert_image_location()
    {
        $image = base64_decode($_POST['image']);
        $fileExtension = pathinfo($_POST['image_name'], PATHINFO_EXTENSION);
        $url = "http://localhost/Team04-BSCS-NS-3A-M/Pasabay_post/get_image/?path=";
        $path = 'uploads/posts/pasabay/' . $this->db->insert_id() . "." . $fileExtension;
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
        if (strcmp($query[0]['type'], 'delivery') == 0) {
            $deliveryData = array(
                'post_id ' => $query[0]['post_id'],
                'requestor_id ' => $query[0]['user_id'],
                'first_name	' => $query[0]['first_name'],
                'last_name' => $query[0]['last_name'],
                'destination' => $query[0]['destination'],
                'item' => $query[0]['item'],
                'quantity' => $query[0]['quantity'],
                'status' => 'delivering'
            );
            $this->db->insert($this->db_delivery, $deliveryData);
        } else if (strcmp($query[0]['type'], 'single_delivery') == 0) {
            $this->db->set('status', 'accepted');
            $this->db->where('request_id', $this->input->post('request_id'));
            $this->db->update($this->db_request);
        }
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
