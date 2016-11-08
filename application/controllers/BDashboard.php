<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BDashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('bauth');
  }

  function index()
  {
    $data_page = array(
      'title' => 'Dashboard',
      'button' =>'',
      'side_bar' => $this->modelsik->getmenu()->result(),
      'content' => $this->load->view('b_dashboard', array(),true)
    );
    $this->parser->parse('b_main', $data_page);
  }

}
