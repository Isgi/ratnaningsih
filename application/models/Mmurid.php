<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmurid extends CI_Model{
  public function insertMurid($data){
    $this->db->insert('murid',$data);
  }
  public function getMurid($limit=null, $offset=null){
    $query = $this->db->select('sekolah.derajat as sekolah, tahun_ajaran, kelas.nama as kelas, no_induk, murid.nama as murid, murid.id as id_murid, program.nama as program')
    ->join('kelas', 'kelas.id = murid.kelas')
    ->join('sekolah', 'sekolah.id = kelas.sekolah')
    ->join('program', 'program.id = murid.program')
    ->get('murid',$limit,$offset);
    return $query;
  }
  public function getMuridFilter($query, $limit=null, $offset=null){
    $this->db->select('sekolah.derajat as sekolah, tahun_ajaran, kelas.nama as kelas, no_induk, murid.nama as murid, murid.id as id_murid, program.nama as program')
    ->join('kelas', 'kelas.id = murid.kelas')
    ->join('sekolah', 'sekolah.id = kelas.sekolah')
    ->join('program', 'program.id = murid.program')
    ->like('murid.nama', $query['nama_or_nis']);
    if ($query['kelas'] != "") {
      $this->db->where('murid.kelas',$query['kelas']);
    }
    $query = $this->db->get('murid',$limit,$offset);
    return $query;
  }
  public function searchMurid($kata_cari){
    $query = $this->db->select('id,no_induk,nama')
    ->like('nama',$kata_cari)
    ->or_like('no_induk',$kata_cari)
    ->get('murid');
    return $query;
  }
  public function getMuridById($id){
    $query = $this->db->select('murid.id, no_induk, murid.nama, murid.program, murid.kelas, sekolah.derajat')
    ->join('kelas','kelas.id=murid.kelas')
    ->join('sekolah','sekolah.id=kelas.sekolah')
    ->get_where('murid', array('murid.id' => $id ));
    return $query;
  }
  public function getMuridItemPembayaran($murid){
    $query = $this->db->select('item_pembayaran.id,program.nama as nama_program, jenis_pembayaran.nama, harga, sekolah.derajat')
    ->join('jenis_pembayaran','jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
    ->join('sekolah', 'item_pembayaran.sekolah = sekolah.id')
    ->join('program', 'item_pembayaran.program = program.id')
    // ->where("(item_pembayaran.program='".$murid['program']."' OR item_pembayaran.program=1)")
    ->where("sekolah.derajat = '".$murid['derajat']."'")
    ->order_by("jenis_pembayaran.nama","ASC")
    ->get('item_pembayaran');
    return $query;
  }
  public function updateMurid($data){
    $this->db->where('id', $data['id'])
    ->update('murid', $data);
  }
  public function deleteMurid($id){
    $this->db->delete('murid', array('id' => $id));
  }
}
