<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Keterangan</h1>
             <?php echo showBreadCrumb() ?>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                Daftar Presensi Karyawan
            </h2>
            <p class="section-lead">Daftar Keterangan Karyawan</p>

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
                                    <th>Keterangan</th>
                                    <th>Alasan</th>
                                    <th>Jam</th>
                                    <th>Foto</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (count($keterangan) > 0): ?>
                                    <?php foreach ($keterangan as $ke): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $ke->nama_pegawai; ?></td>
                                            <td><?php echo $ke->nama_jabatan; ?></td>
                                            <td><?php echo IDdateFormat($ke->tanggal); ?></td>
                                            <td><?php echo $ke->keterangan; ?></td>
                                            <td><?php echo $ke->alasan; ?></td>
                                            <td><?php echo $ke->jam; ?></td>
                                            <td><?php echo $ke->foto; ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url('dashboard8/index/' . $k->nama_pegawai); ?>" class="btn btn-light">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                                <a href="#" class="btn btn-light" onclick="showConfirmDelete('dashboard', <?php echo $k->nama_pegawai; ?>)">
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