<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_model extends Main_model {

	protected $table = 'pengaturan';

	public function updateSetting($data = [])
	{
		$pengaturan = $this->first();
		if(!$pengaturan) {
			$update = $this->insert($data);
		} else {
			$update = $this->update($data, ['id_pengaturan' => 1]);
		}

		return $update;
	}

}

/* End of file Pengaturan_model.php */
/* Location: ./application/models/Pengaturan_model.php */