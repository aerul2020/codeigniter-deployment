<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kehadiran extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if (!isAuthenticated()) {
            redirect(base_url('auth'));
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Data Jabatan',
            'kehadiran' => $this->Presensi->getAllwithDetail(),
            'no' => 1
        ];
        $this->main_lib->getTemplate('kehadiran/index', $data);
    }

    public function detail($id_kehadiran = null)
    {
        if($id_kehadiran === null) {
            redirect(base_url('errorpage'));
        }

        $kehadiran = $this->Presensi->getAllwithDetail(['id_presensi' => $id_kehadiran], false);

        if($kehadiran === null) {
            redirect(base_url('errorpage'));
        }

        $data = [
            'title' => 'Detail Kehadiran',
            'kehadiran' => $kehadiran,
            'profil' => $this->Profil_perusahaan->first(),
            'pengaturan' => $this->Pengaturan->first()
        
        ];

        $this->main_lib->getTemplate("kehadiran/detail", $data);
    }

    public function delete($id_kehadiran)
    {
        if (isset($_POST['_method']) && $_POST['_method'] === "DELETE") {
            $data_id = $this->main_lib->getPost('data_id');
            $data_type = $this->main_lib->getPost('data_type');

            if ($data_id === $id_kehadiran && $data_type === 'kehadiran') {
                $delete = $this->Presensi->delete(['id_presensi' => $data_id]);
                if ($delete) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data kehadiran berhasil dihapus!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menghapus data kehadiran!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('kehadiran'), 'refresh');
            } else {
                $messages = [
                    'type' => 'error',
                    'text' => 'Gagal menghapus data!',
                ];
                $this->session->set_flashdata('message', $messages);
                redirect(base_url('kehadiran'), 'refresh');
            }
        } else {
            redirect('dashboard');
        }
    }
}

/* End of file Kehadiran.php */
/* Location: ./application/controllers/Kehadiran.php */