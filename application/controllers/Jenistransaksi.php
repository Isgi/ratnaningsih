<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenistransaksi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('mjenistransaksi');
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  public function index()
  {
    $data_content = $this->mjenistransaksi->getjenistransaksi()->result();
    $data_page    = array(
    'title'     => 'Jenis Pembayaran',
    'button'    => '',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('jenis_transaksi', array('data_content'=>$data_content),true)
    );
    $this->parser->parse('main', $data_page);
  }

  public function actAdd(){
    $kode           = $this->input->post('kode');
    $nama_pembayaran = $this->input->post('nama');
    $periode        = $this->input->post('periode');
    $jenis          = $this->input->post('jenis');

    $data_jenis_pembayaran = array('kode'             => $kode,
                                   'nama'             => $nama_pembayaran,
                                   'periode'          => $periode,
                                   'jenis'            => $jenis);
    $this->mjenistransaksi->insertjenistransaksi($data_jenis_pembayaran);
    if($this->db->affected_rows() > 0)
      $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Tambah BERHASIL</div>");
    else
      $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Tambah GAGAL</div>");
    redirect('jenistransaksi');
  }

  public function edit($id){
    $data_edit = $this->mjenistransaksi->getjenistransaksiby(array('id' => $id))->result();

    $data_page    = array(
    'title'     => 'Edit Jenis Pembayaran '.$data_edit[0]->nama,
    'button'    => '',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('jenis_transaksi_edit', array('data_edit' => $data_edit),true)
    );
    $this->parser->parse('main', $data_page);
  }

  public function actEdit(){
    $id             = $this->input->post('id');
    $kode           = $this->input->post('kode');
    $nama_pembayaran = $this->input->post('nama');
    $periode        = $this->input->post('periode');
    $jenis          = $this->input->post('jenis');

    $data_jenis_pembayaran = array('id'               => $id,
                                   'kode'             => $kode,
                                   'nama'             => $nama_pembayaran,
                                   'periode'          => $periode,
                                   'jenis'            => $jenis);
    $this->mjenistransaksi->updatejenistransaksi($data_jenis_pembayaran);
    if($this->db->affected_rows() > 0)
      $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Ubah BERHASIL</div>");
    else
      $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Ubah GAGAL</div>");
    redirect('jenistransaksi');
  }

  public function actDelete($id){
    $this->mjenistransaksi->deletejenistransaksi($id);
    redirect('jenistransaksi');
  }
}
