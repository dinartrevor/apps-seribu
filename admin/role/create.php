<div class="modal fade" id="modal-create" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../config/function/role_store.php" method="POST" id="form-create" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name <span class="text-red">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="Enter Your Name">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><input type="checkbox" class="form-check-input ModalallCheckbox" name="permission_multiple[]"></th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($permissions)){
                                    foreach($permissions as $value){
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input" id="permission" name="permission[]" value="<?= $value['id'] ?>">
                                        </td>
                                        <td>
                                            <label for="permission" class="form-check-label"><?= $value['name'] ?></label>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
