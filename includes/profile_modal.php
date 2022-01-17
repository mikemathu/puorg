<?php  

// Name edit
if (isset($_POST['save'])){
// get session
$user_name= $_SESSION['username'];

  // $name=$_POST['name'];
  // $email=$_POST['email'];
  $course=$_POST['course']; 
  $year=$_POST['year'];
  $skills=$_POST['skills'];
  $notes=$_POST['notes'];
  $photo=$_POST['photo'];

  // Get user Id
  $stmt = $pdo->prepare("SELECT id FROM members WHERE username = :user_name");
  $stmt->execute([$user_name]);
  $row = $stmt->fetch();

  $id = $row['id'];
  // return $stmt;
  // echo $iddd;

  // update tbl profile
  $stmt = $pdo->prepare("UPDATE profile SET course=? ,year_of_study=?, skills=?, notes=?, photo=? WHERE member_id=?");
  $stmt->execute([$course,$year,$skills,$notes, $photo, $id]);


  $message .= '
				<div class="callout callout-danger">
					<h4><i class="icon fa fa-warning"></i> Error!</h4>
					Incorrect username or password
				</div>
				';
  ?>
  <script>
      document.querySelector('input[name=save]').addEventListener('click', function(e) {
          e.preventDefault();
          window.location.reload();
      });
  </script>
<?php
}

?>


<div class="modal fade" id="profile">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Profile</h4>
              </div>
              <div class="modal-body">
              <form method="POST" action="">

        <div class="form-group">
            <label for="Title">Username <?php echo $_SESSION['username'];; ?></label>
            <input type="text" id="title" name="name"  class="form-control" placeholder="<?php echo $_SESSION['username'] ?> " disabled>
        </div>
        <div class="form-group">
        
        <?php  
        // Get User Name
        $user_name= $_SESSION['username'];
        // Get user email
  $stmt = $pdo->prepare("SELECT email FROM members WHERE username = :user_name");
  $stmt->execute([$user_name]);
  $row = $stmt->fetch();

  $email = $row['email'];
        
        ?>
            <label for="authot">Email</label>
            <input type="text" name="email" id="authot" class="form-control" placeholder="Enter..." disabled>
        </div>
        <div class="form-group">
            <label for="Title">Course</label>
            <input type="text"  name="course"  id="title" class="form-control">
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
          <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1">
        </div>
		 <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="save"><i class="fa fa-save"></i> Save</button>
              </div>
      </form>
              </div>
             
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


  