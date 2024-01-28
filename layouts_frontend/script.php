  <!-- Script Bootstrap -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/sweetalert2/sweetalert2.min.js"></script>
<script>
    $(document).ready(function () {
        if($("#isVerify").val() != ""){
            Swal.fire({
                title: "Akun Anda Belum Di Verifikasi Admin !!",
                icon: "warning"
            });
        }
    });
</script>