<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends Main_model
{
    protected $table = 'pegawai';

    public function all()
    {
    	$query = "SELECT $this->table.*, jabatan.nama_jabatan FROM $this->table JOIN jabatan USING (kode_jabatan)";
    	$query = $this->db->query($query);
    	return $query->result();
    }

    public function setFaceDescriptor($id_pegawai, $faceDesciptor)
    {
    	$data = ['kontur_wajah' => $faceDesciptor];

    	return $this->update($data, ['id_pegawai' => $id_pegawai]);
    }

    public function getAllFacesModel()
    {
        return $this->db->select("kontur_wajah")
            ->from($this->table)
            ->where('kontur_wajah', '!=', '')
            ->get()
            ->result();
    }

    public function getByCode($kode_pegawai)
    {
        return $this->getBy('kode_pegawai', $kode_pegawai);
    }
}

/* End of file .php */