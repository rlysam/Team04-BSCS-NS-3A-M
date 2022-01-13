<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Pahiram_chat extends CI_Controller {
    
  public function send_message(){
    $this->load->model('Pahiram_chat_model');
    $this->Pahiram_chat_model->store_message();
  }
}