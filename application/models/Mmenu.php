<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmenu extends CI_Model{

	public function __construct(){
    parent::__construct();
    $this->jabatan = $this->session->userdata('jabatan');
  }

	public function getMenu()
  {
		if ($this->jabatan == 'su') {
			$query = $this->db->order_by('urutan','ASC')
			->get('menu');
		} else {
			$query = $this->db->order_by('urutan','ASC')
			->get_where('menu', array('izin'=>'u'));
		}
		return $query;
  }
}
