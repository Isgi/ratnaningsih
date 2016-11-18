<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ratnaningsih extends CI_Model{

  public function getMenu()
  {
    $query = $this->db->get('menu');
		return $query;
  }

  public function getUser($data){
		$query = $this->db->get_where('user',$data);
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

  public function getSekolah(){
    $query = $this->db->get('sekolah');
    return $query;
  }

  // public function getSekolah(){
  //   $query = $this->db->select('yayasan.nama as yayasan, sekolah.nama as sekolah, GROUP_CONCAT(derajat.nama) as derajat, sekolah.dibuat as dibuat')
  //   ->join('yayasan', 'yayasan.id = sekolah.yayasan')
  //   ->join('derajat', 'derajat.id = sekolah.derajat')
  //   ->order_by('sekolah.dibuat','ASC')
  //   ->group_by('yayasan')
  //   ->get('sekolah');
  //   return $query;
  // }




  //Kelas
  public function insertKelas($data){
    $sekolah = $data['sekolah'];
    $jumlah_sekolah = sizeof($sekolah);
    for ($i=0; $i < $jumlah_sekolah ; $i++) {
      $data['sekolah'] = $sekolah[$i];
      $this->db->insert('kelas', $data);
    }
  }

  public function getKelas(){
    $query = $this->db->select('kelas.id, sekolah.nama, sekolah.derajat, kelas.nama as nama_kelas , kelas.kapasitas as kapasitas_kelas')
    ->join('sekolah', 'sekolah.id = kelas.sekolah')
    // ->group_by('sekolah')
    ->get('kelas');
    return $query;
  }



  //program
  public function getProgram(){
    return $this->db->order_by('id','DESC')
    ->get('program');
  }



  //jenis Pembayaran
  public function insertJenisPembayaran($data){
    $this->db->insert('jenis_transaksi', $data);
  }
  public function getJenisPembayaran(){
    $query = $this->db->order_by('nama','ASC')
    ->get('jenis_transaksi');
    return $query;
  }
  public function getJenisPembayaranBy($data){
    $query = $this->db->get_where('jenis_transaksi',$data);
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
  public function getItemPembayaran(){
    $query = $this->db->select('item_transaksi.id, program.nama as program, jenis_transaksi.nama as jenis_transaksi, sekolah.derajat as derajat, harga as harga')
    ->join('program','program.id = item_transaksi.program')
    ->join('jenis_transaksi','jenis_transaksi.id = item_transaksi.jenis_transaksi')
    ->join('sekolah','sekolah.id = item_transaksi.sekolah')
    ->order_by('jenis_transaksi.nama','asc')
    // ->group_by('jenis_transaksi')
    ->get('item_transaksi');
    return $query;
  }



  //siswasiswi
  public function insertSiswa($data){
    $this->db->insert('murid',$data);
  }
  public function getSiswa(){
    $query = $this->db->select('sekolah.derajat as sekolah, kelas.nama as kelas, no_induk, murid.nama as murid, murid.id as id_murid')
    ->join('kelas', 'kelas.id = murid.kelas')
    ->join('sekolah', 'sekolah.id = kelas.sekolah')
    ->get('murid');
    return $query;
  }
}
