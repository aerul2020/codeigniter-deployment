<?php

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') or exit('No direct script access allowed');

class ExportExcel
{
	private $spreadSheet = null;
	private $activeSheet = null;
	private $indexCell = 11;

	public $data = array();

	public function setSpreadsheet($spreadsheet)
	{
		$this->spreadSheet = $spreadsheet;
		$this->activeSheet = $this->spreadSheet->getActiveSheet();
	}

	public function setData(array $data)
    {
        if($data === null || count($data) === 0) {
            die('Please provide data to export the presence report.');
        }

        $this->data = $data;
    }
}
