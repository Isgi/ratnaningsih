<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitempembayaran extends CI_Model{
	public function insertItemPembayaran($data){
    $sekolah = $data['sekolah'];
    $jumlah_sekolah = sizeof($sekolah);
    for ($i=0; $i < $jumlah_sekolah ; $i++) {
      $data['sekolah'] = $sekolah[$i];
      $this->db->insert('item_pembayaran', $data);
    }
  }
  public function getItemPembayaran(){
    $query = $this->db->select('item_pembayaran.id, program.nama as program, jenis_pembayaran.nama as jenis_pembayaran, sekolah.derajat as derajat, harga as harga')
    ->join('program','program.id = item_pembayaran.program')
    ->join('jenis_pembayaran','jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
    ->join('sekolah','sekolah.id = item_pembayaran.sekolah')
    ->order_by('jenis_pembayaran.id','desc')
    // ->group_by('jenis_pembayaran')
    ->get('item_pembayaran');
    return $query;
  }
  public function getItemPembayaranBy($data){
    $query = $this->db->get_where('item_pembayaran',$data);
    return $query;
  }
  public function updateItemPembayaran($data){

    $this->db->where('id', $data['id'])
    ->update('item_pembayaran', $data);
  }
  public function deleteItemPembayaran($id){
    $this->db->delete('item_pembayaran', array('id' => $id));
  }
}