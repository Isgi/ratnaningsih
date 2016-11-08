<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BJenisPembayaran extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('bauth');
  }

  public function index()
  {
    $data_content = $this->modelsik->getjenispembayaranbyuser()->result();
    $data_page    = array(
    'title'     => 'Jenis Pembayaran',
    'button'    => '',
    'side_bar'  => $this->modelsik->getmenu()->result(),
    'content'   => $this->parser->parse('b_jenis_pembayaran', array('data_content'=>$data_content),true)
    );
    $this->parser->parse('b_main', $data_page);
  }

  public function actAdd(){
    $kode           = $this->input->post('kode');
    $nama_transaksi = $this->input->post('nama');
    $periode        = $this->input->post('periode');
    $jenis          = $this->input->post('jenis');

    $data_jenis_pembayaran = array('kode'             => $kode,
                                   'nama'             => $nama_transaksi,
                                   'periode_bulanan'  => $periode,
                                   'jenis'            => $jenis);
    $this->modelsik->insertjenispembayaran($data_jenis_pembayaran);

    redirect('bjenispembayaran');
  }

}
