<div class="modal fade" id="addnew">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Member</h4>
              </div>
              <div class="modal-body">
              <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

        <div class="form-group">
            <label for="username">Username Name</label>
            <input type="text" id="username" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlFile1">Choose photo</label>
          <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
      </form>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <!-- DELETE MODAL -->
        <div class="modal modal-danger fade" id="delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Member</h4>
              </div>
              <div class="modal-body">
              <h2>Are you sure you want to delete this User?  </h2>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa  fa-check"></i> Ok</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <!-- EDIT PHOTO -->
        <div class="modal fade" id="edit_photo">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Member</h4>
              </div>
              <div class="modal-body">
              <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
          <label for="exampleFormControlFile1">Choose photo</label>
          <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
      </form>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>