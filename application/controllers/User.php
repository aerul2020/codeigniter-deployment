<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
            'title' => 'Data Pengguna',
            'users' => $this->User->all(),
            'no' => 1
        ];
        $this->main_lib->getTemplate('user/index', $data);
    }

    public function create()
    {
        $list_user_levels = [
            'SUPER_USER',
            'ADMIN_TOKO',
            'ADMIN_KEUANGAN',
            'ADMIN_SUPPLIER'
        ];

        $data = [
            'title' => 'Tambah Pengguna',
            'user_levels' => $list_user_levels
        ];

        if (isset($_POST['submit'])) {
            $rules = $this->_rules('create');
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->main_lib->getTemplate('user/form-create', $data);
            } else {
                $user_data = [
                    'nama_lengkap' => $this->main_lib->getPost('nama_lengkap'),
                    'username' => $this->main_lib->getPost('username'),
                    'email' => $this->main_lib->getPost('email'),
                    'password' => password_hash($this->main_lib->getPost('password'), PASSWORD_DEFAULT),
                    'level' => $this->main_lib->getPost('level')
                ];

                $insert = $this->User->insert($user_data);
                if ($insert) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data pengguna berhasil ditambahkan!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menambahkan pengguna baru!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('user'), 'refresh');
            }
        } else {
            $this->main_lib->getTemplate('user/form-create', $data);
        }
    }

    public function edit($user_id)
    {
        if (empty(trim($user_id))) {
            redirect(base_url('user'));
        }

        $list_user_levels = [
            'SUPER_USER',
            'ADMIN_TOKO',
            'ADMIN_KEUANGAN',
            'ADMIN_SUPPLIER'
        ];
        $user = $this->User->findById(['id_pengguna' => $user_id]);
        $data = [
            'title' => 'Edit Pengguna',
            'user' => $user,
            'user_levels' => $list_user_levels
        ];

        if (isset($_POST['update'])) {
            $rules = $this->_rules('update');
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->main_lib->getTemplate('user/form-update', $data);
            } else {
                $user_data = [
                    'nama_lengkap' => $this->main_lib->getPost('nama_lengkap'),
                    'username' => $this->main_lib->getPost('username'),
                    'email' => $this->main_lib->getPost('email'),
                    'password' => password_hash($this->main_lib->getPost('password'), PASSWORD_DEFAULT),
                    'level' => $this->main_lib->getPost('level')
                ];

                $update = $this->User->update($user_data, ['id_pengguna' => $user_id]);
                if ($update) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data pengguna berhasil disimpan!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menyimpan data pengguna!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('user'), 'refresh');
            }
        } else {
            $this->main_lib->getTemplate('user/form-update', $data);
        }
    }

    public function delete($user_id)
    {
        if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
            $data_id = $this->main_lib->getPost('data_id');
            $data_type = $this->main_lib->getPost('data_type');

            if ($data_id === $user_id && $data_type === 'user') {
                $delete = $this->User->delete(['id_pengguna' => $data_id]);
                if ($delete) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Data pengguna berhasil dihapus!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal menghapus data pengguna!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('user'), 'refresh');
            } else {
                $messages = [
                    'type' => 'error',
                    'text' => 'Gagal menghapus data!',
                ];
                $this->session->set_flashdata('message', $messages);
                redirect(base_url('user'), 'refresh');
            }
        } else {
            redirect('dashboard');
        }
    }

    public function profile()
    {
        $id_pengguna = getUser('id_pengguna');

        $data = [
            'title' => 'Profil pengguna',
            'user' => $this->User->findById(['id_pengguna' => $id_pengguna]),
        ];
        if (isset($_POST['update'])) {
            $rules = $this->_rules('update');
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->main_lib->getTemplate('user/profile', $data);
            } else {
                $user_data = [
                    'nama_lengkap' => $this->main_lib->getPost('nama_lengkap'),
                    'username' => $this->main_lib->getPost('username'),
                    'email' => $this->main_lib->getPost('email'),
                    'level' => $this->main_lib->getPost('level')
                ];

                $update = $this->User->update($user_data, ['id_pengguna' => $id_pengguna]);
                if ($update) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Profil berhasil diperbarui!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal memperbarui profil!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('user/profile'), 'refresh');
            }
        } else {
            $this->main_lib->getTemplate("user/profile", $data);
        }
    }

    public function change_password()
    {
        $id_pengguna = getUser('id_pengguna');
        $user = $this->User->findById(['id_pengguna' => $id_pengguna]);
        $data = [
            'title' => 'Ubah password',
        ];

        if (isset($_POST['update'])) {
            $rules = $this->_rules('password');
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->main_lib->getTemplate('user/form-password', $data);
            } else {
                $new_password = $this->main_lib->getPost('new_password');
                $old_password = $this->main_lib->getPost('old_password');

                //Validate old password
                $validate = password_verify($old_password, $user->password);
                if ($validate) {
                    $update = $this->User->update([
                        'password' => password_hash($new_password, PASSWORD_DEFAULT)
                    ], [
                        'id_pengguna' => $id_pengguna
                    ]);
                    if ($update) {
                        $messages = [
                            'type' => 'success',
                            'text' => 'Password pengguna berhasil diperbarui!',
                        ];
                    } else {
                        $messages = [
                            'type' => 'error',
                            'text' => 'Gagal mengubah password pengguna!'
                        ];
                    }
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Password lama yang Anda masukan salah!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('user/change-password'), 'refresh');
            }
        } else {
            $this->main_lib->getTemplate("user/form-password", $data);
        }
    }

    public function change_picture()
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

            if (!$this->upload->do_upload('foto')) {
                $error = $this->upload->display_errors();
                $error = str_replace(" ", "-", $error);
                $error = strip_tags($error);
                redirect(base_url('user/profile') . '?show_modal=true&errmsg=' . $error);
            } else {
                $upload_data = $this->upload->data();
                $file_name = 'uploads/' . $upload_data['file_name'];

                //Get user
                $id_pengguna = getUser('id_pengguna');
                $user = $this->User->findById(['id_pengguna' => $id_pengguna]);

                //If there are foto
                if ($user->foto !== '' && file_exists(FCPATH . $user->foto)) {
                    //remove old foto
                    unlink(FCPATH . $user->foto);
                }

                $update = $this->User->update(['foto' => $file_name], ['id_pengguna' => $id_pengguna]);

                if ($update) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Foto profil pengguna berhasil diperbarui',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal memperbarui foto profil pengguna!'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('user/profile'), 'refresh');
            }

        } else {
            redirect(base_url('user/profile') . '?show_modal=true');
        }
    }

    public function _rules($type)
    {
        $rules = [
            [
                'field' => 'nama_lengkap',
                'label' => 'Nama Lengkap',
                'rules' => 'required|alpha_numeric_spaces'
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|is_unique[pengguna.username]|min_length[6]|max_length[30]'
            ],
            [
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required|is_unique[pengguna.email]|valid_email'
            ],
            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|min_length[6]'
            ],
            [
                'field' => 'confirm_password',
                'label' => 'confirm_password',
                'rules' => 'required|matches[password]|trim'
            ],
            [
                'field' => 'level',
                'label' => 'level',
                'rules' => 'required|trim'
            ],
        ];

        if ($type === "update") {
            $rules = [
                [
                    'field' => 'nama_lengkap',
                    'label' => 'Nama Lengkap',
                    'rules' => 'required|alpha_numeric_spaces'
                ],
                [
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required|min_length[6]|max_length[30]'
                ],
                [
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required|valid_email'
                ],
                [
                    'field' => 'level',
                    'label' => 'level',
                    'rules' => 'required|trim'
                ],
            ];
        }

        if ($type === "password") {
            //Rule when update password user
            $rules = [
                [
                    'field' => 'old_password',
                    'label' => 'Password lama',
                    'rules' => 'required|min_length[6]'
                ],
                [
                    'field' => 'new_password',
                    'label' => 'Password baru',
                    'rules' => 'required|min_length[6]'
                ],
                [
                    'field' => 'confirm_password',
                    'label' => 'Konfirmasi password',
                    'rules' => 'required|matches[new_password]|trim'
                ]
            ];
        }

        return $rules;
    }
}

/* End of file User.php */
