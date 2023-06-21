<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();

    	if(!isAuthenticated()) {
    	    redirect(base_url('auth'));
        }
    }

    public function index()
	{
	    $totalUser = $this->User->count();
	    $totalPegawai = $this->Pegawai->count();
	    $kehadiranHariIni = $this->Presensi->getTodayAttendance();
	    $totalKehadiranPerBulan = $this->Presensi->getCountPerMonth();

	    $totalKehadiran = [];
	    $indexBulan = 1;
        foreach (getMonth(null, 'long') as $month) {
            $total = 0;
            foreach ($totalKehadiranPerBulan as $kehadiran) {
                if((int) $kehadiran->index_bulan === $indexBulan) {
                    $total = $kehadiran->total;
                }
            }

            $totalKehadiran[] = (int) $total;
            $indexBulan++;
	    }

        $data = [
            'title' => 'Dashboard',
            'total_user' => $totalUser,
            'total_pegawai' => $totalPegawai,
            'total_kehadiran_hari_ini' => count($kehadiranHariIni),
            'kehadiran' => $kehadiranHariIni,
            'total_kehadiran_per_tahun' => $totalKehadiran,
            'no' => 1,
            
        ];

        $this->main_lib->getTemplate("dashboard/index", $data);
	}

    public function keterangan()
    {
        global $koneksi;
        $nama_pegawai = $_POST['nama'];
        $nama_jabatan = $_POST['jabatan'];
        $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];
        $alasan =  $_POST['alasan'];

        // Bulan dan tahun 
            // bulan
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];

            // convert bulan

            if ($bulan == 1) {
                $newBulan = "Januari";
            }else if($bulan == 2){
                $newBulan = "Februari";
            }else if($bulan == 3){
                $newBulan = "Maret";
            }else if($bulan == 4){
                $newBulan = "April";
            }else if($bulan == 5){
                $newBulan = "Mei";
                }else if($bulan == 6){
                    $newBulan = "Juni";
                }else if($bulan == 7){
                $newBulan = "Juli";
            }else if($bulan == 8){
                $newBulan = "Agustus";
            }else if($bulan == 9){
                $newBulan = "September";
            }else if($bulan == 10){
                $newBulan = "Oktober";
            }else if($bulan == 11){
                $newBulan = "November";
            }else if($bulan == 12){
                $newBulan = "Desember";
            }

            // end bulan dan tahun

	        $jam_masuk = $_POST['jam'];
		    $foto = $_FILES['foto']['name'];

            if ($foto!= "") {
                $allowed_ext = array('png','jpg');
                $x = explode(".", $foto);
                $ext = strtolower(end($x));
                $file_tmp = $_FILES['foto']['tmp_name'];
                $angka_acak = rand(1,999);
                $nama_file_baru = $angka_acak.'-'.$foto;
                if (in_array($ext, $allowed_ext)===true) {
                    move_uploaded_file($file_tmp, '../attendance-system/assets/img'.$nama_file_baru);
                    $select_ket = mysqli_query($koneksi, "SELECT * FROM presensi WHERE id_presensi = '$id_presensi' AND tanggal='$tanggal'");
                    $check_ket = mysqli_num_rows($select_ket);
                    if ($check_ket) {
                        echo '<script>alert("mohon maaf, anda sudah memberi keterangan tidak hadir untuk hari ini!")</script>';
                    }else{
                        $res = mysqli_query($koneksi, "INSERT INTO keterangan SET id_pegawai='$id_pegawai', nama='$nama', tanggal='$tanggal', bulan='$newBulan', tahun='$tahun', keterangan='$keterangan', alasan='$alasan', foto='$nama_file_baru', jam='$jam'");
                    }
                }
            }
            // ----------------------------------------FUNCTION URL, KEEP IT BELOW!!------------------------------------------------------------------
            function url()
            {
	            return $url = "//localhost/attendance-system/assets/";

            }
        }
    }

/* End of file Dashboard.php */