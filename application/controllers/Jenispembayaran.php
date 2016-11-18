<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenispembayaran extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  public function index()
  {
    $data_content = $this->ratnaningsih->getjenispembayaran()->result();
    $data_page    = array(
    'title'     => 'Jenis Pembayaran',
    'button'    => '',
    'side_bar'  => $this->ratnaningsih->getmenu()->result(),
    'content'   => $this->parser->parse('jenis_pembayaran', array('data_content'=>$data_content),true)
    );
    $this->parser->parse('main', $data_page);
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
    $this->ratnaningsih->insertjenispembayaran($data_jenis_pembayaran);

    redirect('jenispembayaran');
  }

  public function edit($id){
    $data_edit = $this->ratnaningsih->getjenispembayaranby(array('id' => $id))->result();
    $data_content = $this->ratnaningsih->getjenispembayaran()->result();
    $data_page    = array(
    'title'     => 'Jenis Pembayaran',
    'button'    => '',
    'side_bar'  => $this->ratnaningsih->getmenu()->result(),
    'content'   => $this->parser->parse('jenis_pembayaran', array('data_content'=>$data_content, 'data_edit' => $data_edit),true)
    );
    $this->parser->parse('main', $data_page);
  }

}
