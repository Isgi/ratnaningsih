<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mjenispembayaran extends CI_Model{
	public function insertJenisPembayaran($data){
    $this->db->insert('jenis_pembayaran', $data);
  }
  public function getJenisPembayaran(){
    $query = $this->db->order_by('nama','ASC')
    ->get('jenis_pembayaran');
    return $query;
  }
  public function getJenisPembayaranBy($data){
    $query = $this->db->get_where('jenis_pembayaran',$data);
    return $query;
  }
  public function updateJenisPembayaran($data){
    $this->db->where('id', $data['id'])
    ->update('jenis_pembayaran', $data);
  }
  public function deleteJenisPembayaran($id){
    $this->db->delete('jenis_pembayaran', array('id' => $id));
  }
}