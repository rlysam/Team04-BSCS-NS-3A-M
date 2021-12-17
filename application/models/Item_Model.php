<?php
defined('BASEPATH') OR exit('No direct script access allowed');


    class Item_Model extends CI_Model{

        private $table = 'items';
        function get_item() {  return $this->db->get($this->table)->result_array(); }

        function insert() { $this->db->insert($this->table, $this->input->post()); }

        function update($item_id, $flag, $data) {
            $this->db->set($flag, $data);
            $this->db->where('item_id', $item_id);
            $this->db->update($this->table);
            return ($this->db->affected_rows() > 0) ? '200' : '404'; // pa correct na lang kung ano tamang error code
        }   
        
        function update_item($item_id) {
            $this->db->set('item_name, quantity, description', $data);
            $this->db->where('item_id', $item_id);
            $this->db->update($this->table);

            return ($this->db->affected_rows() > 0) ? '200' : '404'; // pa correct na lang kung ano tamang error code
        }
        function get_item_quantity($item_id) {
            $this->db->select('quantity');
            $this->db->where('item_id', $item_id);
            $query = $this->db->get($this->table);

            $result = $query->row();

            return $result->quantity;
        }

        function get_item_name($item_id) {
            $this->db->select('item');
            $this->db->where('item_id', $item_id);
            $query = $this->db->get($this->table);

            $result = $query->row();

            return $result->item;
        }

        function get_item_description($item_id){
            $this->db->select('description');
            $this->db->where('item_id', $item_id);
            $query = $this->db->get($this->table);

            $result = $query->row();

            return $result->description;
        }
    }