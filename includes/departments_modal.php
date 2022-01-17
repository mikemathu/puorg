<?php
require_once('config.php');
require_once('db.php');
 
$message = '';



// Check for Submission
// if(isset($_POST['join'])){

//   header("location: dashboard.php");
//   // Get form data
//   $dptmtName = $_POST['dptmtname'];
//   $dptmtCode = $_POST['dptmtcode'];

//   $sql = 'SELECT * FROM tbldepartments WHERE DepartmentName = :dptmtName OR DepartmentCode = :dptmtCode';
//   $stmt = $pdo->prepare($sql);
//   $stmt->execute([$dptmtName,$dptmtCode]);
//   $row = $stmt->fetchAll();
//   $rowCount = $stmt->rowCount();

//   if($rowCount > 0){
//     $message .= '
//     <div class="alert alert-danger">
//               <h4><i class="icon fa fa-warning"></i> Error!</h4>
//               The department already exist!!
//           </div>
          
//   ';
// } else { header("location: dashboard.php");
//   try{
//     $sql="INSERT INTO tbldepartments(DepartmentName,DepartmentCode) VALUES(?,?)";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([$dptmtName,$dptmtCode]);
//     $count = $stmt->rowCount();

//     $lastInsertId = $pdo->lastInsertId();

// if($lastInsertId){
//   $message .= '
//         <div class="alert alert-success">
//                   <h4><i class="icon fa fa-check"></i> Success!</h4>
//                   Department <b>'.$email.'</b>  added succesfully
//               </div>
//               <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
//       ';

// }
//   }
//   catch(PDOException $e){
//     $message .= '
//     <div class="alert alert-danger">
//               <h4><i class="icon fa fa-warning"></i> Error!</h4>
//               '.$e->getMessage().'
//           </div>
//           <h4>You may <a href="signup.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
//   ';
//   }
 
// }

//  } 
      

if(isset($_POST['join']))
{
$user_name=$_SESSION['username'];
//  $department=$_POST['id'];
$id=$_COOKIE['ids'];
$status=0;
$isread=0;


             // Get member Id
             $stmt = $pdo->prepare("SELECT id FROM members WHERE username = :user_name");
             $stmt->execute([$user_name]);
             $row = $stmt->fetch();
           
             $user_id = $row['id'];

            //  check whether it exists
            $sql = 'SELECT * FROM dptmntsapplications WHERE Department = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
      // echo " Application exists";
        $message .= '
    <div class="alert alert-danger">
              <h4><i class="icon fa fa-warning"></i> Error!</h4>
              Application sent!!
          </div>      
  ';
  
  // echo $message;

    } else {

      
$sql="INSERT INTO dptmntsapplications(Status,IsRead,member_id,department) VALUES(?,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$status, $isread, $user_id,$id]);

$count = $stmt->rowCount();
      
$lastInsertId = $pdo->lastInsertId();

if($lastInsertId){
// $message .= '
//       <div class="callout callout-success">
//           <h4><i class="icon fa fa-check"></i> Success!</h4>
//           Account <b>'.$username.'</b> is activated. You can login <a href="login.php">here</a>
//       </div>                        
//   ';      


$msg="Leave applied successfully";
}
else 
{
$msg="Something went wrong. Please try again";
}
}

    }

    echo $msg=''; 


?>


        <div class="modal modal-info fade" id="join">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Join Department</h4>
              </div>
              <div class="modal-body">
              <form method="POST" action="">
              <h2>Are you sure you want to Join this department?</h2>
        
		 <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="join"><i class="fa fa-check"></i> Ok</button>
              </div>
      </form>
              </div>
             
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        

        