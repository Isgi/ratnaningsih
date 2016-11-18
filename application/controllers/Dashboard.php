<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  function index()
  {
    $data_page = array(
      'title' => 'Dashboard',
      'button' =>'',
      'side_bar' => $this->ratnaningsih->getmenu()->result(),
      'content' => $this->load->view('dashboard', array(),true)
    );
    $this->parser->parse('main', $data_page);
  }

}
