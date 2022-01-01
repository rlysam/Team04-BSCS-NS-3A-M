<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

    class Item extends CI_Controller {

        function create_item(){
            if ($this->input->post() > 0) {
                $this->load->Model('Item_Nodel');
                
                if ($this->Item_Model->insert())
                    $this->output->set_status_header('200');
                else
                    $this->output->set_header_header('409'); 
            }

            echo json_encode($this->input->post());
        }


        function get_item(){

            $this->load->model('Item_Model');

            $data = $this->Item_Model->get_item();

            echo json_encode($data[0]);
        }

        // di rin ako sure kung row na eedit at once or modular siya

        // edit entire specific row
        function edit_item(){
            $data = array(
                'item_id' => $this->input->post('item_id'),
                'item_name' => $this->input->post('item_name'),
                'quantity' => $this->input->post('quantity'),
                'description' => $this->input->post('description')
            );

            $this->load->model('Item_Model');

            $status_code = $this->Item_Model->update_item($item_id, $data);

            $this->output->set_status_header($status_code);
            
        }

        function edit_item_name(){
            $flag = 'item_name';
            $this->load->model('Item_Model');

            $item_id = $this->input->post('item_id');
            $data = $this->input->post($flag);

            if (empty($data) and empty($item_id))
                $this->output->set_status_header('404');
            else {
                $this->Item_Model->update($item_id, $flag, $data);
                $this->output->set_status_header('200');
            }

        }

        function edit_item_description(){
            $flag = 'description';
            $this->load->model('Item_Model');

            $item_id = $this->input->post('item_id');
            $data = $this->input->post($flag);

            if (empty($data) and $empty($item_id))
                $this->output->set_status_header('404');
            else {
                $this->Item_Model->update($item_id, $flag, $data);
                $this->output->set_status_header('200');
            }

        }
        
        function edit_quantity(){
            $flag = 'quantity';
            $this->load->model('Item_Model');

            $item_id = $this->input->post('item_id');
            $data = $this->input->post($flag);

            if (empty($data) && empty($item_id))
                $this->output->set_status_header('404');
            else {
                $this->Item_Model->update($item_id, $flag, $data);
                $this->output->set_status_header('200');
            }

        }

        function deactivate() {
            $flag = 'status';
            $this->load->model('Item_Model');
            
            $item_id = $this->input->post('item_id');
            $data = $this->input->post($flag);


            if (empty($data) and empty($item_id))
                $this->output->set_status_header('404');
            else {
                $this->Item_Model->update($item_id, $flag, $data);
                $this->output->set_status_header('200');
            }
        }

    }