<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller
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
            'title' => 'Data Jabatan',
            'jabatans' => $this->Jabatan->all(),

            'no' => 1
        ];
        $this->main_lib->getTemplate('jabatan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jabatan',
            'kode_jabatan' => getAutoCode('jabatan', 'kode_jabatan', 'JAB'),
        ];

        if (isset($_POST['submit'])) {
            $rules = $this->_rules();
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->main_lib->getTemplate('jabatan/form-create', $data);
            } else {
                $jabatan_data = [
                    'nama_jabatan' => $this->main_lib->getPost('nama_jabatan'),
                    'kode_jabatan' => $this->main_lib->getPost('kode_jabatan'),
                    'keterangan' => $this->main_lib->getPost('keterangan'),
                ];

                $insert = $this->Jabatan->insert($jabatan_data);
                if ($insert) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data Jabatan berhasil ditambahkan!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menambahkan data Jabatan baru!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('jabatan'), 'refresh');
            }
        } else {
            $this->main_lib->getTemplate('jabatan/form-create', $data);
        }
    }

    public function edit($id_jabatan)
    {
        if (empty(trim($id_jabatan))) {
            redirect(base_url('jabatan'));
        }

        $jabatan = $this->Jabatan->findById(['id_jabatan' => $id_jabatan]);
        $data = [
            'title' => 'Edit Jabatan',
            'jabatan' => $jabatan,
        ];

        if (isset($_POST['update'])) {
            $rules = $this->_rules();
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->main_lib->getTemplate('jabatan/form-update', $data);
            } else {
                $jabatan_data = [
                    'nama_jabatan' => $this->main_lib->getPost('nama_jabatan'),
                    'keterangan' => $this->main_lib->getPost('keterangan'),
                ];

                $update = $this->Jabatan->update($jabatan_data, ['id_jabatan' => $id_jabatan]);
                if ($update) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data Jabatan berhasil disimpan!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menyimpan data Jabatan!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('jabatan'), 'refresh');
            }
        } else {
            $this->main_lib->getTemplate('jabatan/form-update', $data);
        }
    }

    public function delete($id_jabatan)
    {
        if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
            $data_id = $this->main_lib->getPost('data_id');
            $data_type = $this->main_lib->getPost('data_type');

            if ($data_id === $id_jabatan && $data_type === 'jabatan') {
                $delete = $this->Jabatan->delete(['id_jabatan' => $data_id]);
                if ($delete) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data Jabatan berhasil dihapus!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menghapus data Jabatan!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('jabatan'), 'refresh');
            } else {
                $messages = [
                    'type' => 'error',
                    'text' => 'Gagal menghapus data!',
                ];
                $this->session->set_flashdata('message', $messages);
                redirect(base_url('jabatan'), 'refresh');
            }
        } else {
            redirect('dashboard');
        }
    }

    public function _rules()
    {
        return [
            [
                'field' => 'nama_jabatan',
                'name' => 'Nama jabatan',
                'rules' => 'required'
            ],
            [
                'field' => 'kode_jabatan',
                'name' => 'Kode jabatan',
                'rules' => 'required'
            ],
        ];
    }
}

/* End of file Jabatan.php */
