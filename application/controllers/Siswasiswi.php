<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswasiswi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if(!$this->session->userdata('username'))
        redirect('auth');
  }

  function index()
  {
    // $data_sekolah = $this->ratnaningsih->getsekolah();
    $data_kelas = $this->ratnaningsih->getkelas()->result();
    $data_content = $this->ratnaningsih->getsiswa()->result();
    // var_dump($data_kelas);
    // exit;
    $data_page    = array(
    'title'     => 'Siswa - Siswi ',
    'button'    => '<button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-success" name="button"><i class="ti-plus"></i>&nbsp&nbspBaru</button>',
    'side_bar'  => $this->ratnaningsih->getmenu()->result(),
    'content'   => $this->parser->parse('siswa_siswi', array('data_kelas' => $data_kelas, 'data_content' => $data_content),true)
    );
    $this->parser->parse('main', $data_page);
  }

  public function actAdd(){
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
      $program = $this->ratnaningsih->getprogram()->result_array();

      $upload_data = $this->upload->data();
      $file = $upload_data['file_path'].$upload_data['file_name'];
			//load the excel library
	    $this->load->library('Excel');
			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);

			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
	    $worksheetTitle     = $worksheet->getTitle();
	    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
	    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
	    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

		    for ($row = 4; $row <= $highestRow; ++ $row) {
	        for ($col = 1; $col < $highestColumnIndex; ++ $col) {
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
		    }
			}

      $this->rendersiswa($dataArr);
      redirect('siswasiswi');
			// $this->insertDataFile($dataArr);
    }
  }
  private function renderSiswa($data){
    foreach ($data as $datasiswa => $dat) {
      $rebuild_data = array('no_induk'        => $dat[1],
														'nama'            => $dat[2],
		 												'jk'              => $dat[3],
														'nama_panggilan'  => $dat[4],
														'ttl'             => $dat[5],
														'ortu'            => $dat[6],
                            'alamat'          => $dat[7],
                            'program'         => $dat[8],
                            'kelas'           => $dat[9]
                          );
			$this->ratnaningsih->insertsiswa($rebuild_data);
      # code...
    }
  }
}
