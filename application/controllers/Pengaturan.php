<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();

    	if(!isAuthenticated()) {
    	    redirect(base_url('auth'));
        }
    }

	public function index()
	{
		$data = [
			'title' => 'Pengaturan',
			'pengaturan' => $this->Pengaturan->first()
		];

		if(isset($_POST['submit'])) {
			$this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'trim|required');
			$this->form_validation->set_rules('jam_pulang', 'Jam Pulang', 'trim|required');
			$this->form_validation->set_rules('toleransi_keterlambatan', 'Toleransi keterlambatan', 'trim|required');
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('pengaturan/form-pengaturan', $data);				
			} else {
				$jamMasuk = $this->main_lib->getPost('jam_masuk');
				$jamPulang = $this->main_lib->getPost('jam_pulang');
				$toleransiKeterlambatan = $this->main_lib->getPost('toleransi_keterlambatan');

				$data = [
					'jam_masuk' => $jamMasuk,
					'jam_pulang' => $jamPulang,
                    'toleransi_keterlambatan' => $toleransiKeterlambatan,
				];

				$update = $this->Pengaturan->updateSetting($data);
                if ($update) {
                    $messages = [
                        'type' => 'success',
                        'text' => 'Pengaturan berhasil diperbarui!',
                    ];
                } else {
                    $messages = [
                        'type' => 'error',
                        'text' => 'Gagal memperbarui pengaturan'
                    ];
                }

                $this->session->set_flashdata('message', $messages);
                redirect(base_url('pengaturan'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate('pengaturan/form-pengaturan', $data);
		}
	}

}

/* End of file Pengaturan.php */
/* Location: ./application/controllers/Pengaturan.php */