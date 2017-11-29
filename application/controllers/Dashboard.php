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
    $this->load->model('mtransaksi');
    $graph_pendapatan = [0,0,0,0,0,0,0,0,0,0,0,0];
    $graph_pengeluaran = [0,0,0,0,0,0,0,0,0,0,0,0];
    $banyak_murid = $this->mmurid->getmurid()->num_rows();

    $data_spp_lunas = $this->mtransaksi->getspplunas()->row_array();
    $prosentase_spp = array('lunas' => $data_spp_lunas['jumlah_lunas'] * (100/$banyak_murid),
                            'belum_lunas' => ($banyak_murid - $data_spp_lunas['jumlah_lunas']) * (100/$banyak_murid));
    $data_pendapatan = $this->mtransaksi->getpendapatan()->result();
    $data_pengeluaran = $this->mtransaksi->getpengeluaran()->result();

    foreach ($data_pendapatan as $data) {
      $graph_pendapatan[date("m",strtotime($data->dibuat))-1] = $data->nominal;
    }
    foreach ($data_pengeluaran as $data) {
      $graph_pengeluaran[date("m",strtotime($data->dibuat))-1] = $data->nominal;
    }
    $data_page = array(
      'title' => 'Dashboard',
      'button' =>'',
      'side_bar' => $this->mmenu->getmenu()->result(),
      'content' => $this->load->view('dashboard', array('banyak_murid'=>$banyak_murid,'graph_pendapatan'=>$graph_pendapatan,'graph_pengeluaran'=>$graph_pengeluaran, 'prosentase_spp' => $prosentase_spp),true)
    );
    $this->parser->parse('main', $data_page);
  }

}
