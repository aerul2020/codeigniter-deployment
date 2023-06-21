<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi extends CI_Controller
{
    public function index()
    {
        $all_pegawai = $this->Pegawai->all();
        $profil_perusahaan = $this->Profil_perusahaan->first();
        $pengaturan = $this->Pengaturan->first();

        $daftar_pegawai = [];
        $models = [];

        foreach ($all_pegawai as $p) {
            $daftar_pegawai[$p->kode_pegawai] = $p->nama_pegawai;
            if ($p->kontur_wajah !== '' && $p->kontur_wajah !== null) {
                $models[] = $p->kontur_wajah;
            }
        }

        $data = [
            'title' => 'Halaman Presensi Pegawai',
            'daftar_pegawai' => $daftar_pegawai,
            'models' => $models,
            'profil' => $profil_perusahaan,
            'pengaturan' => $pengaturan
        ];

        $this->load->view('presensi/index', $data);
    }

    public function catat_presensi()
    {
        if ($this->input->is_ajax_request()) {
            $null_time = '00:00:00';

            $kode_pegawai = $this->main_lib->getPost('kode');
            $pegawai = $this->Pegawai->getByCode($kode_pegawai);

            if ($pegawai) {
                $tanggal = date('Y-m-d');
                $jam_masuk = date('H:i:s');
                $cek_presensi = $this->Presensi->checkTodayAttendance($kode_pegawai);

                $data = [
                    'kode_pegawai' => $kode_pegawai,
                    'tanggal' => $tanggal,
                    'jam_masuk' => $jam_masuk,
                    'jam_pulang' => $null_time,
                ];

                //Sudah absensi masuk
                if ($cek_presensi->num_rows() <= 0) {
                    $this->Presensi->insert($data);

                    $response = [
                        'status' => 'success',
                        'data' => $data
                    ];

                    echo json_encode($response);
                } else {
                    $data = ['jam_pulang' => $jam_masuk];

                    $presensi = $cek_presensi->row();
                    if ($presensi->jam_pulang === "00:00:00") {
                        $this->Presensi->update($data, ['id_presensi' => $presensi->id_presensi]);

                        $response = [
                            'status' => 'success',
                            'data' => $data
                        ];
                    } else {
                        $response = ['status' => 'success', 'data' => null];
                    }

                    echo json_encode($response);
                }
            }

        } else {
            echo json_encode([
                'message' => "Method doesn`t support!"
            ]);
        }
    }

    public function daftar_hadir()
    {
        if ($this->input->is_ajax_request()) {
            $kehadiran = $this->Presensi->get_datatables();
            $totalData = $this->Presensi->count_all();
            $filteredData = $this->Presensi->count_filtered();

            $response = [
                'draw' => $_POST['draw'],
                'recordsTotal' => count($kehadiran),
                'recordsFiltered' => $filteredData,
                'data' => $kehadiran,
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to process the request!'
            ];
        }

        echo json_encode($response);
    }
}

/* End of file Presensi.php */
