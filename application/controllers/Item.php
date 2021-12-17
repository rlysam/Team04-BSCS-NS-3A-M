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

        // di ako sure mismong drop natin yung row or deactivate na lang din item         
        function delete_item(){}

        // di rin ako sure kung row na eedit at once or modular siya

        // edit entire specific row
        function edit_item($item_id){
            $data = array(
                'item_name' => $this->input->post('item_id'),
                'quantity' => $this->input->post('quantity'),
                'description' => $this->input->post('description')
            );

            $this->load->model('Item_Model');

            $status_code = $this->Item_Model->update_item($item_id, $data);

            $this->output->set_status_header($status_code);
            
        }

        function edit_item_name($item_id, $flag = 'item_name'){
            $flag = 'item_name';
            $this->load->model('Item_Model');
            $data = $this->Item_Model->get_item_name($item_id);
            $status_code = '404'; //default 

            if (empty($item_name))
                $status_code = '404';
            else {
                $this->Item_Model->update($item_id, $flag, $item_name);
                $status_code = '200';
            }

            $this->output->set_status_header($status_code);
        }

        function edit_item_description($item_id, $flag = 'description'){
            $flag = 'description';
            $this->load->model('Item_Model');
            $data = $this->Item_Model->get_item_description($item_id);
            $status_code = '404'; //default 


            if (empty($item_name))
                $status_code = '404';
            else {
                $this->Item_Model->update($item_id, $flag, $item_name);
                $status_code = '200';
            }

            $this->output->set_status_header($status_code);
        }
        
        function edit_quantity($item_id, $flag = 'quantity'){
            $flag = '';
            $this->load->model('Item_Model');
            $data = $this->Item_Model->get_quantity($item_id);
            $status_code = '404'; //default 

            if (empty($item_name))
                $status_code = '404';
            else {
                $this->Item_Model->update($item_id, $flag, $item_name);
                $status_code = '200';
            }

            $this->output->set_status_header($status_code);
        }


    }