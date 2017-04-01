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
    $this->load->model('mmurid');
    $this->load->model('mpembayaran');
    $banyak_murid = $this->mmurid->getmurid()->num_rows();
    $data_kekurangan = $this->mpembayaran->getkekurangan()->row_array();
    $data_lunas = $this->mpembayaran->getlunas()->row_array();

    print_r($data_kekurangan);

    $data_page = array(
      'title' => 'Dashboard',
      'button' =>'',
      'side_bar' => $this->mmenu->getmenu()->result(),
      'content' => $this->load->view('dashboard', array('banyak_murid'=>$banyak_murid,'data_kekurangan'=>$data_kekurangan,'data_lunas'=>$data_lunas),true)
    );
    $this->parser->parse('main', $data_page);
  }

}
