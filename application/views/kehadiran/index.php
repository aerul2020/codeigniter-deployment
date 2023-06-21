<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Kehadiran</h1>
             <?php echo showBreadCrumb() ?>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                Daftar Presensi Karyawan
            </h2>
            <p class="section-lead">Daftar hadir Karyawan</p>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                     <div class="card card-primary">
                        <div class="card-body">
                            <table id="data-table" class="table table-striped table-md table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>Suhu</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (count($kehadiran) > 0): ?>
                                    <?php foreach ($kehadiran as $k): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $k->nama_pegawai; ?></td>
                                            <td><?php echo $k->nama_jabatan; ?></td>
                                            <td><?php echo IDdateFormat($k->tanggal); ?></td>
                                            <td><?php echo $k->jam_masuk; ?></td>
                                            <td><?php echo $k->jam_pulang; ?></td>
                                            <td><?php echo $k->suhu; ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url('kehadiran/detail/' . $k->id_presensi); ?>" class="btn btn-light">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                                <a href="#" class="btn btn-light" onclick="showConfirmDelete('kehadiran', <?php echo $k->id_presensi; ?>)">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center text-info font-weight-bold" colspan="6">
                                            Tidak ada data.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>