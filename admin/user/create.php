<div class="modal fade" id="modal-create" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="../../config/function/user_store.php" id="form-create" method="POST" enctype="multipart/form-data">
            <div class="modal-body">

                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="name" class="form-label">Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="Name">

                    </div>
                    <div class="col-6 mb-3">
                        <label for="email" class="form-label">Email <span class="text-red">*</span></label>
                        <input type="email" class="form-control"  name="email" id="email" autocomplete="off" placeholder="Email">

                    </div>
                    <div class="col-6">
                        <label for="password" class="form-label">Password <span class="text-red">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Password">

                    </div>
                    <div class="col-6">
                        <label for="npm" class="form-label">NPM <span class="text-red">*</span></label>
                        <input type="text" class="form-control number-only" name="npm" id="npm" autocomplete="off" placeholder="NPM">

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="role_id" class="form-label">Role <span class="text-red">*</span></label>
                        <select class="form-select"  name="role_id" id="role_id" data-selectModalCreatejs="true" data-placeholder="Role">
                            <option value="" selected disabled>Pilih Role</option>
                            <?php if(!empty($roles)){
                                    foreach($roles as $role){
                            ?>
                                <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>

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
