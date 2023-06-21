<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Karyawan</h1>
             <?php echo showBreadCrumb() ?>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                Daftar Karyawan
                <a href="<?php echo base_url('pegawai/create'); ?>" class="btn btn-primary btn-icon icon-left float-right">
                    <i class="fa fa-plus"></i>
                    Tambah Karyawan
                </a>
            </h2>
            <p class="section-lead">Daftar akun Karyawan</p>

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
                                    <th>L/P</th>
                                    <th>Telpon</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (count($pegawais) > 0): ?>
                                    <?php foreach ($pegawais as $pegawai): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $pegawai->nama_pegawai; ?></td>
                                            <td><?php echo $pegawai->nama_jabatan; ?></td>
                                            <td><?php echo $pegawai->jk; ?></td>
                                            <td><?php echo $pegawai->telpon; ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url('pegawai/edit/' . $pegawai->id_pegawai); ?>" class="btn btn-light">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-light" onclick="showConfirmDelete('pegawai', <?php echo $pegawai->id_pegawai; ?>)">
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