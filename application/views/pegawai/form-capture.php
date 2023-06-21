<style>
    #canvas-layer {
        position: absolute;
        z-index: 2;
        margin: 0 auto;
    }

    video {
        position: absolute;
        z-index: 1;
    }

    #target-video {
        width: 100%;
        height: 420px;
    }

    @media (max-width: 767px) {
        .header-navbar .navbar-header .navbar-brand {
            padding: 0px;
        }
    }
    .card-body{
        border-top:1px solid #f0f0f0 !important;
        border-bottom: 1px solid #f0f0f0 !important;
    }
</style>
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

            <form action="<?php echo base_url('pegawai/capture/' . $pegawai->id_pegawai); ?>" method="post">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-6 offset-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Pratinjau Kamera</h4>
                            </div>
                            <div class="card-body" id="target-video">
                                <video width="500px" height="360px" autoplay muted id="my-video"></video>
                                <input type="hidden" name="data">
                                <input type="hidden" name="kode_pegawai" value="<?= $pegawai->kode_pegawai; ?>">
                                <?= form_error('data'); ?>
                                <?= form_error('kode_pegawai'); ?>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6 col-xs-12">
                                        <button type="button" class="btn btn-block btn-primary" id="btn-capture">Pindai Wajah</button>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 col-xs-12">
                                        <button type="submit" name="upload" class="btn btn-block btn-success" disabled id="btn-upload">Upload Data</button>
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