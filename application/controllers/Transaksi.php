
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('mtransaksi');
        if(!$this->session->userdata('username'))
            redirect('auth');
    }

    public function index(){
        // $kategori = $this->input->get('kategori');
        // $data_content = $this->mtransaksi->getpembayaran($kategori)->result();
        $data_page    = array(
          'title'     => 'Lihat Transaksi ',
          'button'    => '',
          'side_bar'  => $this->mmenu->getmenu()->result(),
          'content'   => $this->parser->parse('transaksi_read', array(),true)
        );
        $this->parser->parse('main', $data_page);
    }

    public function add(){
      $data_page    = array(
        'title'     => 'Transaksi Baru',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi_add', array(),true)
      );
      $this->parser->parse('main', $data_page);
    }

    //transaksi pembayaran murid
    public function pendapatanMurid(){
      $this->load->model('mmurid');

      $kata_cari = $this->input->get('cari');
      $data_murid = $this->mmurid->searchmurid($kata_cari)->result();
      if (empty($kata_cari)) {
        $data_murid='';
      }

      $data_page    = array(
      'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('transaksi/add').'>Transaksi Baru</a> / Pembayaran Murid</div>',
      'button'    => '',
      'side_bar'  => $this->mmenu->getmenu()->result(),
      'content'   => $this->parser->parse('transaksi_pendapatan_murid_cari', array('data_murid' => $data_murid),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function pendapatanMuridAdd($id) {
      $this->load->model('mmurid');

      $data_murid = $this->mmurid->getmuridbyid($id)->row_array();
      $data_murid_item_pembayaran = $this->mmurid->getmuriditempembayaran($data_murid)->result();

      $data_kekurangan_bulanan = $this->mtransaksi->getkekuranganbulanan($id)->result();
      $data_kekurangan_tahunan = $this->mtransaksi->getkekurangantahunan($id)->result();
      $data_kekurangan_tdk = $this->mtransaksi->getkekurangantdkdiket($id)->result();

      $data_lunas_bulanan = $this->mtransaksi->getlunasbulanan($id)->result();
      $data_lunas_tahunan = $this->mtransaksi->getlunastahunan($id)->result();
      $data_lunas_tdk = $this->mtransaksi->getlunastdkdiket($id)->result();

      $data_page    = array(
      'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('transaksi/add').'>Transaksi Baru</a> / <a href='.site_url('transaksi/pendapatanmurid').'>Pembayaran Murid</a> / Baru</div>',
      'button'    => '',
      'side_bar'  => $this->mmenu->getmenu()->result(),
      'content'   => $this->parser->parse('transaksi_pendapatan_murid_add', array
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

    public function pendapatanMuridActAdd(){
      $this->load->model('mitemtransaksimurid');
      $id_murid   = $this->input->get('id_murid');
      $pembayaran  = $this->input->get('pembayaran');
      $penyetor   = $this->input->get('penyetor');
      $nominal    = $this->input->get('nominal');
      $tgl_setoran= $this->input->get('tgl_setoran');

      //get jenis transaksi

      $jenis_transaksi = $this->mitemtransaksimurid->getItemTransaksiMuridBy(array('item_transaksi_pendapatan_murid.id' => $pembayaran))->row_array();

      $data_pembayaran = array
      (
        'murid'           => $id_murid,
        'nama'            => $jenis_transaksi['nama'],
        'kode'            => $jenis_transaksi['kode'],
        'harga'           => $jenis_transaksi['harga'],
        'jenis_transaksi' => $jenis_transaksi['jenis_transaksi_id'],
        'penyetor'        => $penyetor,
        'nominal'         => $nominal,
        'tgl_setoran'     => $tgl_setoran,
        'dibuat'          => gmdate("Y-m-d H:i:s", time()+60*60*7)
      );
      // print_r($data_pembayaran);
      // die();
      $this->mtransaksi->insertPembayaran($data_pembayaran);
      if($this->db->affected_rows() > 0)
        $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Tambah BERHASIL</div>");
      else
        $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Tambah GAGAL</div>");
      redirect('transaksi/pendapatanmurid');
    }

    public function pendapatanMuridBulananRead(){
      $this->load->library('MyPagination');

      //get query param
      $query_param = array(
        'kategori' => $this->input->get('kategori'),
        'nis' => $this->input->get('nis')
      );

      //get total pembayaran berdasarkan query param
      $total_pembayaran = $this->mtransaksi->getpembayaranbulanangroup($query_param)->num_rows();
      $pagination = $this->mypagination->pagination('transaksi/pendapatanmuridbulananread',$total_pembayaran,3);

      $data_content = $this->mtransaksi->getpembayaranbulanangroup($query_param,$pagination['per_page'],$pagination['page'])->result();
      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('transaksi').'>Lihat Transaksi</a> / Bulanan</div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi_pendapatan_murid_read', array('data_content' => $data_content, 'link' => $pagination['link']),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function pendapatanMuridTahunanRead(){
      $this->load->library('MyPagination');

      //get query param
      $query_param = array(
        'kategori' => $this->input->get('kategori'),
        'nis' => $this->input->get('nis')
      );

      //get total pembayaran berdasarkan query param
      $total_pembayaran = $this->mtransaksi->getpembayarantahunangroup($query_param)->num_rows();
      $pagination = $this->mypagination->pagination('transaksi/pendapatanmuridtahunanread',$total_pembayaran,3);

      $data_content = $this->mtransaksi->getpembayarantahunangroup($query_param,$pagination['per_page'],$pagination['page'])->result();
      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('transaksi').'>Lihat Transaksi</a> / Tahunan</div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi_pendapatan_murid_read', array('data_content' => $data_content, 'link' => $pagination['link']),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function pendapatanMuridTakDitentukanRead(){
      $this->load->library('MyPagination');

      //get query param
      $query_param = array(
        'kategori' => $this->input->get('kategori'),
        'nis' => $this->input->get('nis')
      );

      //get total pembayaran berdasarkan query param
      $total_pembayaran = $this->mtransaksi->getpembayarantdkgroup($query_param)->num_rows();
      $pagination = $this->mypagination->pagination('transaksi/pendapatanmuridtakditentukanread',$total_pembayaran,3);

      $data_content = $this->mtransaksi->getpembayarantdkgroup($query_param,$pagination['per_page'],$pagination['page'])->result();
      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('transaksi').'>Lihat Transaksi</a> / Lain - lain</div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi_pendapatan_murid_read', array('data_content' => $data_content, 'link' => $pagination['link']),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function angsuranPendapatanMuridBulananRead(){
      $query_param = array(
        'date' => $this->input->get('tanggal'),
        'nis' => $this->input->get('nis'),
        'kode' => $this->input->get('pembayaran')
      );

      $data_content = $this->mtransaksi->getAngsuranBulanan($query_param)->result();

      $dt = new DateTime($query_param['date']);
      $month = $dt->format('Y-m');

      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px">
                          <a href='.site_url('transaksi').'>Lihat Transaksi</a> /
                          <a href='.site_url('transaksi/pendapatanmuridbulananread').'>Bulanan</a> /
                          '.$data_content[0]->nama_transaksi.' '.$month.', '.$data_content[0]->nama_murid.'
                        </div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi_angsuran_murid_read', array('data_content' => $data_content),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function angsuranPendapatanMuridTahunanRead(){
      $query_param = array(
        'date' => $this->input->get('tanggal'),
        'nis' => $this->input->get('nis'),
        'kode' => $this->input->get('pembayaran')
      );

      $data_content = $this->mtransaksi->getAngsuranTahunan($query_param)->result();

      $dt = new DateTime($query_param['date']);
      $year = $dt->format('Y');

      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px">
                          <a href='.site_url('transaksi').'>Lihat Transaksi</a> /
                          <a href='.site_url('transaksi/pendapatanmuridtahunanread').'> Tahunan</a> /
                          '.$data_content[0]->nama_transaksi.' '.$year.', '.$data_content[0]->nama_murid.'
                        </div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi_angsuran_murid_read', array('data_content' => $data_content),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function angsuranPendapatanMuridTakDitentukanRead(){
      $query_param = array(
        'date' => $this->input->get('tanggal'),
        'nis' => $this->input->get('nis'),
        'kode' => $this->input->get('pembayaran')
      );

      $data_content = $this->mtransaksi->getAngsuranTdk($query_param)->result();

      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px">
                          <a href='.site_url('transaksi').'>Lihat Transaksi</a> /
                          <a href='.site_url('transaksi/pendapatanmuridtakditentukanread').'> Tak Ditentukan</a> /
                          '.$data_content[0]->nama_transaksi.', '.$data_content[0]->nama_murid.'
                        </div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi_angsuran_murid_read', array('data_content' => $data_content),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function edit($angsuran,$id){
      $this->load->model('mmurid');

      $data_edit = $this->mtransaksi->getpembayaranbyid($id)->row_array();

      $data_murid = $this->mmurid->getmuridbyid($data_edit['murid'])->row_array();
      $data_item_pembayaran = $this->mmurid->getmuriditempembayaran($data_murid)->result();

      $data_page    = array(
      'title'     => '<div class="navbar-brand" style="margin-left:-45px">
                         <a href='.site_url('transaksi/'.$angsuran.'?'.$_SERVER['QUERY_STRING']).'> Kembali</a>
                      </div>',
      'button'    => '',
      'side_bar'  => $this->mmenu->getmenu()->result(),
      'content'   => $this->load->view('transaksi_edit', array('data_edit' => $data_edit, 'data_item_pembayaran' => $data_item_pembayaran),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function actEdit($angsuran){
      //menangkap url redirect dari input type hidden
      $redirect   = $this->input->get('redirect');

      $data_pembayaran = array('id'               => $this->input->get('id_pembayaran'),
                              'penyetor'          => $this->input->get('penyetor'),
                              'nominal'           => $this->input->get('nominal'),
                              'dibuat'            => gmdate("Y-m-d H:i:s", time()+60*60*7)
                            );
      $this->mtransaksi->updatePembayaran($data_pembayaran);
      if($this->db->affected_rows() > 0)
        $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Ubah BERHASIL</div>");
      else
        $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Ubah GAGAL</div>");
      redirect('transaksi/'.$angsuran.'?'.$redirect);
    }

    public function actDelete($angsuran,$id){
      $query_param = array(
        'date' => $this->input->get('tanggal'),
        'nis' => $this->input->get('nis'),
        'item_transaksi_pendapatan_murid' => $this->input->get('pembayaran')
      );

      $this->mtransaksi->deletepembayaran($id);

      switch ($angsuran) {
        case 'angsuranpendapatanmuridbulananread':
          $data_angsuran = $this->mtransaksi->getAngsuranBulanan($query_param)->num_rows();
          $periode = 'bulanan';
          break;

        case 'angsuranpendapatanmuridtahunanread':
          $data_angsuran = $this->mtransaksi->getAngsuranTahunan($query_param)->num_rows();
          $periode = 'tahunan';
          break;

        default:
          # code...
          break;
      }

      if ($data_angsuran == 0) {
        redirect('transaksi/pendapatanmurid'.$periode.'read');
      }else{
        redirect('transaksi/'.$angsuran.'?'.$_SERVER['QUERY_STRING']);
      }
    }
    //end transaksi pembayaran murid

    //transaksi pendapatan lain-lain
    public function pendapatanLainlainAdd() {
      $data_page    = array(
      'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('transaksi/add').'>Transaksi Baru</a> / Pendapatan lain - lain</div>',
      'button'    => '',
      'side_bar'  => $this->mmenu->getmenu()->result(),
      'content'   => $this->parser->parse('transaksi_pendapatan_lainlain_add', array(),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function pendapatanLainlainActAdd(){
      $this->load->model('mjenistransaksi');
      $nama_pendapatan    = $this->input->get('nama_pendapatan');
      $penyetor           = $this->input->get('penyetor');
      $keterangan         = $this->input->get('keterangan');
      $nominal            = $this->input->get('nominal');
      $id_jenis_transaksi = 134;
      $tgl_setoran= $this->input->get('tgl_setoran');

      $jenis_transaksi = $this->mjenistransaksi->getJenisTransaksiBy(array('id'=>$id_jenis_transaksi))->row_array();

      $data_pembayaran = array
      (
        'nama'           => $nama_pendapatan,
        'kode'            =>$jenis_transaksi['kode'],
        'jenis_transaksi' => $jenis_transaksi['id'],
        'penyetor'        => $penyetor,
        'nominal'         => $nominal,
        'keterangan'         => $keterangan,
        'tgl_setoran'     => $tgl_setoran,
        'dibuat'          => gmdate("Y-m-d H:i:s", time()+60*60*7)
      );
      // print_r($data_pembayaran);
      // die();
      $this->mtransaksi->insertPembayaran($data_pembayaran);
      if($this->db->affected_rows() > 0)
        $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Tambah BERHASIL</div>");
      else
        $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Tambah GAGAL</div>");
      redirect('transaksi/pendapatanlainlainadd');
    }

    public function pendapatanLainlainRead() {
      $this->load->library('MyPagination');

      //get query param
      $query_param = array(
        'nama' => $this->input->get('nama')
      );

      //get total pembayaran berdasarkan query param
      $total_pembayaran = $this->mtransaksi->gettransaksilainlain($query_param)->num_rows();
      $pagination = $this->mypagination->pagination('transaksi/pendapatanlainlainread',$total_pembayaran,3);

      $data_content = $this->mtransaksi->gettransaksilainlain($query_param,$pagination['per_page'],$pagination['page'])->result();
      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('transaksi').'>Transaksi</a> / Pendapatan lain-lain</div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi_pendapatan_lainlain_read', array('data_content' => $data_content, 'link' => $pagination['link']),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function pendapatanLainlainActDelete($id) {

      $this->mtransaksi->deletepembayaran($id);

      redirect('transaksi/pendapatanlainlainread?'.$_SERVER['QUERY_STRING']);
    }
    //end transaksi pengeluaran

    //transaksi pengeluaran
    public function pengeluaranAdd() {
      $data_pengeluaran = $this->mtransaksi->getjenistransaksi()->result();
      // print_r($data_pengeluaran);
      // die();
      $data_page    = array(
      'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('transaksi/add').'>Transaksi Baru</a> / Pengeluaran</div>',
      'button'    => '',
      'side_bar'  => $this->mmenu->getmenu()->result(),
      'content'   => $this->parser->parse('transaksi_pengeluaran_add', array('data_pengeluaran' => $data_pengeluaran),true)
      );
      $this->parser->parse('main', $data_page);
    }

    public function pengeluaranActAdd() {
      $this->load->model('mjenistransaksi');
      $nama   = $this->input->get('nama');
      $id_jenis_transaksi  = $this->input->get('jenis_transaksi');
      $penyetor   = $this->input->get('penyetor');
      $keterangan = $this->input->get('keterangan');
      $nominal    = $this->input->get('nominal');
      $tgl_setoran= $this->input->get('tgl_setoran');

      $jenis_transaksi = $this->mjenistransaksi->getJenisTransaksiBy(array('id'=>$id_jenis_transaksi))->row_array();
      $data_pengeluaran = array
      (
        'nama'           => $nama,
        'jenis_transaksi' => $jenis_transaksi['id'],
        'kode'            => $jenis_transaksi['kode'],
        'penyetor'        => $penyetor,
        'nominal'         => $nominal,
        'keterangan' => $keterangan,
        'tgl_setoran'     => $tgl_setoran,
        'dibuat'          => gmdate("Y-m-d H:i:s", time()+60*60*7)
      );
      // print_r($data_pembayaran);
      // die();
      $this->mtransaksi->insertPembayaran($data_pengeluaran);
      if($this->db->affected_rows() > 0)
        $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Tambah BERHASIL</div>");
      else
        $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Tambah GAGAL</div>");
      redirect('transaksi/pengeluaranadd');
    }

    public function pengeluaranRead() {
      $this->load->library('MyPagination');

      //get query param
      $query_param = array(
        'nama' => $this->input->get('nama')
      );

      //get total pembayaran berdasarkan query param
      $total_pembayaran = $this->mtransaksi->gettransaksipengeluaran($query_param)->num_rows();
      $pagination = $this->mypagination->pagination('transaksi/pengeluaranread',$total_pembayaran,3);

      $data_content = $this->mtransaksi->gettransaksipengeluaran($query_param,$pagination['per_page'],$pagination['page'])->result();
      $data_page    = array(
        'title'     => '<div class="navbar-brand" style="margin-left:-45px"><a href='.site_url('transaksi').'>Transaksi</a> / Pendapatan lain-lain</div>',
        'button'    => '',
        'side_bar'  => $this->mmenu->getmenu()->result(),
        'content'   => $this->parser->parse('transaksi_pengeluaran_read', array('data_content' => $data_content, 'link' => $pagination['link']),true)
      );
      $this->parser->parse('main', $data_page);
    }
    //end transaksi pengeluaran
}

/* End of file BTransaksi.php */
