<div class="modal fade" id="profile">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Profile</h4>
              </div>
              <div class="modal-body">
              <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

        <div class="form-group">
            <label for="Title">Username</label>
            <input type="text" id="Title" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="authot">Email</label>
            <input type="text" name="email" id="authot" class="form-control">
        </div>
        <div class="form-group">
            <label for="Title">Course</label>
            <input type="text" id="Title" name="cource" class="form-control">
        </div>
        <div class="form-group">
            <label for="year">Year of Study</label>
            <input type="text" name="year" id="year" class="form-control">
        </div>
        <div class="form-group">
            <label for="Title">Skills</label>
            <input type="text" id="Title" name="skills" class="form-control">
        </div>
        <div class="form-group">
            <label for="authot">Notes</label>
            <input type="text" name="notes" id="authot" class="form-control">
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