<?php
    require_once '../config/helper.php';
    session_start();
    checkIsNotUser();
    $roles = getAllRole();
    $permissions = getAllPermission();
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
                                                <th scope="col">Created By</th>
                                                <th scope="col">Updated By</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            <?php if(!empty($roles)){
                                                foreach ($roles as $key => $role) {
                                            ?>
                                                <tr>
                                                    <td><?= $key + 1; ?></td>
                                                    <td><?= $role['name']; ?></td>
                                                    <td><?= $role['created_by']; ?></td>
                                                    <td><?= $role['updated_by']; ?></td>
                                                    <td><?= date('d-m-Y', strtotime($role['created_at'])); ?></td>
                                                   
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-gear-fill"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item edit" href="#" data-id="<?= $role['id']; ?>" data-url-update="<?= './../config/function/role_update.php' ?>" data-url="<?= './../config/function/role_edit.php' ?>">
                                                                    <em class="bi bi-pencil-fill open-card-option"></em>
                                                                        Edit
                                                                </a>
                                                                <a class="dropdown-item delete" data-url-destroy="<?= './../config/function/role_delete.php' ?>" data-id="<?= $role['id']; ?>">
                                                                    <em class="bi bi-trash-fill close-card"></em>
                                                                    Delete
                                                                </a>
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
				<?php include 'role/create.php' ?>
                <?php include 'role/edit.php' ?>
            </section>
        </main>
        <?php include '../layouts/footer.php'; ?>
        <?php include '../layouts/script.php'; ?>
        <script src='../assets/js/validationJs/role.js'></script>
        <script>
            $(document).ready(function () {
                $('.ModalallCheckbox').click(function(e){
                    let table= $(e.target).closest('table');
                    $('td input:checkbox',table).prop('checked',this.checked);
                });

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
                        if(response.permission.length > 0){
                            console.log
                            let html = '';
                            for (let i = 0; i < response.permission.length; i++) {
                                html += '<tr>'
                                html += '<td><input type="checkbox" class="modal_checbox" name="permission[]" value="'+response.permission[i].id+'" '+response.permission[i].checked+'></td>'
                                html += '<td>'+response.permission[i].name+'</td>'
                                html += '</tr>'
                            }
                            $('#tbody-permission').html(html);
                        }
                       if(response.status){
                            let data = response.data;
                            let roles = response.roles;
                            $('#id_edit').val(data.id);
                            $('#name_edit').val(data.name);

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
            });

        </script>
    </body>
</html>