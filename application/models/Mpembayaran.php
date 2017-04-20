<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpembayaran extends CI_Model{

	public function insertPembayaran($data){
    $this->db->insert('pembayaran', $data);
  }

  public function getPembayaranBulananGroup($query=null,$limit=null,$offset=null){
			$this->db->select('
				pembayaran.id,
				tgl_setoran,
				sum(nominal) as jumlah_nominal,
				harga,
				jenis_pembayaran.nama as nama_pembayaran,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				nominal,
				item_pembayaran')
	    ->join('item_pembayaran','item_pembayaran.id = pembayaran.item_pembayaran')
	    ->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
	    ->join('murid','murid.id = pembayaran.murid')
	    ->join('kelas','kelas.id = murid.kelas')
	    ->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','bln')
			->group_by('no_induk')
	    ->group_by('item_pembayaran')
			->group_by('MONTH(tgl_setoran), YEAR(tgl_setoran)')
	    ->order_by('pembayaran.id','DESC');
			if ($query != null) {
				if ($query['kategori']=='lunas') {
					$this->db->having('sum(nominal) >= harga');
				}elseif ($query['kategori']=='belum_lunas') {
					$this->db->having('sum(nominal) < harga');
				}
				$this->db->like('no_induk',$query['nis']);
			}
	    $query = $this->db->get('pembayaran',$limit,$offset);
    return $query;
  }

	public function getPembayaranTahunanGroup($query=null,$limit=null,$offset=null){
			$this->db->select('
				pembayaran.id,
				tgl_setoran,
				sum(nominal) as jumlah_nominal,
				harga,
				jenis_pembayaran.nama as nama_pembayaran,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				nominal,
				item_pembayaran')
	    ->join('item_pembayaran','item_pembayaran.id = pembayaran.item_pembayaran')
	    ->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
	    ->join('murid','murid.id = pembayaran.murid')
	    ->join('kelas','kelas.id = murid.kelas')
	    ->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','thn')
	    ->group_by('item_pembayaran')
			->group_by('YEAR(tgl_setoran)')
			->group_by('no_induk')
	    ->order_by('pembayaran.id','DESC');
			if ($query != null) {
				if ($query['kategori']=='lunas') {
					$this->db->having('sum(nominal) >= harga');
				}elseif ($query['kategori']=='belum_lunas') {
					$this->db->having('sum(nominal) < harga');
				}
				$this->db->like('no_induk',$query['nis']);
			}
	    $query = $this->db->get('pembayaran',$limit,$offset);
    return $query;
  }

	public function getPembayaranTdkGroup($query=null,$limit=null,$offset=null){
			$this->db->select('
				pembayaran.id,
				tgl_setoran,
				sum(nominal) as jumlah_nominal,
				harga,
				jenis_pembayaran.nama as nama_pembayaran,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				nominal,
				item_pembayaran')
	    ->join('item_pembayaran','item_pembayaran.id = pembayaran.item_pembayaran')
	    ->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
	    ->join('murid','murid.id = pembayaran.murid')
	    ->join('kelas','kelas.id = murid.kelas')
	    ->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','tdk')
	    ->group_by('item_pembayaran')
			->group_by('no_induk')
	    ->order_by('pembayaran.id','DESC');
			if ($query != null) {
				if ($query['kategori']=='lunas') {
					$this->db->having('sum(nominal) >= harga');
				}elseif ($query['kategori']=='belum_lunas') {
					$this->db->having('sum(nominal) < harga');
				}
				$this->db->like('no_induk',$query['nis']);
			}
	    $query = $this->db->get('pembayaran',$limit,$offset);
    return $query;
  }

	public function getAngsuranBulanan($query){
			$this->db->select('
				pembayaran.id,
				tgl_setoran,
				harga,
				jenis_pembayaran.nama as nama_pembayaran,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				nominal,')
	    ->join('item_pembayaran','item_pembayaran.id = pembayaran.item_pembayaran')
	    ->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
	    ->join('murid','murid.id = pembayaran.murid')
	    ->join('kelas','kelas.id = murid.kelas')
	    ->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','bln')
	    ->where('pembayaran.item_pembayaran',$query['item_pembayaran'])
			->where('YEAR(tgl_setoran)', date('Y',strtotime($query['date'])))
			->where('MONTH(tgl_setoran)', date('m',strtotime($query['date'])))
			->where('no_induk', $query['nis'])
	    ->order_by('pembayaran.id','DESC');
	    $query = $this->db->get('pembayaran');
    return $query;
  }

	public function getAngsuranTahunan($query){
			$this->db->select('
				pembayaran.id,
				tgl_setoran,
				harga,
				jenis_pembayaran.nama as nama_pembayaran,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				nominal,')
	    ->join('item_pembayaran','item_pembayaran.id = pembayaran.item_pembayaran')
	    ->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
	    ->join('murid','murid.id = pembayaran.murid')
	    ->join('kelas','kelas.id = murid.kelas')
	    ->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','thn')
	    ->where('pembayaran.item_pembayaran',$query['item_pembayaran'])
			->where('YEAR(tgl_setoran)', date('Y',strtotime($query['date'])))
			->where('no_induk', $query['nis'])
	    ->order_by('pembayaran.id','DESC');
	    $query = $this->db->get('pembayaran');
    return $query;
  }

	public function getAngsuranTdk($query){
			$this->db->select('
				pembayaran.id,
				tgl_setoran,
				harga,
				jenis_pembayaran.nama as nama_pembayaran,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				nominal,')
	    ->join('item_pembayaran','item_pembayaran.id = pembayaran.item_pembayaran')
	    ->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
	    ->join('murid','murid.id = pembayaran.murid')
	    ->join('kelas','kelas.id = murid.kelas')
	    ->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','tdk')
	    ->where('pembayaran.item_pembayaran',$query['item_pembayaran'])
			->where('no_induk', $query['nis'])
	    ->order_by('pembayaran.id','DESC');
	    $query = $this->db->get('pembayaran');
    return $query;
  }

  public function getPembayaranHarian($tgl,$limit=null,$offset=null){

    $query = $this->db->select('pembayaran.id, harga, jenis_pembayaran.nama as pembayaran, jenis_pembayaran.kode as pembayaran_kode, program.nama as program, murid.nama as murid, murid.no_induk, pembayaran.penyetor, tgl_setoran, nominal, tahun_ajaran, kelas.nama as kelas')
    ->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
    ->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
    ->join('program', 'program.id = item_pembayaran.program')
    ->join('murid', 'murid.id = pembayaran.murid')
		->join('kelas', 'kelas.id = murid.kelas')
    ->order_by('no_induk','desc')
    ->where('DATE(pembayaran.dibuat)',$tgl)
    ->get('pembayaran',$limit,$offset);
    return $query;
  }

  public function getPembayaranBulanan($bln,$limit=null,$offset=null){
    $query = $this->db->select('pembayaran.id, harga, jenis_pembayaran.nama as pembayaran, jenis_pembayaran.kode as pembayaran_kode, program.nama as program, murid.nama as murid, murid.no_induk, pembayaran.penyetor, tgl_setoran, nominal, tahun_ajaran, kelas.nama as kelas')
    ->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
    ->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
    ->join('program', 'program.id = item_pembayaran.program')
    ->join('murid', 'murid.id = pembayaran.murid')
		->join('kelas', 'kelas.id = murid.kelas')
		->order_by('no_induk','desc')
    ->where('YEAR(pembayaran.dibuat)',date('Y',strtotime($bln)))
    ->where('MONTH(pembayaran.dibuat)',date('m',strtotime($bln)))
    ->get('pembayaran',$limit,$offset);
    return $query;
  }

  public function getPembayaranTahunan($thn,$limit=null,$offset=null){
    $query = $this->db->select('pembayaran.id, harga, jenis_pembayaran.nama as pembayaran, jenis_pembayaran.kode as pembayaran_kode, program.nama as program, murid.nama as murid, murid.no_induk, pembayaran.penyetor, tgl_setoran, nominal, tahun_ajaran, kelas.nama as kelas')
    ->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
    ->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
    ->join('program', 'program.id = item_pembayaran.program')
    ->join('murid', 'murid.id = pembayaran.murid')
		->join('kelas', 'kelas.id = murid.kelas')
		->order_by('no_induk','desc')
    ->where('YEAR(pembayaran.dibuat)',$thn)
    ->get('pembayaran',$limit,$offset);
    return $query;
  }

	public function getPembayaranById($id){
		$query = $this->db->get_where('pembayaran',array('id' => $id));
		return $query;
	}

	public function getKekuranganBulanan($id){
		$query = $this->db->select('pembayaran.id,item_pembayaran.id as item_pembayaran, jenis_pembayaran.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
		->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
		->group_by('MONTH(tgl_setoran), YEAR(tgl_setoran)')
		->where('periode','bln')
		->where('pembayaran.murid',$id)
		->having('sum(nominal) < harga')
		->get('pembayaran');
		return $query;
	}

	public function getKekuranganTahunan($id){
		$query = $this->db->select('pembayaran.id,item_pembayaran.id as item_pembayaran,jenis_pembayaran.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
		->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
		->group_by('YEAR(tgl_setoran)')
		->where('periode','thn')
		->having('sum(nominal) < harga')
		->where('pembayaran.murid',$id)
		->get('pembayaran');
		return $query;
	}

	public function getKekuranganTdkDiket($id){
		$query = $this->db->select('pembayaran.id,item_pembayaran.id as item_pembayaran,jenis_pembayaran.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
		->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
		->group_by('jenis_pembayaran.nama')
		->where('periode','tdk')
		->having('sum(nominal) < harga')
		->where('pembayaran.murid',$id)
		->get('pembayaran');
		return $query;
	}

	public function getLunasBulanan($id){
		$query = $this->db->select('jenis_pembayaran.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
		->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
		->group_by('MONTH(tgl_setoran), YEAR(tgl_setoran)')
		->where('periode','bln')
		->where('pembayaran.murid',$id)
		->having('sum(nominal) >= harga')
		->get('pembayaran');
		return $query;
	}

	public function getLunasTahunan($id){
		$query = $this->db->select('jenis_pembayaran.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
		->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
		->group_by('YEAR(tgl_setoran)')
		->where('periode','thn')
		->having('sum(nominal) >= harga')
		->where('pembayaran.murid',$id)
		->get('pembayaran');
		return $query;
	}

	public function getLunasTdkDiket($id){
		$query = $this->db->select('jenis_pembayaran.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
		->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
		->group_by('jenis_pembayaran.nama')
		->where('periode','tdk')
		->having('sum(nominal) >= harga')
		->where('pembayaran.murid',$id)
		->get('pembayaran');
		return $query;
	}

	public function getKekurangan(){
		$query = $this->db->select('count(murid.nama) as jumlah_kekurangan, harga')
		->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
		->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
		->join('murid', 'murid.id = pembayaran.murid')
		->group_by('murid.no_induk')
		->where('periode','bln')
		->where('YEAR(tgl_setoran)',gmdate('Y', time()+60*60*7))
		->where('MONTH(tgl_setoran)',gmdate('m', time()+60*60*7))
		->having('sum(nominal) < harga')
		->get('pembayaran');
		return $query;
	}

	public function getLunas(){
		$query = $this->db->select('count(murid.nama) as jumlah_lunas, harga')
		->join('item_pembayaran', 'item_pembayaran.id = pembayaran.item_pembayaran')
		->join('jenis_pembayaran', 'jenis_pembayaran.id = item_pembayaran.jenis_pembayaran')
		->join('murid', 'murid.id = pembayaran.murid')
		->group_by('murid.no_induk')
		->where('periode','bln')
		->where('YEAR(tgl_setoran)',gmdate('Y', time()+60*60*7))
		->where('MONTH(tgl_setoran)',gmdate('m', time()+60*60*7))
		->having('sum(nominal) >= harga')
		->get('pembayaran');
		return $query;
	}

	public function updatePembayaran($data){
		$this->db->where('id', $data['id'])
		->update('pembayaran', $data);
	}

	public function deletePembayaran($id){
		$this->db->delete('pembayaran', array('id' => $id));
	}
}
