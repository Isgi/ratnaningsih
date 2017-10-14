<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitemtransaksimurid extends CI_Model{
	public function insertItemTransaksiMurid($data){
    $sekolah = $data['sekolah'];
    $jumlah_sekolah = sizeof($sekolah);
    for ($i=0; $i < $jumlah_sekolah ; $i++) {
      $data['sekolah'] = $sekolah[$i];
      $this->db->insert('item_transaksi_pendapatan_murid', $data);
    }
  }
  public function getItemTransaksiMurid(){
    $query = $this->db->select('item_transaksi_pendapatan_murid.id, program.nama as program, jenis_transaksi.nama as jenis_transaksi, sekolah.derajat as derajat, harga as harga')
    ->join('program','program.id = item_transaksi_pendapatan_murid.program')
    ->join('jenis_transaksi','jenis_transaksi.id = item_transaksi_pendapatan_murid.jenis_transaksi')
    ->join('sekolah','sekolah.id = item_transaksi_pendapatan_murid.sekolah')
    ->order_by('jenis_transaksi.id','desc')
    // ->group_by('jenis_transaksi')
    ->get('item_transaksi_pendapatan_murid');
    return $query;
  }
  public function getItemTransaksiMuridBy($data){
    $query = $this->db->get_where('item_transaksi_pendapatan_murid',$data);
    return $query;
  }
  public function updateItemTransaksiMurid($data){

    $this->db->where('id', $data['id'])
    ->update('item_transaksi_pendapatan_murid', $data);
  }
  public function deleteItemTransaksiMurid($id){
    $this->db->delete('item_transaksi_pendapatan_murid', array('id' => $id));
  }
}
