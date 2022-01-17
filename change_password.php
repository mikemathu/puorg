<?php
  include('includes/header.php');  

    $message = ' ';

    if(isset($_POST['submit'])){
        $password=$_POST['password'];
        $newpassword= md5(htmlspecialchars($_POST['newpassword']));
        $renewpassword=  md5(htmlspecialchars($_POST['renewpassword']));
        // $renewpassword=$_POST['renewpassword'];
        // $username=$_POST['username'];
        // $updatedate=date('d-m-Y h:i:s', time());
        $username= $_SESSION['username'];

    if(empty($password) || empty($newpassword) ||  empty($renewpassword)) {
       
        $message .= '
                <div class="alert alert-danger">
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                    All field are required
                 </div>
                <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
            ';
        } 
        else {
          if($newpassword != $renewpassword){
            $message =  'password never matched';
              $message .= '
                      <div class="alert alert-danger">
                          <h4><i class="icon fa fa-warning"></i> Error!</h4>
                      passwords did not match
                      </div>
                      <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
                    ';    
          } 
          else {
             
            $sql ='SELECT * FROM members WHERE username=:username AND password=:password';
            $stmt= $pdo->prepare($sql);
            $stmt->execute(['username' => $username,'password' => $password]);
            $row = $stmt->fetchAll();
            $rowCount = $stmt->rowCount();

            if($rowCount > 0){
                try{
                    
                    $sql = 'UPDATE members SET password =:newpassword WHERE username=:username';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['newpassword' => $newpassword,'username' => $username]);
                    echo 'Password successfully Updated';
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                    // header('location: '.$path);
                }
            } 
            else {
                $message .= '
                      <div class="alert alert-danger">
                          <h4><i class="icon fa fa-warning"></i> Error!</h4>
                          Your current password is wrong
                      </div>
                      <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
                          ';   
            }      
          } 
        } 
    }
?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Password
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="breadcrumb panel-body col-md-6">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

        <div class="form-group">
            <label for="Title">Old Password</label>
            <input type="text" id="oldpassword" name="password" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label for="authot">New Password</label>
            <input type="text" name="newpassword" id="newpassword" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label for="authot">Re-enter Password</label>
            <input type="text" name="renewpassword" id="renewpassword" class="form-control" disabled>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary" disabled>
        </div>
      </form>
      </div>
    </section>
</div>  

<?php include('includes/footer.php');?>