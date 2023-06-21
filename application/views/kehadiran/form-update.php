<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pegawai</h1>
             <?php echo showBreadCrumb() ?>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tambah Pegawai</h2>
            <p class="section-lead">
                Silahkan isi form di bawah untuk menambahkan data pegawai baru.
            </p>

            <form action="<?php echo base_url('pegawai/edit/' . $pegawai->id_pegawai); ?>" method="post">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                         <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputnama_rekening3" class="col-sm-3 col-form-label">Kode Pegawai</label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="kode_pegawai" value="<?php echo $pegawai->kode_pegawai; ?>" readonly class="form-control" placeholder="Kode Pegawai" autocomplete="off">
                                        <?php echo form_error('kode_pegawai'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputnama_rekening3" class="col-sm-3 col-form-label">Nama Pegawai</label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="nama_pegawai" value="<?php echo $pegawai->nama_pegawai; ?>" class="form-control" placeholder="Nama Pegawai" autocomplete="off">
                                        <?php echo form_error('nama_pegawai'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputnama_rekening3" class="col-sm-3 col-form-label">Jabatan</label>
                                    <div class="col-sm-9">
                                        <select name="kode_jabatan" required class="form-control">
                                            <option selected disabled>-- Pilih Jabatan --</option>
                                            <?php foreach ($jabtan as $j): ?>
                                                <option <?= ($j->kode_jabatan == $pegawai->kode_jabatan) ? 'selected' : ''; ?> value="<?= $j->kode_jabatan; ?>"><?= $j->nama_jabatan; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <?php echo form_error('kode_jabatan'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputnama_rekening3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        <select name="jk" required class="form-control">
                                            <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                            <option <?= ($pegawai->jk == 'L') ? 'selected' : ''; ?> value="L">Laki-Laki</option>
                                            <option <?= ($pegawai->jk == 'P') ? 'selected' : ''; ?> value="P">Perempuan</option>
                                        </select>
                                        <?php echo form_error('jk'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                         <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Telpon</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" value="<?php echo $pegawai->telpon; ?>" name="telpon" id="inputPassword3" placeholder="Telpon">
                                        <?php echo form_error('telpon'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea name="alamat" required cols="30" rows="3" class="form-control" placeholder="Alamat"><?php echo $pegawai->alamat; ?></textarea>
                                        <?php echo form_error('alamat'); ?>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button name="update" class="btn btn-primary mr-1" type="submit">Simpan Perubahan</button>
                                    <a href="<?= base_url('pegawai') ?>" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>