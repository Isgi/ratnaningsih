<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mjenistransaksi extends CI_Model{
	public function insertJenisTransaksi($data){
    $this->db->insert('jenis_transaksi', $data);
  }
  public function getJenisTransaksi(){
    $query = $this->db->order_by('nama','ASC')
    ->get('jenis_transaksi');
    return $query;
  }
	public function getJenisTransaksiPemasukan() {
		$query = $this->db->order_by('nama','ASC')
		->where('jenis', 'pemasukan')
    ->get('jenis_transaksi');
    return $query;
	}
  public function getJenisTransaksiBy($data){
    $query = $this->db->get_where('jenis_transaksi',$data);
    return $query;
  }
  public function updateJenisTransaksi($data){
    $this->db->where('id', $data['id'])
    ->update('jenis_transaksi', $data);
  }
  public function deleteJenisTransaksi($id){
    $this->db->delete('jenis_transaksi', array('id' => $id));
  }
}
