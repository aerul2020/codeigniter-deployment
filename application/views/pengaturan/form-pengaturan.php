<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan</h1>
            <?php echo showBreadCrumb() ?>
        </div>

        <div class="section-body">
            <h2 class="section-title">Pengaturan</h2>
            <p class="section-lead">
                Silahkan isi form di bawah untuk memperbarui pengaturan.
            </p>

            <form action="<?php echo base_url('pengaturan'); ?>" method="post">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Form Pengaturan
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="jam-masuk" class="col-sm-3 col-form-label">Jam Masuk</label>
                                    <div class="col-sm-9">
                                        <input type="time" required name="jam_masuk"
                                               value="<?php echo ($pengaturan !== null) ? $pengaturan->jam_masuk : ""; ?>"
                                               class="form-control" autocomplete="off">
                                        <?php echo form_error('jam_masuk'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jam-pulang" class="col-sm-3 col-form-label">Jam Pulang</label>
                                    <div class="col-sm-9">
                                        <input type="time" required name="jam_pulang"
                                               value="<?php echo ($pengaturan !== null) ? $pengaturan->jam_pulang : ""; ?>"
                                               class="form-control" autocomplete="off">
                                        <?php echo form_error('jam_pulang'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jam-pulang" class="col-sm-3 col-form-label">Toleransi
                                        keterlambatan</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="number" required name="toleransi_keterlambatan"
                                                   value="<?php echo ($pengaturan !== null) ? $pengaturan->toleransi_keterlambatan : ""; ?>"
                                                   class="form-control" autocomplete="off">
                                            <div class="input-group-append">
                                                <div class="input-group-text">Menit</div>
                                            </div>
                                        </div>
                                        <?php echo form_error('toleransi_keterlambatan'); ?>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button name="submit" class="btn btn-primary mr-1" type="submit">Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title">Informasi</h4>
                            </div>
                            <div class="card-body">
                                <div id="accordion">
                                    <div class="accordion">
                                        <div class="accordion-header" role="button" data-toggle="collapse"
                                             data-target="#panel-body-1" aria-expanded="true">
                                            <h4>Jam Masuk &amp; Jam Keluar</h4>
                                        </div>
                                        <div class="accordion-body collapse show" id="panel-body-1"
                                             data-parent="#accordion">
                                            <p class="mb-0">
                                                <b>Jam Masuk :</b> 08:00 WIb <br>
                                                <b>Jam Keluar :</b> 17:00 WIb<br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="accordion">
                                        <div class="accordion-header" role="button" data-toggle="collapse"
                                             aria-expanded="false" data-target="#panel-body-2">
                                            <h4>Toleransi Keterlambatan</h4>
                                        </div>
                                        <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
                                            <p class="mb-0">
                                                Toleransi keterlambatan adalah banyaknya waktu yang masih dimaklumi ketika karyawan datang melebihi waktu masuk kantor.
                                                Sebagai contoh, jika Anda mengatur toleransi keterlambatan <b>15 menit</b> dan waktu masuk kantor adalah pukul <b>7 pagi</b>,
                                                maka karyawan yang masuk pada rentang pukul <b>07.00 - 07.15</b> dianggap tidak datang terlambat. Apabila karyawan melakukan presensi <u><i>diatas</i></u> pukul <b>07.15</b> maka dianggap datang <u>terlambat</u>.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>