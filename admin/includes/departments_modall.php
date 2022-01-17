<?php
require_once('config.php');
require_once('db.php');
 
$message = '';

// Check for Submission
if(isset($_POST['add'])){

  echo 'set';
  // Get form data
  $dptmtName = $_POST['dptmtname'];
  $dptmtCode = $_POST['dptmtcode'];

  $sql = 'SELECT * FROM departments WHERE DepartmentName = :dptmtName OR DepartmentCode = :dptmtCode';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$dptmtName,$dptmtCode]);
  $row = $stmt->fetchAll();
  $rowCount = $stmt->rowCount();

  if($rowCount > 0){
    $message .= '
    <div class="alert alert-danger">
              <h4><i class="icon fa fa-warning"></i> Error!</h4>
              The department already exist!!
          </div>
          
  ';
} else {
  try{
    $sql="INSERT INTO departments(DepartmentName,DepartmentCode) VALUES(?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$dptmtName,$dptmtCode]);
    $count = $stmt->rowCount();

    $lastInsertId = $pdo->lastInsertId();

if($lastInsertId){
  $message .= '
        <div class="alert alert-success">
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                  Department <b>'.$email.'</b>  added succesfully
              </div>
              <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
      ';

}
  }
  catch(PDOException $e){
    $message .= '
    <div class="alert alert-danger">
              <h4><i class="icon fa fa-warning"></i> Error!</h4>
              '.$e->getMessage().'
          </div>
          <h4>You may <a href="signup.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
  ';
  }
 
}

 } 
      
      
       

       

        
       
     


?>

<div class="modal fade" id="addnew">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Department</h4>
              </div>
              <div class="modal-body">
              <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

        <div class="form-group">
            <label for="name">Department Name</label>
            <input type="text" id="name" name="dptmtname" class="form-control">
        </div>
        <div class="form-group">
            <label for="code">Department Code</label>
            <input type="text" name="dptmtcode" id="code" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlFile1">Choose Logo</label>
          <input type="file" name="logo" class="form-control-file" id="exampleFormControlFile1">
        </div>
      </form>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" name="add" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

      <!-- EDIT MODAL -->
        <div class="modal fade" id="edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Department</h4>
              </div>
              <div class="modal-body">
              <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

        <div class="form-group">
            <label for="Title">Department Name</label>
            <input type="text" id="Title" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="authot">Department Code</label>
            <input type="text" name="email" id="authot" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlFile1">Choose Logo</label>
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
                <h4 class="modal-title">Delete Department</h4>
              </div>
              <div class="modal-body">
              <h2>Are you sure you want to delete this department?</h2>
      </form>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-check"></i> Ok</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

           <!-- EDIT PHOTO -->
           <div class="modal fade" id="edit_logo">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Logo</h4>
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