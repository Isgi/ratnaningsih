<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('mkelas');
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  function index(){
    $this->load->model('msekolah');
    $data_content = $this->mkelas->getkelas()->result();
    $data_sekolah = $this->msekolah->getsekolah()->result();
    $data_page    = array(
    'title'     => 'Kelas ',
    'button'    => '',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('kelas', array('data_sekolah' => $data_sekolah, 'data_content' => $data_content),true)
    );
    $this->parser->parse('main', $data_page);
  }

  function actAdd(){
    $nama_kelas = $this->input->post('nama');
    $kapasitas  = $this->input->post('kapasitas');
    $sekolah    = $_REQUEST['sekolah'];

    $data_kelas = array('nama'      => $nama_kelas,
                        'kapasitas' => $kapasitas,
                        'sekolah'   => $sekolah);
    $this->mkelas->insertkelas($data_kelas);
    if($this->db->affected_rows() > 0)
      $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Tambah BERHASIL</div>");
    else
      $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Tambah GAGAL</div>");
    redirect('kelas');
  }

  public function actDelete($id){
    $this->mkelas->deletekelas($id);
    redirect('kelas');
  }

}
