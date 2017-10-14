<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('mtransaksi');
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  function index(){
    redirect('laporan/harian');
  }

  function harian(){
    $this->load->library('mypagination');
    $tgl = $this->input->get('tgl');
    if (empty($tgl))
      $tgl = gmdate("Y-m-d", time()+60*60*7);

    $total_laporan = $this->mtransaksi->getpembayaranharian($tgl)->num_rows();

    $pagination = $this->mypagination->pagination('laporan/harian',$total_laporan,3);

    $data_content = $this->mtransaksi->getpembayaranharian($tgl,$pagination['per_page'],$pagination['page'])->result();
    // print_r('<pre>');
    // print_r($data_content);
    // print_r('</pre>');
    // die();
    $data_page    = array(
      'title'     => 'Laporan '. date("d M y", strtotime($tgl)),
      'button'    => '<a href="{site_url(laporan/harian)}"><button disabled class="btn btn-success">Harian</button></a>
                      <a href="{site_url(laporan/bulanan)}"><button class="btn btn-warning">Bulanan</button></a>
                      <a href="{site_url(laporan/tahunan)}"><button class="btn btn-primary">Tahunan</button></a>',
      'side_bar'  => $this->mmenu->getmenu()->result(),
      'content'   => $this->parser->parse('laporan_harian', array('data_content' => $data_content, 'form_cari' => $tgl, 'link' => $pagination['link']),true)
    );
    $this->parser->parse('main', $data_page);
  }

  function bulanan(){
    $this->load->library('mypagination');
    $bln = $this->input->get('tgl');
    if (empty($bln))
      $bln = gmdate("Y-m", time()+60*60*7);

    $total_laporan = $this->mtransaksi->getpembayaranbulanan($bln)->num_rows();
    $pagination = $this->mypagination->pagination('laporan/bulanan',$total_laporan,3);

    $data_content = $this->mtransaksi->getpembayaranbulanan($bln,$pagination['per_page'],$pagination['page'])->result();
    $data_page    = array(
    'title'     => 'Laporan '. date("M Y", strtotime($bln)),
    'button'    => '<a href="{site_url(laporan/harian)}"><button class="btn btn-success">Harian</button></a>
                    <a href="{site_url(laporan/bulanan)}"><button disabled class="btn btn-warning">Bulanan</button></a>
                    <a href="{site_url(laporan/tahunan)}"><button class="btn btn-primary">Tahunan</button></a>',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('laporan_bulanan', array('data_content' => $data_content, 'form_cari' => $bln, 'link' => $pagination['link']),true)
    );
    $this->parser->parse('main', $data_page);
  }

  function tahunan(){
    $this->load->library('mypagination');
    $thn = $this->input->get('tgl');
    if (empty($thn))
      $thn = gmdate("Y", time()+60*60*7);

    $total_laporan = $this->mtransaksi->getpembayarantahunan($thn)->num_rows();
    $pagination = $this->mypagination->pagination('laporan/tahunan',$total_laporan,3);

    $data_content = $this->mtransaksi->getpembayarantahunan($thn,$pagination['per_page'],$pagination['page'])->result();
    $data_page    = array(
    'title'     => 'Laporan '. date("Y", strtotime($thn)),
    'button'    => '<a href="{site_url(laporan/harian)}"><button class="btn btn-success">Harian</button></a>
                    <a href="{site_url(laporan/bulanan)}"><button class="btn btn-warning">Bulanan</button></a>
                    <a href="{site_url(laporan/tahunan)}"><button disabled class="btn btn-primary">Tahunan</button></a>',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('laporan_tahunan', array('data_content' => $data_content, 'form_cari' => $thn, 'link' => $pagination['link']),true)
    );
    $this->parser->parse('main', $data_page);
  }

  function cetak($periode){
    $tgl = $this->input->get('tgl');

    switch ($periode) {
      case 'harian':
        if (empty($tgl)){
          $tgl = gmdate("Y-m-d", time()+60*60*7);
        }
        $data_content = $this->mtransaksi->getpembayaranharian($tgl)->result();
        $data_page = array(
          'data_title' => strtoupper(date("d F, Y", strtotime($tgl))),
          'data_content' => $data_content
        );

        $this->load->view('laporan_cetak',$data_page);

        break;
      case 'bulanan':
        if (empty($tgl)){
          $tgl = gmdate("Y-m", time()+60*60*7);
        }
        $data_content = $this->mtransaksi->getpembayaranbulanan($tgl)->result();

        $data_page = array(
          'data_title' => 'BULAN '.strtoupper(date("F, Y", strtotime($tgl))),
          'data_content' => $data_content
        );

        $this->load->view('laporan_cetak',$data_page);

        break;
      default:
        if (empty($tgl)){
          $tgl = gmdate("Y", time()+60*60*7);
        }
        $data_content = $this->mtransaksi->getpembayarantahunan($tgl)->result();

        $data_page = array(
          'data_title' => 'TAHUN '.strtoupper(date("Y", strtotime($tgl))),
          'data_content' => $data_content
        );

        $this->load->view('laporan_cetak',$data_page);

        break;
    }
  }

  function keuangan() {
    $bln = $this->input->get('tgl');
    if (empty($bln))
      $bln = gmdate("Y-m", time()+60*60*7);

    $data_content = $this->mtransaksi->getlaporankeuangan($bln)->result();
    $data_page    = array(
    'title'     => 'Laporan Keuangan',
    'button'    => '',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('laporan_keuangan', array('data_content' => $data_content, 'form_cari' => $bln),true)
    );
    $this->parser->parse('main', $data_page);
  }

  function keuanganCetak() {
    $tgl = $this->input->get('tgl');
    if (empty($tgl)){
      $tgl = gmdate("Y-m", time()+60*60*7);
    }
    $data_content = $this->mtransaksi->getlaporankeuangan($tgl)->result();

    $data_page = array(
      'data_title' => 'BULAN '.strtoupper(date("F, Y", strtotime($tgl))),
      'data_content' => $data_content
    );

    $this->load->view('laporan_keuangan_cetak',$data_page);
  }
}
