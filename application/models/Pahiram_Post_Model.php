<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pahiram_Post_Model extends CI_Model {
    
    private $table = 'pahiram_post';

    // create post
    function insert() {
        return $this->db->insert($this->table, $this->input->post());
    }
    
    function insert_image_location($path){
        $file_extension = pathinfo($path, PATHINFO_EXTENSION);
        $input['image_location'] = 'uploads/posts/pahiram/' . $this->db->insert_id() . "." . $file_extension;
        $this->db->set($input);
        $this->db->where('post_id',$this->db->insert_id());
        $this->db->update($this->table);

        return $input['image_location'];
    }

    // get post (by id)
    function get_post() {
        $query = $this->db->get($this->table);
        
        return $query->result_array();
    }

    // set post status post (e.g deactivate post)
    function set_status($post_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('post_id', $post_id);
        $this->db->update($this->table);
        return ($this->db->affected_rows() > 0) ? '200' : '409';
    }
    
}