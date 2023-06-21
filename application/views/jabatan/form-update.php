<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Jabatan</h1>
             <?php echo showBreadCrumb() ?>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Jabatan</h2>
            <p class="section-lead">
                Silahkan isi form di bawah untuk memperbarui data jabatan.
            </p>

            <form action="<?php echo base_url('jabatan/edit/' . $jabatan->id_jabatan); ?>" method="post">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-8">
                         <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputnama_rekening3" class="col-sm-3 col-form-label">Kode Jabatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" required readonly name="kode_jabatan" value="<?php echo $jabatan->kode_jabatan; ?>" class="form-control" placeholder="Kode Jabatan" autocomplete="off">
                                        <?php echo form_error('kode_jabatan'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputnama_rekening3" class="col-sm-3 col-form-label">Nama Jabatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="nama_jabatan" value="<?php echo $jabatan->nama_jabatan; ?>" class="form-control" placeholder="Nama Jabatan" autocomplete="off">
                                        <?php echo form_error('nama_jabatan'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Keterangan (Opsional)</label>
                                    <div class="col-sm-9">
                                        <textarea name="keterangan" cols="30" rows="3" class="form-control" placeholder="Keterangan"><?php echo $jabatan->keterangan; ?></textarea>
                                        <?php echo form_error('keterangan'); ?>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button name="update" class="btn btn-primary mr-1" type="submit">Simpan Perubahan
                                    </button>
                                    <a href="<?= base_url('jabatan') ?>" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>