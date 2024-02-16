<?php
    require_once 'config/helper.php';
    session_start();
    checkIsUser();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Register - Apps Seribu</title>
        <meta content="Apps Seribu" name="description">
        <meta content="Apps Seribu" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/logo-sttb.jpg" rel="icon">
        <link href="assets/img/logo-sttb.jpg" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/vendor/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="assets/vendor/toastr/toastr.css">
        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">
        <style>
            .img-logo {
                padding: 0.25rem;
                background-color: transparent;
                border: transparent;
                border-radius: 0.25rem;
                max-width: 50%;
                height: auto;
                margin: 0 auto;
            }
        </style>
      </head>
	<body>
    <main>
        <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="#" class="d-flex align-items-center w-auto">
                    <img src="assets/img/logo-sttb.jpg" alt="Log In Megastore" class="img-logo">
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">

                            <?php  if (isset($_SESSION['error'])) : ?>
                                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                                    <strong><?= $_SESSION['error']; ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php unset($_SESSION['error']); ?>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['success'])) : ?>
                            <div class="alert alert-success text-light border-0 alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['success']; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                                <?php unset($_SESSION['success']); ?>
                            <?php endif; ?>
                            <h5 class="card-title text-center pb-0 fs-4">Buat sebuah akun</h5>
                            <p class="text-center small">Masukkan detail pribadi Anda untuk membuat akun</p>
                         </div>

                        <form action="config/function/register.php" method="post" class="row g-3 needs-validation" novalidate id="form-create">
                            <div class="col-12">
                                <label for="yourName" class="form-label">Nama</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control" autocomplate="off" id="name" placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">NPM</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        <i class="fas fa-file"></i>
                                    </span>
                                    <input type="text" name="npm" class="form-control number-only" autocomplate="off" id="npm" placeholder="NPM">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" autocomplate="off" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Password</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text toggle-password" toggle="#password-field" id="inputGroupPrepend">
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" autocomplate="off" id="password" placeholder="password">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                            </div>
                            <div class="col-12">
                                <p class="small mb-0">Sudah memiliki akun? <a href="login.php">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>

                </div>
            </div>
            </div>

        </section>

        </div>
    </main><!-- End #main -->
     <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
     <?php include 'layouts/script.php'; ?>
    <script src='assets/js/validationJs/register.js'></script>
    <script>
        $("body").on('click', '.toggle-password', function() {
            $(this).find("i").toggleClass("fa-eye-slash fa-eye");
            var passInput=$("#password");
            if(passInput.attr('type')==='password')
            {
                passInput.attr('type','text');
            }else{
                passInput.attr('type','password');
            }
        })
        $("body").on("keyup", ".number-only", function() {
            var regex = /^[0-9]+$/;
            if (regex.test(this.value) !== true) {
                this.value = this.value.replace(/[^0-9]+/, '');
            }
        });
    </script>
</body>

</html>
