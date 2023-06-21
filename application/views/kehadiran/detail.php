<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Kehadiran</h1>
            <?php echo showBreadCrumb(); ?>
        </div>

        <div class="section-body">
            <h2 class="section-title">Profil Perusahaan</h2>
            <p class="section-lead">
                Silahkan isi form di bawah untuk mengubah profil perusahaan.
            </p>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Data Karyawan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                <tr>
                                    <td width="240px;">Nama Karyawan</td>
                                    <td>:</td>
                                    <td><?php echo $kehadiran->nama_pegawai ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Kode Karyawan</td>
                                    <td>:</td>
                                    <td><?php echo $kehadiran->kode_pegawai ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Jabatan</td>
                                    <td>:</td>
                                    <td><?php echo $kehadiran->nama_jabatan ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Tanggal</td>
                                    <td>:</td>
                                    <td><?php echo IDdateFormat($kehadiran->tanggal) ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Jam Masuk</td>
                                    <td>:</td>
                                    <td><?php echo $kehadiran->jam_masuk ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Jam Pulang</td>
                                    <td>:</td>
                                    <td><?php echo $kehadiran->jam_pulang ?></td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="<?php echo base_url('kehadiran') ?>" class="btn btn-light">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>