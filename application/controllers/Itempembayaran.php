<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itempembayaran extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  public function index()
  {
    $data_jenis_pembayaran  = $this->ratnaningsih->getjenispembayaran()->result();
    $data_program           = $this->ratnaningsih->getprogram()->result();
    $data_sekolah           = $this->ratnaningsih->getsekolah()->result();
    $data_content           = $this->ratnaningsih->getitempembayaran()->result();
    $data_page    = array(
    'title'     => 'Jenis Pembayaran ',
    'button'    => '',
    'side_bar'  => $this->ratnaningsih->getmenu()->result(),
    'content'   => $this->parser->parse('item_pembayaran', array( 'data_sekolah'          => $data_sekolah,
                                                                    'data_program'          => $data_program,
                                                                    'data_jenis_pembayaran' => $data_jenis_pembayaran,
                                                                    'data_content'          => $data_content
                                                                  ),true)
    );
    $this->parser->parse('main', $data_page);
  }

  public function actAdd(){
    $jenis_transaksi= $this->input->post('jenis_transaksi');
    $program        = $this->input->post('program');
    $sekolah        = $_REQUEST['sekolah'];
    $harga          = $this->input->post('harga');

    $data_item_pembayaran = array('jenis_transaksi'      => $jenis_transaksi,
                                  'program'              => $program,
                                  'sekolah'              => $sekolah,
                                  'harga'                =>$harga);
    $this->ratnaningsih->insertitempembayaran($data_item_pembayaran);

    redirect('itempembayaran');
  }

}
