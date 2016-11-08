<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BItemPembayaran extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('bauth');
  }

  public function index()
  {
    $data_jenis_pembayaran  = $this->modelsik->getjenispembayaranbyuser()->result();
    $data_program           = $this->modelsik->getprogram()->result();
    $data_derajat           = $this->modelsik->getsekolahbyuser()->result();
    $data_content           = $this->modelsik->getitempembayaranbyuser()->result();
    $data_page    = array(
    'title'     => 'Jenis Pembayaran ',
    'button'    => '',
    'side_bar'  => $this->modelsik->getmenu()->result(),
    'content'   => $this->parser->parse('b_item_pembayaran', array( 'data_derajat'          => $data_derajat,
                                                                    'data_program'          => $data_program,
                                                                    'data_jenis_pembayaran' => $data_jenis_pembayaran,
                                                                    'data_content'          => $data_content
                                                                  ),true)
    );
    $this->parser->parse('b_main', $data_page);
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
    $this->modelsik->insertitempembayaran($data_item_pembayaran);

    redirect('bitempembayaran');
  }

}
