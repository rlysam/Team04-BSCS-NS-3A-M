<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Pasabay_chat extends CI_Controller
{

    public function send_message()
    {
        $this->load->model('Pasabay_chat_model');
        $this->Pasabay_chat_model->store_message();
        echo "heloo";
    }

    public function get_image(){
        $this->load->helper('file');
        $filename = $this->input->get('path');
        header('Content-type: ' . get_mime_by_extension($filename));
        echo file_get_contents($filename); 
    }
}
