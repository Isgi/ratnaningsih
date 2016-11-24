<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  // function index()
  // {
  //   $data_content = $this->ratnaningsih->gettransaksi()->result();
  //   $data_page    = array(
  //   'title'     => 'Laporan ',
  //   'button'    => '<a href="{site_url(laporan/harian)}"><button class="btn btn-success">Harian</button></a>
  //                   <a href="{site_url(laporan/bulanan)}"><button class="btn btn-warning">Bulanan</button></a>
  //                   <a href="{site_url(laporan/tahunan)}"><button class="btn btn-primary">Tahunan</button></a>',
  //   'side_bar'  => $this->ratnaningsih->getmenu()->result(),
  //   'content'   => $this->parser->parse('laporan', array('data_content' => $data_content),true)
  //   );
  //   $this->parser->parse('main', $data_page);
  // }

  function harian(){
    $tgl = $this->input->get('tgl');
    if (empty($tgl))
      $tgl = gmdate("Y-m-d", time()+60*60*7);

    $data_content = $this->ratnaningsih->gettransaksiharian($tgl)->result();
    $data_page    = array(
    'title'     => 'Laporan '. date("d M y", strtotime($tgl)),
    'button'    => '<a href="{site_url(laporan/harian)}"><button disabled class="btn btn-success">Harian</button></a>
                    <a href="{site_url(laporan/bulanan)}"><button class="btn btn-warning">Bulanan</button></a>
                    <a href="{site_url(laporan/tahunan)}"><button class="btn btn-primary">Tahunan</button></a>',
    'side_bar'  => $this->ratnaningsih->getmenu()->result(),
    'content'   => $this->parser->parse('laporan_harian', array('data_content' => $data_content),true)
    );
    $this->parser->parse('main', $data_page);
  }

  function bulanan(){
    $bln = $this->input->get('bln');
    if (empty($bln))
      $bln = gmdate("Y-m", time()+60*60*7);

    $data_content = $this->ratnaningsih->gettransaksibulanan($bln)->result();
    $data_page    = array(
    'title'     => 'Laporan '. date("M Y", strtotime($bln)),
    'button'    => '<a href="{site_url(laporan/harian)}"><button class="btn btn-success">Harian</button></a>
                    <a href="{site_url(laporan/bulanan)}"><button disabled class="btn btn-warning">Bulanan</button></a>
                    <a href="{site_url(laporan/tahunan)}"><button class="btn btn-primary">Tahunan</button></a>',
    'side_bar'  => $this->ratnaningsih->getmenu()->result(),
    'content'   => $this->parser->parse('laporan_bulanan', array('data_content' => $data_content),true)
    );
    $this->parser->parse('main', $data_page);
  }

  function tahunan(){
    $thn = $this->input->get('thn');
    if (empty($thn))
      $thn = gmdate("Y", time()+60*60*7);

    $data_content = $this->ratnaningsih->gettransaksitahunan($thn)->result();
    $data_page    = array(
    'title'     => 'Laporan '. date("Y", strtotime($thn)),
    'button'    => '<a href="{site_url(laporan/harian)}"><button class="btn btn-success">Harian</button></a>
                    <a href="{site_url(laporan/bulanan)}"><button class="btn btn-warning">Bulanan</button></a>
                    <a href="{site_url(laporan/tahunan)}"><button disabled class="btn btn-primary">Tahunan</button></a>',
    'side_bar'  => $this->ratnaningsih->getmenu()->result(),
    'content'   => $this->parser->parse('laporan_tahunan', array('data_content' => $data_content),true)
    );
    $this->parser->parse('main', $data_page);
  }

}
