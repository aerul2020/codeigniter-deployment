<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Get extends CI_Controller
{
    $data=[
        "id_presensi" => $this->input->post('name'),
        "suhu" => $this->input->post('temperature')
    ]
    
    $this->db->insert('presensi', $data);
}