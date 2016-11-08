<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BKelas extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('bauth');
  }

  function index()
  {
    $data_content = $this->modelsik->getkelasbyuser()->result();
    $data_derajat = $this->modelsik->getsekolahbyuser()->result();
    $data_page    = array(
    'title'     => 'Kelas ',
    'button'    => '',
    'side_bar'  => $this->modelsik->getmenu()->result(),
    'content'   => $this->parser->parse('b_kelas', array('data_derajat' => $data_derajat, 'data_content' => $data_content),true)
    );
    $this->parser->parse('b_main', $data_page);
  }

  function actAdd(){
    $nama_kelas = $this->input->post('nama');
    $kapasitas  = $this->input->post('kapasitas');
    $sekolah    = $_REQUEST['sekolah'];

    $data_kelas = array('nama'      => $nama_kelas,
                        'kapasitas' => $kapasitas,
                        'sekolah'   => $sekolah);
    $this->modelsik->insertkelas($data_kelas);

    redirect('bkelas');
  }

}
