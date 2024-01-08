<?php 
	require_once '../config/helper.php';
    session_start();
	checkIsNotUser();
?>
<!DOCTYPE html>
<html lang="en">
    <?php include '../layouts/head.php'; ?>
    <body class="d-flex flex-column min-vh-100">
        <?php include '../layouts/sidebar.php'; ?>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Role</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </nav>
            </div>
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title">Role List</h5>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#modal-create">
                                            <i class="bi bi-plus-circle-fill"></i>  Create Role
                                            </button>
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
                                                <th scope="col">Description</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Table with stripped rows -->
                            </div>
                        </div>
                    </div>
                </div>
				<?php include 'role/create.php' ?>
            </section>
        </main>
        <?php include '../layouts/footer.php'; ?>
        <?php include '../layouts/script.php'; ?>
    </body>
</html>