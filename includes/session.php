<?php include('config.php');?>
<?php include('db.php');?>

<?php
//Start the session
session_start();

 if(isset($_POST['signin'])) {
	$username = htmlspecialchars($_POST['username']);
	$password=md5(htmlspecialchars($_POST['password']));
	 
 $_SESSION['username'] = $username;	 

 $username = $_SESSION['username']; 

 if(empty($username) || empty($password)) {
	$message .= '
			<div class="callout callout-danger">
				<h4><i class="icon fa fa-warning"></i> Error!</h4>
				All fields are required
			</div>
			';
  } 
  else {
	  $sql="SELECT email,password FROM members WHERE username=? AND password=?";
	  $stmt = $pdo->prepare($sql);   //Prepare
	  $stmt->execute([$username, $password]);  //Execute
	  $count = $stmt->rowCount();
	  $row = $stmt->fetchALL();
   
  if($count == 1) {
	$_SESSION['username'] = $username;
	$sql = "SELECT
				p.photo AS photo
			FROM
		   		members 
			LEFT JOIN
		    	profile p ON members.id=p.member_id
			WHERE
			  username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]);
	$row = $stmt->fetch();

	header("location:dashboard.php");
  } 
  else {
	$message .= '
			<div class="callout callout-danger">
				<h4><i class="icon fa fa-warning"></i> Error!</h4>
				Incorrect username or password
			</div>
		  ';
  }     
 }
}
?>