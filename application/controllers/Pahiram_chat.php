<?php
/*
* Pahiream, TUP student resource sharing and delivery
* Copyright (C) 2022
*/
defined('BASEPATH') || exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Pahiram_chat extends CI_Controller
{

  public function send_message()
  {
    $this->load->model('Pahiram_chat_model');
    $this->Pahiram_chat_model->store_message();
  }

  public function get_image()
  {
    $this->load->helper('file');
    $filename = $this->input->get('path');
    header('Content-type: ' . get_mime_by_extension($filename));
    echo file_get_contents($filename);
  }
}
