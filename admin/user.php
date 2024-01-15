<?php
	require_once '../config/helper.php';
    session_start();
	checkIsNotUser();
    $roles = getAllRole();
    $users = getAllUser();
?>
<!DOCTYPE html>
<html lang="en">
    <?php include '../layouts/head.php'; ?>
    <body class="d-flex flex-column min-vh-100">
        <?php include '../layouts/sidebar.php'; ?>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>User</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                                        <h5 class="card-title">User List</h5>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#modal-create">
                                            <i class="bi bi-plus-circle-fill"></i>  Create User
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
                                                <th scope="col">Email</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">NPM</th>
                                                <th scope="col">Tanggal Buat</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($users)){
                                                foreach ($users as $key => $user) {
                                            ?>
                                                <tr>
                                                    <td><?= $key + 1; ?></td>
                                                    <td><?= $user['name']; ?></td>
                                                    <td><?= $user['email']; ?></td>
                                                    <td><?= $user['role_name']; ?></td>
                                                    <td><?= $user['npm']; ?></td>
                                                    <td><?= date('d-m-Y', strtotime($user['created_at'])); ?></td>
                                                    <td>
                                                        <?php if($user['status'] == 0){ ?>
                                                                <span class="badge bg-warning">Pending</span>
                                                        <?php }elseif($user['status'] == 1){ ?>
                                                            <span class="badge bg-success">Approval</span>
                                                        <?php }else{ ?>
                                                            <span class="badge bg-danger">Not Active</span>
                                                        <?php }?>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-gear-fill"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item edit" href="#" data-id="<?= $user['id']; ?>"  data-url-update="<?= './../config/function/user_update.php' ?>" data-url="<?= './../config/function/user_edit.php' ?>">
                                                                    <em class="bi bi-pencil-fill open-card-option"></em>
                                                                        Edit
                                                                </a>
                                                                <a class="dropdown-item delete" data-url-destroy="<?= './../config/function/user_delete.php' ?>" data-id="<?= $user['id']; ?>">
                                                                    <em class="bi bi-trash-fill close-card"></em>
                                                                    Delete
                                                                </a>
                                                                <?php if($user['status'] != 1): ?>
                                                                <a class="dropdown-item verify" data-url-verify="<?= './../config/function/user_verify.php' ?>" data-id="<?= $user['id']; ?>" data-status="1">
                                                                    <em class="bi bi-check2-all close-card"></em>
                                                                    Verifikasi
                                                                </a>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>

                                                    </td>
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
				<?php include 'user/create.php' ?>
				<?php include 'user/edit.php' ?>
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

                $('#data-table tbody').on('click', '.edit', function () {
                    var id = $(this).data('id');
                    var url = $(this).data('url-update');
                    var url_hit = $(this).data('url');
                    $.ajax({
                        url: url_hit,
                        type: 'GET',
                        data : {
                            id : id
                        }
                    }).done(function (response) {
                       response = JSON.parse(response);
                       if(response.status){
                            let data = response.data;
                            let roles = response.roles;
                            $('#id_edit').val(data.id);
                            $('#name_edit').val(data.name);
                            $('#email_edit').val(data.email);
                            $('#npm_edit').val(data.npm);
                            if(roles.length > 0){
                                let html = ``;
                                for (let i = 0; i < roles.length; i++) {
                                    html +=`<option value="${roles[i].id}" ${roles[i].selected}>${roles[i].name}</option>`
                                }
                                $('#role_id_edit').html(html);
                            }

                            $("#form-edit").attr('action', url);
                            $('#modal-edit').modal('show');
                        }
                    })
                    .fail(function () {
                        console.log("error");
                    });
                });
                $('#data-table tbody').on('click', '.delete', function () {
                    let id = $(this).data('id');
                    let url = $(this).data('url-destroy');
                    Swal.fire({
                        title: "Are you sure delete it?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                    }).then((result) => {
                        if (result.isConfirmed){
                            $.ajax({
                                url: url,
                                type: "POST",
                                data: {
                                    "id": id,

                                },
                                success: function (response) {
                                    response = JSON.parse(response);
                                    if(response.status){
                                        Swal.fire("Done!", "It was succesfully deleted!", "success").then(function(){
                                            location.reload();
                                        });
                                    }else{
                                        Swal.fire("Error deleting!", "Please try again", "error").then(function(){
                                            location.reload();
                                        });
                                    }
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    Swal.fire("Error deleting!", "Please try again", "error").then(function(){
                                        location.reload();
                                    });
                            }
                            });
                        }
                    });
                });
                $('#data-table tbody').on('click', '.verify', function () {
                    var id = $(this).data('id');
                    var url = $(this).data('url-verify');
                    let status = $(this).data('status');
                    Swal.fire({
                        title: "Are you sure to verify it?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                    }).then((result) => {
                        if (result.isConfirmed){
                            $.ajax({
                                url: url,
                                type: "POST",
                                data: {
                                    "id": id,
                                    "status": status
                                },
                                success: function (response) {
                                    response = JSON.parse(response);
                                    if(response.status){
                                        Swal.fire("Done!", "It was succesfully Verify!", "success").then(function(){
                                            location.reload();
                                        });
                                    }else{
                                        Swal.fire("Error deleting!", "Please try again", "error").then(function(){
                                            location.reload();
                                        });
                                    }
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    Swal.fire("Error deleting!", "Please try again", "error").then(function(){
                                        location.reload();
                                    });
                            }
                            });
                        }
                    });
                });


            });
        </script>

    </body>
</html>
