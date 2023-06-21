<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kehadiran Pegawai</title>
</head>
<style type="text/css">
    *{
        margin:0;
        padding:0;
        font-family: Arial, Helvetica, sans-serif;
    }

    #content{
        margin-right: 5%;
        margin-left: 5%;
        display: none;
    }

    #header{
        width: 100%;
        padding-bottom: 20px;
    }

    .logo img{
        width: 20%;
    }

    .report-title{
        float: right;
        margin-top: 50px;
        margin-right: 30px;
    }

    table{
        width: 100%;
        border:1px solid black;
        border-collapse: collapse;
    }

    table thead tr th,
    table tbody tr td{
        padding:5px;
        border: 1px solid black;
    }
    table thead{
        background-color:#0984db;
        color: #fff;
    }
    .clearfix{
        clear: both;
        float: none;
    }
    .center{
        text-align: center;
        vertical-align: middle;
    }
    #output {
        width: 100%;
        height: 100vh;
        background: rgba(193, 193, 193, 1);
        /* display: none; */
    }
</style>
<body>
    <div id="content">
        <div id="header">
            <div class="report-title">
                <h2>LAPORAN KEHADIRAN PEGAWAI</h2>
                <h2>PERIODE : 01-06-2020 s.d 30-06-2020</h2>
            </div>
            <div class="logo">
                <img id="img-logo" src="data:image/png;base64,<?= base64_encode($LOGO) ?>" alt="">
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="data-table">
            <table id="report-data">
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
                </tbody>
            </table>
        </div>
    </div>
    <object id="output" type="application/pdf">
        <p>It appears you don't have PDF support in this web browser. <a href="#" id="download-link">Click here to download the PDF</a>.</p>
    </object>
    <script src="<?= base_url('assets/modules/jspdf/jspdf.min.js'); ?>"></script>
    <script src="<?= base_url('assets/modules/jspdf/jspdf.autotable.js'); ?>"></script>
    <script>
        const doc = new jsPDF('l');

        function headerRows(){
            return [
            {
                no: 'No.',
                employee_code: 'NIP',
                fullname: 'Nama Lengkap',
                position: 'Jabatan',
                date: 'Tanggal',
                entry_time: 'Jam Masuk',
                out_time: 'Jam Pulang',
                add_info: 'Keterangan'
            }
            ]
        }

        doc.autoTable({
            html: '#report-data',
            head: headerRows(),
            theme: 'grid',
            headStyles: {
                fillColor: [9, 132, 219],
                fontSize: 14,
            },
            didDrawPage: (data) => {
                doc.setFontSize(18);
                doc.setTextColor(40);
                doc.setFontStyle('normal');
                const base64Img = "<?= base64_encode($LOGO) ?>";
                doc.addImage(base64Img, 'JPEG', data.settings.margin.left, 15, 70, 30);

            //Header
            doc.setFontStyle('bold')
            doc.text('UNIVERSITAS CATUR INSAN CENDEKIA', data.settings.margin.left + 80, 22)
            doc.setFontSize(14);
            doc.text('Terakreditasi Badan Akreditasi Nasional Perguruan Tinggi', data.settings.margin.left + 74, 30)
            doc.setFontSize(11);
            doc.text('Jl. Kesambi No. 202 Cirebon - 45133 Telp. (0231) 200418, 220250. Fax. (0231) 242112', data.settings.margin.left + 66, 36)
            doc.text('Website : http://www.cic.ac.id - Email : info@cic.ac.id', data.settings.margin.left + 90, 41)
            doc.text("____________________________________________________________________________________________________________________________", data.settings.margin.left, 49)


            //Report title
            doc.setFontStyle('bold');
            doc.setFontSize(16);
            doc.text('LAPORAN KEHADIRAN PEGAWAI', data.settings.margin.left + 80, 58)
            doc.setFontSize(14);
            doc.text('Periode : <?= $tanggal_awal; ?> s.d <?= $tanggal_akhir; ?>', data.settings.margin.left + 85, 65)
            },
            margin:{
                top: 70
        }
        });
        document.getElementById("output").data = doc.output('datauristring');
//doc.save('table.pdf');
</script>
</body>
</html>
