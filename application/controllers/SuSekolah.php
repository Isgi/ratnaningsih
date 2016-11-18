
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuSekolah extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if(!$this->session->userdata('username'))
        redirect('bauth');
    }

    public function index()
    {
        $data_derajat = $this->modelsik->getderajat()->result();
        $data_content = $this->modelsik->getsekolah()->result();

        $data_page = array(
        'title' => 'Sekolah',
        'button' => '<button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-success" name="button"><i class="ti-plus"></i>&nbsp&nbspBaru</button>',
        'side_bar' => $this->modelsik->getmenu()->result(),
        'content' => $this->parser->parse('su_sekolah', array('data_content'=>$data_content,'data_derajat'=>$data_derajat),true)
        );
        $this->parser->parse('b_main', $data_page);
    }
    public function actAdd()
    {
        $sekolah  = $this->input->post('sekolah');
        $yayasan  = $this->input->post('yayasan');
        $alamat   = $this->input->post('alamat');
        $pengurus = $this->input->post('pengurus');
        $derajat  = $_REQUEST['derajat'];

        $data_sekolah = array('nama'      => $sekolah,
                              'derajat'   => $derajat,
                              'dibuat'    => gmdate("Y-m-d H:i:s", time()+60*60*7)
                              );
        $data_yayasan = array('nama'      => $yayasan,
                              'alamat'    => $alamat);
        $data_user    = array('username'  => strtolower(preg_replace('/[^A-Za-z0-9\-\']/', '', $pengurus)),
                              'password'  => md5(strtolower(preg_replace('/[^A-Za-z0-9\-\']/', '', $pengurus))),
                              'nama'      => $pengurus,
                              'jabatan'   => 'u',
                              'dibuat'    => gmdate("Y-m-d H:i:s", time()+60*60*7)
                              );

        $this->modelsik->insertsekolah(array('sekolah' => $data_sekolah , 'yayasan' => $data_yayasan, 'user' => $data_user ));
        redirect(susekolah);

    }

}

/* End of file SuSekolah.php */
