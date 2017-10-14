
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpembayaran');
        if(!$this->session->userdata('username'))
            redirect('auth');
    }

    public function index()
    {
        // $kategori = $this->input->get('kategori');
        // $data_content = $this->mpembayaran->getpembayaran($kategori)->result();
        $data_page    = array(
          'title'     => 'Daftar Transaksi ',
          'button'    => '',
          'side_bar'  => $this->mmenu->getmenu()->result(),
          'content'   => $this->parser->parse('pembayaran', array(),true)
        );
        $this->parser->parse('main', $data_page);
    }

    public function bayar($id){
      $this->load->model('mmurid');

      $data_murid = $this->mmurid->getmuridbyid($id)->row_array();
      $data_murid_item_pembayaran = $this->mmurid->getmuriditempembayaran($data_murid)->result();

      $data_kekurangan_bulanan = $this->mpembayaran->getkekuranganbulanan($id)->result();
      $data_kekurangan_tahunan = $this->mpembayaran->getkekurangantahunan($id)->result();
      $data_kekurangan_tdk = $this->mpembayaran->getkekurangantdkdiket($id)->result();

      $data_lunas_bulanan = $this->mpembayaran->getlunasbulanan($id)->result();
      $data_lunas_tahunan = $this->mpembayaran->getlunastahunan($id)->result();
      $data_lunas_tdk = $this->mpembayaran->getlunastdkdiket($id)->result();

      $data_page    = array(
      'title'     => 'Pembayaran Baru',
      'button'    => '',
      'side_bar'  => $this->mmenu->getmenu()->result(),
      'content'   => $this->parser->parse('pembayaran_add', array
        (
          'data_murid' => $data_murid,
          'data_murid_item_pembayaran' => $data_murid_item_pembayaran,
          'data_kekurangan_bulanan' => $data_kekurangan_bulanan,
          'data_kekurangan_tahunan' => $data_kekurangan_tahunan,
          'data_kekurangan_tdk' => $data_kekurangan_tdk,
          'data_lunas_bulanan' => $data_lunas_bulanan,
          'data_lunas_tahunan' => $data_lunas_tahunan,
          'data_lunas_tdk' => $data_lunas_tdk
        ),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function baru(){
      $data_page    = array(
        'title'     => 'Transaksi Baru',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi_baru', array(),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function actAdd(){
      $id_murid   = $this->input->get('id_murid');
      $pembayaran  = $this->input->get('pembayaran');
      $penyetor   = $this->input->get('penyetor');
      $nominal    = $this->input->get('nominal');
      $tgl_setoran= $this->input->get('tgl_setoran');


      $data_pembayaran = array
      (
        'murid'           => $id_murid,
        'item_pembayaran' => $pembayaran,
        'penyetor'        => $penyetor,
        'nominal'         => $nominal,
        'tgl_setoran'     => $tgl_setoran,
        'dibuat'          => gmdate("Y-m-d H:i:s", time()+60*60*7)
      );
      // print_r($data_pembayaran);
      // die();
      $this->mpembayaran->insertPembayaran($data_pembayaran);
      if($this->db->affected_rows() > 0)
        $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Tambah BERHASIL</div>");
      else
        $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Tambah GAGAL</div>");
      redirect('pembayaran/search');
    }

    public function search(){
      $this->load->model('mmurid');

      $kata_cari = $this->input->get('cari');
      $data_murid = $this->mmurid->searchmurid($kata_cari)->result();
      if (empty($kata_cari)) {
        $data_murid='';
      }

      $data_page    = array(
      'title'     => 'Transaksi Baru',
      'button'    => '',
      'side_bar'  => $this->mmenu->getmenu()->result(),
      'content'   => $this->parser->parse('pembayaran_search', array('data_murid' => $data_murid),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function edit($angsuran,$id){
      $this->load->model('mmurid');

      $data_edit = $this->mpembayaran->getpembayaranbyid($id)->row_array();

      $data_murid = $this->mmurid->getmuridbyid($data_edit['murid'])->row_array();
      $data_item_pembayaran = $this->mmurid->getmuriditempembayaran($data_murid)->result();

      $data_page    = array(
      'title'     => '<div class="navbar-brand" style="margin-left:-45px">
                         <a href='.site_url('pembayaran/'.$angsuran.'?'.$_SERVER['QUERY_STRING']).'> Kembali</a>
                      </div>',
      'button'    => '',
      'side_bar'  => $this->mmenu->getmenu()->result(),
      'content'   => $this->load->view('pembayaran_edit', array('data_edit' => $data_edit, 'data_item_pembayaran' => $data_item_pembayaran),true)
      );
      $this->parser->parse('main', $data_page);

    }

    public function actEdit($angsuran){
      //menangkap url redirect dari input type hidden
      $redirect   = $this->input->get('redirect');

      $data_pembayaran = array('id'               => $this->input->get('id_pembayaran'),
                              'item_pembayaran'   => $this->input->get('pembayaran'),
                              'penyetor'          => $this->input->get('penyetor'),
                              'nominal'           => $this->input->get('nominal'),
                              'dibuat'            => gmdate("Y-m-d H:i:s", time()+60*60*7)
                            );
      $this->mpembayaran->updatePembayaran($data_pembayaran);
      if($this->db->affected_rows() > 0)
        $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Ubah BERHASIL</div>");
      else
        $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Ubah GAGAL</div>");
      redirect('pembayaran/'.$angsuran.'?'.$redirect);
    }

    public function actDelete($angsuran,$id){
      $query_param = array(
        'date' => $this->input->get('tanggal'),
        'nis' => $this->input->get('nis'),
        'item_pembayaran' => $this->input->get('pembayaran')
      );

      $this->mpembayaran->deletepembayaran($id);

      switch ($angsuran) {
        case 'angsuranbulanan':
          $data_angsuran = $this->mpembayaran->getAngsuranBulanan($query_param)->num_rows();
          $periode = 'bulanan';
          break;

        case 'angsurantahunan':
          $data_angsuran = $this->mpembayaran->getAngsuranTahunan($query_param)->num_rows();
          $periode = 'tahunan';
          break;

        default:
          # code...
          break;
      }

      if ($data_angsuran == 0) {
        redirect('pembayaran/'.$periode);
      }else{
        redirect('pembayaran/angsuran'.$periode.'?'.$_SERVER['QUERY_STRING']);
      }

    }

    public function bulanan(){
      $this->load->library('MyPagination');

      //get query param
      $query_param = array(
        'kategori' => $this->input->get('kategori'),
        'nis' => $this->input->get('nis')
      );

      //get total pembayaran berdasarkan query param
      $total_pembayaran = $this->mpembayaran->getpembayaranbulanangroup($query_param)->num_rows();
      $pagination = $this->mypagination->pagination('pembayaran/bulanan',$total_pembayaran,3);

      $data_content = $this->mpembayaran->getpembayaranbulanangroup($query_param,$pagination['per_page'],$pagination['page'])->result();
      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('pembayaran').'>Daftar Transaksi</a> / Bulanan</div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('pembayaran_list', array('data_content' => $data_content, 'link' => $pagination['link']),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function tahunan(){
      $this->load->library('MyPagination');

      //get query param
      $query_param = array(
        'kategori' => $this->input->get('kategori'),
        'nis' => $this->input->get('nis')
      );

      //get total pembayaran berdasarkan query param
      $total_pembayaran = $this->mpembayaran->getpembayarantahunangroup($query_param)->num_rows();
      $pagination = $this->mypagination->pagination('pembayaran/tahunan',$total_pembayaran,3);

      $data_content = $this->mpembayaran->getpembayarantahunangroup($query_param,$pagination['per_page'],$pagination['page'])->result();
      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('pembayaran').'>Daftar Transaksi</a> / Tahunan</div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('pembayaran_list', array('data_content' => $data_content, 'link' => $pagination['link']),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function tdk(){
      $this->load->library('MyPagination');

      //get query param
      $query_param = array(
        'kategori' => $this->input->get('kategori'),
        'nis' => $this->input->get('nis')
      );

      //get total pembayaran berdasarkan query param
      $total_pembayaran = $this->mpembayaran->getpembayarantdkgroup($query_param)->num_rows();
      $pagination = $this->mypagination->pagination('pembayaran/tdk',$total_pembayaran,3);

      $data_content = $this->mpembayaran->getpembayarantdkgroup($query_param,$pagination['per_page'],$pagination['page'])->result();
      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('pembayaran').'>Daftar Transaksi</a> / Lain - lain</div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('pembayaran_list', array('data_content' => $data_content, 'link' => $pagination['link']),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function angsuranBulanan(){
      $query_param = array(
        'date' => $this->input->get('tanggal'),
        'nis' => $this->input->get('nis'),
        'item_pembayaran' => $this->input->get('pembayaran')
      );

      $data_content = $this->mpembayaran->getAngsuranBulanan($query_param)->result();

      $dt = new DateTime($query_param['date']);
      $month = $dt->format('Y-m');

      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px">
                          <a href='.site_url('pembayaran').'>Daftar Transaksi</a> /
                          <a href='.site_url('pembayaran/bulanan').'>Bulanan</a> /
                          '.$data_content[0]->nama_pembayaran.' '.$month.', '.$data_content[0]->nama_murid.'
                        </div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('pembayaran_angsuran_list', array('data_content' => $data_content),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function angsuranTahunan(){
      $query_param = array(
        'date' => $this->input->get('tanggal'),
        'nis' => $this->input->get('nis'),
        'item_pembayaran' => $this->input->get('pembayaran')
      );

      $data_content = $this->mpembayaran->getAngsuranTahunan($query_param)->result();

      $dt = new DateTime($query_param['date']);
      $year = $dt->format('Y');

      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px">
                          <a href='.site_url('pembayaran').'>Daftar Transaksi</a> /
                          <a href='.site_url('pembayaran/tahunan').'> Tahunan</a> /
                          '.$data_content[0]->nama_pembayaran.' '.$year.', '.$data_content[0]->nama_murid.'
                        </div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('pembayaran_angsuran_list', array('data_content' => $data_content),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function angsuranTdk(){
      $query_param = array(
        'date' => $this->input->get('tanggal'),
        'nis' => $this->input->get('nis'),
        'item_pembayaran' => $this->input->get('pembayaran')
      );

      $data_content = $this->mpembayaran->getAngsuranTdk($query_param)->result();

      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px">
                          <a href='.site_url('pembayaran').'>Daftar Transaksi</a> /
                          <a href='.site_url('pembayaran/tdk').'> Lain - lain</a> /
                          '.$data_content[0]->nama_pembayaran.', '.$data_content[0]->nama_murid.'
                        </div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('pembayaran_angsuran_list', array('data_content' => $data_content),true)
      );
      $this->parser->parse('main', $data_page);
    }

}

/* End of file BTransaksi.php */
