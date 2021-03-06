<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransaksi extends CI_Model{

	public function insertPembayaran($data){
    $this->db->insert('transaksi', $data);
  }

  public function getPembayaranBulananGroup($query=null,$limit=null,$offset=null){
			$this->db->select('
				transaksi.id,
				tgl_setoran,
				sum(nominal) as jumlah_nominal,
				transaksi.harga as harga,
				transaksi.nama as nama_transaksi,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				transaksi.kode as kode')
	    ->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
	    ->join('murid','murid.id = transaksi.murid')
	    ->join('kelas','kelas.id = murid.kelas')
	    ->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','bln')
			->group_by('no_induk')
	    ->group_by('transaksi.kode')
			->group_by('MONTH(tgl_setoran), YEAR(tgl_setoran)')
	    ->order_by('transaksi.id','DESC');
			if ($query != null) {
				if ($query['kategori']=='lunas') {
					$this->db->having('sum(nominal) >= transaksi.harga');
				}elseif ($query['kategori']=='belum_lunas') {
					$this->db->having('sum(nominal) < transaksi.harga');
				}
				$this->db->like('no_induk',$query['nis']);
			}
	    $query = $this->db->get('transaksi',$limit,$offset);
    return $query;
  }

	public function getPembayaranTahunanGroup($query=null,$limit=null,$offset=null){
			$this->db->select('
				transaksi.id,
				tgl_setoran,
				sum(nominal) as jumlah_nominal,
				transaksi.harga as harga,
				transaksi.nama as nama_transaksi,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				transaksi.kode as kode')
			->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
	    ->join('murid','murid.id = transaksi.murid')
	    ->join('kelas','kelas.id = murid.kelas')
	    ->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','thn')
			->group_by('no_induk')
	    ->group_by('transaksi.kode')
			->group_by('YEAR(tgl_setoran)')
	    ->order_by('transaksi.id','DESC');
			if ($query != null) {
				if ($query['kategori']=='lunas') {
					$this->db->having('sum(nominal) >= harga');
				}elseif ($query['kategori']=='belum_lunas') {
					$this->db->having('sum(nominal) < harga');
				}
				$this->db->like('no_induk',$query['nis']);
			}
	    $query = $this->db->get('transaksi',$limit,$offset);
    return $query;
  }

	public function getPembayaranTdkGroup($query=null,$limit=null,$offset=null){
			$this->db->select('
				transaksi.id,
				tgl_setoran,
				sum(nominal) as jumlah_nominal,
				transaksi.harga as harga,
				transaksi.nama as nama_transaksi,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				transaksi.kode as kode')
			->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
			->join('murid','murid.id = transaksi.murid')
			->join('kelas','kelas.id = murid.kelas')
			->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','tdk')
			->group_by('no_induk')
			->group_by('transaksi.kode')
			->order_by('transaksi.id','DESC');
			if ($query != null) {
				if ($query['kategori']=='lunas') {
					$this->db->having('sum(nominal) >= harga');
				}elseif ($query['kategori']=='belum_lunas') {
					$this->db->having('sum(nominal) < harga');
				}
				$this->db->like('no_induk',$query['nis']);
			}
	    $query = $this->db->get('transaksi',$limit,$offset);
    return $query;
  }

	//ambil data transaksi pendapatan dari angsuran murid tipe bulanan, ex: SPP
	public function getAngsuranBulanan($query){
			$this->db->select('
				transaksi.id,
				tgl_setoran,
				transaksi.harga,
				transaksi.nama as nama_transaksi,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				transaksi.nominal,')
	    ->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
	    ->join('murid','murid.id = transaksi.murid')
	    ->join('kelas','kelas.id = murid.kelas')
	    ->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','bln')
	    ->where('transaksi.kode',$query['kode'])
			->where('YEAR(tgl_setoran)', date('Y',strtotime($query['date'])))
			->where('MONTH(tgl_setoran)', date('m',strtotime($query['date'])))
			->where('no_induk', $query['nis'])
	    ->order_by('transaksi.id','DESC');
	    $query = $this->db->get('transaksi');
    return $query;
  }

	//ambil data transaksi pendapatan dari angsuran murid tipe tahunan, ex: Bangunan
	public function getAngsuranTahunan($query){
			$this->db->select('
				transaksi.id,
				tgl_setoran,
				transaksi.harga,
				transaksi.nama as nama_transaksi,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				transaksi.nominal,')
			->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
			->join('murid','murid.id = transaksi.murid')
			->join('kelas','kelas.id = murid.kelas')
			->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','thn')
	    ->where('transaksi.kode',$query['kode'])
			->where('YEAR(tgl_setoran)', date('Y',strtotime($query['date'])))
			->where('no_induk', $query['nis'])
	    ->order_by('transaksi.id','DESC');
	    $query = $this->db->get('transaksi');
    return $query;
  }

	//ambil data transaksi pendapatan dari angsuran murid berdasarkan periode tidak ditentukan, ex: baju seragam
	public function getAngsuranTdk($query){
			$this->db->select('
				transaksi.id,
				tgl_setoran,
				transaksi.harga,
				jenis_transaksi.nama as nama_transaksi,
				murid.no_induk,
				murid.nama as nama_murid,
				kelas.nama as nama_kelas,
				derajat,
				transaksi.nominal,')
	    ->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
	    ->join('murid','murid.id = transaksi.murid')
	    ->join('kelas','kelas.id = murid.kelas')
	    ->join('sekolah','sekolah.id = kelas.sekolah')
			->where('periode','tdk')
	    ->where('transaksi.kode',$query['kode'])
			->where('no_induk', $query['nis'])
	    ->order_by('transaksi.id','DESC');
	    $query = $this->db->get('transaksi');
    return $query;
  }

	//ambil data transaksi pendapatan dari murid berdasarkan hari
  public function getPembayaranHarian($tgl,$limit=null,$offset=null){
    $query = $this->db->select('
			transaksi.id,
			transaksi.penyetor,
			transaksi.nama,
			transaksi.kode,
			jenis_transaksi.jenis as transaksi_jenis,
			murid.nama as murid,
			murid.no_induk,
			murid.tahun_ajaran,
			tgl_setoran, nominal')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
    ->join('murid', 'murid.id = transaksi.murid', 'left')
    ->order_by('tgl_setoran','desc')
    ->where('DATE(tgl_setoran)',$tgl)
    ->get('transaksi',$limit,$offset);
    return $query;
  }

	//ambil data transaksi pendapatan dari murid berdasarkan bulan
  public function getPembayaranBulanan($bln,$limit=null,$offset=null){
    $query = $this->db->select('
			transaksi.id,
			transaksi.penyetor,
			transaksi.nama,
			transaksi.kode,
			jenis_transaksi.jenis as transaksi_jenis,
			murid.nama as murid,
			murid.no_induk,
			murid.tahun_ajaran,
			tgl_setoran, nominal')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
    ->join('murid', 'murid.id = transaksi.murid', 'left')
    ->order_by('tgl_setoran','desc')
    ->where('YEAR(tgl_setoran)',date('Y',strtotime($bln)))
    ->where('MONTH(tgl_setoran)',date('m',strtotime($bln)))
    ->get('transaksi',$limit,$offset);
    return $query;
  }

	//ambil data transaksi pendapatan dari murid berdasarkan tahun
  public function getPembayaranTahunan($thn,$limit=null,$offset=null){
    $query = $this->db->select('
			transaksi.id,
			transaksi.penyetor,
			transaksi.nama,
			transaksi.kode,
			jenis_transaksi.jenis as transaksi_jenis,
			murid.nama as murid,
			murid.no_induk,
			murid.tahun_ajaran,
			tgl_setoran, nominal')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
    ->join('murid', 'murid.id = transaksi.murid', 'left')
    ->order_by('tgl_setoran','desc')
    ->where('YEAR(tgl_setoran)',$thn)
    ->get('transaksi',$limit,$offset);
    return $query;
  }

	public function getPembayaranById($id){
		$query = $this->db->get_where('transaksi',array('id' => $id));
		return $query;
		}

	public function getKekuranganBulanan($id){
		$query = $this->db->select('transaksi.id, jenis_transaksi.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->group_by('MONTH(tgl_setoran), YEAR(tgl_setoran)')
		->where('periode','bln')
		->where('murid',$id)
		->having('sum(nominal) < harga')
		->get('transaksi');
		return $query;
	}

	public function getKekuranganTahunan($id){
		$query = $this->db->select('transaksi.id, jenis_transaksi.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->group_by('YEAR(tgl_setoran)')
		->where('periode','thn')
		->having('sum(nominal) < harga')
		->where('murid',$id)
		->get('transaksi');
		return $query;
	}

	public function getKekuranganTdkDiket($id){
		$query = $this->db->select('transaksi.id, jenis_transaksi.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->group_by('transaksi.kode')
		->where('periode','tdk')
		->having('sum(nominal) < harga')
		->where('murid',$id)
		->get('transaksi');
		return $query;
	}

	public function getLunasBulanan($id){
		$query = $this->db->select('transaksi.id, jenis_transaksi.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->group_by('MONTH(tgl_setoran), YEAR(tgl_setoran)')
		->where('periode','bln')
		->where('murid',$id)
		->having('sum(nominal) >= harga')
		->get('transaksi');
		return $query;
	}

	public function getLunasTahunan($id){
		$query = $this->db->select('transaksi.id, jenis_transaksi.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->group_by('YEAR(tgl_setoran)')
		->where('periode','thn')
		->having('sum(nominal) >= harga')
		->where('murid',$id)
		->get('transaksi');
		return $query;
	}

	public function getLunasTdkDiket($id){
		$query = $this->db->select('transaksi.id, jenis_transaksi.nama, sum(nominal) as nominal, harga, tgl_setoran')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->group_by('transaksi.kode')
		->where('periode','tdk')
		->having('sum(nominal) >= harga')
		->where('murid',$id)
		->get('transaksi');
		return $query;
	}

	public function getKekurangan(){
		$query = $this->db->select('count(murid.nama) as jumlah_kekurangan, harga')
		->join('item_transaksi_pendapatan_murid', 'item_transaksi_pendapatan_murid.id = transaksi.item_transaksi_pendapatan_murid')
		->join('jenis_transaksi', 'jenis_transaksi.id = item_transaksi_pendapatan_murid.jenis_transaksi')
		->join('murid', 'murid.id = transaksi.murid')
		->group_by('murid.no_induk')
		->where('periode','bln')
		->where('YEAR(tgl_setoran)',gmdate('Y', time()+60*60*7))
		->where('MONTH(tgl_setoran)',gmdate('m', time()+60*60*7))
		->having('sum(nominal) < harga')
		->get('transaksi');
		return $query;
	}

	public function getSppLunas(){
		$query = $this->db->select('count(murid.nama) as jumlah_lunas, harga')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->join('murid', 'murid.id = transaksi.murid')
		->group_by('murid.no_induk')
		->where('periode','bln')
		->where('jenis_transaksi.kode','SPP')
		->or_where('jenis_transaksi.kode', 'SPPH')
		->or_where('jenis_transaksi.kode', 'SPPF')
		->where('YEAR(tgl_setoran)',gmdate('Y', time()+60*60*7))
		->where('MONTH(tgl_setoran)',gmdate('m', time()+60*60*7))
		->having('sum(nominal) >= harga')
		->get('transaksi');
		return $query;
	}

	public function getTransaksiLainlain($query=null,$limit=null,$offset=null){
    $this->db->select('transaksi.id, transaksi.nama, transaksi.penyetor, tgl_setoran, keterangan, nominal')
    ->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->order_by('dibuat','desc')
		->where('jenis_transaksi', 134);
		if ($query != null) {
			$this->db->like('transaksi.nama',$query['nama']);
		}
		$query = $this->db->get('transaksi',$limit,$offset);
    return $query;
  }

	public function getTransaksiPengeluaran($query=null,$limit=null,$offset=null) {
		$this->db->select('
			transaksi.id,
			transaksi.nama,
			transaksi.penyetor,
			jenis_transaksi.nama as jenis_transaksi_nama,
			jenis_transaksi.kode as jenis_transaksi_kode,
			tgl_setoran, keterangan, nominal')
    ->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->order_by('dibuat','desc')
		->where('jenis_transaksi.jenis', 'pengeluaran');
		if ($query != null) {
			$this->db->like('jenis_transaksi.nama',$query['nama']);
		}
		$query = $this->db->get('transaksi',$limit,$offset);
    return $query;
	}

	public function getLaporanKeuangan($bln=null,$limit=null,$offset=null) {
		// print_r($bln);
		// die();
		// ling lto ki
		$query = $this->db->select('
			transaksi.id,
			transaksi.nama,
			transaksi.kode as transaksi_kode,
			jenis_transaksi.jenis as transaksi_jenis,
			tgl_setoran, SUM(nominal) as nominal')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->group_by('transaksi.kode')
    ->where('YEAR(tgl_setoran)',date('Y',strtotime($bln)))
    ->where('MONTH(tgl_setoran)',date('m',strtotime($bln)))
		->order_by('jenis_transaksi.jenis', 'desc')
    ->get('transaksi',$limit,$offset);
    return $query;
	}

	public function getPendapatan() {
		$query = $this->db->select('sum(nominal) as nominal, transaksi.dibuat, jenis_transaksi.jenis')
		// ->join('item_transaksi_pendapatan_murid', 'item_transaksi_pendapatan_murid.id = transaksi.item_transaksi_pendapatan_murid', 'left')
		// ->join('jenis_transaksi as jenis_transaksi_item', 'jenis_transaksi_item.id = item_transaksi_pendapatan_murid.jenis_transaksi', 'left')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->group_by('MONTH(transaksi.dibuat), YEAR(transaksi.dibuat)')
		->where('jenis_transaksi.jenis !=', 'pemasukan')
		->get('transaksi');
		return $query;
	}

	public function getPengeluaran() {
		$query = $this->db->select('sum(nominal) as nominal, transaksi.dibuat, jenis_transaksi.jenis')
		// ->join('item_transaksi_pendapatan_murid', 'item_transaksi_pendapatan_murid.id = transaksi.item_transaksi_pendapatan_murid', 'left')
		// ->join('jenis_transaksi as jenis_transaksi_item', 'jenis_transaksi_item.id = item_transaksi_pendapatan_murid.jenis_transaksi', 'left')
		->join('jenis_transaksi', 'jenis_transaksi.id = transaksi.jenis_transaksi')
		->group_by('MONTH(transaksi.dibuat), YEAR(transaksi.dibuat)')
		->where('jenis_transaksi.jenis !=', 'pengeluaran')
		->get('transaksi');
		return $query;
	}

	public function updatePembayaran($data){
		$this->db->where('id', $data['id'])
		->update('transaksi', $data);
	}

	public function deletePembayaran($id){
		$this->db->delete('transaksi', array('id' => $id));
	}

	public function getJenisTransaksi() {
		$query = $this->db->select('*')
		->where('jenis', 'pengeluaran')
		->order_by('nama','asc');
		$query = $this->db->get('jenis_transaksi');
		return $query;
	}

}
