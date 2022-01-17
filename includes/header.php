<?php
 
  include('session.php');

  // Redirect url to login page when not logged in
  if(!isset($_SESSION['username']) || trim($_SESSION['username']) == ''){
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
    $stmt->execute(['username'=>$_SESSION['username']]);
    $row = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PU IT CLUB | User Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="bower_components/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="bower_components/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
  <link rel="stylesheet" href="bower_components/ionicons.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="dist/css/AdminLTE.min.css"> -->
  <link rel="stylesheet" href="bower_components/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="bower_components/_all-skins.min.css">
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="bower_components/morris.js/morris.css"> -->
  <link rel="stylesheet" href="bower_components/morris.css">
  <!-- jvectormap -->
  <!-- <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css"> -->
  <link rel="stylesheet" href="bower_components/jquery-jvectormap.css">
   
  <!-- Date Picker -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
  <link rel="stylesheet" href="bower_components/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <link rel="stylesheet" href="plugins/bootstrap3-wysihtml5.min.css">

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
      <span class="logo-lg"><b>User</b>PUIT</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/profile.jpg'; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $row['username']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <img src="<?php echo (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/profile.jpg'; ?>" class="img-circle" alt="User Image">
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
        <img src="<?php echo (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/profile.jpg'; ?>" class="img-circle" alt="User Image">
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
        <li id="treeview">
          <a href="departments.php">
            <i class="fa  fa-university"></i> <span>Departments</span>
          </a>
        </li>
          <!-- <a href="departments.php">
            <i class="fa fa-university"></i>
            <span>Departments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="treeview-menu"><a href="departments.php"><i class="fa fa-circle-o"></i> Departments</a></li>
            <li id="treeview-menu"><a href="webdev.php"><i class="fa fa-circle-o"></i> Web Development</a></li>
            <li id="treeview-menu"><a href="android.php"><i class="fa fa-circle-o"></i> Android Development</a></li>
            <li id="treeview-menu"><a href="cyber_security.php"><i class="fa fa-circle-o"></i> Cyber Security</a></li>
            <li id="treeview-menu"><a href="animation.php"><i class="fa fa-circle-o"></i> Animation</a></li>
            <li id="treeview-menu"><a href="hardware.php"><i class="fa fa-circle-o"></i> Hardware</a></li>
          </ul>
        </li> -->
        <li class="treeview" id="treeview">
          <a href="members.php">
            <i class="fa fa-users"></i> <span>Members</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="treeview-menu"><a href="members.php"><i class="fa fa-circle-o"></i> Members</a></li>
            <li id="treeview-menu"><a href="firstyear.php"><i class="fa fa-circle-o"></i> First Year</a></li>
            <li id="treeview-menu"><a href="secondyear.php"><i class="fa fa-circle-o"></i> Second Year</a></li>
            <li id="treeview-menu"><a href="thirdyear.php"><i class="fa fa-circle-o"></i> Third Year</a></li>
            <li id="treeview-menu"><a href="forthyear.php"><i class="fa fa-circle-o"></i> Forth Year</a></li>
            <li id="treeview-menu"><a href="other.php"><i class="fa fa-circle-o"></i> Other</a></li>
          </ul>
        </li>
        <li id="treeview">
          <a href="change_password.php">
            <i class="fa   fa-lock"></i> <span>Change Password</span>
          </a>
        </li>
  </aside>
  <script src="../js/index.js">  </script>