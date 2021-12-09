<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class Pahiram_Post_Model extends CI_Model {
        
        private $table = 'pahiream_post';
        private $users_table = 'users';

        // create post
        public function insert() {
            $this->db->insert($this->table, $this->input->post());
        }
        
        // get post (by id)
        public function get_post() {
            $query = $this->db->get($this->table);
            
            return $query->result_array();
        }

        // deactivate post (e.g delete post)
        public function deactivate_status($id) {
            $this->db->set('unavailable');
            $this->db->where('post_id', $id);
            $this->db->update($this->table);
        }
        
    }