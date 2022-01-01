<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasabay_post_Model extends CI_Model {

    private $db_table = "pasabay_post";

    public function get_post(){
        $query = $this->db->get($this->db_table);

        return $query -> result_array();
    }

    function create_post(){
        return $this->db->insert($this->db_table, $this->input->post());
    }

    function insert_image_location($path){
        $file_extension = pathinfo($path, PATHINFO_EXTENSION);
        $input['image_location'] = 'uploads/posts/pasabay/' . $this->db->insert_id() . "." . $file_extension;
        $this->db->set($input);
        $this->db->where('post_id',$this->db->insert_id());
        $this->db->update($this->db_table);

        return $input['image_location'];
    }
	
    function deactivate_post($post_id){
        $this->db->set('status', 'deactivated');
        $this->db->where('post_id',$post_id);
        $this->db->update($this->db_table);
        return ($this->db->affected_rows() > 0) ? '200' : '409';
    }

}
