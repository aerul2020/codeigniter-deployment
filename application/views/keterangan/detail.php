<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Keterangan</h1>
            <?php echo showBreadCrumb(); ?>
        </div>

        <div class="section-body">
            <h2 class="section-title">Keterangan</h2>
            <p class="section-lead">
                Silahkan isi form di bawah untuk keterangan.
            </p>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Data Keterangan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                <tr>
                                    <td width="240px;">Nama Karyawan</td>
                                    <td>:</td>
                                    <td><?php echo $keterangan->nama_pegawai ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Jabatan</td>
                                    <td>:</td>
                                    <td><?php echo $keterangan->nama_jabatan ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Tanggal</td>
                                    <td>:</td>
                                    <td><?php echo IDdateFormat ($keterangan->tanggal) ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Keterangan</td>
                                    <td>:</td>
                                    <td><?php echo ($keterangan->keterangan) ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Alasan</td>
                                    <td>:</td>
                                    <td><?php echo $keterangan->Alasan ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Jam</td>
                                    <td>:</td>
                                    <td><?php echo $keterangan->jam_masuk ?></td>
                                </tr>
                                <tr>
                                    <td width="240px;">Foto</td>
                                    <td>:</td>
                                    <td><?php echo $keterangan->foto ?></td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="<?php echo base_url('keterangan') ?>" class="btn btn-light">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>