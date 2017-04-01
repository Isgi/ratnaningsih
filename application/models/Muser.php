<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model{
	public function getUser($data){
		$query = $this->db->get_where('user',$data);
		return $query;
	}
}