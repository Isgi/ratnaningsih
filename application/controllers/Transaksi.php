
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
        if(!$this->session->userdata('username'))
            redirect('auth');
    }

    public function index()
    {
        $data_content = $this->ratnaningsih->getTransaksi()->result();
        $data_page    = array(
        'notif'     => array('message' => 'Sukses ditambahkan'),
        'title'     => 'Transaksi ',
        'button'    => '',
        'side_bar'  => $this->ratnaningsih->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi', array('data_siswa' => null, 'data_content' => $data_content),true)
        );
        $this->parser->parse('main', $data_page);
    }
    public function searchSiswa(){
      $kata_cari = $this->input->get('cari');
      $data_siswa = $this->ratnaningsih->searchsiswa($kata_cari)->result();
      $data_page    = array(
      'title'     => 'Transaksi ',
      'button'    => '',
      'side_bar'  => $this->ratnaningsih->getmenu()->result(),
      'content'   => $this->parser->parse('transaksi', array('data_siswa' => $data_siswa),true)
      );
      $this->parser->parse('main', $data_page);
    }
    public function bayar($id_siswa){
      $data_siswa = $this->ratnaningsih->getsiswabyid($id_siswa)->result_array();
      $data_siswa_item_transaksi = $this->ratnaningsih->getsiswaitemtransaksi($data_siswa[0])->result();
      // $data_kekurangan = $this->ratnaningsih->getkekurangantransaksi($id_siswa);

      $data_page    = array(
      'title'     => 'Transaksi ',
      'button'    => '',
      'side_bar'  => $this->ratnaningsih->getmenu()->result(),
      'content'   => $this->parser->parse('form_transaksi', array('data_siswa' => $data_siswa, 'data_siswa_item_transaksi' => $data_siswa_item_transaksi),true)
      );
      $this->parser->parse('main', $data_page);
    }
    public function actAdd(){
      $id_siswa   = $this->input->get('id_siswa');
      $transaksi = $this->input->get('transaksi');
      $penyetor   = $this->input->get('penyetor');
      $bayar      = $this->input->get('dibayarkan');


      $data_transaksi = array('murid'           => $id_siswa,
                              'item_transaksi'  => $transaksi,
                              'penyetor'        => $penyetor,
                              'dibayarkan'      => $bayar,
                              'tgl'             => gmdate("Y-m-d H:i:s", time()+60*60*7)
                            );
      $this->ratnaningsih->insertTransaksi($data_transaksi);
      redirect('transaksi');
    }

}

/* End of file BTransaksi.php */
