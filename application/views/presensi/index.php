<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $title; ?> &mdash; <?= ($profil !== null) ? $profil->nama_institusi : 'CV HANAFI ID' ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/presensi.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>
<body class="layout-3" onload="getTodayAttendance()">
<div id="app" style="background: #0f253c;">
    <div class="main-wrapper container">
        <nav class="navbar navbar-expand-lg bg-primary main-navbar">
            <div class="container">
                <a href="<?php echo base_url(); ?>" class="navbar-brand sidebar-gone-hide">
                    <?= ($profil !== null) ? $profil->nama_institusi : 'CV HANAFI ID' ?>
                </a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="<?= base_url('auth') ?>" class="nav-link nav-link-lg nav-link-user font-weight-bold">Login Administrator!</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main-content" style="padding-top: 120px;">
            <section class="section">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                             <div class="card card-success" id="preview-box">
                                <div class="card-header">
                                    <h4>Kotak Pratinjau Kamera</h4>
                                </div>
                                <div class="card-body" id="target-video">
                                    <video autoplay muted id="my-video"></video>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6" id="attendance-list-wrapper">
                             <div class="card card-primary">
                                <div class="card-header">
                                    <h4 class="card-title">Daftar Hadir</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="attendance-list" data-page-length="5" class="table table-bordered table-md">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Jam Masuk</th>
                                                    <th>Jam Pulang</th>
                                                    <th>Suhu</th>
                                                </tr>
                                            </thead>
                                            <tbody id="target-list"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; <?php echo date('Y') ?>
                <div class="bullet"></div>
                Developed By <a target="_blank" rel="noreferrer">Amilia</a>
            </div>
            <div class="footer-right">
            </div>
        </footer>
    </div>
</div>

<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Responsive-2.2.1/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Responsive-2.2.1/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/faceapi/face-api.js"></script>
<script>
    const BASE_URL = "<?php echo base_url(); ?>";
    const FACES_MODELS = <?= json_encode($models); ?>;
    const DAFTAR_PEGAWAI = <?= json_encode($daftar_pegawai) ?>;
    const RECORD_ATTENDANCE_ROUTE = `${BASE_URL}/catat-presensi`;
    const LIST_ATTENDANCE_ROUTE = `${BASE_URL}/daftar-kehadiran`;

</script>
<script src="<?php echo base_url(); ?>assets/js/my-app.js"></script>
</body>
</html>
