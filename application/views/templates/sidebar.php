<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);

$dashboard = "";
$data_master = "";
    $jabatan = "";
    $pegawai = "";
    $kehadiran = "";

$laporan = "";

$data_pengaturan = "";
    $pengguna = "";
    $profilPerusahaan = "";
    $pengaturan = "";

if($uri1 === "" || $uri1 === 'dashboard') {
    $dashboard = "active";
} else if($uri1 === "pegawai") {
    $pegawai = "active";
} else if($uri1 === "jabatan") {
    $jabatan = "active";
} else if($uri1 === "kehadiran") {
    $kehadiran = "active";
} else if($uri1 === "pengguna") {
    $pengguna = "active";
} else if($uri1 === "laporan") {
    $laporan = "active";
} else if($uri1 === "profil" || $uri1 === "profil-perusahaan") {
    $profilPerusahaan = "active";
}

$profil = $this->Profil_perusahaan->first();
$namaInstitusi = "CV HANAFI ID";

if($profil !== null) {
    $namaInstitusi = $profil->nama_institusi;
}

?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('dashboard') ?>"><?php echo $namaInstitusi; ?></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('dashboard') ?>">APP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?= $dashboard ?>"><a href="<?= base_url('dashboard') ?>" class="nav-link">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span></a>
            </li>
            <li class="menu-header">Data Master</li>
            <li class="<?= $jabatan ?>">
                <a href="<?= base_url('jabatan') ?>" class="nav-link">
                    <i class="fas fa-briefcase"></i>
                    <span>Data Jabatan</span>
                </a>
            </li>
            <li class="<?= $pegawai ?>">
                <a href="<?= base_url('pegawai') ?>" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Data Karyawan</span>
                </a>
            </li>
            <li class="<?= $kehadiran ?>">
                <a href="<?= base_url('kehadiran') ?>" class="nav-link">
                    <i class="fas fa-fire"></i>
                    <span>Data Kehadiran</span>
                </a>
            </li>
            <li class="<?= $kehadiran?>">
                <a href="<?= base_url('keterangan') ?>" class="nav-link">
                    <i class="fa-solid fa-book"></i>
                    <span>Data Keterangan</span>
                </a>
            </li>
            <li class="menu-header">Laporan</li>
            <li class="<?= $laporan ?>"><a href="<?= base_url('laporan') ?>" class="nav-link">
                <i class="fas fa-print"></i>
                <span>Laporan Kehadiran</span></a>
            </li>
            <li class="menu-header">Pengaturan</li>
            <li class="dropdown <?= $uri1 === 'user' ? 'active' : '' ?>">
                <a href="<?= base_url('user') ?>" class="nav-link"><i class="fas fa-user-alt"></i><span>Manajemen Pengguna</span></a>
            </li>
            <li class="dropdown <?= $uri1 === 'profil-perusahaan' ? 'active' : '' ?>">
                <a href="<?= base_url('profil-perusahaan') ?>" class="nav-link"><i class="fas fa-building"></i><span>Profil Perusahaan</span></a>
            </li>
            <li class="dropdown <?= $uri1 === 'pengaturan' ? 'active' : '' ?>">
                <a href="<?= base_url('pengaturan') ?>" class="nav-link"><i class="fas fa-cogs"></i><span>Pengaturan</span></a>
            </li>
        </ul>


        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" onclick="showConfirmLogout()" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-power-off"></i> Logout
            </a>
        </div>
    </aside>
</div>
