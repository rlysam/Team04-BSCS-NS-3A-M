<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pahiram_Post_Model extends CI_Model {
    
    private $table = 'pahiram_post';

    // create post
    function insert() {
        $this->db->insert($this->table, $this->input->post());
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