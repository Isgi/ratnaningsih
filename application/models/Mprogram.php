<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mprogram extends CI_Model{
	public function getProgram(){
    return $this->db->order_by('id','DESC')
    ->get('program');
  }
}