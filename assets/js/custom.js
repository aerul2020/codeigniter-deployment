const showConfirmLogout = () => {

    swal({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin akan keluar dari aplikasi ini?',
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
                text: "Ya, Keluar Sekarang!",
                value: true,
                visible: true,
                className: "btn-danger",
                closeModal: true
            }
        }
    }).then((value) => {
        if (value) {
            document.getElementById("form-logout").submit();
        }
    });
}