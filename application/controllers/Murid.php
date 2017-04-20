<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Murid extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('mmurid');
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  function index()
  {
    $this->load->library('mypagination');
    $this->load->model('mkelas');

    $total_murid = $this->mmurid->getmurid()->num_rows();

    $pagination = $this->mypagination->pagination('murid/index',$total_murid,3);

    $data_content = $this->mmurid->getmurid($pagination['per_page'],$pagination['page'])->result();
    $data_kelas = $this->mkelas->getkelas()->result();

    $data_page    = array(
    'title'     => 'Murid ',
    'button'    => '<button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-success" name="button"><i class="ti-plus"></i>&nbsp&nbspBaru</button>',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('murid', array(
        'data_kelas' => $data_kelas,
        'data_content' => $data_content,
        'link' => $pagination['link']
      ),true)
    );
    $this->parser->parse('main', $data_page);
  }

  function filter(){
    $this->load->library('mypagination');
    $this->load->model('mkelas');
    $this->load->model('mprogram');

    //get query param
    $query_param = array(
      'kelas' => $this->input->get('kelas'),
      'nama_or_nis' => $this->input->get('nama_or_nis')
    );

    //get total murid berdasarkan query param
    $total_murid = $this->mmurid->getmuridfilter($query_param)->num_rows();
    $pagination = $this->mypagination->pagination('murid/filter',$total_murid,3);

    $data_content = $this->mmurid->getmuridfilter($query_param,$pagination['per_page'],$pagination['page'])->result();
    $data_kelas = $this->mkelas->getkelas()->result();
    $data_program = $this->mprogram->getprogram()->result();

    $data_page    = array(
    'title'     => 'Murid ',
    'button'    => '<button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-success" name="button"><i class="ti-plus"></i>&nbsp&nbspBaru</button>',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('murid', array(
        'data_kelas' => $data_kelas,
        'data_program' => $data_program,
        'data_content' => $data_content,
        'link' => $pagination['link']
      ),true)
    );
    $this->parser->parse('main', $data_page);
  }

  public function actAdd(){
    $this->load->model('mprogram');
    $config['upload_path'] = './assets/excel_files';
    $config['allowed_types'] = 'xlsx|csv|xls';
    $config['max_size'] = '100';
    $config['overwrite'] = true;
    $config['encrypt_name'] = FALSE;
    $config['remove_spaces'] = TRUE;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!is_dir('./assets/excel_files'))
    {
      mkdir('./assets/excel_files', 0777, true);
    }

    if ( ! $this->upload->do_upload('file'))
    {
      $error = array('error' => $this->upload->display_errors());
      // $this->load->view('main', $error);
    }
    else{
      $kelas = $this->input->post('kelas');
      $tahun_ajaran = $this->input->post('tahun_ajaran');
      $program = $this->mprogram->getprogram()->result_array();

      $upload_data = $this->upload->data();
      $file = $upload_data['file_path'].$upload_data['file_name'];
			//load the cel library
	    $this->load->library('Excel');
			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);

			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
	    $worksheetTitle     = $worksheet->getTitle();
	    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
	    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
	    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

		    for ($row = 3; $row <= $highestRow; ++ $row) {
	        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
	            $cell = $worksheet->getCellByColumnAndRow($col, $row);
	            $val = $cell->getValue();
	            $dataArr[$row][$col] = $val;
	        }
          for ($i=0; $i < sizeof($program) ; $i++) {
            if (strcasecmp($dataArr[$row][8],$program[$i]['nama']) == 0 ) {
              $dataArr[$row][8] = $program[$i]['id'];
            }
          }
          $dataArr[$row][9] = $kelas;
          $dataArr[$row][10] = $tahun_ajaran;
          $dataArr[$row][11] = gmdate("Y-m-d H:i:s", time()+60*60*7);
		    }
			}

      $this->rendermurid($dataArr);
      redirect('murid');
			// $this->insertDataFile($dataArr);
    }
  }
  private function renderMurid($data){
    foreach ($data as $datamurid => $dat) {
      $rebuild_data = array('no_induk'        => $dat[1],
                            'nama'            => $dat[2],
                            'jk'              => $dat[3],
                            'nama_panggilan'  => $dat[4],
                            'ttl'             => $dat[5],
                            'ortu'            => $dat[6],
                            'alamat'          => $dat[7],
                            'program'         => $dat[8],
                            'kelas'           => $dat[9],
                            'tahun_ajaran'    => $dat[10],
                            'dibuat'          => $dat[11]
                          );
			$this->mmurid->insertmurid($rebuild_data);
    }
  }
  public function edit($id){
    $this->load->model('mkelas');
    $this->load->model('mprogram');

    $data_edit = $this->mmurid->getmuridbyid($id)->row_array();
    $data_kelas = $this->mkelas->getkelas()->result();
    $data_program = $this->mprogram->getprogram()->result();

    $data_page    = array(
    'title'     => 'Murid -> Ubah '.$data_edit['nama'],
    'button'    => '',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('murid_edit', array('data_edit' => $data_edit, 'data_kelas' => $data_kelas, 'data_program' => $data_program),true)
    );
    $this->parser->parse('main', $data_page);

  }

  public function actEdit(){
    $id = $this->input->post('id');
    $no_induk = $this->input->post('no_induk');
    $nama = $this->input->post('nama');
    $jk = $this->input->post('jk');
    $nama_panggilan = $this->input->post('nama_panggilan');
    $ttl = $this->input->post('ttl');
    $ortu = $this->input->post('ortu');
    $alamat = $this->input->post('alamat');
    $program = $this->input->post('program');
    $kelas = $this->input->post('kelas');

    $data_murid = array
    (
      'id'             => $id,
      'no_induk'       => $no_induk,
      'nama'           => $nama,
      'jk'             => $jk,
      'nama_panggilan' => $nama_panggilan,
      'ttl'            => $ttl,
      'ortu'           => $ortu,
      'alamat'         => $alamat,
      'program'        => $program,
      'kelas'          => $kelas
    );
    $this->mmurid->updatemurid($data_murid);
    if($this->db->affected_rows() > 0)
      $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert'>Ubah BERHASIL</div>");
    else
      $this->session->set_flashdata('message',"<div class='alert alert-danger' role='alert'>Ubah GAGAL</div>");

    redirect('murid');
  }

  public function riwayat($id) {
    $this->load->model('mpembayaran');

    $data_murid = $this->mmurid->getmuridbyid($id)->row_array();

    $data_kekurangan_bulanan = $this->mpembayaran->getkekuranganbulanan($id)->result();
    $data_kekurangan_tahunan = $this->mpembayaran->getkekurangantahunan($id)->result();
    $data_kekurangan_tdk = $this->mpembayaran->getkekurangantdkdiket($id)->result();

    $data_lunas_bulanan = $this->mpembayaran->getlunasbulanan($id)->result();
    $data_lunas_tahunan = $this->mpembayaran->getlunastahunan($id)->result();
    $data_lunas_tdk = $this->mpembayaran->getlunastdkdiket($id)->result();

    $data_page    = array(
    'title'     => 'Riwayat Pembayaran '.$data_murid['nama'],
    'button'    => '',
    'side_bar'  => $this->mmenu->getmenu()->result(),
    'content'   => $this->parser->parse('pembayaran_riwayat', array
      (
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

  public function actDelete($id){
    $this->mmurid->deletemurid($id);
    redirect('murid');
  }
}
