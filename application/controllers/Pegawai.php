<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller
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
            'title' => 'Data Pegawai',
            'pegawais' => $this->Pegawai->all(),
            'no' => 1
        ];
        $this->main_lib->getTemplate('pegawai/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pegawai',
            'kode_pegawai' => getAutoCode('pegawai', 'kode_pegawai', 'PEG'),
            'jabtan' => $this->Jabatan->all()
        ];

        if (isset($_POST['submit'])) {
            $rules = $this->_rules();
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->main_lib->getTemplate('pegawai/form-create', $data);
            } else {
                $pegawai_data = [
                    'kode_pegawai' => $this->main_lib->getPost('kode_pegawai'),
                    'nama_pegawai' => $this->main_lib->getPost('nama_pegawai'),
                    'kode_jabatan' => $this->main_lib->getPost('kode_jabatan'),
                    'alamat' => $this->main_lib->getPost('alamat'),
                    'jk' => $this->main_lib->getPost('jk'),
                    'telpon' => $this->main_lib->getPost('telpon'),
                ];

                $insert = $this->Pegawai->insert($pegawai_data);
                if ($insert) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data Pegawai berhasil ditambahkan!',
                    ];
                    
                    $id_pegawai = $this->db->insert_id();

                    $this->session->set_flashdata('message', $messages);
                    redirect(base_url('pegawai/capture/' . $id_pegawai), 'refresh');
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menambahkan data Pegawai baru!'
                    ];

                    $this->session->set_flashdata('message', $messages);
                    redirect(base_url('pegawai/create'), 'refresh');
                }

            }
        } else {
            $this->main_lib->getTemplate('pegawai/form-create', $data);
        }
    }

    public function edit($id_pegawai)
    {
        if (empty(trim($id_pegawai))) {
            redirect(base_url('pegawai'));
        }

        $pegawai = $this->Pegawai->findById(['id_pegawai' => $id_pegawai]);
        $data = [
            'title' => 'Edit Pegawai',
            'pegawai' => $pegawai,
            'jabtan' => $this->Jabatan->all()
        ];

        if (isset($_POST['update'])) {
            $rules = $this->_rules();
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->main_lib->getTemplate('pegawai/form-update', $data);
            } else {
                $pegawai_data = [
                    'kode_pegawai' => $this->main_lib->getPost('kode_pegawai'),
                    'nama_pegawai' => $this->main_lib->getPost('nama_pegawai'),
                    'kode_jabatan' => $this->main_lib->getPost('kode_jabatan'),
                    'alamat' => $this->main_lib->getPost('alamat'),
                    'jk' => $this->main_lib->getPost('jk'),
                    'telpon' => $this->main_lib->getPost('telpon'),
                ];

                $update = $this->Pegawai->update($pegawai_data, ['id_pegawai' => $id_pegawai]);
                if ($update) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data Pegawai berhasil disimpan!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menyimpan data Pegawai!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('pegawai'), 'refresh');
            }
        } else {
            $this->main_lib->getTemplate('pegawai/form-update', $data);
        }
    }

    public function delete($id_pegawai)
    {
        if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
            $data_id = $this->main_lib->getPost('data_id');
            $data_type = $this->main_lib->getPost('data_type');

            if ($data_id === $id_pegawai && $data_type === 'pegawai') {
                $delete = $this->Pegawai->delete(['id_pegawai' => $data_id]);
                if ($delete) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data Pegawai berhasil dihapus!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menghapus data Pegawai!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('pegawai'), 'refresh');
            } else {
                $messages = [
                    'type' => 'error',
                    'text' => 'Gagal menghapus data!',
                ];
                $this->session->set_flashdata('message', $messages);
                redirect(base_url('pegawai'), 'refresh');
            }
        } else {
            redirect('dashboard');
        }
    }

    public function _rules()
    {
        return [
            [
                'field' => 'nama_pegawai',
                'name' => 'Nama pegawai',
                'rules' => 'required'
            ],
            [
                'field' => 'kode_pegawai',
                'name' => 'Kode pegawai',
                'rules' => 'required'
            ],
            [
                'field' => 'kode_jabatan',
                'name' => 'kode_jabatan',
                'rules' => 'required'
            ],
            [
                'field' => 'alamat',
                'name' => 'alamat',
                'rules' => 'required'
            ],
            [
                'field' => 'telpon',
                'name' => 'telpon',
                'rules' => 'required'
            ]
        ];
    }

    public function capture($id_pegawai)
    {
        if (empty(trim($id_pegawai))) {
            redirect(base_url('pegawai'));
        }

        $pegawai = $this->Pegawai->findById(['id_pegawai' => $id_pegawai]);
        $data = [
            'title' => 'Ambil wajah pegawai',
            'pegawai' => $pegawai
        ];

        if (isset($_POST['upload'])) {
            $this->form_validation->set_rules('kode_pegawai', 'Kode Pegawai', 'trim|required');
            $this->form_validation->set_rules('data', 'Kontur wajah', 'required');
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->main_lib->getTemplate("pegawai/form-capture", $data);
            } else {
                $faceDesciptor = $this->main_lib->getPost('data');
                
                $setFaceDescriptor = $this->Pegawai->setFaceDescriptor($id_pegawai, $faceDesciptor);

                if ($setFaceDescriptor) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data kontur wajah Pegawai berhasil disimpan!',
                    ];

                    $this->session->set_flashdata('message', $messages);
                    redirect(base_url('pegawai/test-recognize/' . $id_pegawai), 'refresh');
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menyimpan data kontur wajah Pegawai!'
                    ];

                    $this->session->set_flashdata('message', $messages);
                    $id_pegawai = $this->db->insert_id();
                    redirect(base_url('pegawai/capture/' . $id_pegawai), 'refresh');
                }
            }
        } else {
            $this->main_lib->getTemplate("pegawai/form-capture", $data);
        }
    }

    public function test_recognize($id_pegawai)
    {
        if (empty(trim($id_pegawai))) {
            redirect(base_url('pegawai'));
        }

        $pegawai = $this->Pegawai->findById(['id_pegawai' => $id_pegawai]);
        $all_pegawai = $this->Pegawai->all();
        
        $daftar_pegawai = [];
        $models = [];

        foreach ($all_pegawai as $p) {
            $daftar_pegawai[$p->kode_pegawai] = $p->nama_pegawai;
            if($p->kontur_wajah !== '' && $p->kontur_wajah !== null) {
                $models[] = $p->kontur_wajah;
            }
        }

        $data = [
            'title' => 'Ambil wajah pegawai',
            'pegawai' => $pegawai,
            'daftar_pegawai' => $daftar_pegawai,
            'models' => $models
        ];        

        $this->main_lib->getTemplate("pegawai/test-recognize", $data);

    }
}

/* End of file Pegawai.php */
