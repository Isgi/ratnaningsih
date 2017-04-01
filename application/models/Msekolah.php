<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msekolah extends CI_Model{
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
}