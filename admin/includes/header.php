<?php
    include('session.php');  

    // Redirect url to login page when not logged in
    if(!isset($_SESSION['adminame']) || trim($_SESSION['adminame']) == ''){
      header('location:login.php');
      exit();
    } 
    $sql = 'SELECT 
               *, p.photo AS photo 
            FROM 
               members 
            LEFT JOIN
               profile p ON members.id=p.member_id
             WHERE
              username =:username';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username'=>$_SESSION['adminame']]);
    $row = $stmt->fetch();    
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PU IT CLUB | Admin Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../bower_components/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../bower_components/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jquery-jvectormap.css">

   
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../bower_components/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>PU</b> IT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>PUIT</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- <i class="fa fa-bell-o"></i> -->
              <li class="hide-on-small-and-down"><a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button dropdown-right show-on-large">
<?php 
$isread=0;
$sql = "SELECT Id from dptmntsapplications where IsRead=:isread";
$query = $pdo -> prepare($sql);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$unreadcount=$query->rowCount();?>


<i class="fa fa-bell-o"></i><span class="badge"><?php echo htmlentities($unreadcount);?></span></a></li>



                                
                                <?php 
$isread=0;

// $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblleaves.PostingDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.IsRead=:isread";

$sql = "SELECT dptmntsapplications.Id as lid,members.username,members.id,dptmntsapplications.PostingDate from dptmntsapplications join members on dptmntsapplications.Id=members.id where dptmntsapplications.IsRead=:isread";
$query = $pdo -> prepare($sql);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<!-- 
                                    <li>
                                        <a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>">
                                        <div class="notification">
                                            <div class="notification-icon circle cyan"><i class="material-icons">done</i></div>
                                            <div class="notification-text"><p><b><?php echo htmlentities($result->username);?><br />(<?php echo htmlentities($result->id);?>)</b> applied for leave</p><span>at <?php echo htmlentities($result->PostingDate);?></span></div>
                                        </div>
                                        </a>
                                    </li> -->


                                     <!-- User Account: style can be found in dropdown.less -->
          <!-- <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
           
              <span class="hidden-xs"><?php echo htmlentities($result->lid); ?></span>
            </a>
            <ul class="dropdown-menu">
              
              <li class="user-header">
             
                <p>
                <?php echo htmlentities($result->username); ?> - Web Developer
                  <small>Member since <?php echo date('M d, Y', strtotime($row['username'])) ?></small>
                </p>
              </li>
            
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li> -->
          <!-- Control Sidebar Toggle Button -->

  
                                   <?php }} ?>

             
            </a>
            <ul class="dropdown-menu">
            
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg'; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $row['username']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <img src="<?php echo (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
                <p>
                <?php echo $row['username']; ?> - Web Developer
                  <small>Member since <?php echo date('M d, Y', strtotime($row['username'])) ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <img src="<?php echo (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $row['username']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li id="treevieww">
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="header">MANAGE</li>
        <li class="treeview" id="treeview">
        <!-- <li id="treeview"> -->
          <!-- <a href="departments.php">
            <i class="fa  fa-university"></i> <span>Departments</span>
          </a>
        </li> -->
          <a href="departments.php">
            <i class="fa fa-university"></i>
            <span>Departments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li id="treeview-menu"><a href="departments.php"><i class="fa fa-circle-o"></i> Departments</a></li>
            <li id="treeview-menu"><a href="applications.php"><i class="fa fa-circle-o"></i> Departments appplications</a></li>
            <!-- <li id="treeview-menu"><a href="department_members.php?row='.$row['id'].'  "><i class="fa fa-circle-o"></i> Web Development</a></li>
            <li id="treeview-menu"><a href="android.php"><i class="fa fa-circle-o"></i> Android Development</a></li>
            <li id="treeview-menu"><a href="cyber_security.php"><i class="fa fa-circle-o"></i> Cyber Security</a></li>
            <li id="treeview-menu"><a href="animation.php"><i class="fa fa-circle-o"></i> Animation</a></li>
            <li id="treeview-menu"><a href="hardware.php"><i class="fa fa-circle-o"></i> Hardware</a></li> -->
          </ul>
        </li>
        <li class="treeview" id="treeview">
          <a href="members.php">
            <i class="fa fa-users"></i> <span>Members</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="treeview-menu"><a href="members.php"><i class="fa fa-circle-o"></i> Members</a></li>
            <li id="treeview-menu"><a href="firstyear.php"><i class="fa fa-circle-o"></i> First Years</a></li>
            <li id="treeview-menu"><a href="secondyear.php"><i class="fa fa-circle-o"></i> Second Years</a></li>
            <li id="treeview-menu"><a href="thirdyear.php"><i class="fa fa-circle-o"></i> Third Years</a></li>
            <li id="treeview-menu"><a href="forthyear.php"><i class="fa fa-circle-o"></i> Forth Years</a></li>
            <li id="treeview-menu"><a href="other.php"><i class="fa fa-circle-o"></i> Other</a></li>
          </ul>
        </li>
        <li id="treeview">
          <a href="access_logs.php">
            <i class="fa fa-table"></i> <span>User Access Logs</span>
          </a>
        </li>
        <li id="treeview">
          <a href="change_password.php">
            <i class="fa   fa-lock"></i> <span>Admin Change Password</span>
          </a>
        </li>
  </aside>
 

  