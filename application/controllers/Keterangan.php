<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keterangan extends CI_Controller
{
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
            'title' => 'Data Keterangan',
            'keterangan' => $this->Presensi->getAllwithDetail(),
            'no' => 2
        ];
        $this->main_lib->getTemplate('keterangan/index', $data);
    }

    public function detail($keterangan = null)
    {
        if($keterangan === null) {
            redirect(base_url('errorpage'));
        }
        
        $keterangan = $this->Presensi->getAllwithDetail(['id_presensi' => $id_keterangan], false);

        if($kehadiran === null) {
            redirect(base_url('errorpage'));
        }

        $data = [
            'title' => 'Detail Keterangan',
            'keterangan' => $keterangan

        ];
        $this->main_lib->getTemplate("keterangan/detail", $data);
    }

    public function delete ($keterangan)
    {
       if (isset($_POST['_method']) && $_POST ['_method'] === "DELETE"){
        $data_id = $this->main_lib->getPost('data_id');
        $data_type = $this->main_lib->getPost('data_type');

        if ($data_id === $id_keterangan && $data_type === 'keterangan') {
            $delete = $this->Presensi->delete(['id_presensi' => $data_id]);
            if ($delete) {
                $messages = [
                    'type' => 'success',
                    'text' => 'Data keterangan berhasil dihapus!',
                ];
            } else {
                $messages = [
                    'type' => 'error',
                    'text' => 'Gagal menghapus data keterangan!'
                ];
            }
            $this->session->set_flashdata('message', $messages);
                redirect(base_url('keterangan'), 'refresh');
            } else {
                $messages = [
                    'type' => 'error',
                    'text' => 'Gagal menghapus data!',
                ];
                $this->session->set_flashdata('message', $messages);
                redirect(base_url('keterangan'), 'refresh');
            }
        } else {
            redirect('dashboard');
        }
    }
}
/* End of file Keterangan.php */
/* Location: ./application/controllers/Keterangan.php */