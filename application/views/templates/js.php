<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<!-- JS Libraies -->
<script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/page/modules-sweetalert.js"></script>
<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/axios.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/faceapi/face-api.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Responsive-2.2.1/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Responsive-2.2.1/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>

<?php if ($this->uri->segment(1) === 'dashboard'): ?>
    <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
    <script>
        const ctx = document.getElementById("attendance-chart").getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(getMonth(null, 'long')) ?>,
                datasets: [{
                    label: 'Statistics',
                    data: <?php echo json_encode($total_kehadiran_per_tahun) ?>,
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
    </script>
<?php endif; ?>


<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWqffhGu-f9WUyhxJT-4nqtF-CBS4HYOs"></script>
<script src="<?php echo base_url(); ?>assets/modules/gmaps.js"></script>
<?php if ($this->uri->segment(1) === "kehadiran" && $this->uri->segment(2) === "detail"): ?>
    <script>
        const userLongitude = document.querySelector('#user-longitude').value;
        const userLatitude = document.querySelector('#user-latitude').value;

        // initialize map
        const map = new GMaps({
            div: '#map',
            lat: parseFloat(userLatitude),
            lng: parseFloat(userLongitude),
            zoom: 13
        });

        map.addMarker({
            lat: parseFloat(userLatitude),
            lng: parseFloat(userLongitude),
            draggable: true,
        });
    </script>
<?php endif ?>

<?php if ($this->uri->segment(1) === 'profil-perusahaan' && $this->uri->segment(2) === "edit"): ?>
    <script src="<?php echo base_url(); ?>assets/js/page/gmaps-draggable-marker.js"></script>
<?php endif; ?>

<?php if ($this->uri->segment(2) === "capture"): ?>
    <script src="<?php echo base_url(); ?>assets/js/capture.js"></script>
<?php elseif ($this->uri->segment(2) === "test-recognize"): ?>
    <script src="<?php echo base_url(); ?>assets/js/test-recognize.js"></script>
<?php endif; ?>

<script>
    const showConfirmDelete = (dataType, dataId) => {
        if (dataType !== '' && dataId !== '') {
            swal({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin akan menghapus data ini?',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: "Batalkan",
                        value: null,
                        visible: true,
                        className: "btn-secondary",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Ya, Hapus!",
                        value: true,
                        visible: true,
                        className: "btn-danger",
                        closeModal: true
                    }
                }
            }).then((value) => {
                if (value) {
                    const form = document.getElementById("delete");
                    const actionURL = `<?= base_url(); ?>${dataType}/delete/${dataId}`;

                    const type = document.querySelector("input[name=data_type]");
                    const id = document.querySelector("input[name=data_id]");

                    type.value = dataType;
                    id.value = dataId;
                    form.setAttribute('action', actionURL);
                    form.submit();
                }
            });

        }
    }

    if ($("#data-table")) {
        $("#data-table").dataTable({
            responsive: true,
        });
    }

    <?php if(isset($_GET['show_modal']) && $_GET['show_modal'] === 'true'): ?>
    $("#form-upload-modal").modal('show');
    <?php endif; ?>
</script>
<?php if (isset($_SESSION['message']) && $_SESSION['message'] !== ''): ?>
    <script>
        swal({
            title: '<?php echo ucfirst($_SESSION['message']['type']); ?>',
            text: '<?php echo $_SESSION['message']['text']; ?>',
            icon: '<?php echo $_SESSION['message']['type']; ?>',
            timer: 2000
        });
    </script>
<?php endif;
$_SESSION['message'] = ''; ?>
</body>
</html>