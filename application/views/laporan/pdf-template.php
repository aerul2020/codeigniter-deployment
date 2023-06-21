<html>
    <head>
        <title>Laporan Kehadiran</title>
    </head>
    <style type='text/css'>
        body{
            margin-right:20px;
            margin-left:20px;
            padding:0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .align-middle{
            text-align: center;
            vertical-align: middle;
        }
        #header {margin-bottom: 30px;border-bottom:2px solid #000;padding-bottom:10px;}
        .text-center{text-align: center;vertical-align:middle;}
        .logo > img{width: 8%;position: fixed;margin-left:30px;}
        .kop-text{
            display: block;
            text-align: center;
            margin-left:25px;
        }
        h1,h3, h3, h4,h5,h6,p{margin:0;}
        .sub-header{margin-bottom: 20px !important;}
        .sub-header{text-align:center;margin-bottom:20px;}
        .nama_kelas{text-align:left;}
        .box-ket{margin-top:10px;padding:10px;border:1px solid #000;width:280px;}
        .box-ket table tr td:nth-child(1){width:120px;}
        .box-ket table tr td:nth-child(2){width:40px;}
        .text-center{text-align:center;vertical-align:middle;}
        .font-weight-bold{font-weight:bold !important;}
        .table-center{width:100%;}
        #ttd{
            width:60%;
            margin-left:60%;
        }
        #ttd p{
            margin-top:10px;
            font-size:10pt;
        }
        #ttd img{
            margin-top:5px;
            width:50%;
            display:block;
            margin-right:80px;
        }
        .text-bold{font-weight: bold;}
        ol{padding-left: 1.3rem;margin-top:0;}
        .table-data{
        	width: 100%;
        	border:1px solid #333;
        	border-collapse: collapse;
        }
        .table-data tr th, .table-data tr td{
        	border:1px solid #333;
        	padding:5px;
        }
        .table-data tr th{
        	background: #3F59DC;
        	color: #fff;
        }
    </style>
    <body>
        <div id='header'>
            <div class='logo'>
                <img src='<?php echo $LOGO; ?>'>
            </div>
            <div class='kop-text'>
                <h1 style='font-size:21pt;'>
                    <?php echo ($profil !== null) ? $profil->nama_institusi : 'CV HANAFI ID' ?>
                </h1>
                <p style='font-size:12pt'>
                    <?php echo ($profil !== null) ? $profil->alamat : 'Jl. Raya Tegal Kacang, Sampiran 45171 Cirebon' ?>
                    <br>
                    Telpon : <?php echo ($profil !== null) ? $profil->telpon : '0231-2020211' ?> - Email : <?php echo ($profil !== null) ? $profil->email : 'ahanafi.id@gmail.com' ?> <br>
                </p>
            </div>
        </div>
        <div class='sub-header'>
            <h3><u>Laporan Kehadiran Pegawai</u></h3>
            <br>
            <p>Periode : <?= IDdateFormat($tanggal_awal); ?> s.d <?= IDdateFormat($tanggal_akhir); ?> </p>
        </div>
        
        <table class="table-data">
        	<thead>
        		<tr>
        			<th>No.</th>
        			<th>Kode Pegawai</th>
        			<th>Nama Pegawai</th>
        			<th>Jabatan</th>
        			<th>Tanggal</th>
        			<th>Jam Masuk</th>
        			<th>Jam Pulang</th>
        		</tr>
        	</thead>
        	<tbody>
        		<?php $no = 1; ?>
                <?php if(count($kehadiran) > 0): ?>
        		<?php foreach ($kehadiran as $k): ?>
        			<tr>
        				<td class="text-center"><?= $no++; ?></td>
        				<td><?= $k->kode_pegawai; ?></td>
        				<td><?= $k->nama_pegawai; ?></td>
        				<td><?= $k->nama_jabatan; ?></td>
        				<td class="text-center"><?= IDdateFormat($k->tanggal); ?></td>
        				<td class="text-center"><?= $k->jam_masuk; ?></td>
        				<td class="text-center"><?= $k->jam_pulang; ?></td>
        			</tr>
        		<?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">
                        Tidak Ada Data.
                    </td>
                </tr>
            <?php endif; ?>
        	</tbody>
        </table>    
        <!--div id='ttd'>
            <p>Cirebon, 2 Mei 2020</p>
            <img src='assets/img/tanda-tangan.png'>
        </div-->
        </div>
    </body>
</html>