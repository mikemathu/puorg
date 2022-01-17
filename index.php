<?php
if(!isset($_SESSION['username']) || trim($_SESSION['username']) == ''){
    header('location:login.php');
    exit();
  }