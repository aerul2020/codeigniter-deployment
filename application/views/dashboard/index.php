<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Admin</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $total_user; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pegawai</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $total_pegawai; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kehadiran Hari Ini</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $total_kehadiran_hari_ini ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        			
        <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Grafik Kehadiran Tahun <?php echo date('Y') ?></h4>
                    </div>
                    <div class="card-body">
                        <canvas id="attendance-chart" height="182"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Daftar Hadir Hari Ini</h4>
                    </div>
                    <div class="card-body">
                        <table id="data-table" class="table table-striped table-md table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Karyawan</th>
                                <th>Jabatan</th>
                                <th>Jam Masuk</th>
                                <th>Suhu</th>
                            </tr>
                            </thead>
                
                            <tbody>
                            <?php foreach ($kehadiran as $k): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $k->nama_pegawai; ?></td>
                                    <td><?php echo $k->nama_jabatan; ?></td>
                                    <td><?php echo $k->jam_masuk; ?></td>
                                    <td><?php echo $k->suhu; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>                   
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Keterangan</h4>
                    </div>
                            <div class="card-body">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Masukkan Keterangan Anda</h5>
                            </div>

                            <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data">
      	                    
                            <div class="form-group">
                            <label><b>Nama : </b></label><br>
                            <!-- <?=$kehadiran['nama_lengkap'];?>
                                <input type="text" class="form-control" hidden value="<?=$kehadiran->nama_lengkap['nama_lengkap'];?>" name="nama"> -->
                            </div> 

                            <div class="form-group">
                            <label><b>Jabatan : </b></label><br>
                            <!-- <?=$kehadiran['nama_lengkap'];?>
                                <input type="text" class="form-control" hidden value="<?=$kehadiran->nama_lengkap['nama_lengkap'];?>" name="nama"> -->
                            </div> 

                            <div class="form-group">
                            <label>Keterangan</label>
                            <select name="keterangan" class="form-control">
          	                    <option>Ijin</option>
          	                    <option>Sakit</option>
                            </select>
                            </div>

                            <div class="form-group">
                            <label>Alasan</label>
                                <textarea name="alasan" class="form-control"></textarea>
                            </div>
                            
                            <!-- Kodingan tanggal dan jam -->

                            <div class="form-group">
                            <label>Foto Bukti / Surat Keterangan</label>
                            <input type="file" class="form-control" name="foto">
                            </div>

                            <div class="modal-footer">
                            <button type="submit" name="simpan_ket" class="btn btn-primary">Save changes</button>
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
        </div>
    </section>
</div>