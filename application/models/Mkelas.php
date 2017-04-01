<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkelas extends CI_Model{
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
  public function getKelasBy($data){
    $query = $this->db->get_where('kelas',$data);
    return $query;
  }
  public function deleteKelas($id){
    $this->db->delete('kelas', array('id' => $id));
  }


}
