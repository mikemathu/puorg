<?php
require_once('config.php');
require_once('db.php');

$message = '';

// Check for Submission
if (isset($_POST['save'])) {

    // Get form data
    $dptmtName = $_POST['dptmtName'];
    $deptHead = $_POST['head'];
    $logo=$_POST['logo'];

    $sql = 'SELECT * FROM departments WHERE name = :dptmtName';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$dptmtName]);
    $row = $stmt->fetch();
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        $message .= '
    <div class="alert alert-danger">
              <h4><i class="icon fa fa-warning"></i> Error!</h4>
              The department already exist!!
          </div>      
  ';
    } else {
        try {
            //insert dept departments
            $sql = "INSERT INTO departments(name,photo) VALUES(?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$dptmtName,$logo]);
          
            //insert dept head
            $stmt = $pdo->prepare("INSERT INTO department_heads (member_id,dept_id)VALUES(?,?)");
            $stmt->execute([$deptHead, $row['id']]);
            $count = $stmt->rowCount();

            $lastInsertId = $pdo->lastInsertId();

             if($lastInsertId){
              $message .= '
                    <div class="alert alert-success">
                              <h4><i class="icon fa fa-check"></i> Success!</h4>
                              Department <b>'.$dptmtName.'</b>  added succesfully
                          </div>
                          <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
                  ';

            } 
        } catch (PDOException $e) {
            $message .= '
    <div class="alert alert-danger">
              <h4><i class="icon fa fa-warning"></i> Error!</h4>
              ' . $e->getMessage() . '
          </div>
          <h4>You may <a href="signup.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
  ';
        }

    }

}

// Name edit
if (isset($_POST['edit'])){
    $deptNameU=$_POST['deptNameU'];
    $id=$_COOKIE['ids'];
    $stmt = $pdo->prepare("UPDATE departments SET name=? WHERE id=?");
    $stmt->execute([$deptNameU,$id]);
    ?>
    <script>
        document.querySelector('input[name=edit]').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.reload();
        });
    </script>
<?php
}

// delete
if (isset($_POST['delete'])){
    $id=$_COOKIE['ids'];
    $stmt = $pdo->prepare("DELETE FROM departments WHERE id=?");
    $stmt->execute([$id]);
    ?>
    <script>
        document.querySelector('input[name=delete]').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.reload();
        });
    </script>
<?php
}

// logo edit
if (isset($_POST['edit_logo'])){
    $logo=$_POST['logo'];
    $id=$_COOKIE['ids'];
    $stmt = $pdo->prepare("UPDATE departments SET photo=? WHERE id=?");
    $stmt->execute([$logo,$id]);
    ?>
    <script>
        document.querySelector('input[name=edit_logo]').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.reload();
        });
    </script>
<?php
}
    ?>

    <script>
        document.querySelector('input[name=edit_logo]').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.reload();
        });
    </script>
<?php
// }
?>

<!-- ADD NEW MODAL -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Department</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">

                    <div class="form-group">
                        <label for="name">Department Name</label>
                        <input type="text" id="name" name="dptmtName" class="form-control" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="code">Department Head</label>
                        <select class="form-control" name="head" required>
                            <?php
                            $stmt = $pdo->prepare("SELECT * FROM members");
                            $stmt->execute();
                            foreach ($stmt as $row) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['email']; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Choose Logo</label>
                        <input type="file" name="logo" class="form-control-file" id="exampleFormControlFile1">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                            class="fa fa-close"></i> Close
                </button>
                <button type="submit" name="save" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save
                </button>
            </div>
            </form>
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
                <form method="POST" action="">

                    <div class="form-group">
                        <label for="Title">Department Name</label>
                        <input type="text" id="Title" name="deptNameU" class="form-control" Placeholder="Enter New Name...">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                    class="fa fa-close"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat" name="edit"><i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- Delete Modal -->
<div class="modal modal-danger" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Department</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">

                <h2>Are you sure you want to delete this Department?</h2>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                    class="fa fa-close"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat" name="delete"><i class="fa fa-check"></i> Yes
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- EDIT logo  -->
<div class="modal fade" id="edit_logo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Department</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Choose Logo</label>
                        <input type="file" id="exampleFormControlFile1" name="logo" class="form-control-file"  >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                    class="fa fa-close"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat" name="edit_logo"><i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

