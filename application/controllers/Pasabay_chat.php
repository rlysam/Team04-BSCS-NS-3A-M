<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Pasabay_chat extends CI_Controller
{

    public function send_message()
    {
        $this->load->model('Pasabay_chat_model');
        $this->Pasabay_chat_model->store_message();

    }
}
