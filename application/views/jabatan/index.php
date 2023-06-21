<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Jabatan</h1>
             <?php echo showBreadCrumb() ?>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                Daftar Jabatan
                <a href="<?php echo base_url('jabatan/create'); ?>" class="btn btn-primary btn-icon icon-left float-right">
                    <i class="fa fa-plus"></i>
                    Tambah Jabatan
                </a>
            </h2>
            <p class="section-lead">Daftar Jabatan</p>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                     <div class="card card-primary">
                        <div class="card-body">
                            <table id="data-table" class="table table-striped table-md table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Jabatan</th>
                                        <th>Nama Jabatan</th>
                                        <th>Keterangan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (count($jabatans) > 0): ?>
                                        <?php foreach ($jabatans as $jabatan): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $jabatan->kode_jabatan; ?></td>
                                                <td><?php echo $jabatan->nama_jabatan; ?></td>
                                                <td><?php echo $jabatan->keterangan; ?></td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url('jabatan/edit/' . $jabatan->id_jabatan); ?>" class="btn btn-light">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-light" onclick="showConfirmDelete('jabatan', <?php echo $jabatan->id_jabatan; ?>)">
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