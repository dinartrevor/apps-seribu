<div class="modal fade" id="modal-edit" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" id="form-edit" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id_edit">
            <div class="modal-body">
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="name" class="form-label">Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="name" id="name_edit" autocomplete="off" placeholder="Name">

                    </div>
                    <div class="col-4 mb-3">
                        <label for="email" class="form-label">Email <span class="text-red">*</span></label>
                        <input type="email" class="form-control"  name="email" id="email_edit" autocomplete="off" placeholder="Email">

                    </div>
                    <div class="col-4">
                        <label for="npm" class="form-label">NPM <span class="text-red">*</span></label>
                        <input type="text" class="form-control number-only" name="npm" id="npm_edit" autocomplete="off" placeholder="NPM">

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="role_id" class="form-label">Role <span class="text-red">*</span></label>
                        <select class="form-select"  name="role_id" id="role_id_edit" data-selectModalEditjs="true" data-placeholder="Role">

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
