<?php
    include('includes/config.php');
    include('includes/db.php');

    include('includes/login-header.php');  
  
  $message = '';

  // Check for Submission
  if(isset($_POST['register'])){
    // Get form data
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = md5(htmlspecialchars($_POST['password']));    
    $repassword = md5(htmlspecialchars($_POST['repassword']));

    //set values of Profile Table to default
    $course = '';
$year = '';
$skills = ''; 
$notes = '';

    // Ensure the new user in not blocked
    $status = true;
   
    if(empty($email) || empty($password)) {
      $message .= '
            <div class="callout callout-danger">
                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                All fields are required
             </div>
          ';
      } 
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        // Failed
        $message .= '
              <div class="callout callout-danger">
                  <h4><i class="icon fa fa-warning"></i> Error!</h4>
                  Please use a valid email
              </div>
            ';
      }
      else {
        if($password != $repassword){
          $message .= '
            <div class="callout callout-danger">
                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                Passwords did not match
            </div>
          ';     
        }
        else {        
          $sql = 'SELECT * FROM members WHERE username = :username OR email = :email';
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$username,$email]);
          $row = $stmt->fetchAll();
          $rowCount = $stmt->rowCount();

          if($rowCount > 0){
            $message .= '
              <div class="callout callout-danger">
                  <h4><i class="icon fa fa-warning"></i> Error!</h4>
                  The username or email already exists!
              </div>
            ';
        } 
        else {
          try{
              $sql="INSERT INTO members(username,email,password,status) VALUES(?,?,?,?)";
              $stmt = $pdo->prepare($sql);
              $stmt->execute([$username, $email, $password, $status]);
              // $count = $stmt->rowCount();

              // echo $count;

              // Get new member Id
  $stmt = $pdo->prepare("SELECT id FROM members WHERE email = :email");
  $stmt->execute([$email]);
  $row = $stmt->fetch();

  $idd = $row['id'];


              // Insert into profile
              $sql="INSERT INTO profile(member_id,course,year_of_study,skills,notes) VALUES(?,?,?,?,?)";
              $stmt = $pdo->prepare($sql);
              $stmt->execute([$idd,$course, $year, $skills, $notes]);
              $count = $stmt->rowCount();
                    
              $lastInsertId = $pdo->lastInsertId();
        
            if($lastInsertId){
              $message .= '
                    <div class="callout callout-success">
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        Account <b>'.$username.'</b> is activated. You can login <a href="login.php">here</a>
                    </div>                        
                ';      
              }
          }
          catch(PDOException $e){
            $message .= '
            <div class="callout callout-danger">
                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                '.$e->getMessage().'
            </div>
          ';
          }        
        }        
      }   
   }
 }
?>

<?php include('includes/login-footer.php');?>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>PU</b> IT CLUB</a>
  </div>
  <?php echo $message; ?>
  <div class="register-box-body">
    <p class="login-box-msg">Register as a new member</p>

    <form action="" method="POST">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="repassword" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="terms.php">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="register">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
