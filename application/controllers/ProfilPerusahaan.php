<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfilPerusahaan extends CI_Controller
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
        $profilPerusahaan = $this->Profil_perusahaan->first();
        $data = [
            'title' => 'Profil perusahaan',
            'profil' => $profilPerusahaan
        ];

        $this->main_lib->getTemplate("profil-perusahaan/form-profil", $data);
    }

    public function edit()
    {
        $profil_perusahaan = $this->Profil_perusahaan->first();
        $data = [
            'title' => 'Profil perusahaan',
            'profil' => $profil_perusahaan
        ];

        if (isset($_POST['update'])) {
            $rules = $this->_rules();
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->main_lib->getTemplate("profil-perusahaan/form-profil", $data);
            } else {
                $data_pengaturan = [
                    'nama_institusi' => $this->main_lib->getPost('nama_institusi'),
                    'telpon' => $this->main_lib->getPost('telpon'),
                    'email' => $this->main_lib->getPost('email'),
                    'alamat' => $this->main_lib->getPost('alamat')
                ];

                //Check pengaturan
                $check = $this->Profil_perusahaan->first();
                if ($check) {
                    $id_profil = $check->id_profil;
                    $insert = $this->Profil_perusahaan->update($data_pengaturan, ['id_profil' => $id_profil]);
                } else {
                    $insert = $this->Profil_perusahaan->insert($data_pengaturan);
                }

                if ($insert) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data perusahaan berhasil diperbarui',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal memperbarui data perusahaan!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('profil-perusahaan'), 'refresh');
            }
        } else {
            $this->main_lib->getTemplate("profil-perusahaan/form-profil", $data);
        }
    }

    public function upload()
    {
        if (isset($_POST['upload'])) {
            $config = [
                'upload_path' => './uploads/',
                'allowed_types' => 'jpeg|jpg|png',
                'max_size' => '2048',
                'max_width' => '512',
                'max_height' => '512',
                'file_ext_tolower' => TRUE,
                'encrypt_name' => TRUE
            ];

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('logo')) {
                $error = $this->upload->display_errors();
                $error = str_replace(" ", "-", $error);
                $error = strip_tags($error);
                redirect(base_url('profil-perusahaan') . '?show_modal=true&errmsg=' . $error);
            } else {
                $upload_data = $this->upload->data();
                $file_name = 'uploads/' . $upload_data['file_name'];

                //Check pengaturan
                $check = $this->Profil_perusahaan->first();
                if ($check) {
                    $id_profil = $check->id_profil;
                    $data_pengaturan = [
                        'logo' => $file_name
                    ];

                    if (file_exists(FCPATH . $check->logo)) {
                        unlink(FCPATH . $check->logo);
                    }
                    $insert = $this->Profil_perusahaan->update($data_pengaturan, ['id_profil' => $id_profil]);
                } else {
                    $data_pengaturan = [
                        'nama_institusi' => '',
                        'telpon' => '0812',
                        'logo' => $file_name,
                        'email' => 'test@mail.com',
                        'alamat' => ''
                    ];

                    $insert = $this->Profil_perusahaan->insert($data_pengaturan);
                }

                if ($insert) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Logo perusahaan berhasil diperbarui',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal memperbarui logo perusahaan!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('profil-perusahaan'), 'refresh');
            }

        } else {
            redirect(base_url('profil-perusahaan') . '?show_modal=true');
        }
    }

    private function _rules()
    {
        return [
            [
                'field' => 'nama_institusi',
                'label' => 'Nama institusi',
                'rules' => 'required'
            ],
            [
                'field' => 'telpon',
                'label' => 'Telpon',
                'rules' => 'required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required'
            ]
        ];
    }

}