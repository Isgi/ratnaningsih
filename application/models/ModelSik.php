<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelSik extends CI_Model{

  private $permission;
  private $username;
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->permission = $this->session->userdata('jabatan');
    $this->username   = $this->session->userdata('username');
  }

  public function getMenu()
  {
    $query = $this->db->where(array('izin' => $this->permission ))
    ->or_where('izin', 'all')
    ->get('menu');
		return $query;
  }

  public function getUser($data){
		$query = $this->db->select('yayasan.nama as nama_yayasan, yayasan.id as id_yayasan, user.nama, user.jabatan, user.username')
    ->join('yayasan','yayasan.id = user.yayasan')
    ->get_where('user',$data);
		return $query;
	}



  //derajat
  public function getDerajat(){
    return $this->db->get('derajat');
  }




  //yayasan
  public function insertYayasan($data){
    $this->db->insert('yayasan',$data);
  }




  //sekolah
  public function insertSekolah($data){
    $derajat = $data['sekolah']['derajat'];
    $jumlah_derajat = sizeof($derajat);

    //insert yayasan
    $this->insertyayasan($data['yayasan']);

    //set id yayasan dan id sekolah
    $data['sekolah']['yayasan'] = $this->db->insert_id();
    $data['user']['yayasan'] = $this->db->insert_id();

    //insert sekolah
    for ($i=0; $i < $jumlah_derajat ; $i++) {
      $data['sekolah']['derajat'] = $derajat[$i];
      $this->db->insert('sekolah', $data['sekolah']);
    }

    //insert user
    $this->db->insert('user', $data['user']);
  }

  public function getSekolahByUser(){
    $query = $this->db->select('sekolah.nama as nama_sekolah, derajat.nama as nama_derajat, sekolah.id as id_sekolah')
    ->join('yayasan', 'yayasan.id = sekolah.yayasan')
    ->join('derajat', 'derajat.id = sekolah.derajat')
    ->join('user', 'user.yayasan = yayasan.id')
    ->get_where('sekolah',array('username' => $this->username ));
    return $query;
  }

  public function getSekolah(){
    $query = $this->db->select('yayasan.nama as yayasan, sekolah.nama as sekolah, GROUP_CONCAT(derajat.nama) as derajat, sekolah.dibuat as dibuat')
    ->join('yayasan', 'yayasan.id = sekolah.yayasan')
    ->join('derajat', 'derajat.id = sekolah.derajat')
    ->order_by('sekolah.dibuat','ASC')
    ->group_by('yayasan')
    ->get('sekolah');
    return $query;
  }




  //Kelas
  public function insertKelas($data){
    $sekolah = $data['sekolah'];
    $jumlah_sekolah = sizeof($sekolah);
    for ($i=0; $i < $jumlah_sekolah ; $i++) {
      $data['sekolah'] = $sekolah[$i];
      $this->db->insert('kelas', $data);
    }
  }

  public function getKelasByUser(){
    $query = $this->db->select('kelas.id, sekolah.nama, derajat.nama as derajat, GROUP_CONCAT(kelas.nama) as nama_kelas ,  GROUP_CONCAT(kelas.kapasitas) as kapasitas_kelas')
    ->join('sekolah', 'sekolah.id = kelas.sekolah')
    ->join('derajat', 'derajat.id = sekolah.derajat')
    ->join('yayasan', 'yayasan.id = sekolah.yayasan')
    ->join('user'   , 'user.yayasan    = yayasan.id')
    ->group_by('sekolah')
    ->get_where('kelas', array('username' => $this->username ));
    return $query;
  }



  //program
  public function getProgram(){
    return $this->db->get('program');
  }



  //jenis Pembayaran
  public function insertJenisPembayaran($data){
    $this->db->insert('jenis_transaksi', $data);
  }
  public function getJenisPembayaranByUser(){
    $query = $this->db->select('jenis_transaksi.id, jenis_transaksi.kode, jenis_transaksi.nama, jenis_transaksi.periode_bulanan, jenis_transaksi.jenis')
    ->join('jenis_transaksi', 'jenis_transaksi.id = item_transaksi.jenis_transaksi')
    ->join('sekolah', 'sekolah.id = item_transaksi.sekolah')
    ->join('yayasan', 'yayasan.id = sekolah.yayasan')
    ->join('user', 'user.yayasan = yayasan.id')
    ->group_by('jenis_transaksi')
    ->get_where('jenis_transaksi',array('username' => $this->username ));
    return $query;
  }


  //item Pembayaran
  public function insertItemPembayaran($data){
    $sekolah = $data['sekolah'];
    $jumlah_sekolah = sizeof($sekolah);
    for ($i=0; $i < $jumlah_sekolah ; $i++) {
      $data['sekolah'] = $sekolah[$i];
      $this->db->insert('item_transaksi', $data);
    }
  }
  public function getItemPembayaranByUser(){
    $query = $this->db->select('item_transaksi.id, program.nama as program, jenis_transaksi.nama as jenis_transaksi, GROUP_CONCAT(derajat.nama) as derajat, harga')
    ->join('program','program.id = item_transaksi.program')
    ->join('jenis_transaksi','jenis_transaksi.id = item_transaksi.jenis_transaksi')
    ->join('sekolah','sekolah.id = item_transaksi.sekolah')
    ->join('derajat','derajat.id = sekolah.derajat')
    ->join('yayasan','yayasan.id = sekolah.yayasan')
    ->join('user','user.yayasan = yayasan.id')
    ->group_by('program')
    ->get_where('item_transaksi', array('username' => $this->username));
    return $query;
  }



  //Post
  public function insertPost($data)
  {
    $this->db->insert('post',$data);
  }

  public function getpost()
  {

    $query = $this->db->select('user.nama , post.judul , post.waktu , post.id')
    ->join('user', 'user.id = post.user')
    ->get_where('post',array('status' => 'visible' ));

    return $query;
  }

  public function getPostBy($data)
  {
    $query = $this->db->get_where('post', $data);
    return $query;
  }

  public function updatePost($data)
  {
    if (!empty($data['gambar']))
    {
        $row = $this->db->where('id',$data['id'])
        ->get('post')->row();
        unlink('assets/img/upload/'.$row->gambar);
    }
    $this->db->where('id',$data['id'])
    ->update('post',$data);
  }
}
