<?php include('config.php');?>
<?php include('db.php');?>

<?php
//Start the session
session_start();

 if(isset($_POST['signin'])) {
	$adminame = htmlspecialchars($_POST['adminame']);
	$password=($_POST['password']);	
 
	$_SESSION['adminame'] = $adminame;	 

	$adminame = $_SESSION['adminame'];

	if(empty($adminame) || empty($password)) {
		$message .= '
				<div class="callout callout-danger">
					<h4><i class="icon fa fa-warning"></i> Error!</h4>
					All fields are required
				</div>
				';
	} 
	else {
			$sql = "SELECT
						*
					FROM
							department_heads 
					LEFT JOIN
							members m ON department_heads.member_id=m.id
					WHERE
							username=? AND password=?";
		$stmt = $pdo->prepare($sql);   //Prepare
		$stmt->execute([$adminame, $password]);  //Execute
		$count = $stmt->rowCount();
		$row = $stmt->fetchALL();
	
		if($count == 1) {
				$sql = "SELECT
							*
						FROM
								department_heads 
						LEFT JOIN
								members m ON department_heads.member_id=m.id
						WHERE
							username=?";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([$adminame]);

				foreach($stmt as $row){
					$sql = "SELECT
								*,p.photo AS photo
							FROM
								department_heads 
							LEFT JOIN
								profile p ON department_heads.member_id=p.member_id";
					$stmt = $pdo->prepare($sql);
					$stmt->execute();
					
					$image = (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg';
					
					$status = (!$user['status']) ? '<a href="#block"  data-toggle="modal" class="btn btn-danger btn-xs">Block</a>' : '<a href="#unblock" class="btn btn-warning btn-xs"  data-toggle="modal">Unblock</a>';
				}

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