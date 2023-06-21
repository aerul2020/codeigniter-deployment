<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi_model extends Main_model
{
    protected $table = 'presensi';

    public function getCountPerMonth($year = null)
    {
        $year = ($year !== null) ? $year : date('Y');
        $query = $this->db->select('COUNT(*) AS total, MONTH(tanggal) AS index_bulan')
            ->from($this->table)
            ->where('YEAR(tanggal)', $year)
            ->group_by('index_bulan')
            ->order_by('index_bulan')
            ->get();

        return $query->result();

    }

    public function checkTodayAttendance($kode_pegawai)
    {
        $today = date('Y-m-d');
        $query = $this->db->where('kode_pegawai', $kode_pegawai)
            ->where('tanggal', $today)
            ->get($this->table);
        return $query;
    }

    public function getTodayAttendance()
    {
        return $this->db->select("$this->table.*, pegawai.nama_pegawai, jabatan.nama_jabatan")
            ->from($this->table)
            ->join("pegawai", "$this->table.kode_pegawai = pegawai.kode_pegawai")
            ->join("jabatan", "pegawai.kode_jabatan = jabatan.kode_jabatan")
            ->where("tanggal", date('Y-m-d'))
            ->order_by('tanggal', 'DESC')
            ->order_by('jam_masuk', 'DESC')
            ->get()->result();
    }

    public function getAllwithDetail($where = [], $all = true)
    {
        $query = $this->db->select("$this->table.*, pegawai.nama_pegawai, jabatan.nama_jabatan")
            ->from($this->table)
            ->join("pegawai", "$this->table.kode_pegawai = pegawai.kode_pegawai")
            ->join("jabatan", "pegawai.kode_jabatan = jabatan.kode_jabatan");

        if ($where !== null) {
            $query->where($where);
        }

        $query->order_by('tanggal', 'DESC')
            ->order_by('jam_masuk', 'DESC');

        if($all !== true) {
            return $query->get()->row();
        }

        return $query->get()->result();
    }

    private function _get_datatables_query()
    {
        $this->getTodayAttendance();
    }

    public function get_datatables()
    {
        $query = $this->_get_datatables_query();
        if ($_POST['length'] !== -1) {
            $query = $this->db->select("$this->table.*, pegawai.nama_pegawai")
                ->from($this->table)
                ->join("pegawai", "$this->table.kode_pegawai = pegawai.kode_pegawai")
                ->where("tanggal", date('Y-m-d'))
                ->order_by('tanggal', 'DESC')
                ->order_by('jam_masuk', 'DESC')
                ->limit($_POST['length'], $_POST['start']);

            return $query->get()->result();
        }
        return $query;
    }

    public function count_filtered()
    {
        return count((array) $this->_get_datatables_query());
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}

/* End of file .php */