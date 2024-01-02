<div class="modal fade" id="modal-create" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Role</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               
                <div class="row">
                    <div class="col-md-12">
                        <label for="name" class="form-label">Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="Enter Your Name">
                      
                    </div>
                    <div class="col-md-12">
                        <label for="email" class="form-label">Description <span class="text-red">*</span></label>
                        <input type="email" class="form-control"  name="email" id="email" autocomplete="off" placeholder="Enter Your Email">
                     
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
