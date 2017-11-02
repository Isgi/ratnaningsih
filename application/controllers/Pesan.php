<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

  public function __construct(){
      parent::__construct();
      $this->load->model('mtransaksi');
      if(!$this->session->userdata('username'))
          redirect('auth');
  }

  public function index() {
    $data_page    = array(
      'title'     => 'Pesan ',
      'button'    => '',
      'side_bar'  => $this->mmenu->getmenu()->result(),
      'content'   => $this->parser->parse('pesan', array(),true)
    );
    $this->parser->parse('main', $data_page);
  }
}
