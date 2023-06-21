<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends Main_Model {


	private $_pegawai = 'pegawai',
			$_jabatan = 'jabatan',
			$_presensi = 'presensi';

	public function getLaporan($tanggal_awal, $tanggal_akhir, $kode_pegawai = 'ALL')
	{
		$query = "SELECT $this->_presensi.*, $this->_pegawai.nama_pegawai, $this->_pegawai.kode_pegawai, $this->_jabatan.nama_jabatan";
		$query .= " FROM $this->_presensi JOIN $this->_pegawai USING (kode_pegawai) JOIN $this->_jabatan USING (kode_jabatan)";
		$query .= " WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";

		if($kode_pegawai !== 'ALL') {
			$query .= " AND $this->_presensi.kode_pegawai = '$kode_pegawai'";
		}

		$query .= " ORDER BY $this->_pegawai.kode_pegawai ASC, tanggal ASC";
		return $this->db->query($query)->result();
	}


}

/* End of file Laporan_model.php */
/* Location: ./application/models/Laporan_model.php */