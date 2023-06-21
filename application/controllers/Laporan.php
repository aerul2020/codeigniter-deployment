<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Laporan extends CI_Controller {

	private $SPREADSHEET = 'SPREADSHEET',
			$PDF = 'PDF';

	public function __construct()
    {
        parent::__construct();
        if (!isAuthenticated()) {
            redirect(base_url('auth'));
        }
        $this->load->library('ExportExcel');
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan Kehadiran Pegawai',
            'pegawai' => $this->Pegawai->all(),
            'no' => 1
        ];
        $this->main_lib->getTemplate('laporan/form-laporan', $data);
    }

    public function cetak()
    {
    	if (isset($_POST['submit'])) {

    		$rules = $this->_rules();
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

            if ($this->form_validation->run() === FALSE) {
                $this->index();
            } else {
            	$pegawai = $this->main_lib->getPost('pegawai');
            	$tanggal_awal = $this->main_lib->getPost('tanggal_awal');
            	$tanggal_akhir = $this->main_lib->getPost('tanggal_akhir');
            	$format = $this->main_lib->getPost('format');

            	$kehadiran = $this->Laporan->getLaporan($tanggal_awal, $tanggal_akhir, $pegawai);
            	$profilPerusahaan = $this->Profil_perusahaan->first();
                $logo = $profilPerusahaan !== null && $profilPerusahaan->logo !== '' && file_exists(FCPATH . $profilPerusahaan->logo)
                    ? $profilPerusahaan->logo : '/assets/img/example-image-50.jpg';

            	$data = [
					'pegawai' => $pegawai,
					'tanggal_awal' => $tanggal_awal,
					'tanggal_akhir' => $tanggal_akhir,
					'kehadiran' => $kehadiran,
                    'profil' => $profilPerusahaan,
                    'LOGO' => $logo
            	];
                $this->generatePDF($data);
            }
    	} else {
    		redirect('laporan');
    	}
    }

    public function _rules()
    {
    	return [
    		[
    			'field' => 'pegawai',
    			'label' => 'Pegawai',
    			'rules' => 'required'
    		],
    		[
    			'field' => 'tanggal_awal',
    			'label' => 'Tanggal Awal',
    			'rules' => 'required'
    		],
    		[
    			'field' => 'tanggal_akhir',
    			'label' => 'Tanggal Akhir',
    			'rules' => 'required'
    		]
    	];
    }

    private function generatePDF($data = array())
    {
    	$html = $this->load->view('laporan/pdf-template', $data, true);

    	$dompdf = new Dompdf();
		$dompdf->loadHtml($html);

		//Options
    	$options = new Options();
		$options->setChroot(FCPATH);
		$options->setDefaultFont('courier');
		$dompdf->setOptions($options);

		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();

		$file_name = "LAPORAN KEHADIRAN";
		$dompdf->stream($file_name, ['Attachment' => FALSE]);
    }

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */