<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itempembayaran extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('mitempembayaran');
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  public function index()
  {
    $this->load->model('mjenispembayaran');
    $this->load->model('mprogram');
    $this->load->model('msekolah');
    $data_jenis_pembayaran  = $this->mjenispembayaran->getjenispembayaran()->result();
    $data_program           = $this->mprogram->getprogram()->result();
    $data_sekolah           = $this->msekolah->getsekolah()->result();
    $data_content           = $this->mitempembayaran->getitempembayaran()->result();
    $data_page    = array(
    'title'     => 'Item Pembayaran ',
    'button'    => '',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('item_pembayaran', array( 'data_sekolah'          => $data_sekolah,
                                                                    'data_program'          => $data_program,
                                                                    'data_jenis_pembayaran' => $data_jenis_pembayaran,
                                                                    'data_content'          => $data_content
                                                                  ),true)
    );
    $this->parser->parse('main', $data_page);
  }

  public function actAdd(){
    $jenis_pembayaran= $this->input->post('jenis_pembayaran');
    $program        = $this->input->post('program');
    $sekolah        = $_REQUEST['sekolah'];
    $harga          = $this->input->post('harga');

    $data_item_pembayaran = array('jenis_pembayaran'      => $jenis_pembayaran,
                                  'program'              => $program,
                                  'sekolah'              => $sekolah,
                                  'harga'                =>$harga);
    $this->mitempembayaran->insertitempembayaran($data_item_pembayaran);
    if($this->db->affected_rows() > 0)
      $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Tambah BERHASIL</div>");
    else
      $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Tambah GAGAL</div>");
    redirect('itempembayaran');
  }

  public function edit($id){
    $this->load->model('mjenispembayaran');
    $this->load->model('mprogram');
    $this->load->model('msekolah');
    $data_jenis_pembayaran  = $this->mjenispembayaran->getjenispembayaran()->result();
    $data_program           = $this->mprogram->getprogram()->result();
    $data_sekolah           = $this->msekolah->getsekolah()->result();
    $data_edit              = $this->mitempembayaran->getitempembayaranby(array('item_pembayaran.id' => $id))->row_array();

    $data_page    = array(
    'title'     => 'Edit Item Pembayaran',
    'button'    => '',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('item_pembayaran_edit', array( 'data_sekolah'          => $data_sekolah,
                                                                    'data_program'          => $data_program,
                                                                    'data_jenis_pembayaran' => $data_jenis_pembayaran,
                                                                    'data_edit'          => $data_edit
                                                                  ),true)
    );
    $this->parser->parse('main', $data_page);
  }

  public function actEdit(){
    $id             = $this->input->post('id');
    $jenis_pembayaran= $this->input->post('jenis_pembayaran');
    $program        = $this->input->post('program');
    $sekolah        = $this->input->post('sekolah');
    $harga          = $this->input->post('harga');

    $data_item_pembayaran = array('id'                   => $id,
                                  'jenis_pembayaran'      => $jenis_pembayaran,
                                  'program'              => $program,
                                  'sekolah'              => $sekolah,
                                  'harga'                =>$harga);
    $this->mitempembayaran->updateitempembayaran($data_item_pembayaran);
    if($this->db->affected_rows() > 0)
      $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Ubah BERHASIL</div>");
    else
      $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Ubah GAGAL</div>");
    redirect('itempembayaran');
  }

  public function actDelete($id){
    $this->mitempembayaran->deleteitempembayaran($id);
    redirect('itempembayaran');
  }

}
