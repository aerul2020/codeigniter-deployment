<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Kehadiran</h1>
             <?php echo showBreadCrumb() ?>
        </div>

        <div class="section-body">
            <h2 class="section-title">Cetak Laporan Kehadiran</h2>
            <p class="section-lead">
                Silahkan isi form di bawah untuk mengekspor laporan kehadiran.
            </p>

            <form action="<?php echo base_url('laporan/cetak'); ?>" method="post" target="_blank">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-6">
                         <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="pegawai" class="col-sm-3 col-form-label">Pegawai </label>
                                    <div class="col-sm-9">
                                        <select name="pegawai" required class="form-control">
                                            <option value="ALL" selected>-- Semua Pegawai --</option>
                                            <?php foreach ($pegawai as $p): ?>
                                                <option value="<?= $p->kode_pegawai ?>"><?= $p->nama_pegawai . " - " . $p->nama_jabatan; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <?php echo form_error('kode_pegawai'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_awal" class="col-sm-3 col-form-label">Tanggal Awal</label>
                                    <div class="col-sm-9">
                                        <input type="date" required name="tanggal_awal" value="<?php echo date('Y-m-d'); ?>" class="form-control" autocomplete="off">
                                        <?php echo form_error('tanggal_awal'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_akhir" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                                    <div class="col-sm-9">
                                        <input type="date" required name="tanggal_akhir" value="<?php echo date('Y-m-d'); ?>" class="form-control" autocomplete="off">
                                        <?php echo form_error('tanggal_akhir'); ?>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button name="submit" class="btn btn-primary mr-1" type="submit">Cetak Laporan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>