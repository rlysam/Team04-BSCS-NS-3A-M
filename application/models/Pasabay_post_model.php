<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasabay_post_model extends CI_Model
{

    private $db_table = "pasabay_post";

    public function get_post()
    {


        if ($this->input->get('page') != null) {
            $total_rows  = $this->db->count_all($this->db_table);
            $total_pages = ceil($total_rows / 10);
            $this->db->where('status','active');
            $query = $this->db->get($this->db_table, 10, ($this->input->get('page') - 1) * 10);
            $data = array(
                "total_posts" => $total_rows,
                "total_pages" => $total_pages,
                "posts" => $query->result_array()
            );

            return $data;
        } else if ($this->input->get('post_id') != null) {
            //$this->db->where('post_id', $_GET['post_id']);
            //$query = $this->db->get($this->db_table);
            $data = array(
                'post_id' => $_GET['post_id'],
                'status' => 'active'
            );
            $query = $this->db->get_where($this->db_table, $data);
            $result = $query->result_array();

            return $result[0];
        } else if ($this->post->get('user_id') != null) {
            //$this->db->where('user_id', $_GET['user_id']);
            //$query = $this->db->get($this->db_table);
            $data = array(
                'user_id' => $_GET['user_id'],
                'status' => 'active'
            );
            $query = $this->db->get_where($this->db_table, $data);
            return $query->result_array();
        } else {
            $query = $this->db->get($this->db_table);
        }

        return $query->result_array();
    }

    public function create_post()
    {
        return $this->db->insert($this->db_table, $this->input->post());
    }

    // public function insert_image_location(){
    //     $image_file = $_FILES['file']['name'];
    //     $file_extension = pathinfo($image_file, PATHINFO_EXTENSION);
    //     $url = "http://localhost/Team04-BSCS-NS-3A-M/pasabay_post/get_image/?path=";
    //     $input['image_location'] = $url . 'uploads/posts/pasabay/' . $this->db->insert_id() . "." . $file_extension;
    //     move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/posts/pasabay/' . $this->db->insert_id() . "." . $file_extension);
    //     $this->db->set($input);
    //     $this->db->where('post_id',$this->db->insert_id());
    //     $this->db->update($this->db_table);
    // }

    //Image base64 encoding

    public function insert_image_location()
    {
        $image = base64_decode($_POST['image']);
        $file_extension = pathinfo($_POST['image_name'], PATHINFO_EXTENSION);
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
