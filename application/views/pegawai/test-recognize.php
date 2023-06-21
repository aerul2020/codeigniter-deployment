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
        height: 360px;
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
    .hidden{
        display: none;
        visibility: none;
    }
    tr td, tr th {
        border:1px solid #c0c0c0 !important;
        height: 36px !important;
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

            
            <div class="row">
                <div class="col-4 col-md-4 col-lg-4 col-xs-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Pratinjau Kamera</h4>
                        </div>
                        <div class="card-body" id="target-video">
                            <video width="340px" height="360px" autoplay muted id="my-video"></video>
                        </div>
                        <div class="card-footer">
                            <div class="row" id="start-testing-action">
                                <div class="col-sm-12 col-lg-12 col-xs-12">
                                    <button type="button" class="btn btn-block btn-primary" id="btn-test-recognize">Mulai Uji Coba Pengenalan Wajah</button>
                                </div>
                            </div>
                            <div class="row mt-3 hidden" id="end-testing-action">
                                <div class="col-sm-6 col-lg-6 col-xs-12">
                                    <a href="<?= base_url('pegawai/capture/' . $pegawai->id_pegawai) ?>" class="btn btn-block btn-secondary">Ambil Ulang</a>
                                </div>
                                <div class="col-sm-6 col-lg-6 col-xs-12">
                                    <a href="<?= base_url('pegawai') ?>" class="btn btn-block btn-success">Selesai</a>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 col-md-8 col-lg-8 col-xs-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h4>Tabel Hasil Prediksi Pengenalan Wajah</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-success">
                                        <th style="color: #fff;">No.</th>
                                        <th style="color: #fff;">Kode Pegawai</th>
                                        <th style="color: #fff;">Nama Pegawai</th>
                                        <th style="color: #fff;">Tingkat Akurasi (%)</th>
                                        <th style="color: #fff;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="result-recognize-rows"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="kode-pegawai" value="<?= $pegawai->kode_pegawai; ?>">
        <input type="hidden" id="nama-pegawai" value="<?= $pegawai->nama_pegawai; ?>">
    </section>
</div>
<script>
    const FACES_MODELS = <?= json_encode($models); ?>;
    const DAFTAR_PEGAWAI = <?= json_encode($daftar_pegawai) ?>;
</script>