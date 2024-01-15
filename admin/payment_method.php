<?php
	require_once '../config/helper.php';
    session_start();
	checkIsNotUser();
	$paymentMethods = getAllPaymentMethod();
?>
<!DOCTYPE html>
<html lang="en">
    <?php include '../layouts/head.php'; ?>
    <body class="d-flex flex-column min-vh-100">
        <?php include '../layouts/sidebar.php'; ?>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Metode Pembayaran</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Metode Pembayaran</li>
                    </ol>
                </nav>
            </div>
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                    <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['error']; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                                <?php unset($_SESSION['error']); ?>
                            <?php endif; ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title">Metode Pembayaran List</h5>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="d-flex justify-content-end">
                                            <!-- <button class="btn btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#modal-create">
                                                <i class="bi bi-plus-circle-fill"></i>  Create Metode Pembayaran
                                            </button> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Table with stripped rows -->
                                <div class="table-responsive">
                                    <table class="table table-striped" id="data-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Tipe</th>
                                                <th scope="col">Tanggal Buat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($paymentMethods)){
                                                foreach ($paymentMethods as $key => $paymentMethod) {
                                            ?>
                                                <tr>
                                                    <td><?= $key + 1; ?></td>
                                                    <td><?= $paymentMethod['name']; ?></td>
                                                    <td><?= $paymentMethod['type']; ?></td>
                                                    <td><?= date('d-m-Y', strtotime($paymentMethod['created_at'])); ?></td>
                                                </tr>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Table with stripped rows -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include '../layouts/footer.php'; ?>
        <?php include '../layouts/script.php'; ?>
        <script src='../assets/js/validationJs/user.js'></script>
        <script>
            $(document).ready(function () {
                <?php if(!empty($_SESSION['message_success'])): ?>
                    toastr.success('<?php echo $_SESSION['message_success']; ?>');
                    <?php unset($_SESSION['message_success']); ?>
                <?php endif; ?>

                <?php if(!empty($_SESSION['message_error'])): ?>
                    toastr.error('<?php echo $_SESSION['message_error']; ?>');
                    <?php unset($_SESSION['message_error']); ?>
                <?php endif; ?>
            });
        </script>

    </body>
</html>
