<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  function index()
  {
    $data_content = $this->ratnaningsih->getkelas()->result();
    $data_sekolah = $this->ratnaningsih->getsekolah()->result();
    $data_page    = array(
    'title'     => 'Kelas ',
    'button'    => '',
    'side_bar'  => $this->ratnaningsih->getmenu()->result(),
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
    $this->ratnaningsih->insertkelas($data_kelas);

    redirect('kelas');
  }

}
